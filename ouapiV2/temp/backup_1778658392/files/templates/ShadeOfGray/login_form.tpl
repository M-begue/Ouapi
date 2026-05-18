<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<div style="height:80%">
	<div><img src="images/logo.png" alt="" /></div>
	<form action="config/login.php?action=login" method="post" style="margin-bottom:0px;">	
	<div class="login_background" style="width:400px;height:220px;margin-left:auto;margin-right:auto;margin-bottom:50px;">
	<div class="titre2" style="margin-top:-10px;margin-left:10px;width:200px;padding:2px;padding-left:5px;text-align:center"><b>{USER_LOGIN_TITLE}</b></div> 
	
	<table align="center"style="margin-top:10px;">
	<tr>
		<td class="row" colspan="2" align="center" style="padding:20px;color:red;font-size:14px;"><b><u>{USER_LOGIN_HELP}</u></b></td>
	</tr>
	<tr>
		<td>{USER_LOGIN}</td>
		<td class="row"><input type="text" name="login" class="non_form" /></td>
	</tr>
	<tr>
		<td>{USER_PASSWORD}</td>
		<td class="row"><input type="password" name="password" class="non_form" /></td>
	</tr>
	<tr>
		<td class="row" colspan="2" align="center" style="padding:20px;"><input type="submit" name="submit" value="{USER_CONNECT_BUTTON}" class="non_form" /></td>
	</tr>
	</table>

	<!-- BEGIN login_error -->
	<br/><center><font style="color:red;font-weight:bold;background-color:white;border:1px solid black;padding:3px;
	text-align:center;font-size:12px;">{login_error.LOGIN_ERROR_MESSAGE}</font></center>
	<!-- END login_error -->

	</div>
	</form>
</div>