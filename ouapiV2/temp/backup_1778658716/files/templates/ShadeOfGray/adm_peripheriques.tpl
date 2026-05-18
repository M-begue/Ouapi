<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
           "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>{LANG_MAIN_TITLE}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
		showOtherMonths:true,
		selectOtherMonths:true,
		changeMonth: true,
    changeYear: true,
		showOn:"button",
		buttonImageOnly:true,
		dateFormat:"dd-mm-yy",
		buttonImage:"images/calendar.gif"
		});
  });
  </script>
</head>
<body>

<!-- BEGIN form -->
<div class="cat_title">{form.L_TITLE}</div>
<div class="textbox_white">
	<form name="form" action="{form.ACTION}" method="post" onsubmit="return verifErrors()">

	<!-- BEGIN source_head -->
		<p class="head_baseouapi">{form.source_head.L_BASEINFO}</p>
    <p class="head_baseexterne">{form.source_head.L_OCSINFO}</p><br/>
	<!-- END source_head -->

	<!-- BEGIN periphname -->
	<label>{form.periphname.TITLE}</label>
	<input type="text" name="nom" value="{form.periphname.VALUE}" id="{form.periphname.ID}" onkeyup="{form.periphname.KEYUP}" onkeydown="if (document.images['imglink_periphname']) { document.images['imglink_periphname'].src='images/arrow_useredit.gif' }" {form.periphname.DISABLED} />
		<!-- BEGIN valid -->
			<img src="{form.periphname.valid.IMAGE}" border="0" name="imglink_periphname" title="{form.periphname.valid.LIBELLE}" onclick="{form.periphname.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN action -->
			<a href="{form.periphname.action.LINK}"><img src="{form.periphname.action.IMAGE}" border="0" title="{form.periphname.action.LIBELLE}" name="imglink_periphname" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.periphname.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END periphname -->
	
	<!-- BEGIN serial -->
	<label>{form.serial.TITLE}</label>
  <input type="text" name="num_serie" value="{form.serial.VALUE}" onkeydown="if (document.images['imglink_serial']) { document.images['imglink_serial'].src='images/arrow_useredit.gif' }" {form.serial.DISABLED} />
		<!-- BEGIN action -->
			<a href="{form.serial.action.LINK}"><img src="{form.serial.action.IMAGE}" border="0" title="{form.serial.action.LIBELLE}" name="imglink_numserie" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.serial.valid.IMAGE}" border="0" name="imglink_serial" title="{form.serial.valid.LIBELLE}" onclick="{form.serial.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.serial.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END serial -->
	
	<!-- BEGIN type -->
	<label>{form.type.TITLE}</label>
  <select name="type" onchange="if (document.images['imglink_type']) { document.images['imglink_type'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">
		<!-- BEGIN list -->
			<option value="{form.type.list.ID}" {form.type.list.SELECTED}>{form.type.list.LIBELLE}</option>
		<!-- END list -->
	</select>
		<!-- BEGIN action -->
			<a href="{form.type.action.LINK}" target="_blank"><img src="{form.type.action.IMAGE}" border="0" name="imglink_type" title="{form.type.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.type.valid.IMAGE}" border="0" name="imglink_type" title="{form.type.valid.LIBELLE}" onclick="{form.type.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.type.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END type -->
	
	<!-- BEGIN marque -->
	<label>{form.marque.TITLE}</label>
  <select name="marque" onchange="{form.marque.ONCLICK}">
		<!-- BEGIN list -->
			<option value="{form.marque.list.ID}" {form.marque.list.SELECTED}>{form.marque.list.LIBELLE}</option>
		<!-- END list -->
	</select>
		<!-- BEGIN action -->
			<a href="{form.marque.action.LINK}" target="_blank"><img src="{form.marque.action.IMAGE}" name="imglink_marque" border="0" title="{form.marque.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.marque.valid.IMAGE}" border="0" name="imglink_marque" title="{form.marque.valid.LIBELLE}" onClick="{form.marque.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.marque.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END marque -->
	
	<!-- BEGIN modele -->
	<label>{form.modele.TITLE}</label>
  <span id="bloc_periph_modele">
	  <select name="modele" onchange="if (document.images['imglink_modele']) { document.images['imglink_modele'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">
		<!-- BEGIN list -->
			<option value="{form.modele.list.ID}" {form.modele.list.SELECTED}>{form.modele.list.LIBELLE}</option>
		<!-- END list -->
		</select>
  </span>
		<!-- BEGIN action -->
			<a href="{form.modele.action.LINK}" id="link_periph_modele" target="_blank"><img src="{form.modele.action.IMAGE}" name="imglink_modele" border="0" title="{form.modele.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.modele.valid.IMAGE}" border="0" name="imglink_modele" title="{form.modele.valid.LIBELLE}" onClick="{form.modele.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.modele.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END modele -->
	
	<!-- BEGIN multisite -->
	<label>{form.multisite.TITLE}</label>
  <select name="agence_id">
		<!-- BEGIN list -->
			<option value="{form.multisite.list.ID}" {form.multisite.list.SELECTED}>{form.multisite.list.LIBELLE}</option>
		<!-- END list -->
	</select><br/>
	<!-- END multisite -->
	<!-- BEGIN monosite -->
		<input type="hidden" name="agence_id" value="{form.monosite.AGENCE_ID}" />
	<!-- END monosite -->
	
	<!-- BEGIN linkhard -->
	<label>{form.linkhard.TITLE}</label>
  <select name="hard" onchange="if (document.images['imglink_linkhard']) { document.images['imglink_linkhard'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">
		<!-- BEGIN list -->
			<option value="{form.linkhard.list.ID}" {form.linkhard.list.SELECTED}>{form.linkhard.list.LIBELLE}</option>
		<!-- END list -->
	</select>
		<!-- BEGIN action -->
			<a href="{form.linkhard.action.LINK}" target="_blank"><img src="{form.linkhard.action.IMAGE}" name="imglink_linkhard" border="0" title="{form.linkhard.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.linkhard.valid.IMAGE}" border="0" name="imglink_linkhard" title="{form.linkhard.valid.LIBELLE}" onClick="{form.linkhard.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.linkhard.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END linkhard -->

	<!-- BEGIN reservable -->
	<label>{form.reservable.TITLE}</label>
	<p class="input" style="border:0;margin-bottom:0;">
		<!-- BEGIN list -->
		{form.reservable.list.LIBELLE}&nbsp;
		<input type="radio" name="reservable" value="{form.reservable.list.VALUE}" class="non_form" style="border:0;vertical-align:middle" {form.reservable.list.CHECKED} />
		<!-- END list -->
	</p>
	<!-- END reservable -->

	<!-- BEGIN date -->
	<label>{form.date.TITLE}</label>
	<input name="date" type="text" id="datepicker" value="{form.date.VALUE}" />
	<br/>
	<!-- END date -->

	<!-- BEGIN comment -->
	<label>{form.comment.TITLE}</label>
  <textarea name="commentaire"  rows="3" cols="50" onkeydown="if (document.images['imglink_comment']) { document.images['imglink_comment'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">{form.comment.VALUE}</textarea>
		<!-- BEGIN valid -->
			<img src="{form.comment.valid.IMAGE}" border="0" name="imglink_comment" style="vertical-align:top;margin-top:8px;" title="{form.comment.valid.LIBELLE}" onClick="{form.comment.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.comment.ocs.VALUE}" id="ocs" style="vertical-align:top" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END comment -->
	
	<!-- BEGIN suivi_rebus -->
	<label>{form.suivi_rebus.TITLE}</label>
  <textarea name="suivi" rows="10" cols="50" style="vertical-align:top">{form.suivi_rebus.VALUE}</textarea><br/>
	<!-- END suivi_rebus -->
	
	<!-- BEGIN rebus -->
	<label>{form.rebus.TITLE}</label>
  <textarea name="suivi" rows="10" cols="50" style="vertical-align:top">{form.rebus.VALUE}</textarea><br/>
	<!-- END rebus -->

	<!-- BEGIN ocs_id -->
		<input type="hidden" name="ocs_id" value="{form.ocs_id.VALUE}" />
	<!-- END ocs_id -->
	
	<!-- BEGIN ocs_type -->
		<input type="hidden" name="ocs_type" value="{form.ocs_type.VALUE}" />
	<!-- END ocs_type -->

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
		<img src="{form.key.TEMPLATE_DIR}images/arrow_ok.gif" style="vertical-align:middle;margin-left:10px;" alt="" />&nbsp;{form.key.L_OK}<br/>
		<img src="{form.key.TEMPLATE_DIR}images/arrow.gif" style="vertical-align:middle;margin-left:10px;" alt="" />&nbsp;{form.key.L_TRANS}<br/>
		<img src="{form.key.TEMPLATE_DIR}images/arrow_add.gif" style="vertical-align:middle;margin-left:10px;" alt="" />&nbsp;{form.key.L_ADD}<br/>
		<img src="{form.key.TEMPLATE_DIR}images/arrow_add_ocs.gif" style="vertical-align:middle;margin-left:10px;" alt="" />&nbsp;{form.key.L_ADD_OCS}<br/>
		<img src="{form.key.TEMPLATE_DIR}images/arrow_useredit.gif" style="vertical-align:middle;margin-left:10px;" alt="" />&nbsp;{form.key.L_USER}<br/>
		<img src="{form.key.TEMPLATE_DIR}images/arrow_forbid.gif" style="vertical-align:middle;margin-left:10px;" alt="" />&nbsp;{form.key.L_FORBID}<br/>
		</div>
	<!-- END key -->	

</div>
<!-- END form -->

<!-- BEGIN addlink -->
<div class="cat_title">{addlink.L_TITLE}</div>
<div class="textbox">
	<form name="form" action="{addlink.ACTION}" method="POST" onSubmit="return verifErrors()">
	
	<!-- BEGIN periph -->
	<label>{addlink.periph.TITLE}</label>
  <select name="periph_id" id="large">
		<!-- BEGIN list -->
			<option value="{addlink.periph.list.ID}" {addlink.periph.list.SELECTED}>{addlink.periph.list.LIBELLE}</option>
		<!-- END list -->
	</select><br/>
	<!-- END periph -->

	<!-- BEGIN button -->	
	<input type="submit" name="soumettre" value="{addlink.button.TITLE}" />
	<!-- END button -->

	<!-- BEGIN no_link -->
	<div class="no_record" align="center">{addlink.no_link.TEXT}</div>
	<!-- END no_link -->
	
	</form>
</div>
<!-- END addlink -->
<!-- BEGIN no_link -->
<div class="cat_title">{no_link.L_TITLE}</div>
<div class="textbox">
	<div class="no_record" align="center">{no_link.TEXT}</div>
</div>
<!-- END no_link -->

<!-- BEGIN form_post -->
	<br/>
  <p class="contenu" id="{form_post.ID}">{form_post.OK}<br/>
  <br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->

</body>
</html>