<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN form_post -->
	<br/>
  <p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->

<!-- BEGIN inst_etape1 -->
<div class="cat_title">{inst_etape1.L_TITLE}</div>
<div class="textbox_white">
<form name="form" action="{inst_etape1.FORM_LINK}" method="POST">
{inst_etape1.DESC}<br/><br/>
	<!-- BEGIN sql -->
	<div class="cat_title2">{inst_etape1.sql.L_TITLE}</div><br/>
	{inst_etape1.sql.DESC}<br/>
			<!-- BEGIN list -->
				<p style="font-size:9px;margin-left:20px;">{inst_etape1.sql.list.TEXT}</p><br/><br/>
			<!-- END list -->
	<!-- END sql -->
	<div align="center"><input type="submit" name="soumettre" value="{inst_etape1.BUTTON}" class="non_form"></div>
</form>
</div>
<!-- END inst_etape1 -->