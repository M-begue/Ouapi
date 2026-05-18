<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox"><form name="form" action="{form.ACTION}" method="post">
		<label>{form.L_USERNAME}</label><input type="text" value="{form.USERNAME}" disabled /><br/>
		<label>{form.L_FIRSTNAME}</label><input type="text" value="{form.FIRSTNAME}" disabled /><br/>
		<label>{form.L_OLDPWD}</label><input type="password" name="oldpass" /><br/>
		<label>{form.L_NEWPWD}</label><input type="password" name="pass" /><br/>
		<label>{form.L_CONFIRMNEWPWD}</label><input type="password" name="confirm_pass" /><br/>
		<input type="hidden" name="user_id" value="{form.USER_ID}" />
		<input type="submit" name="soumettre" value="{form.BUTTON}" /></form>
	</div>

<!-- END form -->

<!-- BEGIN form_addlink -->
	<div class="cat_title">{form_addlink.TITLE}</div>
	<div class="textbox">
	
	
	<form name="form" action="{form_addlink.ACTION}" method="post" onSubmit="return verifErrors()">
		
		<div style="float:left">
		<label>{form_addlink.L_LIBELLE}</label><input type="text" name="libelle" onkeyup="verifLong(this);modifInnerText('button_text',this.value.toUpperCase());" onkeydown="" id="required" /><br/>
		<label>{form_addlink.L_LINK}</label><input type="text" name="link" /><br/>
		<label>{form_addlink.L_COLOR}</label>
		<p class="input" style="border:0;">
		<!-- BEGIN colors -->
			<span style="float:left;margin-right:2px;width:14px;height:14px;background-color:#{form_addlink.colors.COLOR}" onclick="{form_addlink.colors.ONCLICK}">&nbsp;</span>
		<!-- END colors -->
		</p><input type="hidden" name="color" value="2956B2" /><br/>
		
		<label>{form_addlink.L_TARGET}</label>
		<select name="target">
			<option value="_blank" selected>{form_addlink.L_TARGET_BLANK}</option>
			<option value="_self">{form_addlink.L_TARGET_SELF}</option>
		</select><br/>
		
		<label>{form_addlink.L_IMAGE}</label><p class="input" style="border:0;">
		<!-- BEGIN image -->
		<span style="background-color:#AAAAAA;padding:0px;padding-bottom:5px;"><img src="{form_addlink.image.SRC}" alt="" style="width:20px;" onclick="{form_addlink.image.ONCLICK}"/></span>
		<!-- END image -->
		</p><input type="hidden" name="image" value="ouapi.png" />
		
		<!-- BEGIN user -->
		<label>{form_addlink.user.L_VISIBLE}</label>
		<select name="user_id">
			<option value="{form_addlink.user.ID}" selected>{form_addlink.user.MYNAME}</option>
			<option value="0">{form_addlink.user.L_ALL}</option>
		</select><br/>
		<!-- END user -->
		
		<!-- BEGIN user_hidden -->
			<input type="hidden" name="user_id" value="{form_addlink.user_hidden.USER_ID}" />
		<!-- END user_hidden -->
		
		<input type="submit" name="soumettre" value="{form_addlink.BUTTON}" /></form>
		</div>
		
		<div style="float:left;border:1px solid black;margin-left:10px;padding:0px;width:120px;height:135px;margin-top:5px;">
			<span style="position:relative;top:0px;background-color:#FFFFFF;padding-left:37px;padding-right:5px;font-weight:bold;">{form_addlink.L_PREVIEW}</span>
			<span id="preview" class="my_button" style="{form_addlink.PREVIEW_STYLE}"><span id="button_text"></span>
			<img id="preview_image" src="images/gallery/ouapi.png" border="0" alt="" style="position:absolute;bottom:10px;left:10px;"/>
			</span>		
		</div>
		
	</div>
	<div style="clear:both"></div>

<!-- END form_addlink -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->
