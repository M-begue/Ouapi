<!-- BEGIN r_soft -->

		<!-- BEGIN add -->
		<p class="toolbox"><img src="{r_soft.add.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;
		<a href="{r_soft.add.LINK}" target="_blank">{r_soft.add.TEXT}</a></p>
		<!-- END add -->
		
		<!-- BEGIN hardtype -->
		<p class="toolbox"><img src="{r_soft.hardtype.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;
		<a href="{r_soft.hardtype.LINK}" target="_blank">{r_soft.hardtype.TEXT}</a></p>
		<!-- END hardtype -->
		
		<!-- BEGIN display -->
		<p class="toolbox"><img src="{r_soft.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_soft.display.LINK}" target="_blank">{r_soft.display.TEXT}</a></p>
		<!-- END display -->		
		
	
	<!-- BEGIN tab_soft -->
		<!-- BEGIN export -->
		<form method="post" name="formexport" action="index.php?page=export.php&amp;export=soft&amp;type=excel" target="_blank">
		<input type="hidden" name="nom" value="{r_soft.tab_soft.export.NOM}" /><input type="hidden" name="export_data" value="{r_soft.tab_soft.export.DATA}" />
		<p class="toolbox"><img src="{r_soft.tab_soft.export.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="#" onclick="{r_soft.tab_soft.export.LINK}">{r_soft.tab_soft.export.TEXT}</a></p>
		</form>
		<!-- END export -->

		<table class="table">	
		<tr>
			<!-- BEGIN cols -->
				<td class="titre3"><a href="{r_soft.tab_soft.cols.PAGE_TRI}">{r_soft.tab_soft.cols.TITLE}</a></td>				
			<!-- END cols -->		
			<td class="titre3">{r_soft.tab_soft.COL_STATUS}</td>
			<td class="titre3">{r_soft.tab_soft.LANG_TOOLS}</td>
		</tr>
		
		<!-- BEGIN type -->
		<tr>
			<td class="titre4" colspan="{r_soft.tab_soft.type.NBCOLS}" >{r_soft.tab_soft.type.TITLE}</td>
		</tr>
			<!-- BEGIN list -->
			<tr class="{r_soft.tab_soft.type.list.CLASS_ROW}" id="{r_soft.tab_soft.type.list.ANCHOR}">
				<!-- BEGIN cols -->
					<td  class="row1">{r_soft.tab_soft.type.list.cols.TITLE}</td>				
				<!-- END cols -->								
				<td class="row1"><img src="{r_soft.tab_soft.type.list.IMG_STATUS}" alt='' />&nbsp;{r_soft.tab_soft.type.list.COL_STATUS}</td>
				<td class="row1">
				<!-- BEGIN tools --> 
					<a href="{r_soft.tab_soft.type.list.tools.LINK}" target="_blank"><img src="{r_soft.tab_soft.type.list.tools.IMAGE}" border="0" title="{r_soft.tab_soft.type.list.tools.TITLE}" alt="" /></a> 
				<!-- END tools --> 
				</td>
			</tr>
			<!-- END list -->
		<!-- END type -->
	</table>
	<!-- END tab_soft -->
	
	<!-- BEGIN no_soft -->
	<div class="no_record" align="center">{r_soft.no_soft.TEXT}</div>
	<!-- END no_soft -->	
	
	<!-- BEGIN help -->
	<div class="help">{r_soft.help.GENERAL_HELP}</div>
	<!-- END help -->

<!-- END r_soft -->
