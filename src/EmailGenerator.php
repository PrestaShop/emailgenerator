<?php

namespace PrestaShop\EmailGenerator;

use Exception;
use CSSIN;
use Html2Text;

global $EMAIL_TRANSLATIONS_DICTIONARY;
$EMAIL_TRANSLATIONS_DICTIONARY = array();

require_once 'functions.php';

class EmailGenerator
{
    protected $paths;
    protected $isoCodes;

    protected static $_rtl_langs = array('fa', 'ar', 'he', 'ur', 'ug', 'ku');
    protected static $_lang_default_font = array(
        'fa' => 'Tahoma',
        'ar' => 'Tahoma',
    );

    public function __construct($emailTargetPath)
    {
        $this->paths = [
            'root' => dirname(__DIR__),
            'target' => $emailTargetPath,
        ];

        require_once $this->paths['root'].'/vendor/cssin/cssin.php';
        require_once $this->paths['root'].'/vendor/html_to_text/Html2Text.php';

        $this->isoCodes = ['en', 'fr'];
    }

    public static function humanizeString($str)
    {
        return implode(' ', array_map('ucfirst', preg_split('/[_\-]/', $str)));
    }

    private function relativePath($path)
    {
        return substr($path, strlen($this->paths['root']) + 1);
    }

    private function getEmailTemplateList()
    {
        static $templates = null;

        if ($templates !== null) {
            return $templates;
        }

        $templates = array('core' => array(), 'modules' => array());

        $core_dir = $this->paths['root'].'/templates/core';
        if (is_dir($core_dir)) {
            foreach (scandir($core_dir) as $entry) {
                $path = $core_dir.'/'.$entry;

                if (preg_match('/\.php$/', $entry)) {
                    $templates['core'][] = array(
                        'path' => $this->relativePath($path),
                        'name' => self::humanizeString(basename($entry, '.php')),
                    );
                }
            }
        }

        $module_dir = $this->paths['root'].'/templates/modules';
        if (is_dir($module_dir)) {
            foreach (scandir($module_dir) as $module) {
                $dir = $module_dir.'/'.$module;

                if (!preg_match('/^\./', $module) && is_dir($dir)) {
                    $templates['modules'][$module] = array();

                    foreach (scandir($dir) as $entry) {
                        $path = $dir.'/'.$entry;
                        if (preg_match('/\.php$/', $entry)) {
                            $templates['modules'][$module][] = array(
                                'path' => $this->relativePath($path),
                                'name' => self::humanizeString(basename($entry, '.php')),
                            );
                        }
                    }
                }
            }
        }

        return $templates;
    }

    private function quote($str)
    {
        return '\''.str_replace("\n", '', preg_replace('/\\\*\'/', '\\\'', $str)).'\'';
    }

    public function generateAllEmails()
    {
        $templates = $this->getEmailTemplateList();

        foreach ($this->isoCodes as $language) {
            foreach ($templates['core'] as $file) {
                $target_path = $this->paths['target'].'/mails/'.$language.'/'.basename($file['path'], '.php');
                $this->generateEmail($file['path'], $target_path, $language);
            }
            foreach ($templates['modules'] as $module => $files) {
                foreach ($files as $file) {
                    $target_path = $this->paths['target'].$module.'/mails/'.$language.'/'.basename($file['path'], '.php');
                    $this->generateEmail($file['path'], $target_path, $language);
                }
            }
        }

        dump('Done!');
    }

    private function textify($html)
    {
        $html = str_get_html($html);
        foreach ($html->find("[data-html-only='1'],html-only") as $kill) {
            $kill->outertext = '';
        }
        $converter = new Html2Text((string) $html);

        $converter->search[] = '#</p>#';
        $converter->replace[] = "\n";

        $txt = $converter->get_text();

        $txt = preg_replace('/^\s+/m', "\n", $txt);
        $txt = preg_replace_callback('/\{\w+\}/', function ($m) {
            return strtolower($m[0]);
        }, $txt);

        // Html2Text will treat links as relative to the current host. We don't want that!
        // (because of links like <a href='{shop_url}'></a>)
        if (!empty($_SERVER['HTTP_HOST'])) {
            $txt = preg_replace('#\w+://'.preg_quote($_SERVER['HTTP_HOST']).'/?#i', '', $txt);
        }

        return $txt;
    }

