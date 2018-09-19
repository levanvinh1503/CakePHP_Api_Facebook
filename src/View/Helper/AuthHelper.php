<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Auth helper
 */
class AuthHelper extends Helper
{
	public function authUser($recordTale)
	{
		echo $recordTale;
	}
}
