<!-- BEGIN infos -->
<div class="information" style="height:70px;margin-top:0;">
	<img src="{infos.ICON}" alt="" style="float:left;margin-right:20px;" />
	<font style="font-weight:bold;font-size:16px;">{infos.NAME}</font><br/>{infos.MARQUEMODELE}<br/>{infos.SERIAL}<br/>{infos.USER}
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
	<!-- BEGIN hard_details -->
	<div id="hard_details">
	<div class="cat_title">{hard_details.L_HARD}</div>		
	<table class="table">
	<tr>
		<td class="titre3">{hard_details.L_NAME}</td>
		<td class="row1">{hard_details.NAME}</td>
		<td class="titre3">{hard_details.L_USER}</td>
		<td class="row1">{hard_details.USER}</td>
	</tr>
	<tr>
		<td class="titre3" width="15%">{hard_details.L_SITE}</td>
		<td class="row1" width="35%">{hard_details.SITE}</td>
		<td class="titre3" width="15%">{hard_details.L_PLACE}</td>
		<td class="row1" width="35%">{hard_details.PLACE}</td>
	</tr>
	<tr>
		<td class="titre3">{hard_details.L_MARQUE}</td>
		<td class="row1">{hard_details.MARQUE}</td>
		<td class="titre3">{hard_details.L_MODELE}</td>
		<td class="row1">{hard_details.MODELE}</td>
	</tr>
	<tr>
		<td class="titre3">{hard_details.L_SERIAL}</td>
		<td class="row1">{hard_details.SERIAL}</td>
		<td class="titre3">{hard_details.L_OS}</td>
		<td class="row1">{hard_details.OS}</td>
	</tr>
	<tr>
		<td class="titre3">{hard_details.L_CPU}</td>
		<td class="row1">{hard_details.CPU}</td>
		<td class="titre3">{hard_details.L_RAMCAPACITE}</td>
		<td class="row1">{hard_details.RAMCAPACITE}</td>
	</tr>
	<tr>
		<td class="titre3">{hard_details.L_RAMTYPE}</td>
		<td class="row1">{hard_details.RAMTYPE}</td>
		<td class="titre3">{hard_details.L_DISQUECAPACITE}</td>
		<td class="row1">{hard_details.DISQUECAPACITE}</td>
	</tr>
	<tr>
		<td class="titre3">{hard_details.L_DISQUETYPE}</td>
		<td class="row1">{hard_details.DISQUETYPE}</td>
		<td class="titre3">&nbsp;</td>
		<td class="row1">&nbsp;</td>
	</tr>
	<tr>
		<td class="titre3">{hard_details.L_IP}</td>
		<td class="row1">{hard_details.IP}</td>
		<td class="titre3">{hard_details.L_BOOKABLE}</td>
		<td class="row1">{hard_details.BOOKABLE}</td>
	</tr>
	<tr>
		<td class="titre3">{hard_details.L_CREATIONDATE}</td>
		<td class="row1">{hard_details.CREATIONDATE}</td>
		<td class="titre3">{hard_details.L_COMMENT}</td>
		<td class="row1">{hard_details.COMMENT}</td>
	</tr>
	<!-- BEGIN line -->
	<tr>
		<!-- BEGIN info -->
			<td class="titre3">{hard_details.line.info.TITLE}</td>
			<td class="row1">{hard_details.line.info.VALUE}</td>
		<!-- END info -->	
	</tr>
	<!-- END line -->

	</table>
</div>
<!-- END hard_details -->

