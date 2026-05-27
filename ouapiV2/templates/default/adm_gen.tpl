<!-- BEGIN form -->
<div class="cat_title">{form.L_TITLE}</div>
<form name="form" action="{form.ACTION}" method="post">
	<label>{form.FIELDNAME_TITLE}</label>
	<input type="text" name="fieldname" value="{form.FIELDNAME_VALUE}" readonly /><br/>
	
	<label>{form.TABLE_TITLE}</label>
	<input type="text" name="table" value="{form.TABLE_VALUE}" readonly /><br/>
	
	<label>{form.FIELDTYPE_TITLE}</label>
	<select name="fieldtype">
		<option value="varchar(255)" {form.FIELDTYPE_VALUE_VARCHAR}>varchar(255)</option>
		<option value="int(11)" {form.FIELDTYPE_VALUE_INT}>int(11)</option>
		<option value="float(10,2)" {form.FIELDTYPE_VALUE_FLOAT}>float(10,2)</option>
	</select><br/>
	
	<label>{form.FIELDLABEL_TITLE}</label>
	<input type="text" name="fieldlabel" value="{form.FIELDLABEL_VALUE}" /><br/>
	
	<input type="submit" name="soumettre" value="{form.BUTTON_TITLE}" />
</form>
<!-- END form -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="javascript:goBackAndRefresh()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->
