<!-- BEGIN r_users -->
	<form method="post" name="formexport" action="index.php?page=export.php&amp;export=users&amp;type=excel" target="_blank">
	
	<!-- BEGIN addall -->
	<p class="toolbox"><img src="{r_users.addall.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_users.addall.LINK}" target="_blank">{r_users.addall.TEXT}</a></p>
	<!-- END addall -->
	

	<!-- BEGIN conf -->
	<p class="toolbox"><img src="{r_users.conf.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;
	<a href="{r_users.conf.LINK}" target="_blank">{r_users.conf.TEXT}</a></p>
	<!-- END conf -->

	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_users.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_users.display.LINK}" target="_blank">{r_users.display.TEXT}</a></p>
	<!-- END display -->		
	
	<!-- BEGIN export -->
	<input type="hidden" name="nom" value="{r_users.export.NOM}" /><input type="hidden" name="export_data" value="{r_users.export.DATA}" />
	<p class="toolbox"><img src="{r_users.export.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="#" onclick="{r_users.export.LINK}">{r_users.export.TEXT}</a></p>
	<!-- END export -->
	</form>

	<!-- BEGIN filters -->
		<form name="formfilter" action="index.php" method="get">	
		<!-- BEGIN hidden_filter -->
			<input type="hidden" name="{r_users.filters.hidden_filter.NAME}" value="{r_users.filters.hidden_filter.VALUE}" />
		<!-- END hidden_filter -->
		<p class="toolbox">{r_users.filters.TEXT}&nbsp;
		<input type="text" value="" name="filter_text" class="search_field_ldap" style="margin-top:-1px;" /><input type="image" name="filter_submit" src="{r_users.filters.IMG}" title="{r_users.filters.LANG_FILTER}" class="search_ldap" style="margin-top:-1px;" />
		</p>
		</form>
	<!-- END filters -->

	<!-- BEGIN error -->
		<div class="contenu" id="alert" style="margin-top:50px;margin-bottom:10px;">{r_users.error.TEXT}</div>
	<!-- END error -->
		
	<!-- BEGIN tab_user -->


	<table class="table">
	<tr>
		<!-- BEGIN cols -->
			<td class="titre3"><a href="{r_users.tab_user.cols.PAGE_TRI}">{r_users.tab_user.cols.TITLE}</a></td>				
		<!-- END cols -->		
		<td width="30%" class="titre3">{r_users.tab_user.COL_STATUS}</td>
		<td width="11%" class="titre3">{r_users.tab_user.LANG_TOOLS}</td>
	</tr>

		<!-- BEGIN list -->
		<tr class="liste">
			<!-- BEGIN cols -->
				<td  class="row1">{r_users.tab_user.list.cols.TITLE}</td>				
			<!-- END cols -->								
			<td class="row1"><font style="color:{r_users.tab_user.list.STATUS_COLOR}">{r_users.tab_user.list.COL_STATUS}</font></td>
			<td class="row1">
			<!-- BEGIN tools -->
				<a href="{r_users.tab_user.list.tools.LINK}" target="_blank"><img src="{r_users.tab_user.list.tools.IMAGE}" style="vertical-align:middle" border="0" title="{r_users.tab_user.list.tools.TITLE}" alt="" /></a>
			<!-- END tools -->
			&nbsp;</td>
		</tr>
		<!-- END list -->
	</table>
	<!-- END tab_user -->
	
<!-- END r_users -->

<!-- BEGIN r_pc -->
	<form method="post" name="formexport" action="index.php?page=export.php&amp;export=users&amp;type=excel" target="_blank">
	
	<!-- BEGIN addall -->
	<p class="toolbox" style="margin-left:40px;"><img src="{r_pc.addall.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_pc.addall.LINK}" target="_blank">{r_pc.addall.TEXT}</a></p>
	<!-- END addall -->
	

	<!-- BEGIN conf -->
	<p class="toolbox"><img src="{r_pc.conf.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;
	<a href="{r_pc.conf.LINK}" target="_blank">{r_pc.conf.TEXT}</a></p>
	<!-- END conf -->

	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_pc.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_pc.display.LINK}" target="_blank">{r_pc.display.TEXT}</a></p>
	<!-- END display -->		
	
	<!-- BEGIN export -->
	<input type="hidden" name="nom" value="{r_pc.export.NOM}" /><input type="hidden" name="export_data" value="{r_pc.export.DATA}" />
	<p class="toolbox"><img src="{r_pc.export.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="#" onclick="{r_pc.export.LINK}">{r_pc.export.TEXT}</a></p>
	<!-- END export -->
	</form>

	<!-- BEGIN filters -->
		<form name="formfilter" action="index.php" method="get">	
		<!-- BEGIN hidden_filter -->
			<input type="hidden" name="{r_pc.filters.hidden_filter.NAME}" value="{r_pc.filters.hidden_filter.VALUE}" />
		<!-- END hidden_filter -->
		<p class="toolbox">{r_pc.filters.TEXT}&nbsp;
		<input type="text" value="" name="filter_text" class="search_field_ldap" style="margin-top:-1px;" /><input type="image" name="filter_submit" src="{r_pc.filters.IMG}" title="{r_pc.filters.LANG_FILTER}" class="search_ldap" style="margin-top:-1px;" />
		</p>
		</form>
	<!-- END filters -->
	
	<!-- BEGIN error -->
		<div class="contenu" id="alert" style="margin-top:50px;margin-bottom:10px;">{r_pc.error.TEXT}</div>
	<!-- END error -->
	
	<!-- BEGIN tab_pc -->


	<table class="table">
	<tr>
		<!-- BEGIN cols -->
			<td class="titre3"><a href="{r_pc.tab_pc.cols.PAGE_TRI}">{r_pc.tab_pc.cols.TITLE}</a></td>				
		<!-- END cols -->		
		<td width="30%" class="titre3">{r_pc.tab_pc.COL_STATUS}</td>
		<td width="11%" class="titre3">{r_pc.tab_pc.LANG_TOOLS}</td>
	</tr>

		<!-- BEGIN list -->
		<tr class="liste">
			<!-- BEGIN cols -->
				<td  class="row1">{r_pc.tab_pc.list.cols.TITLE}</td>				
			<!-- END cols -->								
			<td class="row1"><font style="color:{r_pc.tab_pc.list.STATUS_COLOR}">{r_pc.tab_pc.list.COL_STATUS}</font></td>
			<td class="row1">
			<!-- BEGIN tools -->
				<a href="{r_pc.tab_pc.list.tools.LINK}" target="_blank"><img src="{r_pc.tab_pc.list.tools.IMAGE}" style="vertical-align:middle" border="0" title="{r_pc.tab_pc.list.tools.TITLE}" alt="" /></a>
			<!-- END tools -->
			&nbsp;</td>
		</tr>
		<!-- END list -->
	</table>
	<!-- END tab_pc -->
	
<!-- END r_pc -->
