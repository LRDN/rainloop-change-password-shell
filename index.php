<?php

	class ChangePasswordShellPlugin extends \RainLoop\Plugins\AbstractPlugin
	{
		public function Init()
		{
			$this->addHook('main.fabrica', 'MainFabrica');
		}

		public function MainFabrica($sName, &$oProvider)
		{
			switch ($sName) {
				case 'change-password':
					include_once __DIR__ . '/ChangePasswordShellDriver.php';
					$oProvider = new ChangePasswordShellDriver();
					$oProvider->SetAllowedEmails(\strtolower(\trim($this->Config()->Get('plugin', 'allowed_emails', ''))));
					break;
			}
		}

		public function configMapping()
		{
			return array(
				\RainLoop\Plugins\Property::NewInstance('allowed_emails')->SetLabel('Allowed emails')
					->SetType(\RainLoop\Enumerations\PluginPropertyType::STRING_TEXT)
					->SetDescription('Allowed emails, space as delimiter, wildcard supported. Example: user1@domain1.net user2@domain1.net *@domain2.net')
					->SetDefaultValue('*')
			);
		}
	}