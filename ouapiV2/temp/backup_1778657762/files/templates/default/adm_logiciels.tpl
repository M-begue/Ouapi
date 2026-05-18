<!-- BEGIN soft_infos -->
<div class="information" style="height:65px;margin-top:0;"><img src="{soft_infos.ICON}" alt="" style="float:left;margin-right:20px;" />
<font style="font-weight:bold;font-size:16px;">{soft_infos.NAME}</font><br/>{soft_infos.MARQUE}<br/>{soft_infos.VERSION}</div>
<!-- END soft_infos -->

<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox">
		<form name="form" action="{form.ACTION}" method="post" onsubmit="return verifErrors()">	
		<!-- BEGIN source_head -->
			<p class="head_baseouapi">{form.source_head.L_BASEINFO}</p><p class="head_baseexterne">{form.source_head.L_OCSINFO}</p><br/>
		<!-- END source_head -->
		<!-- BEGIN softname -->
			<label>{form.softname.TITLE}</label><input type="text" name="nom" value="{form.softname.VALUE}" id="{form.softname.ID}" onkeyup="{form.softname.KEYUP}" onkeydown="if (document.images['imglink_nom']) { document.images['imglink_nom'].src='images/arrow_useredit.gif' }" {form.softname.DISABLED} />
			<!-- BEGIN action -->
				<a href="{form.softname.action.LINK}"><img src="{form.softname.action.IMAGE}" border="0" title="{form.softname.action.LIBELLE}" name="imglink_nom" alt="" /></a>
			<!-- END action -->	
			<!-- BEGIN valid -->
				<img src="{form.softname.valid.IMAGE}" border="0" name="imglink_nom" title="{form.softname.valid.LIBELLE}" onclick="{form.softname.valid.ONCLICK}" alt="" />
			<!-- END valid -->	
			<!-- BEGIN ocs -->
				<input type="text" value="{form.softname.ocs.VALUE}" id="ocs" disabled />
			<!-- END ocs -->	
		<br/>
		<!-- END softname -->

		<!-- BEGIN soft_select -->
		<label>{form.soft_select.TITLE}</label>
		<select name="s_id">
			<!-- BEGIN list -->
				<option value="{form.soft_select.list.ID}" {form.soft_select.list.SELECTED}>{form.soft_select.list.LIBELLE}</option>
			<!-- END list -->
		</select>
		<br/>
		<!-- END soft_select -->

		<!-- BEGIN marque -->
		<label>{form.marque.TITLE}</label><select name="marque_id" onchange="if (document.images['imglink_marque']) { document.images['imglink_marque'].src='images/arrow_useredit.gif' }; ">
			<!-- BEGIN list -->
				<option value="{form.marque.list.ID}" {form.marque.list.SELECTED}>{form.marque.list.LIBELLE}</option>
			<!-- END list -->
		</select>
			<!-- BEGIN action -->
				<a href="{form.marque.action.LINK}" target="_blank"><img src="{form.marque.action.IMAGE}" name="imglink_marque" border="0" title="{form.marque.action.LIBELLE}" alt="" /></a>
			<!-- END action -->	
			<!-- BEGIN valid -->
				<img src="{form.marque.valid.IMAGE}" border="0" name="imglink_marque" title="{form.marque.valid.LIBELLE}" onclick="{form.marque.valid.ONCLICK}" alt="" />
			<!-- END valid -->	
			<!-- BEGIN ocs -->
				<input type="text" value="{form.marque.ocs.VALUE}" id="ocs" disabled />
			<!-- END ocs -->	
		<br/>
		<!-- END marque -->

		<!-- BEGIN vnum -->		
		<label>{form.vnum.TITLE}</label><input type="text" name="{form.vnum.NAME}" value="{form.vnum.VALUE}" {form.vnum.DISABLED} />
			<!-- BEGIN action -->
				<a href="{form.vnum.action.LINK}"><img src="{form.vnum.action.IMAGE}" border="0" title="{form.vnum.action.LIBELLE}" name="imglink_version" alt="" /></a>
			<!-- END action -->	
			<!-- BEGIN valid -->
				<img src="{form.vnum.valid.IMAGE}" border="0" name="imglink_version" title="{form.vnum.valid.LIBELLE}" onclick="{form.vnum.valid.ONCLICK}" alt="" />
			<!-- END valid -->	
			<!-- BEGIN ocs -->
				<input type="text" value="{form.vnum.ocs.VALUE}" id="ocs" disabled />
			<!-- END ocs -->	
		<br/>
		<!-- END vnum -->
		
		<!-- BEGIN vdate -->		
		<label>{form.vdate.TITLE}</label><input type="text" name="{form.vdate.NAME}" value="{form.vdate.VALUE}" style="margin-right:3" readonly {form.vdate.DISABLED} />
			<!-- BEGIN action -->		
			<a href="javascript:show_calendar('document.form.{form.vdate.NAME}', document.form.{form.vdate.NAME}.value,0);"><img src="{form.vdate.action.IMG_CALENDAR}" width="16" height="16" border="0"/></a>
			<!-- END action -->		
			<br/>
		<!-- END vdate -->		
		
		<!-- BEGIN multisite -->
			<label>{form.multisite.TITLE}</label>
			<p class="input" style="border:0;margin-bottom:0;">
			<!-- BEGIN list -->
				{form.multisite.list.LIBELLE}&nbsp;
				<input type="radio" name="site_id" value="{form.multisite.list.VALUE}" class="non_form" style="border:0;vertical-align:middle" {form.multisite.list.CHECKED} />
			<!-- END list -->
			</p>
		<!-- END multisite -->
		<!-- BEGIN monosite -->
			<input type="hidden" name="site_id" value="{form.monosite.SITE_ID}" />
		<!-- END monosite -->

		<!-- BEGIN comment -->
		<label>{form.comment.TITLE}</label><textarea name="commentaire" rows="3" cols="30" {form.comment.DISABLED}>{form.comment.VALUE}</textarea><br/>
		<!-- END comment -->

		<!-- BEGIN pfield_text -->
		<label>{form.pfield_text.TITLE}</label>
		<input type="text" name="{form.pfield_text.NAME}" value="{form.pfield_text.VALUE}" /><br/>
		<!-- END pfield_text -->

		<!-- BEGIN hard_assoc -->		
			<!-- BEGIN list -->
				<label>{form.hard_assoc.list.TITLE}</label><input type="checkbox" name="{form.hard_assoc.list.NAME}" value="{form.hard_assoc.list.VALUE}" {form.hard_assoc.list.CHECKED} /><br/>
			<!-- END list -->
		<input type="hidden" name="nb_type" value="{form.hard_assoc.NB_TYPE}" />
		<!-- END hard_assoc -->

		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{form.button.TITLE}" />
		<!-- END button -->

		<!-- BEGIN help -->
		<div class="help" style="margin-top:20px;">{form.help.TEXT}</div>	
		<!-- END help -->
		</form>
	</div>
