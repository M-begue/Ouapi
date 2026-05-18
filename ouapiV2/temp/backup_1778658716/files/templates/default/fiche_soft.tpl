<!-- BEGIN infos -->
<div class="information" style="height:65px;margin-top:0;">
	<img src="{infos.ICON}" alt="" style="float:left;margin-right:20px;" />
	<font style="font-weight:bold;font-size:16px;">{infos.NAME}</font><br/>{infos.PUB}
</div>
<!-- END infos -->
<div style="clear:both"></div>

<div class="topmenu">
	<!-- BEGIN button -->
		<p id="{button.ID}" class="{button.CLASS}" onclick="{button.LINK}">{button.TEXT}
			<!-- BEGIN nb -->
				&nbsp;({button.nb.TEXT})
			<!-- END nb -->
		</p>
	<!-- END button -->
	<div style="clear:both"></div> 
</div>

<div class="fiche">
	<div id="soft_details">
		<div class="cat_title">{L_TITLE}</div>
		<table class="table">
		<tr>
			<td class="titre3" width="20%">{SOFT_LANG_NAME}</td>
			<td class="row1" width="30%">{SOFT_NAME}</td>
			<td class="titre3">{SOFT_LANG_PUBLISHER}</td>
			<td class="row1">{SOFT_PUBLISHER}</td>
		</tr>
		<tr>
			<td class="titre3" width="20%">{SOFT_LANG_VNUM}</td>
			<td class="row1" width="30%">{SOFT_VNUM}</td>
			<td class="titre3">{SOFT_LANG_VDATE}</td>
			<td class="row1">{SOFT_VDATE}</td>
		</tr>
		<tr>
			<td class="titre3">{SOFT_LANG_COMMENT}</td>
			<td class="row1" colspan="3">{SOFT_COMMENT}</td>
		</tr>
		<!-- BEGIN line -->
		<tr>
			<!-- BEGIN info -->
				<td class="titre3">{line.info.TITLE}</td>
				<td class="row1">{line.info.VALUE}</td>
			<!-- END info -->	
		</tr>
		<!-- END line -->
		</table>
	</div>
	
	<!-- BEGIN docs -->
	<div id="soft_docs" style="display:none;">
		<div class="cat_title">{docs.L_TITLE}</div>
		<table class="table">
		<!-- BEGIN tab -->
			<tr>
				<td class="titre3" width="15%">{docs.tab.TYPE}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.DATE}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.EMETTEUR}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.REF}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.COMMENT}</td>
				<td class="{docs.tab.CLASS}" align="right" width="10%">
				<!-- BEGIN tools -->	
					<a href="{docs.tab.tools.LINK}" target="_blank"><img src="{docs.tab.tools.IMAGE}" border="0" title="{docs.tab.tools.TITLE}" alt="" /></a>&nbsp;
				<!-- END tools -->		
				</td>
			</tr>
		<!-- END tab -->
		<!-- BEGIN no_tab -->
			<tr>
				<td colspan="7" class="no_record">{docs.no_tab.TEXT}</td>
			</tr>
		<!-- END no_tab -->
		</table>
	
	<table width="99%" align="center">
	<tr>
		<td align="right" class="row">	
		<!-- BEGIN adddoc -->
				[ <img src="{docs.adddoc.IMAGE}" border="0" alt="" /> <a href="{docs.adddoc.LINK}" target="_blank">{docs.adddoc.TITLE}</a> ]	
		<!-- END adddoc -->
		</td>
	</tr>
	</table>
	</div>
	<!-- END docs -->


	<!-- BEGIN s_alias -->
	<div id="soft_ocs" style="display:none;">
		<div class="cat_title">{s_alias.L_TITLE}</div>
		<table class="table">
		<!-- BEGIN tab -->
			<tr>
				<td class="row1" width="15%">{s_alias.tab.NAME}</td>
			</tr>
		<!-- END tab -->
		<!-- BEGIN no_tab -->
			<tr>
				<td colspan="7" class="no_record">{s_alias.no_tab.TEXT}</td>
			</tr>
		<!-- END no_tab -->
		</table>
	</div>
	<!-- END s_alias -->

</div>
