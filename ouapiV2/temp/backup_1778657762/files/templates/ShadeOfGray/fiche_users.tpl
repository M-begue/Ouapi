<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN infos -->
<div class="information" style="height:70px;margin-top:0;">
	<img src="{infos.ICON}" alt="" style="float:left;margin-right:20px;" />
	<font style="font-weight:bold;font-size:16px;">{infos.NAME}</font><br/>{infos.MAIL}<br/>{infos.GROUP}
</div>
<!-- END infos -->

<div style="clear:both"></div>

<div class="topmenu">
	<!-- BEGIN button -->
		<p id="{button.ID}" class="{button.CLASS}" onclick="{button.LINK}"><img src="{button.IMG_ICON}" style="height:14px; width:14px"/> &nbsp; {button.TEXT}
			<!-- BEGIN nb -->
				&nbsp;({button.nb.TEXT})
			<!-- END nb -->
		</p>
	<!-- END button -->
	<div style="clear:both"></div> 
</div>

<div class="fiche">
	<div id="user_details">
	<div class="cat_title">{L_TITLE}</div>
		<table class="table">
		<tr>
			<td class="titre3" width="20%">{USER_LANG_LASTNAME}</td>
			<td class="row1" width="30%">{USER_LASTNAME}</td>
			<td class="titre3" width="20%">{USER_LANG_FIRSTNAME}</td>
			<td class="row1" width="30%">{USER_FIRSTNAME}</td>
		</tr>
		<tr>
			<td class="titre3">{USER_LANG_MAIL}</td>
			<td class="row1">{USER_MAIL}</td>
			<td class="titre3">{USER_LANG_GROUP}</td>
			<td class="row1">{USER_GROUP}</td>
		</tr>
		<tr>
			<td class="titre3">{USER_LANG_OUAPILOGIN}</td>
			<td class="row1">{USER_OUAPILOGIN}</td>
			<td class="titre3">{USER_LANG_WINLOGIN}</td>
			<td class="row1">{USER_WINLOGIN}</td>
		</tr>
		<!-- BEGIN line -->
		<tr>
			<!-- BEGIN info -->
				<td class="titre3">{line.info.TITLE}</td>
				<td class="row1">{line.info.VALUE}</td>
			<!-- END info -->	
		</tr>
		<!-- END line -->
		</table>
	</div>
	
	<!-- BEGIN ldap -->
	<div id="user_ldap" style="display:none;">
	<div class="cat_title">{ldap.TITLE}</div>
		<table class="table">
		<!-- BEGIN infos -->
			<!-- BEGIN line -->
			<tr>
				<!-- BEGIN info -->
					<td class="titre3" width="20%">{ldap.infos.line.info.LABEL}</td>
					<td class="row1" width="30%">{ldap.infos.line.info.VALUE}</td>
				<!-- END info -->
			</tr>		
			<!-- END line -->
		<!-- END infos -->
		</table>
	</div>
	<!-- END ldap -->

</div>
