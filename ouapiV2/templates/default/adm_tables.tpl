<!-- BEGIN select -->
	<div class="cat_title">{select.TITLE}</div>
	<div class="textbox">
	<!-- BEGIN records -->
		<table class="table">
		<tr>
			<td class="titre3">{select.records.L_LIBELLE}</td>
			<!-- BEGIN connex -->
				<td class="titre3">{select.records.connex.L_CONNEX}</td>
			<!-- END connex -->
			<!-- BEGIN place -->
				<td class="titre3">{select.records.place.L_PLACE}</td>
			<!-- END place -->
			<!-- BEGIN marque -->
				<td class="titre3">{select.records.marque.L_MARQUE}</td>
			<!-- END marque -->
			<td class="titre3">{select.records.L_TOOLS}</td>
		</tr>
		<!-- BEGIN list -->
		<tr>
			<td class="row1" style="padding-left:2px;">
				<form name="form{select.records.list.ID}" action="{select.ACTION}" method="post" onsubmit="{select.ONSUBMIT}">
				<input type="text" name="libelle" value="{select.records.list.LIBELLE}" onblur="submit()" onkeyup="verifLong(this);" class="non_form" style="padding-left:4px;border:none;width:99%;" />				
			</td>
			
			<!-- BEGIN connex -->		
			<td class="row1">
				<!-- BEGIN option -->
					{select.records.list.connex.option.LIBELLE}&nbsp;<input type="checkbox" name="{select.records.list.connex.option.NAME}" value="{select.records.list.connex.option.VALUE}" class="non_form" onclick="submit()" {select.records.list.connex.option.CHECKED} style="border:0" />&nbsp;&nbsp;
				<!-- END option -->
			</td>
			<!-- END connex -->

			<!-- BEGIN place -->
				<td class="row1"><select name="site_id" class="non_form" onchange="submit()">
				<!-- BEGIN option -->
					<option value="{select.records.list.place.option.ID}" {select.records.list.place.option.SELECTED}>{select.records.list.place.option.NAME}</option>
				<!-- END option -->
				</select></td>
			<!-- END place -->
			<!-- BEGIN monosite -->
				<input type=hidden" name="site_id" value="1" />
			<!-- END monosite -->
			
			<!-- BEGIN marque -->
				<td class="row1"><select name="marque_id" class="non_form" onchange="submit()">
				<!-- BEGIN option -->
					<option value="{select.records.list.marque.option.ID}" {select.records.list.marque.option.SELECTED}>{select.records.list.marque.option.LIBELLE}</option>
				<!-- END option -->
				</select></td>
			<!-- END marque -->
			
			<td class="row1">
				<!-- BEGIN tools -->
					<a href="{select.records.list.tools.LINK}"><img src="{select.records.list.tools.IMAGE}" border="0" title="{select.records.list.tools.TITLE}" alt="" /></a>&nbsp;
				<!-- END tools -->
				<input type="hidden" name="id" value="{select.records.list.ID}" />
				<input type="hidden" name="table" value="{select.TABLE_NAME}" />
				</form>
			</td>
		</tr>
		<!-- END list -->
		</table>
	<!-- END records -->
	<!-- BEGIN no_record -->
		<div class="no_record">{select.no_record.MESSAGE}</div>
	<!-- END no_record -->
	
	<!-- BEGIN post_result -->
		<table class="table" style="margin:0;padding:0;border:0;">
		<tr>
			<td style="margin:0;padding:0;border:0"><div class="{select.post_result.CLASS}"><img src="{select.post_result.ICON}" alt="" style="vertical-align:middle;margin-right:5px;" />{select.post_result.MESSAGE}</div></td>
		</tr>
		</table>
	<!-- END post_result -->
	
	
	</div>
<!-- END select -->



<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox">
		<form name="form" action="{form.ACTION}" method="post" onsubmit="{form.ONSUBMIT}">

		<!-- BEGIN libelle -->
		<label>{form.libelle.TITLE}</label>
		<input type="text" name="libelle" value="{form.libelle.VALUE}" id="{form.libelle.ID}" onKeyUp="{form.libelle.KEYUP}" {form.libelle.DISABLED} /><br/>
		<!-- END libelle -->

		<!-- BEGIN multisite -->
		<label>{form.multisite.TITLE}</label><select name="site_id" {form.multisite.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form.multisite.list.ID}" {form.multisite.list.SELECTED}>{form.multisite.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END multisite -->
		<!-- BEGIN monosite -->
			<input type="hidden" name="site_id" value="{form.monosite.AGENCE_ID}">
		<!-- END monosite -->

		<!-- BEGIN marque -->
		<label>{form.marque.TITLE}</label><select name="marque_id" {form.marque.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form.marque.list.ID}" {form.marque.list.SELECTED}>{form.marque.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END marque -->
		
		<!-- BEGIN connex -->		
			<label>{form.connex.TITLE}</label><p class="input" style="border:0px;margin-bottom:0;">
			<!-- BEGIN list -->
				{form.connex.list.LIBELLE}&nbsp;<input type="checkbox" name="{form.connex.list.NAME}" value="{form.connex.list.VALUE}" class="non_form" {form.connex.list.CHECKED}>&nbsp;&nbsp;
			<!-- END list -->
			</p>
		<!-- END connex -->
		
		<!-- BEGIN button -->	
		<input type="submit" name="soumettre" value="{form.button.TITLE}">
		<!-- END button -->
		
		</form>
	</div>
<!-- END form -->

<!-- BEGIN form_prepost -->
	<table class="table">
	<tr>
		<td class="warning"><form name="form" action="{form_prepost.ACTIONLABEL}" method="post" >
		<!-- BEGIN warning -->
			{form_prepost.warning.TEXT}<br/>
		<!-- END info -->
		<!-- BEGIN info -->
			{form_prepost.info.NB} {form_prepost.info.TEXT}<br/>
		<!-- END info -->
		
		<!-- BEGIN list_field -->
		<label>{form_prepost.list_field.TITLE}</label><select name="{form_prepost.list_field.NAME}" {form_prepost.list_field.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form_prepost.list_field.list.ID}" {form_prepost.list_field.list.SELECTED}>{form_prepost.list_field.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END list_field -->
		<!-- BEGIN hidden_field -->
			<input type="hidden" name="{form_prepost.hidden_field.NAME}" value="{form_prepost.hidden_field.VALUE}">
		<!-- END hidden_field -->
		<!-- BEGIN button -->
			<input type="submit" name="soumettre" value="{form_prepost.button.TEXT}">
		<!-- END button -->
		</form>
		</td>
	</tr>
	</table>
<!-- END form_prepost -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->
