<!-- BEGIN r_users -->
	<form method="post" name="formexport" action="index.php?page=export.php&amp;export=users&amp;type=excel" target="_blank">
	<!-- BEGIN add -->
	<p class="toolbox"><img src="{r_users.add.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_users.add.LINK}" target="_blank">{r_users.add.TEXT}</a></p>
	<!-- END add -->

	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_users.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_users.display.LINK}" target="_blank">{r_users.display.TEXT}</a></p>
	<!-- END display -->		
	
	<!-- BEGIN export -->
	<input type="hidden" name="nom" value="{r_users.export.NOM}" /><input type="hidden" name="export_data" value="{r_users.export.DATA}" />
	<p class="toolbox"><img src="{r_users.export.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="#" onclick="{r_users.export.LINK}">{r_users.export.TEXT}</a></p>
	<!-- END export -->

	</form>

	<!-- BEGIN error -->
	<div class="contenu" id="alert" style="margin-top:30px;margin-bottom:10px;">{r_users.error.TEXT}</div>
	<!-- END error -->

	<!-- BEGIN tab_user -->
	
	<!-- BEGIN filters -->
		<form name="formfilter" action="index.php" method="get">	
		<!-- BEGIN hidden_filter -->
			<input type="hidden" name="{r_users.tab_user.filters.hidden_filter.NAME}" value="{r_users.tab_user.filters.hidden_filter.VALUE}" />
		<!-- END hidden_filter -->
		<p class="toolbox">{r_users.tab_user.filters.TEXT}&nbsp;
		<input type="text" value="" name="filter_text" class="search_field" style="margin-top:-2px;" /><input type="image" name="filter_submit" src="{r_users.tab_user.filters.IMG}" title="{r_users.tab_user.filters.LANG_FILTER}" class="search" style="margin-top:-2px;" />
		</p>
		</form>
	<!-- END filters -->
	
	<table class="table">
		<!-- BEGIN group -->
			<!-- BEGIN head -->
			<tr>
				<td colspan="{r_users.tab_user.NBCOLS}" class="titre2">{r_users.tab_user.group.head.TITLE}</td>
			</tr>		
			<!-- END head -->
			
			<!-- BEGIN head2 -->
			<tr>
				<!-- BEGIN cols -->
					<td class="titre3"><a href="{r_users.tab_user.group.head2.cols.PAGE_TRI}">{r_users.tab_user.group.head2.cols.TITLE}</a></td>				
				<!-- END cols -->		
				<td width="11%" class="titre3">{r_users.tab_user.LANG_TOOLS}</td>
			</tr>
			<!-- END head2 -->

			<!-- BEGIN list -->
			<tr class="{r_users.tab_user.group.list.CLASS_ROW}" id="{r_users.tab_user.group.list.ANCHOR}">
				<!-- BEGIN cols -->
					<td  class="row1">{r_users.tab_user.group.list.cols.TITLE}</td>				
				<!-- END cols -->								
				<td class="row1">
				<!-- BEGIN tools -->
					<a href="{r_users.tab_user.group.list.tools.LINK}" target="_blank"><img src="{r_users.tab_user.group.list.tools.IMAGE}" style="vertical-align:middle" border="0" title="{r_users.tab_user.group.list.tools.TITLE}" alt="" /></a>
				<!-- END tools -->
				&nbsp;</td>
			</tr>
			<!-- END list -->
		<!-- END group -->
	</table>
	<!-- END tab_user -->
	
	<!-- BEGIN no_user -->
	<div class="no_record" align="center">{r_users.no_user.TEXT}</div>
	<!-- END no_user -->
	
<!-- END r_users -->