<!-- BEGIN hard_periph -->
	<div id="hard_periph" style="display:none;">
	<div class="cat_title">{hard_periph.L_PERIPH}</div>		
	<table class="table">
	<!-- BEGIN list -->
		<tr>
			<td class="titre3" width="15%">{hard_periph.list.TYPE}</td>
			<td class="{hard_periph.list.CLASS}" width="55%">{hard_periph.list.MARQUE}&nbsp;-&nbsp;{hard_periph.list.MODELE}&nbsp;-&nbsp;{hard_periph.list.NAME}</td>
			<td class="{hard_periph.list.CLASS}" width="20%">{hard_periph.list.SERIAL}</td>
			<td class="{hard_periph.list.CLASS}" align="right" width="10%">
			<!-- BEGIN tools -->	
				<a href="{hard_periph.list.tools.LINK}" target="_blank"><img src="{hard_periph.list.tools.IMAGE}" border="0" title="{hard_periph.list.tools.TITLE}" alt="" /></a>&nbsp;
			<!-- END tools -->		
			</td>
		</tr>
	<!-- END list -->	
	<!-- BEGIN no_list -->		
		<tr>
			<td colspan="4" class="row1"><i>{hard_periph.no_list.TEXT}</i></td>
		</tr>
	<!-- END no_list -->		
	<!-- BEGIN add -->	
	<tr>
		<td colspan="4" align="right" class="row">[ <img src="{hard_periph.add.IMG}" border="0" alt="" /> 
		<a href="{hard_periph.add.LINK}" target="_blank">{hard_periph.add.TEXT}</a> ]			
		</td>
	</tr>	
	<!-- END add -->		
	</table>
	</div>
<!-- END hard_periph -->

<!-- BEGIN hard_network -->
	<div id="hard_network" style="display:none">
	<div class="cat_title">{hard_network.L_NETWORK}</div>		
	<table class="table">
	<!-- BEGIN list -->
	<tr>
		<td class="titre3" width="10%">{hard_network.list.L_PLUG}</td>
		<td class="row1" width="40%">{hard_network.list.PLUG}</td>
		<td class="titre3" width="20%">{hard_network.list.L_NETWORKHARD}</td>
		<td class="row1" width="30%">{hard_network.list.NETWORKHARD}</td>
	</tr>
	<!-- END list -->
	<!-- BEGIN no_list -->		
	<tr>
		<td colspan="4" class="row1"><i>{hard_network.no_list.TEXT}</i></td>
	</tr>
	<!-- END no_list -->		
	<!-- BEGIN add -->	
	<tr>
		<td colspan="4" align="right" class="row">[ <img src="{hard_network.add.IMG}" border="0" alt="" /> 
		<a href="{hard_network.add.LINK}" target="_blank">{hard_network.add.TEXT}</a> ]			
		</td>
	</tr>	
	<!-- END add -->		
	</table>
	</div>
<!-- END hard_network -->

<!-- BEGIN hard_docs -->
	<div id="hard_docs" style="display:none">
	<div class="cat_title">{hard_docs.L_DOCS}</div>		
	<table class="table">
		<!-- BEGIN list -->
		<tr>
			<td class="titre3" width="12%">{hard_docs.list.DOCTYPE}</td>
			<td class="{hard_docs.list.CLASS}" width="10%">{hard_docs.list.DATE}</td>
			<td class="{hard_docs.list.CLASS}" width="12%">{hard_docs.list.L_DOCEMET}&nbsp;{hard_docs.list.DOCEMET}</td>
			<td class="{hard_docs.list.CLASS}" width="20%">{hard_docs.list.L_DOCREF}&nbsp;{hard_docs.list.DOCREF}</td>
			<td class="{hard_docs.list.CLASS}" width="38%">{hard_docs.list.L_COMMENT}:&nbsp;{hard_docs.list.COMMENT}</td>
			<td class="{hard_docs.list.CLASS}" width="8%" align="right">
			<!-- BEGIN tools -->
				<a href="{hard_docs.list.tools.LINK}" target="_blank"><img src="{hard_docs.list.tools.IMG}" border="0" title="{hard_docs.list.tools.IMG_TITLE}" alt="" /></a>&nbsp;			
			<!-- END tools -->			
			</td>
		</tr>
		<!-- END list -->
		<!-- BEGIN no_list -->		
		<tr>
			<td colspan="6" class="row1"><i>{hard_docs.no_list.TEXT}</i></td>
		</tr>
		<!-- END no_list -->	
		<!-- BEGIN add -->	
		<tr>
			<td colspan="6" align="right" class="row">[ <img src="{hard_docs.add.IMG}" border="0" alt="" /> 
			<a href="{hard_docs.add.LINK}" target="_blank">{hard_docs.add.TEXT}</a> ]			
			</td>
		</tr>	
		<!-- END add -->		
		
	</table>
	</div>
