<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN r_resa -->
	<form method="post" name="formexport" action="index.php?page=export.php&amp;export=resa&amp;type=excel&special=weekly_calendar" target="_blank">	
	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_resa.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_resa.display.LINK}" target="_blank">{r_resa.display.TEXT}</a></p>
	<!-- END display -->		

	<!-- BEGIN export -->
		<p class="toolbox">
		<input type="hidden" name="nom" value="{r_resa.export.NOM}" /><input type="hidden" name="export_data" value="{r_resa.export.DATA}" />
		<img src="{r_resa.export.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="#" onClick="{r_resa.export.LINK}">{r_resa.export.TEXT}</a></p>
	<!-- END export -->
	</form>

	<!-- BEGIN tab_resa -->
	<table class="table">
		<!-- BEGIN group -->
			<!-- BEGIN head -->
			<tr>
				<td colspan="{r_resa.tab_resa.NBCOLS}" class="titre2">{r_resa.tab_resa.group.head.TITLE}</td>
			</tr>
			<!-- END head -->
			
			<!-- BEGIN head2 -->
			<tr>
				<!-- BEGIN cols -->
					<td class="titre3">{r_resa.tab_resa.group.head2.cols.TITLE}</td>				
				<!-- END cols -->		
				<td class="titre3" colspan="12" width="30%">{r_resa.tab_resa.group.COL_NEXTRESA}</td>
				<td class="titre3" width="8%">{r_resa.tab_resa.group.LANG_TOOLS}</td>
			</tr>
			<!-- END head2 -->
			
			<!-- BEGIN list -->
			<tr id="{r_resa.tab_resa.group.list.ANCHOR}">
				<!-- BEGIN cols -->
					<td  class="row1">{r_resa.tab_resa.group.list.cols.TITLE}</td>				
				<!-- END cols -->								
				<!-- BEGIN next -->
				<td class="row1" style="{r_resa.tab_resa.group.list.next.STYLE}" onMouseOver="tooltip.show('<center><b>{r_resa.tab_resa.group.list.next.DAY_BULLE} {r_resa.tab_resa.group.list.next.DATE_BULLE}</b><br/>{r_resa.tab_resa.group.list.next.RESA}</center>')"  onmouseout="tooltip.hide();" width="4%">
				<font style="font-size:10px">{r_resa.tab_resa.group.list.next.DAY}</font><br/>
				<font style="font-size:10px">{r_resa.tab_resa.group.list.next.DATE}</font>
				</td>
				<!-- END next -->
				<td class="row1">
				<!-- BEGIN tools -->
					<a href="{r_resa.tab_resa.group.list.tools.LINK}" target="_blank"><img src="{r_resa.tab_resa.group.list.tools.IMAGE}" border="0" title="{r_resa.tab_resa.group.list.tools.TITLE}" 	alt="" /></a> 
				<!-- END tools -->
				</td>
			</tr>
			<!-- END list -->
		<!-- END group -->
	</table>	
	<!-- END tab_resa -->

	<!-- BEGIN no_resa -->
	<div class="no_record" align="center">{r_resa.no_resa.TEXT}</div>
	<!-- END no_resa -->
	
	<!-- BEGIN help -->
	<div class="help">
	<img src="{r_resa.help.IMG_HELP}" style="margin-top:-40px; margin-left:-27px;" title="{r_resa.help.IMG_TITLE}" alt="" />{r_resa.help.GENERAL_HELP}
	</div>
	<!-- END help -->

<!-- END r_resa -->
