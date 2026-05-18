<!-- BEGIN r_docs -->
	<form method="post" name="formexport" action="index.php?page=export.php&amp;export=docs&amp;type=excel" target="_blank">	
	<!-- BEGIN add -->
	<p class="toolbox"><img src="{r_docs.add.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
	<a href="{r_docs.add.LINK}" target="_blank">{r_docs.add.TEXT}</a></p>
	<!-- END add -->

	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_docs.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_docs.display.LINK}" target="_blank">{r_docs.display.TEXT}</a></p>
	<!-- END display -->		

	<!-- BEGIN export -->
		<p class="toolbox">
		<input type="hidden" name="nom" value="{r_docs.export.NOM}" /><input type="hidden" name="export_data" value="{r_docs.export.DATA}" />
		<img src="{r_docs.export.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="#" onclick="{r_docs.export.LINK}">{r_docs.export.TEXT}</a></p>
	<!-- END export -->
	</form>

	<!-- BEGIN archive -->
	<p class="toolbox"><a href="{r_docs.archive.LINK}">{r_docs.archive.TEXT}</a></p>
	<!-- END archive -->		

	<!-- BEGIN tab_docs -->
	<table class="table">
		<!-- BEGIN group -->			
			<!-- BEGIN head -->
			<tr>
				<td colspan="{r_docs.tab_docs.NBCOLS}" class="titre2">{r_docs.tab_docs.group.head.TITLE}</td>
			</tr>
			<!-- END head -->
			
			<!-- BEGIN head2 -->
			<tr>
				<!-- BEGIN cols -->
					<td class="titre3"><a href="{r_docs.tab_docs.group.head2.PAGE_TRI}">{r_docs.tab_docs.group.head2.cols.TITLE}</a></td>				
				<!-- END cols -->		
				<td class="titre3">{r_docs.tab_docs.group.head2.LANG_TOOLS}</td>
			</tr>
			<!-- END head2 -->
			
			<!-- BEGIN list -->
			<tr class="{r_docs.tab_docs.group.list.CLASS_ROW}" id="{r_docs.tab_docs.group.list.ANCHOR}">
				<!-- BEGIN cols -->
					<td  class="{r_docs.tab_docs.group.list.CLASS}">{r_docs.tab_docs.group.list.cols.TITLE}</td>				
				<!-- END cols -->								
				<td class="{r_docs.tab_docs.group.list.CLASS}">
				<!-- BEGIN tools --> 
					<a href="{r_docs.tab_docs.group.list.tools.LINK}" target="_blank"><img src="{r_docs.tab_docs.group.list.tools.IMAGE}" border="0" title="{r_docs.tab_docs.group.list.tools.TITLE}" alt="" /></a> 
				<!-- END tools --> 
				&nbsp;</td>
			</tr>
			<!-- END list -->
		<!-- END group -->
	</table>
	<!-- END tab_docs -->

	<!-- BEGIN no_docs -->
	<div class="no_record" align="center"><i>{r_docs.no_docs.TEXT}</i></div>
	<!-- END no_docs -->
	
	<!-- BEGIN help -->
	<div class="help">{r_docs.help.GENERAL_HELP}</div>
	<!-- END help -->

<!-- END r_docs -->