<!-- END form -->

<!-- BEGIN no_select -->
	<div class="no_record">{no_select.TEXT}</div>
<!-- END no_select -->

<!-- BEGIN form_ocs -->
	<div class="cat_title">{form_ocs.TITLE}</div>
	<div class="textbox">
		<FORM name="form" action="{form_ocs.ACTION}" method="POST" onSubmit="return verifErrors()">	

		<!-- BEGIN softname -->
			<label>{form_ocs.softname.TITLE}</label><input type="text" name="nom" value="{form_ocs.softname.VALUE}" onKeyUp="verifLong(this);" id="{form_ocs.softname.ID}" {form_ocs.softname.DISABLED} /><br/>
		<!-- END softname -->

		<!-- BEGIN soft_alias -->
		<label>{form_ocs.soft_alias.TITLE}</label><select name="soft_id" id="{form_ocs.soft_alias.ID}" {form_ocs.soft_alias.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form_ocs.soft_alias.list.ID}" {form_ocs.soft_alias.list.SELECTED}>{form_ocs.soft_alias.list.LIBELLE}</option>
			<!-- END list -->
		</select>
		<!-- BEGIN action -->
			<a href="{form_ocs.soft_alias.action.LINK}" target="_blank"><img src="{form_ocs.soft_alias.action.IMAGE}" border="0" title="{form_ocs.soft_alias.action.LIBELLE}" /></a>
		<!-- END action -->	
		<br/>
		<!-- END soft_alias -->
		
		<!-- BEGIN visible -->
		<label>{form_ocs.visible.TITLE}</label>
		<p class="input" style="border:0;margin-bottom:0;">
			<!-- BEGIN list -->
			{form_ocs.visible.list.LIBELLE}&nbsp;
			<input type="radio" name="visible" value="{form_ocs.visible.list.VALUE}" class="non_form" style="border:0;vertical-align:middle"
			onclick="{form_ocs.visible.list.ONCLICK}" {form_ocs.visible.list.CHECKED} />
			<!-- END list -->
		</p>
		<!-- END visible -->

		<!-- BEGIN ocs_soft_name -->
			<input type="hidden" name="ocs_soft_name" value="{form_ocs.ocs_soft_name.VALUE}" />
		<!-- END ocs_soft_name -->
		
		<!-- BEGIN alias_id -->
			<input type="hidden" name="alias_id" value="{form_ocs.alias_id.VALUE}" />
		<!-- END alias_id -->

		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{form_ocs.button.TITLE}" />
		<!-- END button -->

		<!-- BEGIN help -->
		<div class="help">{form_ocs.help.TEXT}</div>	
		<!-- END help -->
		</form>
	</div>