<!-- END hard_docs -->

<!-- BEGIN hard_ocsdetails -->
	<div id="hard_hardocs" style="display:none">
	
	<!-- BEGIN drives -->	
	<div class="fiche_hard_ocsblocks" style="margin-left:4px;"><p class="cat_title2" style="margin-top:0;">{hard_ocsdetails.drives.TITLE}</p>
		<!-- BEGIN list -->	
		<div>
		<div style="float:left;"><img src="{hard_ocsdetails.drives.list.IMG}" alt="" title="{hard_ocsdetails.drives.list.TYPE}" /></div>
		<div style="float:left;"><b>{hard_ocsdetails.drives.list.LETTER}</b>&nbsp;<i>&nbsp;{hard_ocsdetails.drives.list.VOLUMN}</i><br/>
		<font style="font-size:8px;font-style:italic;">{hard_ocsdetails.drives.list.TYPE}</font><br/>
		<p class="fiche_hard_drive" style="background:url('{hard_ocsdetails.drives.list.BGIMG}');background-size:{hard_ocsdetails.drives.list.PRCT}%;background-repeat:no-repeat; ">&nbsp;{hard_ocsdetails.drives.list.TEXT}</p></div>
		</div>
		<div style="clear:both">&nbsp;</div>
		<!-- END list -->	
	</div>
	<!-- END drives -->	

	<div class="fiche_hard_ocsblocks" style="margin-left:4px;"><p class="cat_title2" style="margin-top:0;">{hard_ocsdetails.PROCMEM_TITLE}</p>	
		<div style="float:left;width:18%;margin-right:4px;"><img src="{hard_ocsdetails.PROC_IMG}" alt="" title="{hard_ocsdetails.L_PROCTYPE}" style="width:40px;" /></div>
		<div style="float:left;width:77%;"><font style="font-size:8px;font-style:italic;">{hard_ocsdetails.PROCSPECN}&nbsp;{hard_ocsdetails.L_PROCSPECN}</font><br/>
		{hard_ocsdetails.PROCTYPE} <br/>
		{hard_ocsdetails.PROCSPEC} {hard_ocsdetails.L_PROCSPEC}
		</div>
		
		<div style="clear:both">&nbsp;</div>
		
		<div style="float:left;width:18%;margin-right:4px;"><img src="{hard_ocsdetails.MEM_IMG}" alt="" title="{hard_ocsdetails.L_MEMORY}" style="width:40px;" /></div>
		<div style="float:left;width:77%;">{hard_ocsdetails.MEMORY}&nbsp;{hard_ocsdetails.L_MEMORY_RAM}<br/>
		{hard_ocsdetails.SWAP}&nbsp;{hard_ocsdetails.L_MEMORY_SWAP}
		</div>
	</div>
	
	<div class="fiche_hard_ocsblocks" style="margin-left:4px;"><p class="cat_title2" style="margin-top:0;">{hard_ocsdetails.OS_TITLE}</p>
		
		<div style="float:left;width:18%;margin-right:4px;"><img src="{hard_ocsdetails.OS_IMG}" alt="" title="{hard_ocsdetails.L_OS}" style="width:40px;" /></div>
		<div style="float:left;width:77%;">{hard_ocsdetails.OSNAME}<br/>{hard_ocsdetails.SP}<br/>{hard_ocsdetails.L_OSVERSION}&nbsp;{hard_ocsdetails.OSVERSION}
		</div>

		<div style="clear:both">&nbsp;</div>
		
		<div style="float:left;width:18%;margin-right:4px;"><img src="{hard_ocsdetails.WORKGROUP_IMG}" alt="" title="{hard_ocsdetails.L_WORKGROUP}" style="width:40px;" /></div>
		<div style="float:left;width:77%;">{hard_ocsdetails.WORKGROUP}
		</div>

		<div style="clear:both">&nbsp;</div>
		
		<div style="float:left;width:18%;margin-right:4px;"><img src="{hard_ocsdetails.WINOWNER_IMG}" alt="" title="{hard_ocsdetails.L_WINOWNER}" style="width:40px;" /></div>
		<div style="float:left;width:77%;">{hard_ocsdetails.WINOWNER}
		</div>

	</div>
	
	<div class="fiche_hard_ocsblocks" style="margin-left:5px;"><p class="cat_title2" style="margin-top:0;">{hard_ocsdetails.OTHER_TITLE}</p>
	<b>{hard_ocsdetails.L_LASTUPDATE}</b><br/>
	{hard_ocsdetails.LASTUPDATE}<br/><br/>
	<b>{hard_ocsdetails.L_LASTUSER}</b><br/>
	{hard_ocsdetails.LASTUSER}
	</div>
	
	<div style="clear:both;">&nbsp;</div>
	
	</div>
