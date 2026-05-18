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
<!--  <style>
  /* IE has layout issues when sorting (see #5413) */
  .group { zoom: 1 }
  </style>
  <script>
  $(function() {
    $( "#accordion" )
      .accordion({
        header: "> div > h3"
      })
      .sortable({
        axis: "y",
        handle: "h3",
        stop: function( event, ui ) {
          // IE doesn't register the blur when sorting
          // so trigger focusout handlers to remove .ui-state-focus
          ui.item.children( "h3" ).triggerHandler( "focusout" );
 
          // Refresh accordion to handle new order
          $( this ).accordion( "refresh" );
        }
      });
  });
  </script>-->

</head>
<body>

<!-- BEGIN r_periph -->

	<form name="formfilter" action="index.php" method="get">
	<!-- BEGIN hidden_filter -->
		<input type="hidden" name="{r_periph.hidden_filter.NAME}" value="{r_periph.hidden_filter.VALUE}" />
	<!-- END hidden_filter -->
	<p class="toolbox"><img src="{r_periph.IMG_FILTER}" style="vertical-align:middle;height:12px;" alt="" />&nbsp;<b>{r_periph.LANG_FILTER}:</b>&nbsp;
		<select name="filtre_type" class="site" style="height:16px;width:auto;" onchange="formfilter.submit()">
			<!-- BEGIN type_filters -->
			<option value="{r_periph.type_filters.TYPE_ID}" {r_periph.type_filters.SELECTED}>{r_periph.type_filters.TYPE_NAME}</option>
			<!-- END type_filters -->	
		</select>
	</p>
	</form>

	<!-- BEGIN add -->
	<p class="toolbox">
		<img src="{r_periph.add.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
		<a href="{r_periph.add.LINK}" target="_blank">{r_periph.add.TEXT}</a>
	</p>
	<!-- END add -->

	<!-- BEGIN display -->
	<p class="toolbox">
		<img src="{r_periph.display.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;
		<a href="{r_periph.display.LINK}" target="_blank">{r_periph.display.TEXT}</a>
	</p>
	<!-- END display -->		

	<!-- BEGIN rebus -->
	<p class="toolbox">
		<img src="{r_periph.rebus.IMAGE}" style="vertical-align:middle" border="0" alt="" />
		<a href="{r_periph.rebus.LINK}">{r_periph.rebus.TEXT}</a>
	</p>
	<!-- END rebus -->	

	<!-- BEGIN tab_periph -->
		<!-- BEGIN export -->
		<form method="post" name="formexport" action="index.php?page=export.php&amp;export=periph&amp;type=excel" target="_blank">
			<p class="toolbox">
				<input type="hidden" name="nom" value="{r_periph.tab_periph.export.NOM}" />
				<input type="hidden" name="export_data" value="{r_periph.tab_periph.export.DATA}" />
				<img src="{r_periph.tab_periph.export.IMAGE}" style="vertical-align:middle" border="0" alt="" /> 
				<a href="#" onclick="{r_periph.tab_periph.export.LINK}">{r_periph.tab_periph.export.TEXT}</a>
			</p>
		</form>
		<!-- END export -->
		
		<!-- BEGIN ocs_error -->
		<div class="contenu" id="alert" style="margin:0;margin-top:40px;margin-bottom:10px; width:99%;">{r_periph.tab_periph.ocs_error.TEXT}</div>
		<!-- END ocs_error -->

	<table class="table">		

		<!-- BEGIN group -->
			<!-- BEGIN head -->
			<tr>
				<td colspan="{r_periph.tab_periph.NBCOLS}" class="titre2">{r_periph.tab_periph.group.head.TITLE}</td>
			</tr>	
			<!-- END head -->
			
			<!-- BEGIN head2 -->
			<tr>
				<!-- BEGIN cols -->
				<td class="titre3"><a href="{r_periph.tab_periph.group.head2.cols.PAGE_TRI}">{r_periph.tab_periph.group.head2.cols.TITLE}</a></td>				
				<!-- END cols -->		
				<td class="titre3">{r_periph.tab_periph.group.LANG_TOOLS}</td>
			</tr>
			<!-- END head2 -->
			
			<!-- BEGIN list -->
			<tr class="{r_periph.tab_periph.group.list.CLASS_ROW}" id="{r_periph.tab_periph.group.list.ANCHOR}">
				<!-- BEGIN cols -->
					<td  class="{r_periph.tab_periph.group.list.cols.CLASS}">{r_periph.tab_periph.group.list.cols.TITLE}</td>				
				<!-- END cols -->								
								
				<td class="{r_periph.tab_periph.group.list.CLASS}">
					<!-- BEGIN tools --> 
					<a href="{r_periph.tab_periph.group.list.tools.LINK}" target="_blank">
					<img src="{r_periph.tab_periph.group.list.tools.IMAGE}" border="0" title="{r_periph.tab_periph.group.list.tools.TITLE}" alt="" /></a> 
					<!-- END tools --> 
					&nbsp;
				</td>
			</tr>
			<!-- END list -->
		<!-- END group -->
	</table>
	<!-- END tab_periph -->

	<!-- BEGIN no_periph -->
	<div class="no_record" align="center">{r_periph.no_periph.TEXT}</div>
	<!-- END no_periph -->

	<!-- BEGIN help -->
	<div class="help">
		<img src="{r_periph.help.IMG_HELP}" style="margin-top:-40px; margin-left:-27px;" title="{r_periph.help.IMG_TITLE}" alt="" />{r_periph.help.GENERAL_HELP}
	</div>
	<!-- END help -->
	
<!-- END r_periph -->
</body>
</html>