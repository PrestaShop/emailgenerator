<?php

if (!defined('_PS_VERSION_'))
	exit;


class EmailGenerator extends Module
{
	public function __construct()
	{
		$this->name = 'emailgenerator';
		$this->version = '0.5';
		$this->author = 'fmdj';
		$this->bootstrap = true;

		$this->displayName = 'Email Generator';
		$this->description = 'Generate HTML and TXT emails for PrestaShop from php templates.';

		parent::__construct();
	}

	public function install()
	{
		return parent::install() && $this->installTab();
	}

	public function uninstall()
	{
		return $this->uninstallTab() && parent::uninstall();
	}

	public function installTab()
	{
		$tab = new Tab();
		$tab->active = 1;
		$tab->class_name = "AdminEmailGenerator";
		$tab->name = array();
		foreach (Language::getLanguages(true) as $lang)
			$tab->name[$lang['id_lang']] = "AdminEmailGenerator";
		$tab->id_parent = -1;
		$tab->module = $this->name;
		return $tab->add();
	}

	public function uninstallTab()
	{
		$id_tab = (int)Tab::getIdFromClassName('AdminEmailGenerator');
		if ($id_tab)
		{
			$tab = new Tab($id_tab);
			return $tab->delete();
		}
		else
			return false;
	}

	public function getContent()
	{
		$actionName = Tools::getValue('action');

		if ($actionName)
		{
			$method = strtolower($_SERVER['REQUEST_METHOD']);
			$action = $method.ucfirst($actionName).'Action';
			$this->template = $actionName;
		}
		else
		{
			$actionName = 'index';
			$action = 'getIndexAction';
			$this->template = 'index';
		}

		$data = array();
		if (is_callable(array($this, $action)))
		{
			$values = $this->$action();
			if (is_array($values))
				$data = $values;
		}
		else
		{
			$data['error'] = 'Action not found: '.$actionName;
			$this->template = 'error';
		}

		$data = array_merge($this->getDefaultViewParameters(), $data);

		$this->context->smarty->assign($data);
		return $this->context->smarty->fetch(
			dirname(__FILE__).'/views/templates/admin/'.$this->template.'.tpl'
		);
	}

	public function getDefaultViewParameters()
	{
		$hidden = array(
			'token' => Tools::getValue('token'),
			'configure' => $this->name,
			'controller' => 'AdminModules'
		);

		$inputs = array();
		$params = array();
		foreach ($hidden as $name => $value)
		{
			$inputs[] = "<input type='hidden' name='$name' value='$value'>";
			$params[] = urlencode($name).'='.urlencode($value);
		}
		$stay_here = implode("\n", $inputs);
		$url = '?'.implode('&', $params);

		return array(
			'stay_here' => $stay_here,
			'url' => $url
		);
	}

	public static function humanizeString($str)
	{
		return implode(' ', array_map('ucfirst',  preg_split('/[_\-]/', $str)));
	}

	public static function relativePath($path)
	{
		return substr($path, strlen(dirname(__FILE__))+1);
	}

	public static function listEmailTemplates()
	{
		$templates = array('core' => array(), 'modules' => array());

		if(is_dir(dirname(__FILE__).'/templates/core'))
			foreach (scandir(dirname(__FILE__).'/templates/core') as $entry)
			{
				$path = dirname(__FILE__).'/templates/core/'.$entry;

				if (preg_match('/\.php$/', $entry))
				{
					$templates['core'][] = array(
						'path' => self::relativePath($path),
						'name' => self::humanizeString(basename($entry,'.php'))
					);
				}
			}
		
		if(is_dir(dirname(__FILE__).'/templates/modules'))
			foreach (scandir(dirname(__FILE__).'/templates/modules') as $module)
			{
				$dir = dirname(__FILE__).'/templates/modules/'.$module;

				if (!preg_match('/^\./', $module) && is_dir($dir))
				{
					$templates['modules'][$module] = array();

					foreach (scandir($dir) as $entry)
					{
						$path = $dir.'/'.$entry;
						if (preg_match('/\.php$/', $entry))
						{
							$templates['modules'][$module][] = array(
								'path' => self::relativePath($path),
								'name' => self::humanizeString(basename($entry,'.php'))
							);
						}
					}
				}
			}

		return $templates;
	}

	public function getIndexAction()
	{
		$templates = self::listEmailTemplates();
		return array(
			'templates' => $templates,
			'languages' => Language::getLanguages()
		);
	}

	public function getTranslationsAction()
	{
		$iso_code = Tools::getValue('language');

		if (!class_exists('Translatools'))
		{
			$ttPath = _PS_MODULE_DIR_.'translatools/translatools.php';
			require_once $ttPath;
		}

		$subjectsExtractor = Translatools::getNewTranslationsExtractor($iso_code);
		$subjectsExtractor->extractMailSubjectsStrings();
		$subjectsExtractor->fill();

		$contentExtractor = Translatools::getNewTranslationsExtractor($iso_code);
		$contentExtractor->extractMailContentStrings();
		$contentExtractor->fill();

		return array(
			'language' => $iso_code,
			'subjects' => $subjectsExtractor->getFiles(),
			'content' => $contentExtractor->getFiles()
		);

		return array();
	}

	public function postTranslationsAction()
	{
		$iso_code = Tools::getValue('language');
		$ttPath = _PS_MODULE_DIR_.'translatools/translatools.php';

		if (!class_exists('Translatools'))
		{
			$ttPath = _PS_MODULE_DIR_.'translatools/translatools.php';
			require_once $ttPath;
		}
		
		$extractor = Translatools::getNewTranslationsExtractor($iso_code);
		foreach (Tools::getValue('translations') as $file => $data)
		{
			$path = _PS_ROOT_DIR_.'/'.str_replace('(lc)', $iso_code, $file);
			$contents = $extractor->dictionaryToArray('_LANGMAIL', $data);
			$dir = dirname($path);
			if (!is_dir($dir))
				mkdir($dir, 0777, true);
			file_put_contents($path, $contents);
		}
		
		return $this->getTranslationsAction();
	}
}