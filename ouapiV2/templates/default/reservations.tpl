<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox">
		<FORM name="form1" action="{form.ACTION}" method="POST">
		<label>{form.L_HARD}</label><input type="text" value="{form.HARDNAME}" id="large" disabled><br/>
		<label>{form.L_USER}</label><Select name="user_id">
		<!-- BEGIN user -->
			<option value="{form.user.ID}" {form.user.SELECTED}>{form.user.USERNAME}</option>';
		<!-- END user -->	
		</select><br/>
		<label>{form.L_OBJ}</label><input type="text" name="object"><br/>
		<label>{form.L_STARTDATE}</label><input type="text" name="date_deb" style="margin-right:3" readonly>
		<a href="javascript:show_calendar('document.form1.date_deb', document.form1.date_deb.value,0);"><img src="{form.IMG_CALENDAR}" width="16" height="16" border="0"></a>&nbsp;
		{form.SELECT_STHOUR}&nbsp;{form.SELECT_STMIN}<br/>
		<label>{form.L_ENDDATE}</label><input type="text" name="date_fin" style="margin-right:3" readonly>
		<a href="javascript:show_calendar('document.form1.date_fin', document.form1.date_fin.value,0);"><img src="{form.IMG_CALENDAR}" width="16" height="16" border="0"></a>&nbsp;
		{form.SELECT_ENDHOUR}&nbsp;{form.SELECT_ENDMIN}<br/>
		<input type="hidden" name="agence_id" value="{form.AGENCE_ID}">
		<input type="hidden" name="{form.TYPE_NAME}" value="{form.TYPE_ID}">

		<input type="submit" name="soumettre" value="{form.L_ADD}">
		</form>
	</div>
	
	<!-- BEGIN calendar -->
	<div class="cat_title" style="margin-top:10px;">{form.calendar.L_TITLE}</div>
	<div class="textbox">
	{form.calendar.CAL}
	</div>
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
			<a href="{form.histo.list.tools.LINK}"><img src="{form.histo.list.tools.IMAGE}" title="{form.histo.list.tools.TITLE}" border="0"></a>&nbsp;
			<!-- END tools -->			
			&nbsp;</td>
		</tr>
		<!-- END list -->
	
	</table></div>	
	<!-- END histo -->
<!-- END form -->

<!-- BEGIN view -->
	<div class="cat_title">{view.L_TITLE}</div>
	<!-- BEGIN print -->
		<p class="toolbox" style="margin-left:40px;"><img src="{view.print.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="{view.print.LINK}">{view.print.TEXT}</a></p>
	<!-- END add -->

	<div class="textbox" style="margin-top:40px;">{view.CAL}</div>
<!-- END view -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<a href="{form_post.BACK_PAGE}">{form_post.BACK}</a></p><br/>
<!-- END form_post -->

