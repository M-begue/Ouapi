<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	
	<!-- BEGIN error -->
	<div class="contenu" id="alert" style="margin-top:10px;margin-bottom:10px;">{form.error.TEXT}</div>
	<!-- END error -->

	<div class="textbox">
		<form name="form" action="{form.ACTION}" method="post" onsubmit="return verifErrors()">
		
		<!-- BEGIN ldap_head -->
			<p class="head_baseouapi">{form.ldap_head.L_BASEINFO}</p><p class="head_baseexterne">{form.ldap_head.L_LDAPINFO}</p><br/>
		<!-- END ldap_head -->

		<!-- BEGIN name -->
		<label>{form.name.TITLE}</label>
		<input type="text" name="nom" value="{form.name.VALUE}" id="{form.name.ID}" onkeyup="{form.name.KEYUP}" onkeydown="if (document.images['imglink_nom']) { document.images['imglink_nom'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }" {form.name.DISABLED} />
			<!-- BEGIN action -->
				<a href="{form.name.action.LINK}"><img src="{form.name.action.IMAGE}" border="0" title="{form.name.action.LIBELLE}" name="imglink_nom"></a>
			<!-- END action -->	
			<!-- BEGIN valid -->
				<img src="{form.name.valid.IMAGE}" border="0" name="imglink_nom" title="{form.name.valid.LIBELLE}" onClick="{form.name.valid.ONCLICK}">
			<!-- END valid -->	
			<!-- BEGIN ldap -->
				<input type="text" value="{form.name.ldap.VALUE}" class="ldap" disabled>
			<!-- END ldap -->	
		<br/>
		<!-- END name -->
		
		<!-- BEGIN firstname -->
		<label>{form.firstname.TITLE}</label>
		<input type="text" name="prenom" value="{form.firstname.VALUE}" id="{form.firstname.ID}" onkeyup="{form.firstname.KEYUP}" onkeydown="if (document.images['imglink_firstnom']) { document.images['imglink_firstnom'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }" {form.firstname.DISABLED} />
			<!-- BEGIN action -->
				<a href="{form.firstname.action.LINK}"><img src="{form.firstname.action.IMAGE}" border="0" title="{form.firstname.action.LIBELLE}" name="imglink_firstnom" alt="" /></a>
			<!-- END action -->	
			<!-- BEGIN valid -->
				<img src="{form.firstname.valid.IMAGE}" border="0" name="imglink_firstnom" title="{form.firstname.valid.LIBELLE}" onclick="{form.firstname.valid.ONCLICK}" alt="" />
			<!-- END valid -->	
			<!-- BEGIN ldap -->
				<input type="text" value="{form.firstname.ldap.VALUE}" class="ldap" disabled />
			<!-- END ldap -->	
		<br/>
		<!-- END firstname -->
		
		<!-- BEGIN mail -->
		<label>{form.mail.TITLE}</label>
		<input type="text" name="mail" value="{form.mail.VALUE}" id="{form.mail.ID}" onkeyup="{form.mail.KEYUP}" onkeydown="if (document.images['imglink_mail']) { document.images['imglink_mail'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }" {form.mail.DISABLED} />
			<!-- BEGIN action -->
				<a href="{form.mail.action.LINK}"><img src="{form.mail.action.IMAGE}" border="0" title="{form.mail.action.LIBELLE}" name="imglink_mail" alt="" /></a>
			<!-- END action -->	
			<!-- BEGIN valid -->
				<img src="{form.mail.valid.IMAGE}" border="0" name="imglink_mail" title="{form.mail.valid.LIBELLE}" onclick="{form.mail.valid.ONCLICK}" alt="" />
			<!-- END valid -->	
			<!-- BEGIN ldap -->
				<input type="text" value="{form.mail.ldap.VALUE}" class="ldap" disabled />
			<!-- END ldap -->	
		<br/>
		<!-- END mail -->

		<!-- BEGIN multisite -->
		<label>{form.multisite.TITLE}</label><select name="ut_agence">
			<!-- BEGIN list -->
				<option value="{form.multisite.list.ID}" {form.multisite.list.SELECTED}>{form.multisite.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END multisite -->
		<!-- BEGIN monosite -->
			<input type="hidden" name="ut_agence" value="{form.monosite.AGENCE_ID}">
		<!-- END monosite -->

		<!-- BEGIN win_login -->
		<label>{form.win_login.TITLE}</label>
		<input type="text" name="login_win" value="{form.win_login.VALUE}" id="{form.win_login.ID}" onkeyup="{form.win_login.KEYUP}" onkeydown="if (document.images['imglink_loginwin']) { document.images['imglink_loginwin'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }" {form.win_login.DISABLED} />
			<!-- BEGIN action -->
				<a href="{form.win_login.action.LINK}"><img src="{form.win_login.action.IMAGE}" border="0" title="{form.win_login.action.LIBELLE}" name="imglink_loginwin" alt="" /></a>
			<!-- END action -->	
			<!-- BEGIN valid -->
				<img src="{form.win_login.valid.IMAGE}" border="0" name="imglink_loginwin" title="{form.win_login.valid.LIBELLE}" onclick="{form.win_login.valid.ONCLICK}" alt="" />
			<!-- END valid -->	
			<!-- BEGIN ldap -->
				<input type="text" value="{form.win_login.ldap.VALUE}" class="ldap" disabled />
			<!-- END ldap -->	
		<br/>
		<!-- END win_login -->

		<!-- BEGIN lang -->
		<label>{form.lang.TITLE}</label><select name="ut_langue">
			<!-- BEGIN list -->
				<option value="{form.lang.list.ID}" {form.lang.list.SELECTED}>{form.lang.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END lang -->

		<!-- BEGIN user_ouapi -->
		<label>{form.user_ouapi.TITLE}</label>
			<p class="input" style="border:0;margin-bottom:0;">
			<!-- BEGIN list -->
			{form.user_ouapi.list.LIBELLE}&nbsp;
			<input type="radio" name="user_ouapi" value="{form.user_ouapi.list.VALUE}" onclick="{form.user_ouapi.list.ONCLICK}" class="non_form" style="border:0;vertical-align:middle" {form.user_ouapi.list.CHECKED} />
			<!-- END list -->
		</p>
		<!-- END user_ouapi -->

		<div style="margin:0;{form.DISPLAY_OUAPIUSER}" id="ouapi_user"> 
		<!-- BEGIN group -->
		<label>{form.group.TITLE}</label><select name="ut_groupe">
			<!-- BEGIN list -->
				<option value="{form.group.list.ID}" {form.group.list.SELECTED}>{form.group.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END group -->

		<!-- BEGIN login -->
		<label>{form.login.TITLE}</label>
		<input type="text" name="login" value="{form.login.VALUE}" id="{form.login.ID}" onkeyup="{form.login.KEYUP}" {form.login.DISABLED} /><br/>
		<!-- END login -->

		<!-- BEGIN pwd -->
		<label>{form.pwd.TITLE}</label>
		<input type="password" name="mdp" value="{form.pwd.VALUE}" id="{form.pwd.ID}" onkeyup="{form.pwd.KEYUP}" {form.pwd.DISABLED} /><br/>
		<!-- END pwd -->
		
		<!-- BEGIN confirm_pwd -->
		<label>{form.confirm_pwd.TITLE}</label>
		<input type="password" name="confirm_mdp" value="{form.confirm_pwd.VALUE}" id="{form.confirm_pwd.ID}" onkeyup="{form.confirm_pwd.KEYUP}" {form.confirm_pwd.DISABLED} /><br/>
		<!-- END confirm_pwd -->
		</div>
		
		<!-- BEGIN hidden_param -->	
		<input type="hidden" name="{form.hidden_param.NAME}" value="{form.hidden_param.VALUE}" />
		<!-- END hidden_param -->

		<!-- BEGIN pfield_text -->
		<label>{form.pfield_text.TITLE}</label>
		<input type="text" name="{form.pfield_text.NAME}" value="{form.pfield_text.VALUE}" /><br/>
		<!-- END pfield_text -->
		
		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{form.button.TITLE}" />
		<!-- END button -->

		</form>
		
		<!-- BEGIN key -->	
			<div class="legend">
			<p class="cat_title2" style="margin-top:0">{form.key.L_TITLE}</p>
			<img src="{form.TEMPLATE_ROOT}/arrow_ok.gif" style="vertical-align:middle;margin-left:10px;">&nbsp;{form.key.L_OK}<br/>
			<img src="{form.TEMPLATE_ROOT}/arrow.gif" style="vertical-align:middle;margin-left:10px;">&nbsp;{form.key.L_TRANS}<br/>
			<img src="{form.TEMPLATE_ROOT}/arrow_add.gif" style="vertical-align:middle;margin-left:10px;">&nbsp;{form.key.L_ADD}<br/>
			<img src="{form.TEMPLATE_ROOT}/arrow_useredit.gif" style="vertical-align:middle;margin-left:10px;">&nbsp;{form.key.L_USER}<br/>
			<img src="{form.TEMPLATE_ROOT}/arrow_forbid.gif" style="vertical-align:middle;margin-left:10px;">&nbsp;{form.key.L_FORBID}</td>
			</div>
		<!-- END key -->	
	</div>
<!-- END form -->

<!-- BEGIN addall_ldap -->
	<div class="cat_title">{addall_ldap.TITLE}</div>
	<div class="textbox">
		
		<FORM name="form" action="{addall_ldap.ACTION}" method="POST">
		
		<!-- BEGIN duplicate -->
		<label>{addall_ldap.duplicate.TITLE}</label><select name="duplicate">
			<!-- BEGIN list -->
				<option value="{addall_ldap.duplicate.list.ID}" {addall_ldap.duplicate.list.SELECTED}>{addall_ldap.duplicate.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END duplicate -->
		
		<!-- BEGIN user_ouapi -->
		<label>{addall_ldap.user_ouapi.TITLE}</label>
		<p class="input" style="border:0;margin-bottom:0;">
			<!-- BEGIN list -->
			{addall_ldap.user_ouapi.list.LIBELLE}&nbsp;
			<input type="radio" name="user_ouapi" value="{addall_ldap.user_ouapi.list.VALUE}" onclick="{addall_ldap.user_ouapi.list.ONCLICK}" class="non_form" style="border:0;vertical-align:middle" {addall_ldap.user_ouapi.list.CHECKED}>
			<!-- END list -->
		</p>
		<!-- END user_ouapi -->

		<div style="margin:0;display:none" id="ouapi_user"> 
		<!-- BEGIN group -->
		<label>{addall_ldap.group.TITLE}</label><select name="groupe_id">
			<!-- BEGIN list -->
				<option value="{addall_ldap.group.list.ID}" {addall_ldap.group.list.SELECTED}>{addall_ldap.group.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END group -->

		<!-- BEGIN login -->
		<label>{addall_ldap.login.TITLE}</label><select name="default_login">
			<!-- BEGIN list -->
				<option value="{addall_ldap.login.list.ID}" {addall_ldap.login.list.SELECTED}>{addall_ldap.login.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END login -->
		
		<!-- BEGIN mdp -->
		<label>{addall_ldap.mdp.TITLE}</label><select name="default_mdp">
			<!-- BEGIN list -->
				<option value="{addall_ldap.mdp.list.ID}" {addall_ldap.mdp.list.SELECTED}>{addall_ldap.mdp.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END mdp -->
		</div>
		
		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{addall_ldap.button.TITLE}">
		<!-- END button -->

		</form>

		<!-- BEGIN status -->
		<div class="{addall_ldap.status.CLASS}">
			<b>{addall_ldap.status.TEXT}</b>
			<!-- BEGIN ok -->
				<ul>
					<li>{addall_ldap.status.ok.NB_NEWUSERS}&nbsp;{addall_ldap.status.ok.NEWUSERS}
					<!-- BEGIN error -->
						<ul><li>{addall_ldap.status.ok.error.NB_USERSERROR}&nbsp;{addall_ldap.status.ok.error.USERSERROR}</li></ul>
					<!-- END error -->
					</li>
					<li>{addall_ldap.status.ok.NB_EXISTUSERS}&nbsp;{addall_ldap.status.ok.EXISTUSERS}</li>
				</ul>
			<!-- END ok -->
			<!-- BEGIN detail -->
				{addall_ldap.status.detail.TEXT}
			<!-- END detail -->

		</div>
		<!-- END status -->

</div>
<!-- END addall_ldap -->

<!-- BEGIN form_ldap -->
	<div class="cat_title">{form_ldap.TITLE}</div>
	<div class="textbox">
		<FORM name="form" action="{form_ldap.ACTION}" method="POST">
		
		<!-- BEGIN mask -->
		<label>{form_ldap.mask.TITLE}</label>
		<input type="text" name="mask" value="{form_ldap.mask.VALUE}" id="{form_ldap.mask.ID}" onKeyUp="{form_ldap.mask.KEYUP}" {form_ldap.mask.DISABLED}><br/>
		<!-- END mask -->
		
		<!-- BEGIN mask_hard -->
		<label>{form_ldap.mask_hard.TITLE}</label>
		<input type="text" name="mask_hard" value="{form_ldap.mask_hard.VALUE}" id="{form_ldap.mask_hard.ID}" onKeyUp="{form_ldap.mask_hard.KEYUP}" {form_ldap.mask_hard.DISABLED}><br/>
		<!-- END mask_hard -->
		
		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{form_ldap.button.TITLE}">
		<!-- END button -->

		<!-- BEGIN help -->
		<div class="help">{form_ldap.help.GENERAL_HELP}</div>
		<!-- END help -->

		</form>
	</div>
<!-- END form_ldap -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->
