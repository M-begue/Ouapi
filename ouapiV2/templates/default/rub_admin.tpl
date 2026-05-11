<!-- BEGIN r_admin -->
	<div class="leftmenu">
	<b>{r_admin.TITLE_ADMIN_GEN}</b><br/>
	<a href="{r_admin.SELF}&amp;action=param_gen">{r_admin.RUB_CONF}</a><br/>
	<a href="{r_admin.SELF}&amp;action=param_rights">{r_admin.RUB_RIGHTS}</a><br/>
	<a href="{r_admin.SELF}&amp;action=tables">{r_admin.TITLE_ADMIN_TABLE}</a><br/>
	<a href="{r_admin.SELF}&amp;action=maj_ouapi">{r_admin.TITLE_MAJOUAPI}</a><br/>

	<br/><b>{r_admin.TITLE_ADMIN_TOOLS}</b><br/>	
	<!-- <a href="{r_admin.SELF}&amp;action=import">{r_admin.TITLE_ADMIN_IMPORT}</a><br/> -->
	<a href="{r_admin.SELF}&amp;action=addfield">{r_admin.TITLE_ADMIN_ADDFIELD}</a><br/>

	<br/><b>{r_admin.TITLE_ADMIN_OPTMOD}</b><br/>	
	<!-- BEGIN menu_ldap -->
		<a href="index.php?page=accueil.php&amp;rubrique=admin&amp;action=param_ldap">{r_admin.menu_ldap.RUB_CONF_LDAP}</a><br/>
	<!-- END menu_ldap -->

	<!-- BEGIN menu_ocs -->
		<a href="index.php?page=accueil.php&amp;rubrique=admin&amp;action=param_ocs">{r_admin.menu_ocs.RUB_CONF_OCS}</a><br/>
	<!-- END menu_ocs -->

	<!-- BEGIN no_mod -->
		<i>{r_admin.no_mod.TEXT}</i><br/>
	<!-- END no_mod -->

	<br/><b>{r_admin.TITLE_ADMIN_PLUGIN}</b><br/>	
	<a href="index.php?page=accueil.php&amp;rubrique=admin&amp;action=param_plugin">{r_admin.RUB_CONF_PLUGIN}</a><br/>

	</div>

	<div class="rightmain">
		<!-- BEGIN maj -->
		<div class="rightinmain">
			<div class="cat_title">{r_admin.maj.TITLE}</div>
			<!-- BEGIN new -->
			<div class="warning" style="height:65px;margin-top:10px;"><img src="{r_admin.maj.new.ICON}" alt="" style="float:left;margin-right:20px;" />
			<font style="font-weight:bold;font-size:16px;">{r_admin.maj.new.TITLE}</font><br/>{r_admin.maj.new.TEXT}<br/>
			<a href="{r_admin.maj.new.LINK}" target="_blank">{r_admin.maj.new.LINK_TEXT}</a></div>
			<!-- END new -->	
			<!-- BEGIN no -->
				<div style="margin-top:10px;margin-bottom:10px;"><i>{r_admin.maj.no.TITLE}</i></div>
			<!-- END no -->	
		</div>
		<!-- END maj -->	
	
		<!-- BEGIN stats -->
		<div class="rightinmain">
			<div class="cat_title" style="margin-bottom:10px;">{r_admin.stats.TITLE}</div>
			<div style="float:left;"><img src="{r_admin.stats.ICON}" alt="" style="margin-top:10px;margin-right:20px;" /></div>
			<form name="stats" action="export.php" target="_blank" method="post">
			<font style="font-weight:bold;">{r_admin.stats.SUBTITLE}</font><br/>
			
			
			<!-- BEGIN last_update -->
				{r_admin.stats.last_update.LABEL} 
				<input type="hidden" name="lastupdate" value="{r_admin.stats.last_update.VALUE}">{r_admin.stats.last_update.DATE}<br/>
			<!-- END last_update -->

			<!-- BEGIN infos -->
				<br/><input type="radio" name="references" value="Oui" class="non_form" checked="checked" onclick="javascript:document.getElementById('company').style.display='block'" />&nbsp;{r_admin.stats.infos.REFERENCEYES}&nbsp;<br/>
				<input type="radio" name="references" value="Non" class="non_form"  onclick="javascript:document.getElementById('company').style.display='none'"/>&nbsp;{r_admin.stats.infos.REFERENCENO}&nbsp;<br/><br/>
			
				<div id="company">
					<label>{r_admin.stats.infos.COMPANY}</label><input type="text" name="company" /><br/>
					<label>{r_admin.stats.infos.WEBSITE}</label><input type="text" name="website" /><br/>
					<label>{r_admin.stats.infos.CONTACT}</label><input type="text" name="contact" /><br/>
				</div>			
				<label>{r_admin.stats.infos.COMMENT}</label><textarea name="comment"></textarea><br/>
				<label>{r_admin.stats.infos.SUGGEST}</label><textarea name="suggest"></textarea><br/>
			<!-- END infos -->
				
			<div style="margin-left:10px;margin-top:5px;">
				{r_admin.stats.DETAILTITLE}<br/><i>
				<!-- BEGIN details -->
				<input type="hidden" name="{r_admin.stats.details.SHORTLABEL}" value="{r_admin.stats.details.VALUE}" />
				{r_admin.stats.details.LABEL}&nbsp;{r_admin.stats.details.VALUE}<br/>
				<!-- END details -->
				</i>
			</div>
			
			<p style="text-align:center;margin-bottom:0;"><input type="submit" name="sendstats" value="{r_admin.stats.BUTTONSEND}" class="non_form" />&nbsp;
			<input type="submit" name="notsendstats" value="{r_admin.stats.BUTTONNOTSEND}" class="non_form" /></p>
			</form>
		</div>		
		<!-- END stats -->	
	
		<!-- BEGIN news -->
		<div class="rightinmain">
		<div class="cat_title" style="margin-bottom:10px;">{r_admin.news.TITLE_NEWS}</div>
		{r_admin.news.TEXT_NEWS}
		</div>
		<!-- END news -->	
			
		<!-- BEGIN tables -->
		<div class="rightinmain">
		<div class="cat_title2">{r_admin.TITLE_ADMIN_TABLE}</div>
		<table class="table">
		<tr>
			<td class="titre3">{r_admin.tables.COL_TABLE}</td>
			<td class="titre3" width="20%">{r_admin.tables.COL_TOOLS}</td>
		</tr>
		<!-- BEGIN sites -->
		<tr>
			<td class="row1">{r_admin.tables.sites.RUB_SITE}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=agences&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=agences" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;</td>
		</tr>
		<!-- END sites -->
		<tr>
			<td class="row1">{r_admin.tables.RUB_EXT}</td>
			<td class="row1"><a href="index.php?page=adm_externes.php&amp;action=add" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_externes.php&amp;action=edit" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_PLACES}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=empl&amp;action=Ajouter&amp;slct_site=1" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=empl&amp;slct_site=1" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_HARDTYPE}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=hard_type&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=hard_type" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_HARDMARQUE}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=hard_marque&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=hard_marque" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_HARDMODEL}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=hard_modele&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=hard_modele" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_PERTYPE}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=periph_type&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=periph_type" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_PERMODEL}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=periph_modele&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=periph_modele" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_OS}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=hard_os&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=hard_os" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">{r_admin.tables.RUB_DOCSTYPE}</td>
			<td class="row1"><a href="index.php?page=adm_tables.php&amp;table=docs_type&amp;action=Ajouter" target="_blank">
			<img src="{r_admin.tables.IMG_ADD}" border="0" alt="" title="{r_admin.tables.LANG_ADD}" /></a>&nbsp;
			<a href="index.php?page=adm_tables.php&amp;table=docs_type" target="_blank">
			<img src="{r_admin.tables.IMG_EDIT}" border="0" alt="" title="{r_admin.tables.LANG_EDIT}" /></a>&nbsp;
			</td>
		</tr>
		</table>
		</div>
		<!-- END tables -->

		<!-- BEGIN import -->
		<div class="rightinmain">
			<div class="cat_title2">{r_admin.import.TITLE}</div>
		
			<form name="form" action="index.php?page=import.php" method="post" enctype="multipart/form-data" target="_blank">
			<table class="table">
			<tr>
				<td class="titre3">{r_admin.import.L_SETTING}</td>
				<td class="titre3" width="20%">{r_admin.import.L_VALUE}</td>
			</tr>	
			<tr>
				<td class="row1"><b>{r_admin.import.L_TABLE}</b><br/><font style="font-size:7px"><i>{r_admin.import.DESC_TABLE}</i></font></td>
				<td class="row1" style="padding:5px;"><select name="table" class="non_form">					
				<!-- BEGIN table -->
					<option value="{r_admin.import.table.VALUE}" {r_admin.import.table.SELECTED}>{r_admin.import.table.LIBELLE}</option>
				<!-- END table -->
				</select></td>
			</tr>
			<tr>
				<td class="row1"><b>{r_admin.import.L_FILE}</b><br/><font style="font-size:7px"><i>{r_admin.import.DESC_FILE}</i></font></td>
				<td class="row1" style="padding:5px;"><input type="file" name="fichier" class="non_form" id="large" /></td>
			</tr>
			<tr>
				<td class="row1"><b>{r_admin.import.L_SEP}</b><br/><font style="font-size:7px"><i>{r_admin.import.DESC_SEP}</i></font></td>
				<td class="row1" style="padding:5px;"><select name="sep" class="non_form">					
				<!-- BEGIN sep -->
					<option value="{r_admin.import.sep.VALUE}" {r_admin.import.sep.SELECTED}>{r_admin.import.sep.LIBELLE}</option>
				<!-- END sep -->
				</select></td>
			</tr>
			<!-- BEGIN multisite -->
			<tr>
				<td class="row1"><b>{r_admin.import.multisite.L_SITE}</b><br/><font style="font-size:7px"><i>{r_admin.import.multisite.DESC_SITE}</i></font></td>
				<td class="row1" style="padding:5px;"><select name="agence_id" class="non_form">
				<!-- BEGIN list -->
					<option value="{r_admin.import.multisite.list.ID}" {r_admin.import.multisite.list.SELECTED}>{r_admin.import.multisite.list.LIBELLE}</option>
				<!-- END list -->
				</select></td>
			</tr>
			<!-- END multisite -->
			</table>
			<!-- BEGIN monosite -->
				<input type="hidden" name="agence_id" value="{r_admin.import.monosite.AGENCE_ID}" />
			<!-- END monosite -->
			<center><br/><input type="submit" name="soumettre" value="{r_admin.import.L_SEND}" class="non_form" /><br/><br/></center>
			</form>
		</div>
		<!-- END import -->	

		<!-- BEGIN pfield -->
			<!-- BEGIN add -->
			<div class="rightinmain">
				<div class="cat_title2">{r_admin.pfield.add.TITLE}</div>
				<form name="form" action="index.php?page=adm_gen.php&amp;action=addfield" method="post" enctype="multipart/form-data" target="_blank">
				<label>{r_admin.pfield.add.L_TABLE}</label>
				<select name="table">
				<!-- BEGIN table -->
					<option value="{r_admin.pfield.add.table.VALUE}">{r_admin.pfield.add.table.LABEL}</option>
				<!-- END table -->
				</select><br/>
				<label>{r_admin.pfield.add.L_FIELDNAME}</label>
				<input type="text" name="fieldname" /><br/>
				<label>{r_admin.pfield.add.L_FIELDTYPE}</label>
				<select name="fieldtype">
				<!-- BEGIN fieldtype -->
					<option value="{r_admin.pfield.add.fieldtype.VALUE}">{r_admin.pfield.add.fieldtype.LABEL}</option>
				<!-- END fieldtype -->
				</select><br/>
				<input type="submit" name="soumettre" value="{r_admin.pfield.add.BUTTON}" /><br/>
				</form>
				<div style="clear:both">&nbsp;</div>
			</div>
			<!-- END add -->
			<!-- BEGIN del -->
			<div class="rightinmain">
				<div class="cat_title2">{r_admin.pfield.del.TITLE}</div>
				<table class="table">
				<tr>
					<td class="titre3">{r_admin.pfield.del.L_NAME}</td>
					<td class="titre3">{r_admin.pfield.del.L_TABLE}</td>
					<td class="titre3">{r_admin.pfield.del.L_TOOLS}</td>
				</tr>
				<!-- BEGIN list -->
					<tr>
						<td class="row1">{r_admin.pfield.del.list.TITLE}</td>
						<td class="row1">{r_admin.pfield.del.list.TABLE}</td>
						<td class="row1"><a href="{r_admin.pfield.del.list.LINK}" target="_blank"><img src="{r_admin.pfield.del.list.ICON}" alt="" /></a></td>
					</tr>
				<!-- END list -->	
				<!-- BEGIN nolist -->
					<tr>
						<td class="no_record" colspan="3">{r_admin.pfield.del.nolist.TEXT}</td>
					</tr>
				<!-- END nolist -->
				</table>
			</div>
			<!-- END del -->			
		<!-- END pfield -->
		
		<!-- BEGIN param_gen -->
		<div class="rightinmain">
			<div class="cat_title2">{r_admin.param_gen.TITLE}</div>
			<form name="form" action="{r_admin.param_gen.FORM_ACTION}" method="post" target="_blank">
			<table class="table">
			<tr>
				<td class="titre2" colspan="2">{r_admin.param_gen.DEFAULT_USERPARAM_TITLE}</td>
			</tr>
			<tr>
				<td class="titre3" width="40%">{r_admin.param_gen.L_SETTING}</td>
				<td class="titre3">{r_admin.param_gen.L_VALUE}</td>
			</tr>
			<tr>
				<td class="row1"><b>{r_admin.param_gen.L_LANGUAGE}</b></td>
				<td class="row1" style="padding:5px;"><select name="langue_defaut" class="non_form">					
				<!-- BEGIN lang_list -->
					<option value="{r_admin.param_gen.lang_list.VALUE}" {r_admin.param_gen.lang_list.SELECTED}>{r_admin.param_gen.lang_list.LIBELLE}</option>
				<!-- END lang_list -->
				</select></td>
			</tr>
			<tr>
				<td class="row1"><b>{r_admin.param_gen.L_TEMPLATE}</b></td>
				<td class="row1" style="padding:5px;"><select name="template_defaut" class="non_form">					
				<!-- BEGIN tpl_list -->
					<option value="{r_admin.param_gen.tpl_list.ROOT}" {r_admin.param_gen.tpl_list.SELECTED}>{r_admin.param_gen.tpl_list.NAME}</option>
				<!-- END tpl_list -->
				</select></td>
			</tr>
			<!-- BEGIN subcat -->
			<tr>
				<td class="titre2" colspan="2">{r_admin.param_gen.subcat.TITLE}</td>
			</tr>
			<tr>
				<td class="titre3" width="40%">{r_admin.param_gen.L_SETTING}</td>
				<td class="titre3">{r_admin.param_gen.L_VALUE}</td>
			</tr>
				<!-- BEGIN list -->
					<tr>
						<td class="row1"><b>{r_admin.param_gen.subcat.list.PARAM}</b>
						<!-- BEGIN desc -->
						<br/><font style="font-size:7px"><i>{r_admin.param_gen.subcat.list.desc.LIBELLE}</i></font>
						<!-- END desc -->
						</td>
						<td class="row1" style="padding:5px;">					
						<!-- BEGIN text -->
							<input type="text" name="{r_admin.param_gen.subcat.list.text.NAME}" value="{r_admin.param_gen.subcat.list.text.VALUE}" />
						<!-- END text -->
						
						<!-- BEGIN radio_yn -->
							{r_admin.param_gen.subcat.list.radio_yn.L_YES}&nbsp;<input type="radio" name="{r_admin.param_gen.subcat.list.radio_yn.NAME}" value="1" class="non_form" {r_admin.param_gen.subcat.list.radio_yn.Y_CHECKED} />&nbsp;&nbsp;
							{r_admin.param_gen.subcat.list.radio_yn.L_NO}&nbsp;<input type="radio" name="{r_admin.param_gen.subcat.list.radio_yn.NAME}" value="0" class="non_form" {r_admin.param_gen.subcat.list.radio_yn.N_CHECKED} />						
						<!-- END radio_yn -->
						</td>
					</tr>
				<!-- END list -->
			<!-- END subcat -->
			<tr>
				<td class="row1"><b>{r_admin.param_gen.L_OCSACTIVE}</b><br/><font style="font-size:7px"><i>{r_admin.param_gen.DESC_OCSACTIVE}</i></font></td>
				<td class="row1" style="padding:5px;">
				<!-- BEGIN ocs -->
					{r_admin.param_gen.L_YES}&nbsp;<input type="radio" name="ocs" value="Oui" class="non_form" {r_admin.param_gen.ocs.Y_CHECKED} />&nbsp;&nbsp;
					{r_admin.param_gen.L_NO}&nbsp;<input type="radio" name="ocs" value="Non" class="non_form" {r_admin.param_gen.ocs.N_CHECKED} />						
				<!-- END ocs -->
				</td>
			</tr>
			<tr>
				<td class="row1"><b>{r_admin.param_gen.L_LDAPACTIVE}</b><br/><font style="font-size:7px"><i>{r_admin.param_gen.DESC_LDAPACTIVE}</i></font></td>
				<td class="row1" style="padding:5px;">
				<!-- BEGIN ldap -->
					{r_admin.param_gen.L_YES}&nbsp;<input type="radio" name="ldap" value="Oui" class="non_form" {r_admin.param_gen.ldap.Y_CHECKED} />&nbsp;&nbsp;
					{r_admin.param_gen.L_NO}&nbsp;<input type="radio" name="ldap" value="Non" class="non_form" {r_admin.param_gen.ldap.N_CHECKED} />						
				<!-- END ldap -->
				</td>
			</tr>
			<tr>
				<td class="row1"><b>{r_admin.param_gen.L_MULTIACTIVE}</b><br/><font style="font-size:7px"><i>{r_admin.param_gen.DESC_MULTIACTIVE}</i></font></td>
				<td class="row1" style="padding:5px;">
				<!-- BEGIN multi -->
					{r_admin.param_gen.L_YES}&nbsp;<input type="radio" name="multi" value="Oui" class="non_form" {r_admin.param_gen.multi.Y_CHECKED} />&nbsp;&nbsp;
					{r_admin.param_gen.L_NO}&nbsp;<input type="radio" name="multi" value="Non" class="non_form" {r_admin.param_gen.multi.N_CHECKED} />						
				<!-- END multi -->
				</td>
			</tr>

			</table>
			<center><br/><input type="submit" name="soumettre" value="{r_admin.param_gen.L_SEND}" class="non_form" /><br/><br/></center>
			</form>
		</div>
		<!-- END param_gen -->

		<!-- BEGIN rights -->
		<div class="rightinmain">
			<div class="cat_title2">{r_admin.rights.TITLE_CREATE}</div><br/>

			<form name="form_grpadd" action="{r_admin.rights.ADDFORM_ACTION}" method="post" target="_blank">
			<div class="cat_menu">{r_admin.rights.ADD_LABEL}
			<input type="text" name="grp_name" class="non_form" style="margin-left:50px;width:200px;">
			<input type="submit" name="" value="{r_admin.rights.GRPADD_BUTTON}" class="non_form" style="margin-left:10px;" />
			</div>
			</form>
		</div>
		<div class="rightinmain">
			<div class="cat_title2">{r_admin.rights.TITLE_MODIFY}</div><br/>

			<form name="form_grplist" action="index.php" method="get">
			<input type="hidden" name="page" value="accueil.php" />
			<input type="hidden" name="rubrique" value="admin" />
			<input type="hidden" name="action" value="param_rights" />
			<div class="cat_menu">{r_admin.rights.SELECT_LABEL}
			<select name="grp_id" class="non_form" style="margin-left:50px;width:200px;" onchange="submit()">
			<!-- BEGIN grp_list -->
				<option value="{r_admin.rights.grp_list.ID}" {r_admin.rights.grp_list.SELECTED}>{r_admin.rights.grp_list.NAME}</option><br/>
			<!-- END grp_list -->
			</select>
			</div>
			</form>
			
			<!-- BEGIN grp -->
				<div style="padding:10px;margin-bottom:20px;border-top:1px solid #DDDDDD;"><b>{r_admin.rights.grp.TEXT_EDIT}</b>
				<table class="table">
				<form name="form" action="{r_admin.rights.grp.FORM_ACTION}" method="post" target="_blank">
				<!-- BEGIN category -->		
				<tr>
					<td width="20%">{r_admin.rights.grp.category.CAT_NAME}</td>
					<td>
					<!-- BEGIN rghts -->
						<span style="margin-right:20px;"><input type="checkbox" name="{r_admin.rights.grp.category.rghts.ID}" value="{r_admin.rights.grp.category.rghts.ID}" class="non_form" {r_admin.rights.grp.category.rghts.CHECKED} />&nbsp;{r_admin.rights.grp.category.rghts.LIBELLE}</span>
					<!-- END rghts -->
					</td>
				</p>
				<!-- END category -->
				</table>
				<p style="text-align:center"><input type="submit" name="" value="{r_admin.rights.grp.BUTTON}" class="non_form" /></p>
				</form></div>
			<!-- END grp -->
			
			<!-- BEGIN del_grp -->
				<div style="padding:10px;margin-bottom:20px;border-top:1px solid #DDDDDD;"><b>{r_admin.rights.del_grp.TEXT_DEL}</b><br/>
				 <form name="form_del" action="{r_admin.rights.del_grp.FORM_ACTION}" method="post" target="_blank">
				{r_admin.rights.del_grp.TEXT_NEWGRP}<select name="grp_new" class="non_form" style="margin-left:50px;width:200px;">
				<!-- BEGIN list -->
					<option value="{r_admin.rights.del_grp.list.ID}">{r_admin.rights.del_grp.list.NAME}</option><br/>
				<!-- END list -->
				</select>
				<p style="text-align:center"><input type="submit" name="" value="{r_admin.rights.del_grp.BUTTON}" class="non_form" style="margin-left:10px;" /></p>
				</form></div>
			<!-- END del_grp -->
		</div>
		<!-- END rights -->

		<!-- BEGIN maj_ouapi -->
			<!-- BEGIN check -->
			<div class="warning" style="height:65px;margin-top:0;"><img src="{r_admin.maj_ouapi.check.ICON}" alt="" style="float:left;margin-right:20px;" />
			<font style="font-weight:bold;font-size:16px;">{r_admin.maj_ouapi.check.TITLE}</font><br/>{r_admin.maj_ouapi.check.TEXT}<br/>
			<a href="{r_admin.maj_ouapi.check.LINK}" target="_blank">{r_admin.maj_ouapi.check.LINK_TEXT}</a></div>
			<!-- END check -->	
		<!-- END maj_ouapi -->
		
		<!-- BEGIN param_ldap -->
		<div class="rightinmain">
			<div class="cat_title2">{r_admin.param_ldap.TITLE}</div>
			<form name="form" action="index.php?page=adm_gen.php&amp;action=param_ldap" method="post" target="_blank">
			<table class="table">
			<!-- BEGIN subcat -->
			<tr>
				<td class="titre2" colspan="2">{r_admin.param_ldap.subcat.TITLE}</td>
			</tr>
			<tr>
				<td class="titre3" width="40%">{r_admin.param_ldap.subcat.L_SETTING}</td>
				<td class="titre3">{r_admin.param_ldap.subcat.L_VALUE}</td>
			</tr>
				<!-- BEGIN list -->
					<tr>
						<td class="row1"><b>{r_admin.param_ldap.subcat.list.PARAM}</b>
						<!-- BEGIN desc -->
						<br/><font style="font-size:7px"><i>{r_admin.param_ldap.subcat.list.desc.LIBELLE}</i></font>
						<!-- END desc -->
						</td>
						<td class="row1" style="padding:5px;">				
						<!-- BEGIN text -->
							<input type="text" name="{r_admin.param_ldap.subcat.list.text.NAME}" value="{r_admin.param_ldap.subcat.list.text.VALUE}" class="non_form" id="large" />
						<!-- END text -->
						<!-- BEGIN select -->
						<select name="{r_admin.param_ldap.subcat.list.select.NAME}" class="non_form">	
							<!-- BEGIN option -->
								<option value="{r_admin.param_ldap.subcat.list.select.option.VALUE}" {r_admin.param_ldap.subcat.list.select.option.SELECTED}>{r_admin.param_ldap.subcat.list.select.option.LIBELLE}</option>
							<!-- END option -->		
						</select>
						<!-- END select -->				
						</td>
					</tr>
				<!-- END list -->	
			<!-- END subcat -->			
			</table>
			<center><br/><input type="submit" name="soumettre" value="{r_admin.param_ldap.L_SEND}" class="non_form" /><br/><br/></center>
			</form>
		</div>
		<!-- END param_ldap -->
		
		<!-- BEGIN param_ocs -->
		<div class="rightinmain">
			<div class="cat_title2">{r_admin.param_ocs.TITLE}</div>
			
			<!-- BEGIN error -->
			<div class="contenu" id="alert" style="margin:2px;margin-top:10px;margin-bottom:10px;">{r_admin.param_ocs.error.TEXT}</div>
			<!-- END error -->
			
			<form name="form" action="index.php?page=adm_gen.php&amp;action=param_ocs" method="post" target="_blank">
			<table class="table">
			<tr>
				<td class="titre3" width="40%">{r_admin.param_ocs.L_SETTING}</td>
				<td class="titre3">{r_admin.param_ocs.L_VALUE}</td>
			</tr>
			<!-- BEGIN list -->
				<tr>
					<td class="row1"><b>{r_admin.param_ocs.list.PARAM}</b>
					<!-- BEGIN desc -->
					<br/><font style="font-size:7px"><i>{r_admin.param_ocs.list.desc.LIBELLE}</i></font>
					<!-- END desc -->
					</td>
					<td class="row1" style="padding:5px;">				
					<!-- BEGIN text -->
						<input type="text" name="{r_admin.param_ocs.list.text.NAME}" value="{r_admin.param_ocs.list.text.VALUE}" class="non_form" id="large" />
					<!-- END text -->					
					</td>
				</tr>
			<!-- END list -->
			</table>
			<center><br/><input type="submit" name="soumettre" value="{r_admin.param_ocs.L_SEND}" class="non_form" /><br/><br/></center>
			</form>

			<!-- BEGIN config -->
			<div class="cat_title2">{r_admin.param_ocs.config.TITLE}</div>
			<table class="table">
				<tr>
					<td class="titre3">{r_admin.param_ocs.config.L_NAMEDESC}</td>
					<td class="titre3">{r_admin.param_ocs.config.L_VALUE1}</td>
					<td class="titre3">{r_admin.param_ocs.config.L_VALUE2}</td>
				</tr>
				<!-- BEGIN list -->
				<tr>
					<td class="row1">{r_admin.param_ocs.config.list.NAME}<br/>
					<font style="font-size:7px"><i>{r_admin.param_ocs.config.list.DESC}</i></font></td>
					<td class="row1">{r_admin.param_ocs.config.list.TVALUE}</td>
					<td class="row1">{r_admin.param_ocs.config.list.IVALUE}</td>
				</tr>
				<!-- END list -->
			</table>
			<!-- END config -->
		</div>
		<!-- END param_ocs -->

		<!-- BEGIN param_plugin -->
		<div class="rightinmain">

		<div class="cat_title2">{r_admin.param_plugin.TITLE_NEW}</div>
			<table class="table">
			<tr>
				<td class="titre3" width="40%">{r_admin.param_plugin.L_NAME}</td>
				<td class="titre3">{r_admin.param_plugin.L_TYPE}</td>
				<td class="titre3">{r_admin.param_plugin.L_PATH}</td>
				<td class="titre3">{r_admin.param_plugin.L_COMP}</td>
				<td class="titre3">{r_admin.param_plugin.L_TOOLS}</td>
			</tr>
			<!-- BEGIN list_new -->
				<tr>
					<td class="row1"><b>{r_admin.param_plugin.list_new.NAME}</b>&nbsp;{r_admin.param_plugin.list_new.VERSION}
					<!-- BEGIN desc -->
					<br/><font style="font-size:7px"><i>{r_admin.param_plugin.list_new.desc.LIBELLE}
					<!-- END desc -->
					</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_new.TYPE}</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_new.PATH}</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_new.COMP}</td>
					<td class="row1" style="padding:5px;">
					<!-- BEGIN tools -->
					<a href="{r_admin.param_plugin.list_new.tools.LINK}" target="_blank"><img src="{r_admin.param_plugin.list_new.tools.IMAGE}" border="0" title="{r_admin.param_plugin.list_new.tools.TITLE}"></a> 
					<!-- END tools -->
					</td>
				</tr>
			<!-- END list_new -->
			<!-- BEGIN no_new -->
			<tr><td class="no_record" colspan="5">{r_admin.param_plugin.no_new.TEXT}</td></tr>
			<!-- END no_new -->	
			</table>
			
			<div class="cat_title2" style="margin-top:20px;">{r_admin.param_plugin.TITLE_UPDATE}</div>
			<table class="table">
			<tr>
				<td class="titre3" width="40%">{r_admin.param_plugin.L_NAME}</td>
				<td class="titre3">{r_admin.param_plugin.L_TYPE}</td>
				<td class="titre3">{r_admin.param_plugin.L_PATH}</td>
				<td class="titre3">{r_admin.param_plugin.L_COMP}</td>
				<td class="titre3">{r_admin.param_plugin.L_TOOLS}</td>
			</tr>
			<!-- BEGIN list_update -->
				<tr>
					<td class="row1"><b>{r_admin.param_plugin.list_update.NAME}</b>&nbsp;{r_admin.param_plugin.list_update.VERSION}
					<!-- BEGIN desc -->
					<br/><font style="font-size:7px"><i>{r_admin.param_plugin.list_update.desc.LIBELLE}
					<!-- END desc -->
					</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_update.TYPE}</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_update.PATH}</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_update.COMP}</td>
					<td class="row1" style="padding:5px;">
					<!-- BEGIN tools -->
					<a href="{r_admin.param_plugin.list_update.tools.LINK}" target="_blank"><img src="{r_admin.param_plugin.list_update.tools.IMAGE}" border="0" title="{r_admin.param_plugin.list_update.tools.TITLE}"></a> 
					<!-- END tools -->
					</td>
				</tr>
			<!-- END list_update -->
			<!-- BEGIN no_update -->
			<tr><td class="no_record" colspan="5">{r_admin.param_plugin.no_update.TEXT}</td></tr>
			<!-- END no_update -->	
			</table>
			
			<div class="cat_title2" style="margin-top:20px;">{r_admin.param_plugin.TITLE_INSTALLED}</div>
			<table class="table">
			<tr>
				<td class="titre3" width="40%">{r_admin.param_plugin.L_NAME}</td>
				<td class="titre3">{r_admin.param_plugin.L_TYPE}</td>
				<td class="titre3">{r_admin.param_plugin.L_PATH}</td>
				<td class="titre3">{r_admin.param_plugin.L_TOOLS}</td>
			</tr>
			<!-- BEGIN list_inst -->
				<tr>
					<td class="row1"><b>{r_admin.param_plugin.list_inst.NAME}</b>&nbsp;{r_admin.param_plugin.list_inst.VERSION}
					<!-- BEGIN desc -->
					<br/><font style="font-size:7px"><i>{r_admin.param_plugin.list_inst.desc.LIBELLE}
					<!-- END desc -->
					</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_inst.TYPE}</td>
					<td class="row1" style="padding:5px;">{r_admin.param_plugin.list_inst.PATH}</td>
					<td class="row1" style="padding:5px;">
					<!-- BEGIN tools -->
					<a href="{r_admin.param_plugin.list_inst.tools.LINK}" target="_blank"><img src="{r_admin.param_plugin.list_inst.tools.IMAGE}" border="0" title="{r_admin.param_plugin.list_inst.tools.TITLE}"></a> 
					<!-- END tools -->
					</td>
				</tr>
			<!-- END list_inst -->
			<!-- BEGIN no_inst -->
			<tr><td class="no_record" colspan="4">{r_admin.param_plugin.no_inst.TEXT}</td></tr>
			<!-- END no_inst -->	
			</table>
		</div>
		<!-- END param_plugin -->

	</div>
	<div style="clear:both"></div>
<!-- END r_admin -->
