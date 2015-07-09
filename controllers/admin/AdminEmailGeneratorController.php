<?php

class AdminEmailGeneratorController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;

        $this->template = 'index.tpl';

        if ($action = Tools::getValue('action')) {
            $action = basename($action);
        } else {
            $action = 'index';
        }

        $this->action = $action;
        $this->template = $action.'.tpl';

        parent::__construct();
        if (!$this->module->active) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        }

        $this->context->smarty->assign('emailgenerator', $this->context->link->getAdminLink('AdminEmailGenerator'));
    }

    public function setMedia()
    {
        $this->addCSS(_PS_MODULE_DIR_.'emailgenerator/css/emailgenerator.css');
        parent::setMedia();
    }

    public function processIndex()
    {
        $this->addJS(_PS_MODULE_DIR_.'emailgenerator/js/tree.js');

        $templates = EmailGenerator::listEmailTemplates();
        $languages = array();

        foreach (scandir(_PS_ROOT_DIR_.'/mails') as $lc) {
            if (!preg_match('/^\./', $lc) && is_dir(_PS_ROOT_DIR_.'/mails/'.$lc)) {
                $languages[] = array('iso_code' => $lc);
            }
        }

        $toBuild = array();

        foreach ($languages as $lang) {
            if ($lang['iso_code'] === 'an') {
                continue;
            }

            foreach ($templates['core'] as $tpl) {
                if (!preg_match('/^header/', basename($tpl['path'])) && !preg_match('/^footer/', basename($tpl['path']))) {
                    $toBuild[] = array(
                        'languageCode' => $lang['iso_code'],
                        'template' => $tpl['path'],
                    );
                }
            }
            foreach ($templates['modules'] as $mod) {
                foreach ($mod as $tpl) {
                    $toBuild[] = array(
                        'languageCode' => $lang['iso_code'],
                        'template' => $tpl['path'],
                    );
                }
            }
        }

        $params = array(
            'templates' => $templates,
            'languages' => $languages,
            'toBuild' => Tools::jsonEncode($toBuild),
        );
        $this->context->smarty->assign($params);
    }

    public function processDetails()
    {
        $error = '';
        $template = Tools::getValue('template');
        // Check passed path is authorized
        if ($this->module->isValidTemplatePath($template)) {
            $languageCode = $this->module->currentLanguageCode();

            if ($subAction = Tools::getValue('subAction')) {
                $url = $this->context->link->getAdminLink('AdminEmailGenerator')
                .'&template='.$template
                .'&action=details'
                .'&languageCode='.$languageCode;

                if ($subAction === 'postTranslations') {
                    $files = Tools::getValue('files');
                    $translations = Tools::getValue('translations');
                    $data = array();
                    foreach ($translations as $mt) {
                        if (isset($files[$mt['file']])) {
                            if (!isset($data[$files[$mt['file']]])) {
                                $data[$files[$mt['file']]] = array();
                            }
                            $data[$files[$mt['file']]][$mt['message']] = $mt['translation'];
                        }
                    }
                    $ok = $this->module->writeTranslations($data);
                    if ($ok !== true) {
                        $error = $ok;
                    }
                    if (!$error) {
                        $this->module->generateEmail($template, $languageCode);
                    }
                }

                Tools::redirectAdmin($url);
            }

            $strings = $this->module->extractEmailStrings($template, $languageCode);

            $this->context->smarty->assign(array(
                'template' => $template,
                'template_name' => $this->module->humanizeString(basename($template, '.php')),
                'strings' => $strings,
                'token' => Tools::getValue('token'),
                'languages' => Language::getLanguages(),
                'languageCode' => $languageCode,
                'error' => $error,
            ));
        }
    }

    public function processPreview()
    {
        $template = Tools::getValue('template');
        $languageCode = Tools::getValue('languageCode');
        $generated = $this->module->generateEmail($template, $languageCode);

        die($generated['html']);
    }

    public function ajaxProcessGenerateEmail()
    {
        $res = array('success' => false, 'error_message' => 'Something wrong happened, sorry!');

        $languageCode = Tools::getValue('languageCode');
        $template = Tools::getValue('template');

        try {
            $this->module->generateEmail($template, $languageCode);
            $res['success'] = true;
            unset($res['error_message']);
        } catch (Exception $e) {
            $res['error_message'] = $e->getMessage();
        }

        die(Tools::jsonEncode($res));
    }
}
