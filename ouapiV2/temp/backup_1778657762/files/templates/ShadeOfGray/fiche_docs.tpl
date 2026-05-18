<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN infos -->
<div class="information" style="height:70px;margin-top:0;">
	<img src="{infos.ICON}" alt="" style="float:left;margin-right:20px;" />
	<font style="font-weight:bold;font-size:16px;">{infos.NAME}</font><br/>
	{infos.DATE}<br/>
	{infos.TYPE}<br/>
	{infos.ENTREPRISE}
</div>
<!-- END infos -->

<div style="clear:both"></div>

<div class="topmenu">
	<!-- BEGIN button -->
		<p id="{button.ID}" class="{button.CLASS}" onclick="{button.LINK}">
			<img src="{button.IMG_ICON}" style="height:14px; width:14px" alt=""/> &nbsp; {button.TEXT}
			<!-- BEGIN nb -->
				&nbsp;({button.nb.TEXT})
			<!-- END nb -->
		</p>
	<!-- END button -->
	<div style="clear:both"></div> 
</div>

<div class="fiche">	
	<div id="doc_details">
		<div class="cat_title">{L_TITLE}</div>
		<table class="table">
		<tr>
			<td class="titre3" width="20%">{L_TYPE}</td>
			<td class="row1" width="30%">{TYPE}</td>
			<td class="titre3" width="20%">{L_REF}</td>
			<td class="row1" width="30%">{REF}</td>
		</tr>
		<tr>
			<td class="titre3" width="20%">{L_ENTREPRISE}</td>
			<td class="row1" width="30%">{ENTREPRISE}</td>
			<td class="titre3" width="20%">{L_DATE}</td>
			<td class="row1" width="30%">{DATE}</td>
		</tr>
		<tr>
			<td class="titre3" width="20%">{L_DATE_ARCHIVE}</td>
			<td class="row1" width="30%">{DATE_ARCHIVE}</td>
			<td class="titre3" width="20%">{L_COMMENT}</td>
			<td class="row1">{COMMENT}</td>
		</tr>
		<!-- BEGIN line -->
		<tr>
			<!-- BEGIN info -->
				<td class="titre3">{line.info.TITLE}</td>
				<td class="row1">{line.info.VALUE}</td>
			<!-- END info -->	
		</tr>
		<!-- END line -->
		</table>
	</div>

	<!-- BEGIN doc_links -->
	<div id="doc_links" style="display:none;">
		<div class="cat_title">{doc_links.L_TITLE_ELMTS}</div>
		<table class="table">
		<!-- BEGIN list -->
			<tr>
				<td class="titre3" width="25%">{doc_links.list.TYPE}</td>
				<td class="{doc_links.list.CLASS}">{doc_links.list.NAME}</td>
				<td class="{doc_links.list.CLASS}">
				<!-- BEGIN tools -->	
					<a href="{doc_links.list.tools.LINK}" target="_blank"><img src="{doc_links.list.tools.IMAGE}" border="0" title="{doc_links.list.tools.TITLE}" alt="" /></a>&nbsp;
				<!-- END tools -->		
				</td>
			</tr>		
		<!-- END list -->
		<!-- BEGIN no_contr -->
			<tr>
				<td class="no_record">{doc_links.no_contr.TEXT}</td>
			</tr>
		<!-- END no_contr -->
		</table>

		<!-- BEGIN elmts -->
		<table width="99%" align="center">
		<tr>
			<td align="right" class="row">	
			<!-- BEGIN tools -->
				[ <img src="{doc_links.elmts.tools.IMAGE}" border="0" alt="" />
				<a href="{doc_links.elmts.tools.LINK}" target="_blank">{doc_links.elmts.tools.TITLE}</a> ]
			<!-- END tools -->
			</td>
		</tr>
		</table>
		<!-- END elmts -->
	</div>
	<!-- END doc_links -->

	<div id="doc_view" style="display:none;">
		<!-- BEGIN document -->
		<table class="table">
		<tr>
			<td class="titre2">{document.L_TITLE}</td>
		</tr>
		<tr>
			<td class="row1"><div align="center">
				<object data="{document.PATH}" type="application/{document.EXT}" width="{document.WIDTH}" height="{document.HEIGHT}">
				  <param name="filename" value="{document.PATH}" />  
				</object>
			</div></td>
		</tr>
		</table>
		<!-- END document -->

		<!-- BEGIN download -->
		<table class="table">
		<tr>
			<td class="titre2" colspan="2">{download.L_TITLE}</td>
		</tr>
		<tr>
			<td class="row1"><img src="{download.IMAGE}" alt="" />&nbsp;{download.FILE}&nbsp;({download.PATH})</td>
			<td class="row1" align="right"><a href="{download.LINK}">{download.L_DOWNLOAD}</a>&nbsp;</td>
		</tr>
		</table>
		<!-- END download -->
	</div>
</div>