<?php

	class ChangePasswordShellDriver implements \RainLoop\Providers\ChangePassword\ChangePasswordInterface
	{
		private $sAllowedEmails = '';

		public function SetAllowedEmails($sAllowedEmails)
		{
			$this->sAllowedEmails = $sAllowedEmails;
			return $this;
		}

		public function PasswordChangePossibility($oAccount)
		{
			return $oAccount && $oAccount->Email() && \RainLoop\Plugins\Helper::ValidateWildcardValues($oAccount->Email(), $this->sAllowedEmails);
		}

		public function ChangePassword(\RainLoop\Account $oAccount, $sPrevPassword, $sNewPassword)
		{
			$pHandle = popen(sprintf('sudo -S -u %s /usr/bin/passwd', escapeshellarg($oAccount->IncLogin())), 'w');
			fwrite($pHandle, "$sPrevPassword\n$sPrevPassword\n$sNewPassword\n$sNewPassword");

			if (pclose($pHandle) == 0) {
				return true;
			}

			return false;
		}
	}