<?php

namespace PrestaShop\EmailGenerator;

use Exception;
use CSSIN;

global $EMAIL_TRANSLATIONS_DICTIONARY;
$EMAIL_TRANSLATIONS_DICTIONARY = array();
// Function to put the translations in the templates
function t($str)
{
    global $EMAIL_TRANSLATIONS_DICTIONARY;

    if (isset($EMAIL_TRANSLATIONS_DICTIONARY[$str]) && trim($EMAIL_TRANSLATIONS_DICTIONARY[$str]) !== '') {
        return $EMAIL_TRANSLATIONS_DICTIONARY[$str];
    } else {
        return $str;
    }
}

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

    public function dictionaryToArray($name, $data, $global = true)
    {
        $str = "<?php\n\n";
        if ($global) {
            $str .= 'global $'.$name.";\n";
        }
        $str .= '$'.$name." = array();\n\n";

        foreach ($data as $key => $value) {
            if (trim($value) != '') {
                $str .= '$'.$name.'['.$this->quote($key).'] = '.$this->quote($value).";\n";
            }
        }

        $str .= "\n\nreturn ".'$'.$name.";\n";

        return $str;
    }

    public function writeTranslations($data)
    {
        foreach ($data as $relFilePath => $newTranslations) {
            if (($absPath = $this->isValidTranslationFilePath($relFilePath)) !== false) {
                $currentTranslations = $this->getTranslations($absPath);
                $translations = array_merge($currentTranslations, $newTranslations);
                $phpArray = $this->dictionaryToArray('_LANGMAIL', $translations);
                $dir = dirname($absPath);
                if (!is_dir($dir)) {
                    if (!@mkdir($dir, 0777, true)) {
                        return $this->l('Could not create directory: ').dirname($relFilePath);
                    }
                }
                $fh = fopen($absPath, 'w');
                if (!$fh) {
                    return $this->l('Could not open for writing: ').$relFilePath;
                }
                if (flock($fh, LOCK_EX)) {
                    fwrite($fh, $phpArray);
                    fflush($fh);
                    flock($fh, LOCK_UN);
                    fclose($fh);
                } else {
                    return $this->l('Could not acquire lock on translation file.');
                }
            } else {
                return $this->l('Invalid translation file path: ').$relFilePath;
            }
        }

        return true;
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

    private function getCSS($url)
    {
        dump($url); die;
        $webRoot = Tools::getShopDomain(true).__PS_BASE_URI__;
        if (strpos($url, $webRoot) === 0) {
            $path = _PS_ROOT_DIR_.'/'.substr($url, strlen($webRoot));
            if (!file_exists($path)) {
                throw new Exception('Could not find CSS file: '.$path);
            }
            return file_get_contents($path);
        } else {
            throw Exception('Dont\'t know how to get CSS: '.$url);
        }
    }

    private function generateEmail($template, $languageCode)
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
        $dictionary_path = dirname(__FILE__).'/templates_translations/'.$languageCode.'/lang_content.php';
        if (file_exists($dictionary_path)) {
            $EMAIL_TRANSLATIONS_DICTIONARY = include $dictionary_path;
        } else {
            $EMAIL_TRANSLATIONS_DICTIONARY = array();
        }

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

//    private function currentLanguageCode()
//    {
//        if (($languageCode = Tools::getValue('languageCode')) && preg_match('/[a-z]{2}/', $languageCode)) {
//            return $languageCode;
//        } else {
//            return $this->context->language->iso_code;
//        }
//    }

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

    private function getBodyTranslations($languageCode)
    {
        $path = dirname(__FILE__).'/templates_translations/'.$languageCode.'/lang_content.php';

        return $this->getTranslations($path);
    }

    private function getSubjectTranslations($languageCode)
    {
        $path = _PS_MAIL_DIR_.$languageCode.'/lang.php';

        return $this->getTranslations($path);
    }

    private static function unquote($string)
    {
        return preg_replace(array('/(?:^[\'"]|[\'"]$)/', '/\\\+([\'"])/'), array('', '\1'), $string);
    }

    private static function recListPSPHPFiles($dir)
    {
        foreach (array(_PS_CACHE_DIR_, _PS_TOOL_DIR_) as $skip) {
            if (preg_replace('#/$#', '', $skip) === preg_replace('#/$#', '', $dir)) {
                return array();
            }
        }

        $paths = array();

        if (is_dir($dir)) {
            foreach (scandir($dir) as $entry) {
                if (!preg_match('/^\./', basename($entry))) {
                    $path = $dir.'/'.$entry;
                    if (is_dir($path)) {
                        $paths = array_merge($paths, self::recListPSPHPFiles($path));
                    } elseif (preg_match('/\.php$/', $entry)) {
                        $paths[] = $path;
                    }
                }
            }
        }

        return $paths;
    }

    private function extractEmailStrings($template, $language)
    {
        $id = 0;

        require_once dirname(__FILE__).'/vendor/simple_parsers/classes/SimplePHPFunctionCallParser.php';
        $data = file_get_contents(dirname(__FILE__).'/'.$template);
        $parser = new SimplePHPFunctionCallParser('t');

        $body_strings = $parser->parse($data);
        $body_translations = $this->getBodyTranslations($language);

        $body = array();
        foreach ($body_strings as $str) {
            $str = self::unquote($str[0]);
            if (isset($body_translations[$str])) {
                $translation = $body_translations[$str];
            } else {
                $translation = '';
            }

            $body[$str] = array(
                'translation' => $translation,
                'id' => ++$id,
                'file' => 0,
            );
        }

        $subject_strings = array();
        $potential_subject_strings = array();

        foreach (self::recListPSPHPFiles(_PS_ROOT_DIR_) as $path) {
            $sendParser = new SimplePHPFunctionCallParser('Mail\s*::\s*Send');
            $sends = $sendParser->parse(file_get_contents($path));
            if (count($sends) > 0) {
                foreach ($sends as $send) {
                    if (!isset($send[1]) || !isset($send[2])) {
                        continue;
                    }

                    $templateName = self::unquote($send[1]);
                    if ($templateName === basename($template, '.php')) {
                        $subjectParser = new SimplePHPFunctionCallParser('l');
                        $subjects = $subjectParser->parse($send[2]);
                        if (count($subjects) === 1) {
                            $subject_strings[] = self::unquote($subjects[0][0]);
                        }
                    } elseif (!preg_match('/^\w/', $templateName)) {
                        $subjectParser = new SimplePHPFunctionCallParser('l');
                        $subjects = $subjectParser->parse($send[2]);
                        if (count($subjects) === 1) {
                            $potential_subject_strings[] = self::unquote($subjects[0][0]);
                        }
                    }
                }
            }
        }

        $subject_translations = $this->getSubjectTranslations($language);

        $subjects = array();
        foreach ($subject_strings as $str) {
            if (isset($subject_translations[$str])) {
                $translation = $subject_translations[$str];
            } else {
                $translation = '';
            }

            $subjects[$str] = array(
                'translation' => $translation,
                'id' => ++$id,
                'file' => 1,
            );
        }

        $potential_subjects = array();
        foreach ($potential_subject_strings as $str) {
            if (isset($subject_translations[$str])) {
                $translation = $subject_translations[$str];
            } else {
                $translation = '';
            }

            $potential_subjects[$str] = array(
                'translation' => $translation,
                'id' => ++$id,
                'file' => 1,
            );
        }

        return array(
            'body' => $body,
            'subjects' => $subjects,
            'potential_subjects' => $potential_subjects,
            'files' => array(
                0 => 'modules/emailgenerator/templates_translations/'.$language.'/lang_content.php',
                1 => 'mails/'.$language.'/lang.php',
            ),
        );
    }

    private function isValidTemplatePath($template)
    {
        return preg_match('#^templates/(?:core|modules/[^/]+)/[^/]+\.php$#', $template)
            && file_exists($this->paths['root'].'/'.$template);
    }

    private function getBaseOutputName($template, $languageCode)
    {
        $m = array();
        if (preg_match('#^templates/core/[^/]+\.php$#', $template)) {
            return _PS_ROOT_DIR_.'/mails/'.$languageCode.'/'.basename($template, '.php');
        } elseif (preg_match('#^templates/modules/([^/]+)/(?:[^/]+)\.php$#', $template, $m)) {
            return _PS_MODULE_DIR_.$m[1].'/mails/'.$languageCode.'/'.basename($template, '.php');
        } else {
            return false;
        }
    }

    private function isValidTranslationFilePath($path)
    {
        $absPath = _PS_ROOT_DIR_.'/'.$path;
        $path = substr($absPath, strlen(_PS_ROOT_DIR_) + 1);

        return
            preg_match('#^(?:mails/[a-z]{2}/lang\.php|modules/emailgenerator/templates_translations/[a-z]{2}/lang_content\.php)$#', $path)
            ? $absPath
            : false;
    }
}
