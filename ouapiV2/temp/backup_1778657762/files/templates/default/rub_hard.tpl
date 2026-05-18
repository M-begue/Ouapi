<!-- BEGIN r_hard -->

	<form name="formfilter" action="index.php" method="get">
	<!-- BEGIN hidden_filter -->
		<input type="hidden" name="{r_hard.hidden_filter.NAME}" value="{r_hard.hidden_filter.VALUE}" />
	<!-- END hidden_filter -->
	<p class="toolbox"><img src="{r_hard.IMG_FILTER}" style="vertical-align:middle;height:12px;" alt="" />&nbsp;<b>{r_hard.LANG_FILTER}:</b>&nbsp;
	<select name="filtre_type" class="site" style="height:16px;width:auto;" onchange="formfilter.submit()">
	<!-- BEGIN type_filters -->
		<option value="{r_hard.type_filters.TYPE_ID}" {r_hard.type_filters.SELECTED}>{r_hard.type_filters.TYPE_NAME}</option>
	<!-- END type_filters -->	
	</select>
	</p>
	</form>
	
	<!-- BEGIN add -->
	<p class="toolbox">
	<img src="{r_hard.add.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_hard.add.LINK}" target="_blank">{r_hard.add.TEXT}</a></p>
	<!-- END add -->

	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_hard.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_hard.display.LINK}" target="_blank">{r_hard.display.TEXT}</a></p>
	<!-- END display -->		

	<!-- BEGIN rebus -->
	<p class="toolbox"><img src="{r_hard.rebus.IMAGE}" style="vertical-align:middle" border="0" alt="" /><a href="{r_hard.rebus.LINK}">{r_hard.rebus.TEXT}</a></p>
	<!-- END rebus -->		

	<!-- BEGIN tab_hard -->
		<!-- BEGIN export -->
		<form method="post" name="formexport" action="index.php?page=export.php&amp;export=mat&amp;type=excel" target="_blank" style="margin:0px;">
		<input type="hidden" name="nom" value="{r_hard.tab_hard.export.NOM}" /><input type="hidden" name="export_data" value="{r_hard.tab_hard.export.DATA}" />
		<p class="toolbox">	
		<img src="{r_hard.tab_hard.export.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="#" onclick="{r_hard.tab_hard.export.LINK}"><u>{r_hard.tab_hard.export.TEXT}</u></a></p>
		</form>
		<!-- END export -->
		

		<!-- BEGIN ocs_error -->
		<div class="contenu" id="alert" style="margin-top:30px;margin-bottom:10px;">{r_hard.tab_hard.ocs_error.TEXT}</div>
		<!-- END ocs_error -->
		
		<table class="table">				
		<!-- BEGIN group -->
			<!-- BEGIN head -->
			<tr>
				<td colspan="{r_hard.tab_hard.NBCOLS}" class="titre2">{r_hard.tab_hard.group.head.TITLE}</td>
			</tr>		
			<!-- END head -->
			
			<!-- BEGIN head2 -->
			<tr>
				<!-- BEGIN cols -->
					<td class="titre3"><a href="{r_hard.tab_hard.group.head2.cols.PAGE_TRI}">{r_hard.tab_hard.group.head2.cols.TITLE}</a></td>				
				<!-- END cols -->		
				<td class="titre3">{r_hard.tab_hard.group.LANG_TOOLS}</td>
			</tr>
			<!-- END head2 -->

			<!-- BEGIN list -->
			<tr class="{r_hard.tab_hard.group.list.CLASS_ROW}" id="{r_hard.tab_hard.group.list.ANCHOR}">
				<!-- BEGIN cols -->
					<td  class="{r_hard.tab_hard.group.list.cols.CLASS}">{r_hard.tab_hard.group.list.cols.TITLE}</td>				
				<!-- END cols -->
				
				<td class="{r_hard.tab_hard.group.list.CLASS}">
				<!-- BEGIN tools --> 
					<a href="{r_hard.tab_hard.group.list.tools.LINK}" target="_blank"><img src="{r_hard.tab_hard.group.list.tools.IMAGE}" border="0" title="{r_hard.tab_hard.group.list.tools.TITLE}" alt ="" /></a> 
				<!-- END tools --> 
				&nbsp;</td>
			</tr>
			<!-- END list -->
		<!-- END group -->
	<!-- END tab_hard -->	
	</table>	
	
	<!-- BEGIN no_hard -->
	<div class="no_record" align="center">{r_hard.no_hard.TEXT}</div>
	<!-- END no_hard -->	
	
	<!-- BEGIN help -->
	<div class="help">{r_hard.help.GENERAL_HELP}</div>	
	<!-- END help -->


<!-- END r_hard -->