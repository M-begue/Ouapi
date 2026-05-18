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
		$( "#datepicker_archive" ).datepicker({
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

<!-- BEGIN select -->
	<div class="cat_title">{select.TITLE}</div>
	<div class="textbox_white">
    <form name="form" action="{select.ACTION}" method="post" enctype="multipart/form-data" onsubmit="return verifErrors()">
		<!-- BEGIN elmt_select -->
		<label>{select.elmt_select.TITLE}</label>
    <select name="elmt_id" id="{select.elmt_select.ID}" onchange="{select.elmt_select.CHANGE}" {select.elmt_select.DISABLED}>
			<!-- BEGIN list -->
				<option value="{select.elmt_select.list.ID}" {select.elmt_select.list.SELECTED}>{select.elmt_select.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END elmt_select -->
    		
		<!-- BEGIN elmt -->
		<input type="hidden" name="elmt_id" value="{select.elmt.ID}" />
		<!-- END elmt -->
		
		<!-- BEGIN doc_select -->
		<label>{select.doc_select.TITLE}</label>
    <select name="doc_id" id="{select.doc_select.ID}" onchange="{select.doc_select.CHANGE}" {select.doc_select.DISABLED}>
			<!-- BEGIN list -->
				<option value="{select.doc_select.list.ID}" style="{select.doc_select.list.STYLE}" {select.doc_select.list.SELECTED}>{select.doc_select.list.LIBELLE}</option>
			<!-- END list --> 
		</select><br/>
		<!-- END doc_select -->	
    		
		<!-- BEGIN doc -->
		<input type="hidden" name="doc_id" value="{select.doc.ID}" />
		<!-- END doc -->
		
		<!-- BEGIN javascript -->
		<script type=text/javascript>
			var RS = new Array();
			var Comment = new Array();
			<!-- BEGIN list -->	
			{select.javascript.list.TEXT}
			<!-- END list -->				
		</script>
		<!-- END javascript -->

		<!-- BEGIN rs -->
		<label>{select.rs.TITLE}</label>
		<input type="text" name="rs" value="{select.rs.VALUE}" id="{select.rs.ID}" {select.rs.DISABLED} /><br/>
		<!-- END rs -->

		<!-- BEGIN comment -->
		<label>{select.comment.TITLE}</label>
    <textarea name="commentaire" {select.comment.DISABLED}>{select.comment.VALUE}</textarea><br/>
		<!-- END comment -->
		
		<!-- BEGIN type -->
		<input type="hidden" name="add_type" value="{select.type.ID}" />
		<!-- END type -->

		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{select.button.TITLE}" />
		<!-- END button -->
		
		</form>
	</div>
<!-- END select -->
<!-- BEGIN no_select -->
	<div class="no_record">{no_select.TEXT}</div>
<!-- END no_select -->
	
<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox_white">
    <form name="form" action="{form.ACTION}" method="post" enctype="multipart/form-data" onsubmit="return verifErrors()">
		<!-- BEGIN type -->
		<label>{form.type.TITLE}</label>
    <select name="type" id="{form.type.ID}" onchange="{form.type.CHANGE}" {form.type.DISABLED}>
			<!-- BEGIN list -->
			<option value="{form.type.list.ID}" {form.type.list.SELECTED}>{form.type.list.LIBELLE}</option>
			<!-- END list -->
		</select>
		<!-- BEGIN action -->
		<a href="{form.type.action.LINK}" target="_blank"><img src="{form.type.action.IMAGE}" border="0" title="{form.type.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<br/>
		<!-- END type -->
		
		<!-- BEGIN entreprise -->
		<label>{form.entreprise.TITLE}</label>
    <select name="entreprise" id="{form.entreprise.ID}" onchange="{form.entreprise.CHANGE}" {form.entreprise.DISABLED}>
			<!-- BEGIN list -->
			<option value="{form.entreprise.list.ID}" {form.entreprise.list.SELECTED}>{form.entreprise.list.LIBELLE}</option>
			<!-- END list -->
		</select>
    
		<!-- BEGIN action -->
		<a href="{form.entreprise.action.LINK}" target="_blank"><img src="{form.entreprise.action.IMAGE}" border="0" title="{form.entreprise.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<br/>
		<!-- END entreprise -->
		
		<!-- BEGIN ref -->
		<label>{form.ref.TITLE}</label>
		<input type="text" name="ref" value="{form.ref.VALUE}" id="{form.ref.ID}" onkeyup="{form.ref.KEYUP}" {form.ref.DISABLED} /><br/>
		<!-- END ref -->
		
		<!-- BEGIN date -->
		<label>{form.date.TITLE}</label>
		<input name="date" type="text" id="datepicker" value="{form.date.VALUE}" />
		<br/>
		<!-- END date -->

		<!-- BEGIN date_archive -->
		<label>{form.date_archive.TITLE}</label>
		<input name="date_archive" type="text" id="datepicker_archive" value="{form.date_archive.VALUE}" />
		<br/>
		<!-- END date_archive -->
		
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

		<!-- BEGIN comment -->
		<label>{form.comment.TITLE}</label>
    <textarea name="commentaire" {form.comment.DISABLED} rows="3" cols="30">{form.comment.VALUE}</textarea><br/>
		<!-- END comment -->

		<!-- BEGIN file -->
		<label>{form.file.TITLE}</label>
		<input type="file" name="doc" value="{form.file.VALUE}" id="large" {form.file.DISABLED} /><br/>
		<!-- END file -->

		<!-- BEGIN pfield_text -->
		<label>{form.pfield_text.TITLE}</label>
		<input type="text" name="{form.pfield_text.NAME}" value="{form.pfield_text.VALUE}" /><br/>
		<!-- END pfield_text -->

		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{form.button.TITLE}" />
		<!-- END button -->
		
		</form>
	</div>
<!-- END form -->

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