    public function getCSS($path)
    {
        if (!file_exists($path)) {
            throw new Exception('Could not find CSS file: '.$path);
        }
        return file_get_contents($path);
    }

    private function generateEmail($template, $targetPath, $languageCode)
    {
        if (!preg_match('#^templates/(core/[^/]+|modules/[^\./]+/[^/]+)$#', $template)) {
            throw new Exception('NAH, wrong template name.');
        }
        @ini_set('display_errors', 'on');
        static $cssin;

        if (!$cssin) {
            $cssin = new CSSIN();

            $cssin->setCSSGetter(array($this, 'getCSS'));
        }

        global $EMAIL_TRANSLATIONS_DICTIONARY;
        $dictionary_path = $this->paths['root'].'/translations/'.$languageCode.'/lang_content.php';
        if (file_exists($dictionary_path)) {
            $EMAIL_TRANSLATIONS_DICTIONARY = include $dictionary_path;
        } else {
            $EMAIL_TRANSLATIONS_DICTIONARY = array();
        }

        $emailPublicWebRoot = $this->paths['root'].'/templates/';
        $emailLangIsRTL = in_array($languageCode, self::$_rtl_langs); // see header.php
        $emailDefaultFont = '';
        if (array_key_exists($languageCode, self::$_lang_default_font)) {
            $emailDefaultFont = (self::$_lang_default_font[$languageCode]).',';
        }

        if (dirname($template) !== 'templates/core') {
            set_include_path($this->paths['root'].'/templates/core:'.get_include_path());
        }

        ob_start();

        include $this->paths['root'].'/'.$template;
        $raw_html = ob_get_clean();

        $output_basename = $this->getBaseOutputName($template, $languageCode);
        if ($output_basename === false) {
            throw new Exception($this->l('Template name is invalid.'));
        }
        $html_for_html = str_get_html($raw_html, true, true, DEFAULT_TARGET_CHARSET, false, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
        foreach ($html_for_html->find("[data-text-only='1']") as $kill) {
            $kill->outertext = '';
        }
        foreach ($html_for_html->find('html-only') as $node) {
            $node->outertext = $node->innertext;
        }

        $html_for_html = (string) $html_for_html;

        $html = $cssin->inlineCSS(null, $html_for_html);
        $text = $this->textify($raw_html);

        $write = array(
            $output_basename.'.txt' => $text,
            $output_basename.'.html' => $html,
        );

        foreach ($write as $path => $data) {
            $dir = dirname($path);
            if (!is_dir($dir)) {
                if (!@mkdir($dir, 0777, true)) {
                    throw new Exception($this->l('Could not create directory to write email to.'));
                }
            }
            if (!@file_put_contents($path, $data)) {
                throw new Exception($this->l('Could not write email file: '.$path));
            }
        }

        return array('html' => $html, 'text' => $text);
    }

    private function getTranslations($path)
    {
        if (file_exists($path)) {
            global $_LANGMAIL;
            $old = $_LANGMAIL;

            include $path;
            $dictionary = $_LANGMAIL;
            $_LANGMAIL = $old;

            return $dictionary;
        } else {
            return array();
        }
    }

    private static function unquote($string)
    {
        return preg_replace(array('/(?:^[\'"]|[\'"]$)/', '/\\\+([\'"])/'), array('', '\1'), $string);
    }

    private function getBaseOutputName($template, $languageCode)
    {
        $m = array();
        if (preg_match('#^templates/core/[^/]+\.php$#', $template)) {
            return $this->paths['target'].'/mails/'.$languageCode.'/'.basename($template, '.php');
        } elseif (preg_match('#^templates/modules/([^/]+)/(?:[^/]+)\.php$#', $template, $m)) {
            return $this->paths['target'].'/'.$m[1].'/mails/'.$languageCode.'/'.basename($template, '.php');
        } else {
            return false;
        }
    }
}
