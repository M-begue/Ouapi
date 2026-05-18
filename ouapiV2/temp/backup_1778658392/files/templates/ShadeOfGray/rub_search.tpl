<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN r_search -->	
	<!-- BEGIN header -->
	<div class="search_title1">
		<img src="{r_search.header.TABLE_IMAGE}" style="width:20px;vertical-align:middle" alt="" />&nbsp;{r_search.header.TABLE_NAME}
	</div>
		<!-- BEGIN list -->
	<div class="search_result">
		<!-- BEGIN site -->
		<div class="{r_search.header.list.site.CLASS}">{r_search.header.list.site.TITLE}</div>
		<!-- END site -->
			
		<div style="float:right;width:86%">
			<div class="search_title2">{r_search.header.list.TITLE}</div>
			<div style="font-size:8pt;text-align:justify;margin-bottom:5px;">{r_search.header.list.TEXT}</div>
			<div>
				<!-- BEGIN tools -->
				<img src="{r_search.header.list.tools.IMAGE}" style="vertical-align:middle" border="0" alt="" />&nbsp;
				<span style="margin-right:10px;">
					<a href="{r_search.header.list.tools.LINK}" class="search_link" target="{r_search.header.list.tools.TARGET}">{r_search.header.list.tools.TEXT}</a>
				</span>
				<!-- END tools -->
			</div>
		</div>
			
		<div style="clear:both"></div>

	</div>
	<!-- END list -->
	<!-- BEGIN no_match -->
	<div class="no_result">{r_search.header.no_match.TEXT}</div>
	<!-- END no_match -->
	<!-- END header -->
<!-- END r_search -->