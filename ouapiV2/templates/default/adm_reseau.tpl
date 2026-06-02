<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox">
		<form name="form" action="{form.ACTION}" method="post" onsubmit="{form.ONSUBMIT}">

		<!-- BEGIN equipement_connecte -->
		<fieldset>
			<legend>Equipement connecté</legend>
			
			<!-- BEGIN hard -->
			<label>{form.equipement_connecte.hard.TITLE}</label><select name="hardware_id" id="hardware_id_select" {form.equipement_connecte.hard.DISABLED} onchange="updateEmplacementConnecte()">
				<!-- BEGIN list -->
					<option value="{form.equipement_connecte.hard.list.ID}" data-emplacement-id="{form.equipement_connecte.hard.list.EMPLACEMENT_ID}" {form.equipement_connecte.hard.list.SELECTED}>{form.equipement_connecte.hard.list.LIBELLE}</option>
				<!-- END list -->
			</select><br/>
			<!-- END hard -->

			<!-- BEGIN empl_connecte -->
			<label>{form.equipement_connecte.empl_connecte.TITLE}</label><select id="emplacement_connecte_select" {form.equipement_connecte.empl_connecte.DISABLED}>
				<!-- BEGIN list -->
					<option value="{form.equipement_connecte.empl_connecte.list.ID}" {form.equipement_connecte.empl_connecte.list.SELECTED}>{form.equipement_connecte.empl_connecte.list.LIBELLE}</option>
				<!-- END list -->
			</select><br/>
			<!-- END empl_connecte -->

			<!-- BEGIN numero -->
			<label>{form.equipement_connecte.numero.TITLE}</label>
			<input type="text" name="numero" value="{form.equipement_connecte.numero.VALUE}" id="{form.equipement_connecte.numero.ID}" onkeyup="{form.equipement_connecte.numero.KEYUP}" {form.equipement_connecte.numero.DISABLED} /><br/>
			<!-- END numero -->

			<!-- BEGIN type_reseau_materiel -->
			<label>{form.equipement_connecte.type_reseau_materiel.TITLE}</label><select name="type_reseau_materiel_id" {form.equipement_connecte.type_reseau_materiel.DISABLED}>
				<!-- BEGIN list -->
					<option value="{form.equipement_connecte.type_reseau_materiel.list.ID}" {form.equipement_connecte.type_reseau_materiel.list.SELECTED}>{form.equipement_connecte.type_reseau_materiel.list.LIBELLE}</option>
				<!-- END list -->
			</select>
			<!-- BEGIN action -->
				<a href="{form.equipement_connecte.type_reseau_materiel.action.LINK}"><img src="{form.equipement_connecte.type_reseau_materiel.action.IMAGE}" border="0" title="{form.equipement_connecte.type_reseau_materiel.action.LIBELLE}" alt="" /></a>
			<!-- END action -->	
			<br/>
			<!-- END type_reseau_materiel -->

			<!-- BEGIN poe_checkbox_materiel -->
			<label>{form.equipement_connecte.poe_checkbox_materiel.TITLE}</label>
			<input type="checkbox" name="POE_materiel" value="1" {form.equipement_connecte.poe_checkbox_materiel.CHECKED} {form.equipement_connecte.poe_checkbox_materiel.DISABLED} /><br/>
			<!-- END poe_checkbox_materiel -->

			<!-- BEGIN brancher_poe_checkbox_materiel -->
			<label>{form.equipement_connecte.brancher_poe_checkbox_materiel.TITLE}</label>
			<input type="checkbox" name="Brancher_POE_materiel" value="1" {form.equipement_connecte.brancher_poe_checkbox_materiel.CHECKED} {form.equipement_connecte.brancher_poe_checkbox_materiel.DISABLED} /><br/>
			<!-- END brancher_poe_checkbox_materiel -->
		</fieldset>
		<!-- END equipement_connecte -->

		<!-- BEGIN equipement_reseau -->
		<fieldset>
			<legend>Equipement réseau</legend>
			
			<!-- BEGIN netw -->
			<label>{form.equipement_reseau.netw.TITLE}</label><select name="switch_id" id="switch_id_select" {form.equipement_reseau.netw.DISABLED} onchange="updateEmplacementReseau()">
				<!-- BEGIN list -->
					<option value="{form.equipement_reseau.netw.list.ID}" data-emplacement-id="{form.equipement_reseau.netw.list.EMPLACEMENT_ID}" {form.equipement_reseau.netw.list.SELECTED}>{form.equipement_reseau.netw.list.LIBELLE}</option>
				<!-- END list -->
			</select><br/>
			<!-- END netw -->
			
			<!-- BEGIN empl -->
			<label>{form.equipement_reseau.empl.TITLE}</label><select id="emplacement_reseau_select" {form.equipement_reseau.empl.DISABLED}>
				<!-- BEGIN list -->
					<option value="{form.equipement_reseau.empl.list.ID}" {form.equipement_reseau.empl.list.SELECTED}>{form.equipement_reseau.empl.list.LIBELLE}</option>
				<!-- END list -->
			</select>
			<input type="hidden" name="emplacement_id" id="emplacement_reseau_hidden" value="{form.equipement_reseau.empl.HIDDEN_VALUE}" />
			<br/>
			<!-- END empl -->

			<!-- BEGIN port -->
			<label>{form.equipement_reseau.port.TITLE}</label>
			<input type="text" name="port_id" value="{form.equipement_reseau.port.VALUE}" onkeyup="{form.equipement_reseau.port.KEYUP}" {form.equipement_reseau.port.DISABLED} /><br/>
			<!-- END port -->

			<!-- BEGIN type_reseau_equipement -->
			<label style = "font-size: 12.2px;">{form.equipement_reseau.type_reseau_equipement.TITLE}</label><select name="type_reseau_equipement_id" {form.equipement_reseau.type_reseau_equipement.DISABLED}>
				<!-- BEGIN list -->
					<option value="{form.equipement_reseau.type_reseau_equipement.list.ID}" {form.equipement_reseau.type_reseau_equipement.list.SELECTED}>{form.equipement_reseau.type_reseau_equipement.list.LIBELLE}</option>
				<!-- END list -->
			</select>
			<!-- BEGIN action -->
				<a href="{form.equipement_reseau.type_reseau_equipement.action.LINK}"><img src="{form.equipement_reseau.type_reseau_equipement.action.IMAGE}" border="0" title="{form.equipement_reseau.type_reseau_equipement.action.LIBELLE}" alt="" /></a>
			<!-- END action -->	
			<br/>
			<!-- END type_reseau_equipement -->

			<!-- BEGIN poe_checkbox_reseau -->
			<label>{form.equipement_reseau.poe_checkbox_reseau.TITLE}</label>
			<input type="checkbox" name="POE_reseau" value="1" {form.equipement_reseau.poe_checkbox_reseau.CHECKED} {form.equipement_reseau.poe_checkbox_reseau.DISABLED} /><br/>
			<!-- END poe_checkbox_reseau -->

			<!-- BEGIN brancher_poe_checkbox_reseau -->
			<label>{form.equipement_reseau.brancher_poe_checkbox_reseau.TITLE}</label>
			<input type="checkbox" name="Brancher_POE_reseau" value="1" {form.equipement_reseau.brancher_poe_checkbox_reseau.CHECKED} {form.equipement_reseau.brancher_poe_checkbox_reseau.DISABLED} /><br/>
			<!-- END brancher_poe_checkbox_reseau -->
		</fieldset>
		<!-- END equipement_reseau -->
	
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
		<div style="display:flex; gap:10px; align-items:center; justify-content:space-between;">
		<input type="submit" name="soumettre" value="{form.button.TITLE}" />
		<button type="button" onclick="closeToHome({form.AGENCE_ID}, 'netw')" style="padding:10px 20px; font-size:1.1em;">{form.RETURN}</button>
		</div>
		<!-- END button -->

		</form>
		<script>
		function updateEmplacementConnecte() {
			var hardwareSelect = document.getElementById('hardware_id_select');
			var emplacementSelect = document.getElementById('emplacement_connecte_select');
			var selectedOption = hardwareSelect.options[hardwareSelect.selectedIndex];
			var emplacementId = selectedOption.getAttribute('data-emplacement-id');
			
			if (emplacementId) {
				emplacementSelect.value = emplacementId;
			}
		}

		function updateEmplacementReseau() {
    		var switchSelect = document.getElementById('switch_id_select');
    		var emplacementSelect = document.getElementById('emplacement_reseau_select');
    		var emplacementHidden = document.getElementById('emplacement_reseau_hidden');
    		var selectedOption = switchSelect.options[switchSelect.selectedIndex];
    		var emplacementId = selectedOption ? selectedOption.getAttribute('data-emplacement-id') : null;

    		if (emplacementId) {
        		emplacementSelect.value = emplacementId; // Met à jour le visuel (désactivé)
        		emplacementHidden.value = emplacementId; // Met à jour la valeur envoyée au PHP
    		} else {
        		emplacementSelect.value = '-1';
        		emplacementHidden.value = '';
    		}
		}

		updateEmplacementConnecte();
		updateEmplacementReseau();
		</script>
	</div>
<!-- END form -->

<!-- BEGIN help -->
<div class="help"><img src="{help.IMG}" style="margin-top:-40px;margin-left:-27px;" title="{help.IMG_TITLE}">{help.GENERAL_HELP}</div>	
<!-- END help -->

<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="javascript:goToHomeWithRubrique()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->
