<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>{LANG_MAIN_TITLE}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{STYLESHEET}" />
	<!-- BEGIN opt_css -->
	<link rel="stylesheet" type="text/css" href="{opt_css.HREF}" />
	<!-- END opt_css -->
	<link rel="icon" type="image/png" href="images/icon_ouapi.png" />
	
	<script type="text/javascript">
	<!-- BEGIN opt_js_var -->
		{opt_js_var.NAME} = '{opt_js_var.VALUE}';
	<!-- END opt_js_var -->
	</script> 
	
	<script src="scripts/scripts.js" type="text/javascript"></script> 
	<script src="scripts/calendrier.js" type="text/javascript"></script> 
	<script src="scripts/dynliste.js" type="text/javascript"></script> 
	<!-- BEGIN opt_script -->
	<script src="{opt_script.SRC}" type="text/javascript"></script> 
	<!-- END opt_script -->
	<!-- Debut jQueryUI -->
  <link rel="stylesheet" href="scripts/jquery-ui-1.11.2/css/ui-lightness/jquery-ui.min.css" />
  <script src="scripts/jquery-ui-1.11.2/external/jquery/jquery.js"></script>
  <script src="scripts/jquery-ui-1.11.2/jquery-ui.min.js"></script>
	<!-- Fin jQueryUI -->
</head>
<body class="{BODY_CLASS}">

<script language="JavaScript" type="text/javascript">InitBulle();</script>

<!-- BEGIN head -->
<div class="topmenu">
	<p class="button">
		<img src="images/icon_ouapi.png" style="vertical-align:middle;height:20px" title="OUAPI" alt="OUAPI" />&nbsp;
		<!-- BEGIN welcome -->
		{head.welcome.WELCOME}
		<!-- END welcome -->
		&nbsp;
		<!-- BEGIN switch_log -->
		<a href="{head.switch_log.LINK}" class="barre_sup">{head.switch_log.TEXT}</a><br/>
		<!-- END switch_log -->
	</p>
	<p class="button"><a href="{SESSION_PAGE_DEFAULT}"><img src="{IMG_HOME}" border="0" alt="" onmouseover="{HELP_HOME_BUTTON}" onmouseout="tooltip.hide();" /></a></p>

	<!-- BEGIN admin -->
	<p class="button">
		<a href="index.php?page=accueil.php&amp;rubrique=admin"><img src="{head.admin.IMG_ADMIN}" border="0" title="{head.admin.LANG_GEN_ADMIN}" alt="" onmouseover="{HELP_ADMIN_BUTTON}" onmouseout="tooltip.hide();" /></a>
	</p>
	<!-- END admin -->			

	<!-- BEGIN switch_multisite -->
	<form name="form1" action="index.php" method="get">
		<p class="button">
			<input type="hidden" name="page" value="accueil.php" />
			<select name="agence_id" class="site" onchange="form1.submit()"onmouseover="{HELP_SITE_BUTTON}" onmouseout="tooltip.hide();">
				<!-- BEGIN switch_sites -->
				<option value="{head.switch_multisite.switch_sites.SITE_ID}" {head.switch_multisite.switch_sites.SELECT}>{head.switch_multisite.switch_sites.LIBELLE}</option>			
				<!-- END switch_sites -->
			</select>
		</p>
	</form>
	<!-- END switch_multisite -->

	<!-- BEGIN search -->
	<form name="form" action="index.php?page=accueil.php&amp;rubrique=search&amp;agence_id={head.search.AGENCE_ID}" method="post">
	<p class="button">
		<input type="text" name="keywords" value="{head.search.TEXT}" class="search_field" onmouseover="{HELP_SEARCH_BUTTON}" onmouseout="tooltip.hide();" />
		<input type="image" name="search" src="{head.search.IMG_SEARCH}" title="{head.search.LANG_SEARCH}" class="search" />
		</p>
	</form>
	<!-- END search -->	

	<p class="button">
		<font style="color:white;font-size:11px;">
		<a href="http://www.ouapi.org/documentation-et-support/" target="_blank"><img src="{IMG_HELP}" border="0" title="{LANG_ONLINE_HELP}" alt="" onmouseover="{HELP_HELP_BUTTON}" onmouseout="tooltip.hide();" /></a>
		</font>
	</p>
	
	<!-- BEGIN categories -->
	<p class="button_right" onmouseover="{head.categories.ONMOUSEOVER};{HELP_RUB_BUTTON}" onmouseout="tooltip.hide();" >
		<a href="{head.categories.RUBRIQUE_LINK}"><img src="{head.categories.RUBRIQUE_ICON}" border="0" style="height:23px;" title="{head.categories.RUBRIQUE_TITLE}" alt="" /></a>
	</p>
	<!-- END categories -->

	<div style="clear:both"></div> 
</div>
	<!-- BEGIN sscategorie -->
	<div class="menu_sscat" id="{head.sscategorie.ALIAS}" style="display:none">{head.sscategorie.TITLE}
	<!-- BEGIN button -->
		<p class="button_sscat">
			<a href="{head.sscategorie.button.LINK}"><FONT COLOR="orange"><img src="{head.sscategorie.button.IMAGE}"/>&nbsp;</FONT>{head.sscategorie.button.TITLE}</a>
		</p>
	<!-- END button -->
	</div>
<!-- END sscategorie -->

<!-- END head -->

<div class="{CONTENEUR_CLASS}">
	<!-- BEGIN cat_title -->
	<div class="cat_title">{cat_title.TITLE}
		<!-- BEGIN sscat_title -->
		<div class="cat_title2" style="border:0";padding:0;>{cat_title.sscat_title.TITLE}</div>
		<!-- END sscat_title -->
	</div>
	<!-- END cat_title --></div>
</body>
</html>