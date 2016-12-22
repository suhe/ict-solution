<?php
namespace App\Classes;

use App\Modules\UserGroup\UserGroupModule;
use Auth;

class Role {
	public static function access($type,$module_slug,$user_group_login = '') {
		if($user_group_login != '') 
			$user_group_login = $user_group_login;
		else 
			$user_group_login = Auth::user()->user_group_id;
				
		//user group access
		$user_group_module = UserGroupModule::where(['module_slug' => $module_slug,'user_group_id' => $user_group_login,'access'=> $type])->first();
		if($user_group_login == 1)
			return true;
		else if($user_group_module) 
			return true;
		else
			return false;	
	}
}