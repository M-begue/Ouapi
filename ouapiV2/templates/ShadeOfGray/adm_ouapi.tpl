<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN form_post -->
	<br/>
  <p class="contenu" id="{form_post.ID}">{form_post.OK}<br/>
  <br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->

<!-- BEGIN maj_stage1 -->
	<div class="cat_title">{maj_stage1.TITLE}</div>
	<div class="textbox_white">
		{maj_stage1.TEXT}<br/><br/>
		<form name="form" action="index.php?page=adm_ouapi.php&amp;stage=2" method="post" enctype="multipart/form-data">
			<input type="radio" name="uploadtype" value="uploadfile" style="vertical-align:middle;" class="non_form" >&nbsp;
      {maj_stage1.UPLOAD}&nbsp;
      <input type="file" name="doc" value="" class="non_form" ><br/><br/>
			<input type="radio" name="uploadtype" value="downloadfile" style="vertical-align:middle;" class="non_form" checked="checked" >&nbsp;
      {maj_stage1.DOWNLOAD}<br/><br/>
			<center><input type="submit" class="non_form" value="{maj_stage1.CONTINUE}" ></center><br/>
		</form>
	</div>
	
<!-- END maj_stage1 -->

<!-- BEGIN maj_stage2 -->
	<div class="cat_title">{maj_stage2.TITLE}</div>
	
	<div class="textbox">
		{maj_stage2.TEXT}<br/>
		<table class="table" style="margin-top:20px;margin-bottom:20px;">
		<tr>
				<td class="titre3">{maj_stage2.PARAMETERS}</td>
				<td class="titre3">{maj_stage2.RESULTS}</td>
		</tr>
		<!-- BEGIN tests -->
		<tr>
			<td class="row1">{maj_stage2.tests.NAME}</td>
			<td style="margin:0;padding:0;border:0" colspan="2">
        <div class="{maj_stage2.tests.CLASS}" style="padding:5px;font-size:8pt;">
			  <img src="templates/{maj_stage2.DEFAULT_TEMPLATE}/images/{maj_stage2.tests.IMAGE}.png" alt="" style="vertical-align:middle;margin-right:10px;" />
        {maj_stage2.tests.RESULT}{maj_stage2.tests.MESSAGE}
        </div>
      </td>
		</tr>
		<!-- END tests -->
		</table><br/><br/>
		
		<!-- BEGIN tests_ok -->
		<form name="form" action="index.php?page=adm_ouapi.php&amp;stage=3" method="post" enctype="multipart/form-data">
			<input type="hidden" name="zipfilename" value="{maj_stage2.tests_ok.ZIP_FILENAME}" >
			<input type="hidden" name="version" value="{maj_stage2.tests_ok.NUM_VERSION}" >
			<input type="hidden" name="archive_root" value="{maj_stage2.tests_ok.ARCHIVE_ROOT}" >
			<center>
        <input type="submit" value="{maj_stage2.tests_ok.L_CONTINUE}" class="non_form" >
      </center>
		</form>		
		<!-- END tests_ok -->

	</div>
	
<!-- END maj_stage2 -->

<!-- BEGIN maj_stage3 -->
	<div class="cat_title">{maj_stage3.TITLE}</div>
	
	<div class="textbox">
		{maj_stage3.TEXT}<br/>
	</div>
	
<!-- END maj_stage3 -->