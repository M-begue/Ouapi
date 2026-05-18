<!-- BEGIN r_netw -->
	<form method="post" name="formexport" action="index.php?page=export.php&amp;export=netw&amp;type=excel" target="_blank">	
	<!-- BEGIN add -->		
		<p class="toolbox"><img src="{r_netw.add.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="{r_netw.add.LINK}" target="_blank">{r_netw.add.TEXT}</a></p>
	<!-- END add -->
	
	<!-- BEGIN display -->
	<p class="toolbox"><img src="{r_netw.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;<a href="{r_netw.display.LINK}" target="_blank">{r_netw.display.TEXT}</a></p>
	<!-- END display -->		

	<!-- BEGIN export -->
		<p class="toolbox">
		<input type="hidden" name="nom" value="{r_netw.export.NOM}" /><input type="hidden" name="export_data" value="{r_netw.export.DATA}" />
		<img src="{r_netw.export.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="#" onclick="{r_netw.export.LINK}">{r_netw.export.TEXT}</a></p>
	<!-- END export -->

	<!-- BEGIN hardtype -->
		<p class="toolbox"><img src="{r_netw.hardtype.IMAGE}" border="0" alt="" /> 
		<a href="{r_netw.hardtype.LINK}" target="_blank">{r_netw.hardtype.TEXT}</a></p>
	<!-- END hardtype -->
	</form>

	<!-- BEGIN error -->
	<div class="contenu" id="alert" style="margin-top:50px;margin-bottom:0px;">{r_netw.error.TEXT}</div>
	<!-- END error -->

	<!-- BEGIN equipmt -->
	<div style="width:100%;padding:0;margin-top:35px;">
	<table style="border:1px solid black;margin-right:auto;" cellspacing="0">
	<tr>
		<td style="background-color:#BDBDBD;padding:2px;padding-right:10px;color:white;vertical-align:top;"><font style="font-size:10px"><b>{r_netw.equipmt.NAME}</b><br/>
		<!-- BEGIN ip -->
		<a href="http://{r_netw.equipmt.ip.VALUE}" target="_blank">{r_netw.equipmt.ip.VALUE}</a>
		<!-- END ip -->
		</font></td>
		<td align="left" style="background-color:#BDBDBD;vertical-align:top;padding:0px">		
		<!-- BEGIN list_port -->
		<img src="{r_netw.equipmt.list_port.IMAGE}" onmouseover="tooltip.show('<center><b>- {r_netw.equipmt.list_port.TITLE} -</b></center>{r_netw.equipmt.list_port.NUM}<br/>{r_netw.equipmt.list_port.NAME}<br/> {r_netw.equipmt.list_port.PLACE}')" onmouseout="tooltip.hide();" alt="" />
		<!-- BEGIN line -->
		<br/>
		<!-- END line -->
		<!-- END list_port -->
		</td>
	</tr>
	</table></div>	
	<!-- END equipmt -->
	
	<!-- BEGIN tab_netw -->
	<table class="table">	
	<tr>
		<!-- BEGIN cols -->
			<td class="titre3"><a href="{r_netw.tab_netw.cols.PAGE_TRI}">{r_netw.tab_netw.cols.TITLE}</a></td>				
		<!-- END cols -->		
		<td class="titre3">{r_netw.tab_netw.LANG_TOOLS}</td>
	</tr>
		<!-- BEGIN list -->
		<tr class="{r_netw.tab_netw.list.CLASS_ROW}" id="{r_netw.tab_netw.list.ANCHOR}">
			<!-- BEGIN cols -->
				<td  class="row1">{r_netw.tab_netw.list.cols.TITLE}</td>				
			<!-- END cols -->								
			<td class="row1">
			<!-- BEGIN tools --> 
					<a href="{r_netw.tab_netw.list.tools.LINK}" target="_blank"><img src="{r_netw.tab_netw.list.tools.IMAGE}" border="0" title="{r_netw.tab_netw.list.tools.TITLE}" alt="" /></a> 
			<!-- END tools --> 
			</td>
		</tr>
		<!-- END list -->
	</table>
	<!-- END tab_netw -->

	<!-- BEGIN no_netw -->
	<div class="no_record" align="center">{r_netw.no_netw.TEXT}</div>
	<!-- END no_netw -->	
	
	<!-- BEGIN help -->
	<div class="help">{r_netw.help.GENERAL_HELP}</div>
	<!-- END help -->

<!-- END r_netw -->