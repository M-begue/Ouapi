<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN r_ocs -->
	<!-- BEGIN conf -->
	<p class="toolbox"><img src="{r_ocs.conf.IMAGE}" border="0" alt="" />&nbsp;<a href="{r_ocs.conf.LINK}" target="_blank">{r_ocs.conf.TEXT}</a></p>
	<!-- END conf -->

	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_ocs.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_ocs.display.LINK}" target="_blank">{r_ocs.display.TEXT}</a></p>
	<!-- END display -->		

	<!-- BEGIN aff_hidden -->
	<p class="toolbox"><a href="{r_ocs.aff_hidden.LINK}">{r_ocs.aff_hidden.TEXT}</a></p>	
	<!-- END aff_hidden -->

	<!-- BEGIN ocs_error -->
	<div class="contenu" id="alert" style="margin-top:30px;margin-bottom:10px;">{r_ocs.ocs_error.TEXT}</div>
	<!-- END ocs_error -->

	<div style="clear:both"></div>
	
	<!-- BEGIN main -->
			<table class="table" style="margin:0px;">	
			<tr>
				<!-- BEGIN cols -->
					<td class="titre3"><a href="{r_ocs.main.cols.PAGE_TRI}">{r_ocs.main.cols.TITLE}</a></td>				
				<!-- END cols -->		
				<td class="titre3" width="20%">{r_ocs.main.COL_STATUS}</td>
				<td class="titre3" width="6%">{r_ocs.main.COL_TOOLS}</td>
			</tr>

			<!-- BEGIN list_hard -->
			<tr class="liste">
				<!-- BEGIN cols -->
					<td  class="row1">{r_ocs.main.list_hard.cols.TITLE}</td>				
				<!-- END cols -->								
				<td class="row1">
				<!-- BEGIN status -->
				<font style="color:{r_ocs.main.list_hard.status.COLOR}">{r_ocs.main.list_hard.status.TEXT}</font>
				<!-- END status -->
				</td>
				<td class="row1">
				<!-- BEGIN tools -->
						<a href="{r_ocs.main.list_hard.tools.LINK}" target="_blank"><img src="{r_ocs.main.list_hard.tools.IMAGE}" style="vertical-align:middle" border="0" title="{r_ocs.main.list_hard.tools.TITLE}" alt="" /></a>
				<!-- END tools -->
				</td>
			</tr>
			<!-- END list_hard -->
			
			<!-- BEGIN list_periph -->
			<tr class="liste">
				<!-- BEGIN cols -->
					<td  class="row1">{r_ocs.main.list_periph.cols.TITLE}</td>				
				<!-- END cols -->								
				<td class="row1">
				<!-- BEGIN status -->
				<font style="color:{r_ocs.main.list_periph.status.COLOR}">{r_ocs.main.list_periph.status.TEXT}</font>
				<!-- END status -->
				</td>
				<td class="row1">
				<!-- BEGIN tools -->
						<a href="{r_ocs.main.list_periph.tools.LINK}" target="_blank"><img src="{r_ocs.main.list_periph.tools.IMAGE}" style="vertical-align:middle" border="0" title="{r_ocs.main.list_periph.tools.TITLE}" alt="" /></a>
				<!-- END tools -->
				</td>
			</tr>
			<!-- END list_periph -->
						
			<!-- BEGIN list_soft -->
			<tr class="liste">
				<!-- BEGIN cols -->
					<td class="{r_ocs.main.list_soft.CLASS}">{r_ocs.main.list_soft.cols.TITLE}</td>				
				<!-- END cols -->								
				<td class="{r_ocs.main.list_soft.CLASS}">
				<!-- BEGIN status -->
				<font style="color:{r_ocs.main.list_soft.status.COLOR}">{r_ocs.main.list_soft.status.TEXT}</font>
				<!-- END status -->
				</td>
				<td class="{r_ocs.main.list_soft.CLASS}">
				<!-- BEGIN tools -->
				<a href="{r_ocs.main.list_soft.tools.LINK}" target="_blank"><img src="{r_ocs.main.list_soft.tools.IMAGE}" style="vertical-align:middle" border="0" title="{r_ocs.main.list_soft.tools.TITLE}" alt="" /></a>
				<!-- END tools -->
				</td>
			</tr>
			<!-- END list_soft -->
		<!-- END main -->
		
		<!-- BEGIN conf_error -->
		<tr>
			<td class="{r_ocs.conf_error.CLASS}" align="center">{r_ocs.conf_error.TEXT}</td>
		</tr>
		<!-- END conf_error -->
		</table>
		
		<!-- BEGIN no_ocs -->
		<div class="no_record" align="center">{r_ocs.no_ocs.TEXT}</div>
		<!-- END no_ocs -->

	<div style="clear:both"></div>

<!-- END r_ocs -->