<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN infos -->
<div class="information" style="height:70px;margin-top:0;">
	<img src="{infos.ICON}" alt="" style="float:left;margin-right:20px;" />
	<font style="font-weight:bold;font-size:16px;">{infos.NAME}</font><br/>{infos.MARQUEMODELE}<br/>{infos.SERIAL}<br/>{infos.TXTLINKEDTO}<a href="{infos.LINK}" target="_self" style="color:#686995">{infos.HWNAME}</a>
	
</div>
<!-- END infos -->

<div style="clear:both"></div>

<div class="topmenu">
	<!-- BEGIN button -->
		<p id="{button.ID}" class="{button.CLASS}" onclick="{button.LINK}"> <img src="{button.IMG_ICON}" style="height:14px; width:14px" alt=""/> &nbsp; {button.TEXT}
			<!-- BEGIN nb -->
				&nbsp;({button.nb.TEXT})
			<!-- END nb -->
		</p>
	<!-- END button -->
	<div style="clear:both"></div> 
</div>

<div class="fiche">
	<!-- BEGIN periph_details -->
	<div id="periph_details">
	<div class="cat_title">{periph_details.L_TITLE}</div>

	<table class="table">
	<tr>
		<td colspan="4" class="titre2">{periph_details.L_PERIPH_TITLE}</td>
	</tr>
	<tr>
		<td class="titre3" width="20%">{periph_details.L_PLACE}</td>
		<td class="row1" width="30%">{periph_details.PLACE}</td>
		<td class="titre3" width="20%">{periph_details.L_MARQUE}</td>
		<td class="row1" width="30%">{periph_details.MARQUE}</td>
	</tr>
	<tr>
		<td class="titre3">{periph_details.L_NAME}</td>
		<td class="row1">{periph_details.NAME}</td>
		<td class="titre3">{periph_details.L_MODELE}</td>
		<td class="row1">{periph_details.MODELE}</td>
	</tr>
	<tr>
		<td class="titre3">{periph_details.L_SERIAL}</td>
		<td class="row1">{periph_details.SERIAL}</td>
		<td class="titre3">{periph_details.L_RESERV}</td>
		<td class="row1">{periph_details.RESERV}</td>
	</tr>
	<tr>
		<td class="titre3">{periph_details.L_DATE}</td>
		<td class="row1">{periph_details.DATE}</td>
		<td class="titre3">{periph_details.L_HARDLINK}</td>
		<td class="row1" colspan="3">{periph_details.HARDLINK}</td>
	</tr>
	<tr>
		<td class="titre3" width="20%">{periph_details.L_COMMENT}</td>
		<td class="row1" colspan="3">{periph_details.COMMENT}</td>
	</tr>
	<!-- BEGIN line -->
	<tr>
		<!-- BEGIN info -->
			<td class="titre3">{periph_details.line.info.TITLE}</td>
			<td class="row1">{periph_details.line.info.VALUE}</td>
		<!-- END info -->	
	</tr>
	<!-- END line -->
	</table>
	</div>
	<!-- END periph_details -->

	<!-- BEGIN docs -->
	<div id="periph_docs" style="display:none">
		<div class="cat_title">{docs.L_TITLE}</div>	
		
		<table class="table">
		<tr>
			<td colspan="6" class="titre2"><img src="{docs.IMG}" style="vertical-align:middle" height="16" alt="" />&nbsp;{docs.L_TITLE}</td>
		</tr>
		<!-- BEGIN tab -->
			<tr>
				<td class="titre3" width="15%">{docs.tab.TYPE}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.DATE}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.EMETTEUR}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.REF}</td>
				<td class="{docs.tab.CLASS}" width="15%">{docs.tab.COMMENT}</td>
				<td class="{docs.tab.CLASS}" align="right" width="10%">
				<!-- BEGIN tools -->	
					<a href="{docs.tab.tools.LINK}" target="_blank"><img src="{docs.tab.tools.IMAGE}" border="0" title="{docs.tab.tools.TITLE}" alt="" /></a>&nbsp;
				<!-- END tools -->		
				</td>
			</tr>
		<!-- END tab -->
		<!-- BEGIN no_tab -->
			<tr>
				<td colspan="6" class="no_record">{docs.no_tab.TEXT}</td>
			</tr>
		<!-- END no_tab -->
		</table>
		<table width="99%" align="center">
		<tr>
			<td align="right" class="row">	
			<!-- BEGIN adddoc -->
					[ <img src="{docs.adddoc.IMAGE}" border="0" alt="" /> <a href="{docs.adddoc.LINK}" target="_blank">{docs.adddoc.TITLE}</a> ]		
			<!-- END adddoc -->
				</td>
		</tr>
		</table>
	</div>
	<!-- END docs -->

	<!-- BEGIN periph_ocsdetails -->
	<div id="periph_periphocs" style="display:none">
	<div class="cat_title">{periph_ocsdetails.L_DETAILS}</div>		
		<table class="table">
		<!-- BEGIN line -->
		<tr>
			<!-- BEGIN col -->
			<td class="titre3" width="20%">{periph_ocsdetails.line.col.NAME}</td>
			<td class="row1" width="30%">{periph_ocsdetails.line.col.VALUE}</td>
			<!-- END col -->	
		</tr>
		<!-- END line -->
		</table>
	</div>
	<!-- END periph_ocsdetails -->
</div>