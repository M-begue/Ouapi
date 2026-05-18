<!-- BEGIN infos -->
<div class="information" style="height:65px;margin-top:0;">
	<img src="{infos.ICON}" alt="" style="float:left;margin-right:20px;" />
	<font style="font-weight:bold;font-size:16px;">{infos.NAME}</font><br/>{infos.LOCATION}
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
	
	<div id="netw_details">
		<div class="cat_title">{L_TITLE}</div>
		<table class="table">
		<tr>
			<td class="titre3" width="20%">{L_PLUGNB}</td>
			<td class="row1" width="30%">{PLUGNB}</td>
			<td class="titre3" width="20%">{L_LOCATION}</td>
			<td class="row1" width="30%">{LOCATION}</td>
		</tr>
		<tr>
			<td class="titre3" width="20%">{L_NETWHARDNAME}</td>
			<td class="row1" width="30%">{NETWHARDNAME}</td>
			<td class="titre3" width="20%">{L_HARDNAME}</td>
			<td class="row1" width="30%">{HARDNAME}</td>
		</tr>
		<tr>
			<td class="titre3" width="20%">{L_PORT}</td>
			<td class="row1" width="30%">{PORT}</td>
			<td width="20%">&nbsp;</td>
			<td >&nbsp;</td>
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

	<!-- BEGIN doc_links -->
	<div id="doc_links" style="display:none;">
		<div class="cat_title">{doc_links.L_TITLE_ELMTS}</div>
		<table class="table">
			<!-- BEGIN list -->
			<tr>
				<td class="titre3" width="25%">{doc_links.list.TYPE}</td>
				<td class="{doc_links.list.CLASS}">{doc_links.list.NAME}</td>
				<td class="{doc_links.list.CLASS}">
				<!-- BEGIN tools -->	
					<a href="{doc_links.list.tools.LINK}" target="_blank"><img src="{doc_links.list.tools.IMAGE}" border="0" title="{doc_links.list.tools.TITLE}" alt="" /></a>&nbsp;
				<!-- END tools -->		
				</td>
			</tr>		
			<!-- END list -->
		<!-- BEGIN no_contr -->
			<tr>
				<td class="no_record">{doc_links.no_contr.TEXT}</td>
			</tr>
		<!-- END no_contr -->
		</table>

		<!-- BEGIN elmts -->
		<table width="99%" align="center">
		<tr>
			<td align="right" class="row">	
			<!-- BEGIN tools -->
				[ <img src="{doc_links.elmts.tools.IMAGE}" border="0" alt="" /> <a href="{doc_links.elmts.tools.LINK}" target="_blank">{doc_links.elmts.tools.TITLE}</a> ]		
			<!-- END tools -->
			</td>
		</tr>
		</table>
		<!-- END elmts -->

		<!-- BEGIN document -->
		<table class="table">
		<tr>
			<td class="titre2">{doc_links.document.L_TITLE}</td>
		</tr>
		<tr>
			<td class="row1"><div align="center">
				<object data="{doc_links.document.PATH}" type="application/{document.EXT}" width="{doc_links.document.WIDTH}" height="{doc_links.document.HEIGHT}">
				  <param name="filename" value="{doc_links.document.PATH}" />  
				</object>
			</div></td>
		</tr>
		</table>
		<!-- END document -->

		<!-- BEGIN download -->
		<table class="table">
		<tr>
			<td class="titre2" colspan="2">{doc_links.download.L_TITLE}</td>
		</tr>
		<tr>
			<td class="row1"><img src="{doc_links.download.IMAGE}" alt="" />&nbsp;{doc_links.download.FILE}&nbsp;({doc_links.download.PATH})</td>
			<td class="row1" align="right"><a href="{doc_links.download.LINK}">{doc_links.download.L_DOWNLOAD}</a>&nbsp;</td>
		</tr>
		</table>
		<!-- END download -->
	</div>
	<!-- END doc_links -->
</div>