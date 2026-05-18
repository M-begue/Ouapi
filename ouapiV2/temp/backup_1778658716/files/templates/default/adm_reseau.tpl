<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox">
		<form name="form" action="{form.ACTION}" method="post" onsubmit="{form.ONSUBMIT}">

		<!-- BEGIN numero -->
		<label>{form.numero.TITLE}</label>
		<input type="text" name="numero" value="{form.numero.VALUE}" id="{form.numero.ID}" onkeyup="{form.numero.KEYUP}" {form.numero.DISABLED} /><br/>
		<!-- END numero -->
		
		<!-- BEGIN hard -->
		<label>{form.hard.TITLE}</label><select name="hardware_id" {form.hard.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form.hard.list.ID}" {form.hard.list.SELECTED}>{form.hard.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END hard -->

		<!-- BEGIN numero_select -->
		<label>{form.numero_select.TITLE}</label><select name="numero" {form.numero_select.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form.numero_select.list.ID}" {form.numero_select.list.SELECTED}>{form.numero_select.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END numero_select -->
		
		<!-- BEGIN empl -->
		<label>{form.empl.TITLE}</label><select name="emplacement_id" {form.empl.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form.empl.list.ID}" {form.empl.list.SELECTED}>{form.empl.list.LIBELLE}</option>
			<!-- END list -->
		</select>
		<!-- BEGIN action -->
			<a href="{form.empl.action.LINK}" target="_blank"><img src="{form.empl.action.IMAGE}" border="0" title="{form.empl.action.LIBELLE}" alt="" /></a>
		<!-- END action -->	
		<br/>
		<!-- END empl -->
		
		<!-- BEGIN netw -->
		<label>{form.netw.TITLE}</label><select name="switch_id" {form.netw.DISABLED}>
			<!-- BEGIN list -->
				<option value="{form.netw.list.ID}" {form.netw.list.SELECTED}>{form.netw.list.LIBELLE}</option>
			<!-- END list -->
		</select><br/>
		<!-- END netw -->

		<!-- BEGIN port -->
		<label>{form.port.TITLE}</label>
		<input type="text" name="port_id" value="{form.port.VALUE}" onkeyup="{form.port.KEYUP}" {form.port.DISABLED} /><br/>
		<!-- END port -->
	
		<!-- BEGIN hard_assoc -->		
			<!-- BEGIN list -->
				<label>{form.hard_assoc.list.TITLE}</label><input type="checkbox" name="{form.hard_assoc.list.NAME}" value="{form.hard_assoc.list.VALUE}" {form.hard_assoc.list.CHECKED}><br/>
			<!-- END list -->
		<input type="hidden" name="nb_type" value="{form.hard_assoc.NB_TYPE}" />
		<!-- END hard_assoc -->

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

<!-- BEGIN help -->
<div class="help"><img src="{help.IMG}" style="margin-top:-40px;margin-left:-27px;" title="{help.IMG_TITLE}">{help.GENERAL_HELP}</div>	
<!-- END help -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->
