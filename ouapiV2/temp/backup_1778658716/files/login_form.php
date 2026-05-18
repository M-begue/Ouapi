<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2012 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$template->assign_vars(array(
	'USER_LOGIN_TITLE' => $lang["user_login_title"],
	'USER_LOGIN_HELP' => $lang["user_login_help"],
	'USER_LOGIN' => $lang["user_login_login"],
	'USER_PASSWORD' => $lang["user_login_password"],
	'USER_CONNECT_BUTTON' => $lang["user_login_connect"]
  ));

// Erreur de login
if (isset($_GET['err']))
{
	$template->assign_block_vars('login_error', array(
		'LOGIN_ERROR_MESSAGE' => $lang["user_login_errlogin"]
	));	

}
?>