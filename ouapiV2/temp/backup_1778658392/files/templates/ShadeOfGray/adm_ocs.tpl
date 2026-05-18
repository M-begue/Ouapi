<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN form -->
	<div class="cat_title">{form.CONFIG_TITLE}</div>
	<div class="textbox_white">
	<!-- BEGIN help -->
		<div class="help"><img src="{form.help.IMG_HELP}" style="margin-top:-40px;margin-left:-27px;"title="{form.help.LANG_HELP}" alt="">{form.help.HELP_MESSAGE}</div>
	<!-- END help -->
		
	<form name="form" action="{form.ACTION}" method="POST">
	<div class="cat_title2" style="margin-bottom:10px;">{form.CONFIG_HARD_TITLE}</div>
	
		<!-- BEGIN multisite -->
			<label>{form.multisite.CONF_DIFF_SITE}</label>
			<Select name="mask_type">
				<!-- BEGIN select_ds -->
				<option value="{form.multisite.select_ds.CONF_DS_VALUE}" {form.multisite.select_ds.CONF_DS_SELECTED}>{form.multisite.select_ds.CONF_DS_NAME}</option>
				<!-- END select_ds -->
			</select><br/>
			
		<label>{form.multisite.CONF_DS_MASK_NAME}</label>
    <input type="text" name="mask" value="{form.multisite.CONF_DS_MASK_VALUE}"><br/>
		<!-- END multisite -->
		
		<!-- BEGIN monosite -->
			<input type="hidden" name="mask_type" value="{form.monosite.CONF_DS_NAME}">
			<input type="hidden" name="mask" value="{form.monosite.CONF_DS_MASK_VALUE}">
		<!-- END monosite -->

		<label>{form.CONFIG_COMP_CRIT_LABEL}</label> 
		<Select name="crit">
			<!-- BEGIN select_crit -->
			<option value="{form.select_crit.CONF_CRIT_VALUE}" {form.select_crit.CONF_CRIT_SELECTED}>{form.select_crit.CONF_CRIT_NAME}</option>
			<!-- END select_crit -->
		</select><br/>
	
	<div class="cat_title2" style="margin-top:20px;margin-bottom:10px;">{form.CONFIG_PERIPH_TITLE}</div>
	<!-- BEGIN periph_options_yn -->
	<label>{form.periph_options_yn.LABEL}</label>
	<p style="margin-left:180px;margin-top:5px;margin-bottom:0;padding-top:7px;">
		<input type="radio" name="{form.periph_options_yn.NAME}" class="non_form" style="vertical-align:middle" {form.periph_options_yn.Y_CHECK} value="1">&nbsp;{form.periph_options_yn.YES}&nbsp;
		<input type="radio" name="{form.periph_options_yn.NAME}" class="non_form" style="vertical-align:middle" {form.periph_options_yn.N_CHECK} value="0">&nbsp;{form.periph_options_yn.NO}
	</p>
	<!-- END periph_options_yn -->
	
	<div class="cat_title2" style="margin-top:20px;margin-bottom:10px;">{form.CONFIG_SOFT_TITLE}</div>
	<font style="font-weight:bold;font-size:12px;">{form.CONFIG_SOFT_FILTER}</font><br/>
		<!-- BEGIN soft_filter -->
		<label>{form.soft_filter.CONF_SOFT_FILTER_LABEL}</label>
    <input type="checkbox" name="{form.soft_filter.CONF_SOFT_FILTER_NAME}" 
		value="{form.soft_filter.CONF_SOFT_FILTER_VALUE}" {form.soft_filter.CONF_SOFT_FILTER_CHECK}><br/>
		<!-- END soft_filter -->
		<br/>
		<input type="submit" name="soumettre" value="{form.CONFIG_SAVE_BUTTON}">
	</form>
</div>	
<!-- END form -->

<!-- BEGIN form_post -->
	<br/>
  <p class="contenu" id="mess_retour">{form_post.OK}<br/>
  <br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>
  </p><br/>
<!-- END form_post -->