<!-- END hard_ocsdetails -->

<!-- BEGIN hard_softocs -->
	<!-- BEGIN auto -->
	<div id="hard_softocs" style="display:none;">
		<div class="fiche_hard_ocsblocks" style="margin-left:4px;width:96%;height:auto;"><p class="cat_title2" style="margin-top:0;">{hard_softocs.auto.L_DETAILS}</p>
		<table class="table">
			<!-- BEGIN line -->
			<tr>
				<!-- BEGIN col -->
				<td class="row1" width="50%">{hard_softocs.auto.line.col.OCSNAME}&nbsp;{hard_softocs.auto.line.col.L_VERSION}&nbsp;{hard_softocs.auto.line.col.VERSION}</td>
				<!-- END col -->	
			</tr>
			<!-- END line -->
		</table>
		</div>
	</div>
	<!-- END auto -->
	
	<!-- BEGIN manual -->
	<div id="hard_softocs" style="display:none;">
		<div class="cat_title">{hard_softocs.manual.L_SOFTINSTALLED}</div>		
		<table class="table">
				<tr>
					<td class="titre3">{hard_softocs.manual.L_NAME}</td>
					<td class="titre3">{hard_softocs.manual.L_MAJVERS}</td>
					<td class="titre3">{hard_softocs.manual.L_VERSIONNUM} ({hard_softocs.manual.L_VERSIONDATE})</td>
				</tr>

				<!-- BEGIN list -->
				<tr>
					<td class="row1" width="20%">{hard_softocs.manual.list.NAME}</td>
					<td class="row1" width="40%">{hard_softocs.manual.L_VERSION}: {hard_softocs.manual.list.VERSIONMAJ} {hard_softocs.manual.L_MAJDATE} {hard_softocs.manual.list.DATEMAJ} {hard_softocs.manual.L_MAJUSER} {hard_softocs.manual.list.USER}&nbsp;</td>
					<td class="row1" width="40%">{hard_softocs.manual.list.VERSION}&nbsp;({hard_softocs.manual.list.DATE})</td>
				</tr>				
				<!-- END list -->
				<!-- BEGIN no_soft -->
				<tr>
					<td colspan="3" class="row1">{hard_softocs.manual.no_soft.L_NOSOFT}</td>
				</tr>
				<!-- END no_soft -->
				<!-- BEGIN add -->	
				<tr>
					<td colspan="3" align="right" class="row">[ <img src="{hard_softocs.manual.add.IMG}" border="0" alt="" /> 
					<a href="{hard_softocs.manual.add.LINK}" target="_blank">{hard_softocs.manual.add.TEXT}</a> ]			
					</td>
				</tr>	
				<!-- END add -->		
		</table>
		</div>
	</div>
	<!-- END manual -->

<!-- END hard_softocs -->

<!-- BEGIN hard_ldap -->
<div id="hard_ldap" style="display:none">
<div class="cat_title">{hard_ldap.L_DETAILS}</div>		
	<table class="table">
	<!-- BEGIN line -->
	<tr>
		<!-- BEGIN col -->
		<td class="titre3" width="20%">{hard_ldap.line.col.NAME}</td>
		<td class="row1" width="30%">{hard_ldap.line.col.VALUE}</td>
		<!-- END col -->	
	</tr>
	<!-- END line -->
	</table>
</div>
<!-- END hard_ldap -->
