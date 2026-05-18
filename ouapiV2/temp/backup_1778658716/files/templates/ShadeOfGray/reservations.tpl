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
    $( "#datepicker_deb" ).datepicker({
		numberOfMonths: 3,
		showOtherMonths:true,
		selectOtherMonths:true,
		changeMonth: true,
    changeYear: true,
		showOn:"button",
		buttonImageOnly:true,
		dateFormat:"dd-mm-yy",
		buttonImage:"images/calendar.gif"
		});
		$( "#datepicker_fin" ).datepicker({
		numberOfMonths: 3,
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
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox_white">
		<form name="form1" action="{form.ACTION}" method="POST">
			<label>{form.L_HARD}</label>
			<input type="text" value="{form.HARDNAME}" id="large" disabled /><br/>
			
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
			
			
			
			<label>{form.L_USER}</label>
			<Select name="user_id">
			<!-- BEGIN user -->
				<option value="{form.user.ID}" {form.user.SELECTED}>{form.user.USERNAME}</option>
			<!-- END user -->	
			</select><br/>
			<label>{form.L_OBJ}</label>
			<input type="text" name="object" /><br/>


			<label>{form.L_STARTDATE}</label>
			<input name="date_deb" type="text" id="datepicker_deb" /> &nbsp;
			{form.SELECT_STHOUR}&nbsp;{form.SELECT_STMIN}<br/>
			<label>{form.L_ENDDATE}</label>
			<input name="date_fin" type="text" id="datepicker_fin" /> &nbsp;
			{form.SELECT_ENDHOUR}&nbsp;{form.SELECT_ENDMIN}<br/>
			<input type="hidden" name="agence_id" value="{form.AGENCE_ID}" />
			<input type="hidden" name="{form.TYPE_NAME}" value="{form.TYPE_ID}" />
	
			<input type="submit" name="soumettre" value="{form.L_ADD}" />
		</form>
	</div>
	
	<!-- BEGIN calendar -->
		<div class="cat_title" style="margin-top:10px;">{form.calendar.L_TITLE}</div>
		<div class="textbox">{form.calendar.CAL}</div>
	<!-- END calendar -->
	
	<!-- BEGIN histo -->
	<div class="cat_title" style="margin-top:20px;">{form.histo.L_TITLE}</div>
	<div class="textbox">
		<table class="table">
		<tr>
			<td class="titre3">{form.histo.L_USER}</td>
			<td class="titre3">{form.histo.L_OBJECT}</td>					
			<td class="titre3">{form.histo.L_STARTDATE}</td>					
			<td class="titre3">{form.histo.L_ENDDATE}</td>
			<td class="titre3">{form.histo.L_TOOLS}</td>
		</tr>
			
			<!-- BEGIN list -->
			<tr>
				<td class="row1">{form.histo.list.USER}</td>
				<td class="row1">{form.histo.list.OBJECT}</td>					
				<td class="row1">{form.histo.list.STARTDATE}</td>					
				<td class="row1">{form.histo.list.ENDDATE}</td>
				<td class="row1">
				<!-- BEGIN tools -->
				<a href="{form.histo.list.tools.LINK}"><img src="{form.histo.list.tools.IMAGE}" title="{form.histo.list.tools.TITLE}" border="0" alt=""/></a>&nbsp;
				<!-- END tools -->			
				&nbsp;</td>
			</tr>
			<!-- END list -->
		
		</table>
	</div>	
	<!-- END histo -->
<!-- END form -->

<!-- BEGIN view -->
	<div class="cat_title">{view.L_TITLE}</div>
	<!-- BEGIN print -->
		<p class="toolbox" style="margin-left:40px;">
		<img src="{view.print.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="{view.print.LINK}">{view.print.TEXT}</a>
		</p>
	<!-- END add -->

	<div class="textbox" style="margin-top:40px;">{view.CAL}</div>
<!-- END view -->

<!-- BEGIN form_post -->
	<br/>
	<p class="contenu" id="{form_post.ID}">{form_post.OK}<br/>
	<br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<a href="{form_post.BACK_PAGE}">{form_post.BACK}</a>
	</p><br/>
<!-- END form_post -->

</body>
</html>