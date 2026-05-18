<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN select -->
	<div class="cat_title">{select.TITLE}</div>
	<div class="textbox">
	<!-- BEGIN companies -->
		<table class="table">
		<tr>
			<td class="titre3">{select.companies.L_COMPNAME}</td>
			<td class="titre3">{select.companies.L_ADDRESS}</td>
			<td class="titre3">{select.companies.L_CPOSTAL}</td>
			<td class="titre3">{select.companies.L_CITY}</td>
			<td class="titre3">{select.companies.L_TOOLS}</td>
		</tr>
		<!-- BEGIN list -->
		<tr>
			<td class="row1">{select.companies.list.COMPNAME}</td>
			<td class="row1">{select.companies.list.ADDRESS}</td>
			<td class="row1">{select.companies.list.CPOSTAL}</td>
			<td class="row1">{select.companies.list.CITY}</td>
			<td class="row1"><a href="{select.companies.list.TOOL_LINK}"><img src="{select.companies.list.TOOL_IMAGE}" border="0" title="{select.companies.list.TOOL_TITLE}" alt="" /></a>&nbsp;</td>
		<tr>
		<!-- END list -->
		</table>
	<!-- END companies -->
	<!-- BEGIN no_companies -->
		<div class="no_record">{select.no_companies.MESSAGE}</div>
	<!-- END no_companies -->
	
	</div>
<!-- END select -->

<!-- BEGIN form -->
	<div class="cat_title">{form.TITLE}</div>
	<div class="textbox_white">
		<form name="form" action="{form.ACTION}" method="POST" onSubmit="return verifErrors()">
		
		<!-- BEGIN compname -->
		<label>{form.compname.L_COMPNAME}</label>
    <input type="text" name="rs" value="{form.compname.VALUE}" onKeyUp="verifLong(this);" id="{form.compname.ID}" {form.compname.DISABLED} ><br/>
		<!-- END compname -->
		
		<!-- BEGIN address -->
		<label>{form.address.L_ADDRESS}</label><textarea name="adresse">{form.address.VALUE}</textarea><br/>
		<!-- END address -->
		
		<!-- BEGIN cpostal -->
		<label>{form.cpostal.L_CPOSTAL}</label> <input type="text" value="{form.cpostal.VALUE}" name="cp" ><br/>
		<!-- END cpostal -->
		
		<!-- BEGIN city -->
		<label>{form.city.L_CITY}</label> <input type="text" value="{form.city.VALUE}" name="ville" ><br/>
		<!-- END city -->
		
		<!-- BEGIN phone -->
		<label>{form.phone.L_PHONE}</label> <input type="text" value="{form.phone.VALUE}" name="tel" ><br/>
		<!-- END phone -->
	
		<input type="submit" name="soumettre" value="{form.BUTTON}" >
    </form>
	</div>
<!-- END form -->

<!-- BEGIN form_post -->
	<br/>
  <p class="contenu" id="{form_post.ID}">{form_post.OK}<br/>
  <br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<a href="{form_post.BACK_PAGE}">{form_post.BACK}</a>
  </p><br/>
<!-- END form_post -->