<!-- END form_ocs -->

<!-- BEGIN select -->
	<div class="cat_title">{select.L_TITLE}</div>
	<div class="textbox">
	<!-- BEGIN tab_hard -->	
		<table class="table">
		<tr>
			<td class="titre3" align="center">{select.tab_hard.TITLE_HARDTYPE}</td>
			<td class="titre3" align="center">{select.tab_hard.TITLE_HARDNAME}</td>
			<td class="titre3" align="center">{select.tab_hard.TITLE_USERNAME}</td>
			<td class="titre3" align="center">{select.tab_hard.TITLE_VNUMINST}</td>
			<td class="titre3" align="center">{select.tab_hard.TITLE_LASTVNUM}</td>
			<td class="titre3" align="center">{select.tab_hard.TITLE_ADDTOOLS}</td>
			<td class="titre3" align="center">{select.tab_hard.TITLE_TOOLS}</td>
		</tr>
		<!-- BEGIN list -->
			<tr>
				<td class="row1" align="center">{select.tab_hard.list.HARDTYPE}</td>
				<td class="row1" align="center">{select.tab_hard.list.HARDNAME}</td>
				<td class="row1" align="center">{select.tab_hard.list.USERNAME}</td>
				<!-- BEGIN status -->
					<td class="row1" style="{select.tab_hard.list.status.STYLE}">{select.tab_hard.list.status.VNUM}&nbsp;<i>({select.tab_hard.list.status.VDATE})</i></td>
					<td class="row1" style="{select.tab_hard.list.status.STYLE}">{select.tab_hard.list.status.LASTVNUM}&nbsp;<i>({select.tab_hard.list.status.LASTVDATE})</i></td>
				<!-- END status -->
				<td class="row1" align="center">
				<form name="form" action="index.php?page=adm_logiciels.php&action=MAJ_hard" method="POST" style="padding:0;margin:0" target="_blank">						
					<b>{select.tab_hard.list.L_VNUMTOINST}</b>&nbsp;
					<input type="text" name="soft_version" class="non_form" size="5" value="{select.tab_hard.list.VNUMTOINST}" style="height:16px;font-size:10px;" />
					<input type="hidden" name="h_id" value="{select.tab_hard.list.H_ID}" />
					<input type="hidden" name="s_id" value="{select.tab_hard.list.S_ID}" />
					<input type="submit" name="soumettre" value="{select.tab_hard.list.L_INSTALL}" class="non_form" style="height:16px;font-size:10px;" />
									</form></td>
					<td class="row1"><a href="{select.tab_hard.list.LINK_DEL}" target="_blank">
					<img src="{select.tab_hard.list.IMG_DEL}" border="0" title="{select.tab_hard.list.TITLE_DEL}" style="vertical-align:middle" /></a>
				</form>
				</td>
			</tr>
		<!-- END list -->		
		</table>
	<!-- END tab_hard -->	

	<!-- BEGIN no_hard -->
	<div class="no_record" align="center">{select.no_hard.TEXT}</div>
	<!-- END no_hard -->
	</div>
<!-- END select -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->
