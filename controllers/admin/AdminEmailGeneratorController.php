<?php

class AdminEmailGeneratorController extends ModuleAdminController
{
	public function __construct()
	{
		$this->bootstrap = true;

		$this->template = 'index.tpl';

		if ($action = Tools::getValue('action'))
		{
			$action = basename($action);
		}
		else
		{
			$action = 'index';
		}

		$this->action = $action;
		$this->template = $action.'.tpl';

		parent::__construct();
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));

		$this->context->smarty->assign('emailgenerator', $this->context->link->getAdminLink('AdminEmailGenerator'));
	}

	public function setMedia()
	{
		$this->addCSS('/modules/emailgenerator/css/emailgenerator.css');
		parent::setMedia();
	}

	public function processIndex()
	{
		$this->addJS('/modules/emailgenerator/js/tree.js');

		$templates = EmailGenerator::listEmailTemplates();
		$params = array(
			'templates' => $templates,
			'languages' => Language::getLanguages()
		);
		$this->context->smarty->assign($params);
	}

	public function processDetails()
	{
		$template = Tools::getValue('template');
		// Check passed path is authorized
		if ($this->module->isValidTemplatePath($template))
		{
			$languageCode = $this->module->currentLanguageCode();

			if ($subAction = Tools::getValue('subAction'))
			{
				$url = $this->context->link->getAdminLink('AdminEmailGenerator')
				.'&template='.$template
				.'&action=details'
				.'&languageCode='.$languageCode;

				if ($subAction === 'postTranslations')
				{
					$files = Tools::getValue('files');
					$translations = Tools::getValue('translations');
					$data = array();
					foreach ($translations as $mt)
					{
						if (isset($files[$mt['file']]))
						{
							if (!isset($data[$files[$mt['file']]]))
							{
								$data[$files[$mt['file']]] = array();
							}
							$data[$files[$mt['file']]][$mt['message']] = $mt['translation'];
						}
					}
					$ok = $this->module->writeTranslations($data);
					$ok = $ok && $this->module->generateEmail($template, $languageCode);
					if (!$ok)die("Oops");
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
				'preview_url' => $this->module->getPreviewURL($template, $languageCode)
			));
		}
	}
}