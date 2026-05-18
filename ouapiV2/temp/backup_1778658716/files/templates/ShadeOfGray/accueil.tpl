<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
           "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>{LANG_MAIN_TITLE}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="scripts/infobulle.js" type="text/javascript"></script>
</head>
<body class="{BODY_CLASS}">
  <!-- BEGIN r_my -->
  <div class="cat_title">{r_my.TITLE}</div>

	<!-- BEGIN display -->
		<p class="toolbox" style="margin-left:40px;"><img src="{r_my.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;
    <a href="{r_my.display.LINK}" target="_blank">{r_my.display.TEXT}</a>
    </p>
	<!-- END display -->		

	<div style="clear:both">&nbsp;</div>

	<div style="float:left;">
	<!-- BEGIN infos -->
		<div style="float:left;">
		<span class="my_main_button" style="position:relative;{r_my.infos.STYLE}">{r_my.infos.TEXT}<br/>
    <br/>
      <font style="font-size:10px;">
      {r_my.infos.USER_NAME}<br/>
      {r_my.infos.IP}<br/>
      </font>
		  <img src="{r_my.infos.IMAGE}" border="0" alt="" style="position:absolute;bottom:10px;left:10px;"/>
		</span>
    </div>
	<!-- END infos -->
  
	<!-- BEGIN links -->
		<div style="float:left;" onmouseover="document.getElementById('delspan{r_my.links.ID}').style.display='inline'" onmouseout="document.getElementById('delspan{r_my.links.ID}').style.display='none'">
		<a href="{r_my.links.LINK}" style="display:block;width:100%;height:100%" target="{r_my.links.TARGET}" id="href{r_my.links.ID}">
		<span class="{r_my.links.CLASS}" style="position:relative;{r_my.links.STYLE}" onmouseover="{HELP_ADDSHORTCUT_BUTTON}" onmouseout="tooltip.hide();">{r_my.links.TEXT}
		<img src="{r_my.links.IMAGE}" border="0" alt="" style="position:absolute;bottom:10px;left:10px;"/>
		<!-- BEGIN del -->
			<span id="delspan{r_my.links.ID}" style="position:absolute;bottom:0px;right:0px;display:none;">
			<img src="{r_my.TEMPLATE_ROOT}images/del_corner.gif" alt="" onclick="document.getElementById('href{r_my.links.ID}').target='_self';document.getElementById('href{r_my.links.ID}').href='';
			if (confirm('{r_my.links.del.TEXT}')) { window.open('{r_my.links.del.LINK}') }"/>
			</span>
		<!-- END del -->
		</span>
    </a>
    </div>
	<!-- END links -->
	</div>
	<div style="float:right;width:28%;"></div>
	
	<div style="clear:both">&nbsp;</div>
	
	<!-- BEGIN params -->
		<table class="table">
		<tr>
			<td class="titre2" colspan="3">{r_my.TITLE_PARAM}</td>
		</tr>			
		<tr>
			<td class="titre3" width="40%">{r_my.TITLE_HARD}</td>
			<td class="row1">{r_my.HARD_NAME}</td>
		</tr>
		<tr>
			<td class="titre3" width="40%">{r_my.TITLE_IP}</td>
			<td class="row1">{r_my.IP}</td>
		</tr>
		<tr>
			<td class="titre3" width="40%">{r_my.TITLE_AGENCE}</td>
			<td class="row1">{r_my.AGENCE_NAME}</td>
		</tr>
		</table>
		
	<table class="table">
		<tr>
			<td colspan="8" class="titre2">{r_my.MY_HARD_TITLE}</td>
		</tr>
		<!-- BEGIN col_hard -->
		<tr>
			<td class="{r_my.col_hard.CLASS}" width="15%">{r_my.col_hard.COL_NAME}</td>
			<td class="{r_my.col_hard.CLASS}" width="10%">{r_my.col_hard.COL_TYPE}</td>
			<td class="{r_my.col_hard.CLASS}" width="10%">{r_my.col_hard.COL_PLACE}</td>
			<td class="{r_my.col_hard.CLASS}" width="12%">{r_my.col_hard.COL_MARQUE}</td>
			<td class="{r_my.col_hard.CLASS}" width="12%">{r_my.col_hard.COL_MODEL}</td>
			<td class="{r_my.col_hard.CLASS}">{r_my.col_hard.COL_OS}</td>
			<td class="{r_my.col_hard.CLASS}">{r_my.col_hard.COL_SERIAL}</td>
			<td class="{r_my.col_hard.CLASS}" width="8%">{r_my.col_hard.COL_TOOLS}</td>
		</tr>	
		<!-- END col_hard -->
    
		<!-- BEGIN list_hard -->
		<tr>
			<td class="{r_my.list_hard.CLASS}">{r_my.list_hard.COL_NAME}</td>
			<td class="{r_my.list_hard.CLASS}">{r_my.list_hard.COL_TYPE}</td>
			<td class="{r_my.list_hard.CLASS}">{r_my.list_hard.COL_PLACE}</td>
			<td class="{r_my.list_hard.CLASS}">{r_my.list_hard.COL_MARQUE}</td>
			<td class="{r_my.list_hard.CLASS}">{r_my.list_hard.COL_MODEL}</td>
			<td class="{r_my.list_hard.CLASS}">{r_my.list_hard.COL_OS}</td>
			<td class="{r_my.list_hard.CLASS}">{r_my.list_hard.COL_SERIAL}</td>
			<!-- BEGIN tools -->
			<td class="{r_my.list_hard.CLASS}"><a href="{r_my.list_hard.tools.LINK}" target="_blank"><img src="{r_my.list_hard.tools.IMAGE}" border="0" title="{r_my.list_hard.tools.TITLE}" alt="" /></a>&nbsp;</td>
			<!-- END tools -->
		</tr>	
		<!-- END list_hard -->
    
		<!-- BEGIN no_hard -->
		<tr>
			<td colspan="8" class="no_record" align="center">{r_my.no_hard.TEXT}</td>
		</tr>
		<!-- END no_hard -->
	</table>

	<table class="table">
	<tr>
		<td colspan="7" class="titre2">{r_my.MY_PERIPH_TITLE}</td>
	</tr>
	<!-- BEGIN col_periph -->
	<tr>
		<td class="{r_my.col_periph.CLASS}" width="15%">{r_my.col_periph.COL_NAME}</td>
		<td class="{r_my.col_periph.CLASS}" width="10%">{r_my.col_periph.COL_TYPE}</td>
		<td class="{r_my.col_periph.CLASS}" width="10%">{r_my.col_periph.COL_HARDLINK}</td>
		<td class="{r_my.col_periph.CLASS}" width="12%">{r_my.col_periph.COL_MARQUE}</td>
		<td class="{r_my.col_periph.CLASS}" width="12%">{r_my.col_periph.COL_MODEL}</td>
		<td class="{r_my.col_periph.CLASS}">{r_my.col_periph.COL_SERIAL}</td>
		<td class="{r_my.col_periph.CLASS}" width="8%">{r_my.col_periph.COL_TOOLS}</td>
	</tr>	
	<!-- END col_periph -->
  
	<!-- BEGIN list_periph -->
	<tr>
		<td class="{r_my.list_periph.CLASS}">{r_my.list_periph.COL_NAME}</td>
		<td class="{r_my.list_periph.CLASS}">{r_my.list_periph.COL_TYPE}</td>
		<td class="{r_my.list_periph.CLASS}">{r_my.list_periph.COL_HARDLINK}</td>
		<td class="{r_my.list_periph.CLASS}">{r_my.list_periph.COL_MARQUE}</td>
		<td class="{r_my.list_periph.CLASS}">{r_my.list_periph.COL_MODEL}</td>
		<td class="{r_my.list_periph.CLASS}">{r_my.list_periph.COL_SERIAL}</td>
		<!-- BEGIN tools -->
		<td class="{r_my.list_periph.CLASS}"><a href="{r_my.list_periph.tools.LINK}" target="_blank"><img src="{r_my.list_periph.tools.IMAGE}" border="0" title="{r_my.list_periph.tools.TITLE}" alt="" /></a>&nbsp;</td>
		<!-- END tools -->
	</tr>
	<!-- END list_periph -->
  
	<!-- BEGIN no_periph -->
	<tr>
		<td class="no_record" align="center" colspan="7">{r_my.no_periph.TEXT}</td>
	</tr>
	<!-- END no_periph -->
  
	</table>	
	<!-- END params -->
  <!-- END r_my -->

  <!-- BEGIN sum -->
	<!-- BEGIN title -->
	<div class="cat_title">{sum.title.TITLE_SUM} {sum.title.AGENCE}</div>
	<!-- END title -->

	<table class="table">
	<!-- BEGIN list_mat -->
		<tr>
			<td class="titre2" colspan="4"><img src="{sum.list_mat.IMAGE}" height="18" alt="" /> {sum.list_mat.TITLE}</td>
		</tr>
		
		<!-- BEGIN line -->
		<tr>
			<!-- BEGIN mat -->
				<td class="titre3" width="40%">{sum.list_mat.line.mat.LABEL}</td>
				<td class={sum.list_mat.line.mat.CLASS} width="10%">{sum.list_mat.line.mat.NUM}</td>
			<!-- END mat -->
		</tr>		
		<!-- END line -->
	<!-- END list_mat -->
	<!-- BEGIN users -->
	<tr>
		<td class="titre2" colspan="4"><img src="{sum.users.IMAGE}" height="18" alt="" /> {sum.users.L_USERS}</td>
	</tr>
	<tr>
		<td class="titre3" width="40%">{sum.users.LANG_USERS}</td>
		<td class="row1" colspan="3">{sum.users.NB_USERS}</td>
	</tr>
	<!-- END users -->
	</table>
  <!-- END sum -->
	
	<!-- BEGIN help -->
		<div class="help">
			<img src="{help.IMG_HELP}" style="margin-top:-25px;margin-left:-27px;" title="{help.TITLE}" alt=""/>{help.TEXT}
		</div>
	<!-- END help -->
</body>
</html>