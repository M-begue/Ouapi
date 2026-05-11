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
		showWeek:true,
		firstDay:1,
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
<div class="textbox">

	<form name="form" action="{form.ACTION}" method="post" onsubmit="return verifErrors()">

	<!-- BEGIN source_head -->
		<p class="head_baseouapi">{form.source_head.L_BASEINFO}</p><p class="head_baseexterne">{form.source_head.L_OCSINFO}</p><br/>
	<!-- END source_head -->
	
	<!-- BEGIN hardname -->
	<label>{form.hardname.TITLE}</label>
	<input type="text" name="nom" value="{form.hardname.VALUE}" id="{form.hardname.ID}" onkeyup="{form.hardname.KEYUP}" onkeydown="if (document.images['imglink_nom']) { document.images['imglink_nom'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }" {form.hardname.DISABLED} />
		<!-- BEGIN action -->
			<a href="{form.hardname.action.LINK}"><img src="{form.hardname.action.IMAGE}" border="0" title="{form.hardname.action.LIBELLE}" name="imglink_nom" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.hardname.valid.IMAGE}" border="0" name="imglink_nom" title="{form.hardname.valid.LIBELLE}" onclick="{form.hardname.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.hardname.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END hardname -->
	
	<!-- BEGIN serial -->
	<label>{form.serial.TITLE}</label><input type="text" name="num_serie" value="{form.serial.VALUE}" onkeydown="if (document.images['imglink_numserie']) { document.images['imglink_numserie'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }" {form.serial.DISABLED} />
		<!-- BEGIN action -->
			<a href="{form.serial.action.LINK}"><img src="{form.serial.action.IMAGE}" border="0" title="{form.serial.action.LIBELLE}" name="imglink_numserie" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.serial.valid.IMAGE}" border="0" name="imglink_numserie" title="{form.serial.valid.LIBELLE}" onclick="{form.serial.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.serial.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END serial -->
	
	<!-- BEGIN type -->
	<label>{form.type.TITLE}</label><select name="type" onchange="if (document.images['imglink_type']) { document.images['imglink_type'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">
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
	<label>{form.marque.TITLE}</label><select name="marque" onchange="{form.marque.ONCHANGE}">
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
	<label>{form.modele.TITLE}</label><span id="bloc_hard_modele">
	<select name="modele" onchange="if (document.images['imglink_modele']) { document.images['imglink_modele'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">
		<!-- BEGIN list -->
			<option value="{form.modele.list.ID}" {form.modele.list.SELECTED}>{form.modele.list.LIBELLE}</option>
		<!-- END list -->
	</select></span>
		<!-- BEGIN action -->
			<a href="{form.modele.action.LINK}" id="link_hard_modele" target="_blank"><img src="{form.modele.action.IMAGE}" name="imglink_modele" border="0" title="{form.modele.action.LIBELLE}" alt="" /></a>
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
	<label>{form.multisite.TITLE}</label><select name="agence_id">
		<!-- BEGIN list -->
			<option value="{form.multisite.list.ID}" {form.multisite.list.SELECTED}>{form.multisite.list.LIBELLE}</option>
		<!-- END list -->
	</select><br/>
	<!-- END multisite -->
	<!-- BEGIN monosite -->
		<input type="hidden" name="agence_id" value="{form.monosite.AGENCE_ID}" />
	<!-- END monosite -->

	<!-- BEGIN os -->
	<label>{form.os.TITLE}</label><select name="os" onchange="if (document.images['imglink_os']) { document.images['imglink_os'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">
		<!-- BEGIN list -->
			<option value="{form.os.list.ID}" {form.os.list.SELECTED}>{form.os.list.LIBELLE}</option>
		<!-- END list -->
	</select>
		<!-- BEGIN action -->
			<a href="{form.os.action.LINK}" target="_blank"><img src="{form.os.action.IMAGE}"  name="imglink_os" border="0" title="{form.os.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.os.valid.IMAGE}" border="0" name="imglink_os" title="{form.os.valid.LIBELLE}" onClick="{form.os.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.os.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END os -->
	
	<!-- BEGIN user -->
	<label>{form.user.TITLE}</label><select name="user" onchange="if (document.images['imglink_user']) { document.images['imglink_user'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }">
		<!-- BEGIN list -->
			<option value="{form.user.list.ID}" {form.user.list.SELECTED}>{form.user.list.LIBELLE}</option>
		<!-- END list -->
	</select>
		<!-- BEGIN action -->
			<a href="{form.user.action.LINK}" target="_blank"><img src="{form.user.action.IMAGE}"  name="imglink_user" border="0" title="{form.user.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.user.valid.IMAGE}" border="0" name="imglink_user" title="{form.user.valid.LIBELLE}" onClick="{form.user.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.user.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END user -->
	
	<!-- BEGIN emplacement -->
	<label>{form.emplacement.TITLE}</label><select name="emplacement">
		<!-- BEGIN list -->
			<option value="{form.emplacement.list.ID}" {form.emplacement.list.SELECTED}>{form.emplacement.list.LIBELLE}</option>
		<!-- END list -->
	</select>
		<!-- BEGIN action -->
			<a href="{form.emplacement.action.LINK}" target="_blank"><img src="{form.emplacement.action.IMAGE}" border="0" title="{form.emplacement.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
	<br/>
	<!-- END emplacement -->

	<!-- BEGIN ip -->
	<label>{form.ip.TITLE}</label><input type="text" name="ip" value="{form.ip.VALUE}" onkeydown="if (document.images['imglink_ip']) { document.images['imglink_ip'].src='{form.TEMPLATE_ROOT}/arrow_useredit.gif' }" {form.ip.DISABLED} />
		<!-- BEGIN action -->
			<a href="{form.ip.action.LINK}"><img src="{form.ip.action.IMAGE}" border="0" title="{form.ip.action.LIBELLE}" name="imglink_ip" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.ip.valid.IMAGE}" border="0" name="imglink_ip" title="{form.ip.valid.LIBELLE}" onClick="{form.ip.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.ip.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END ip -->
	
	<!-- BEGIN reservable -->
	<label>{form.reservable.TITLE}</label>
	<p class="input" style="border:0px;margin-bottom:0;">
		<!-- BEGIN list -->
		{form.reservable.list.LIBELLE}&nbsp;
		<input type="radio" name="reservable" value="{form.reservable.list.VALUE}" class="non_form" style="vertical-align:middle;border:0px;" {form.reservable.list.CHECKED} />
		<!-- END list -->
	</p>
	<!-- END reservable -->

	<!-- BEGIN date -->
	<label>{form.date.TITLE}</label>
	<input name="date" type="text" id="datepicker" value="{form.date.VALUE}" />
		<!-- BEGIN valid -->
			<img src="{form.date.valid.IMAGE}" border="0" name="imglink_date" style="vertical-align:top;margin-top:5px;" title="{form.date.valid.LIBELLE}" onclick="{form.date.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<input type="text" value="{form.date.ocs.VALUE}" id="ocs" disabled />
		<!-- END ocs -->	
	<br/>
	<!-- END date -->

	<!-- BEGIN comment -->
	<label>{form.comment.TITLE}</label><textarea name="commentaire" id="comment_textarea">{form.comment.VALUE}</textarea>
		<!-- BEGIN action -->
			<a href="{form.comment.action.LINK}"><img src="{form.comment.action.IMAGE}" border="0" title="{form.comment.action.LIBELLE}" name="imglink_comment" alt="" /></a>
		<!-- END action -->	
		<!-- BEGIN valid -->
			<img src="{form.comment.valid.IMAGE}" border="0" name="imglink_comment" style="vertical-align:top;margin-top:5px;" title="{form.comment.valid.LIBELLE}" onClick="{form.comment.valid.ONCLICK}" alt="" />
		<!-- END valid -->	
		<!-- BEGIN ocs -->
			<textarea name="commentaire" id="ocs" disabled>{form.comment.ocs.VALUE}</textarea>
		<!-- END ocs -->
	<br/>
	<!-- END comment -->

	<!-- BEGIN pfield_text -->
	<label>{form.pfield_text.TITLE}</label>
	<input type="text" name="{form.pfield_text.NAME}" value="{form.pfield_text.VALUE}" /><br/>
	<!-- END pfield_text -->
	
	<!-- BEGIN rebus -->
	<label>{form.rebus.TITLE}</label><textarea name="suivi" rows="10" cols="50" style="vertical-align:top">{form.rebus.VALUE}</textarea><br/>
	<!-- END rebus -->
	
	<!-- BEGIN button -->	
	<input type="submit" name="soumettre" value="{form.button.TITLE}" />
	<!-- END button -->
	
	</form>

	<!-- BEGIN key -->	
		<div class="legend">
		<p class="cat_title2" style="margin-top:0">{form.key.L_TITLE}</p>
		<img src="{form.TEMPLATE_ROOT}/arrow_ok.gif" style="vertical-align:middle;margin-left:10px;" />&nbsp;{form.key.L_OK}<br/>
		<img src="{form.TEMPLATE_ROOT}/arrow.gif" style="vertical-align:middle;margin-left:10px;" />&nbsp;{form.key.L_TRANS}<br/>
		<img src="{form.TEMPLATE_ROOT}/arrow_add.gif" style="vertical-align:middle;margin-left:10px;" />&nbsp;{form.key.L_ADD}<br/>
		<img src="{form.TEMPLATE_ROOT}/arrow_useredit.gif" style="vertical-align:middle;margin-left:10px;" />&nbsp;{form.key.L_USER}<br/>
		<img src="{form.TEMPLATE_ROOT}/arrow_forbid.gif" style="vertical-align:middle;margin-left:10px;" />&nbsp;{form.key.L_FORBID}</td>
		</div>
	<!-- END key -->	

</div>
<!-- END form -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="mess_retour">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a></p><br/>
<!-- END form_post -->

</body>
</html>