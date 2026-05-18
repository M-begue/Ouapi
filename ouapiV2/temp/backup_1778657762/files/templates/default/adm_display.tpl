<!-- BEGIN form_post -->
	<br/><p class="contenu" id="{form_post.ID}">{form_post.OK}<br/><br/>
	<a href="#" onclick="RefreshAndClose()">{form_post.CLOSE}</a>&nbsp;
	<!-- BEGIN back -->
		<a href="{form_post.back.BACK_PAGE}">{form_post.back.BACK}</a>
	<!-- END back -->
	</p><br/>
<!-- END form_post -->

<div class="cat_title">{TITLE}</div>
<!-- BEGIN subcats -->
	<p class="toolbox"><a href="{subcats.LINK}" style="{subcats.STYLE}">{subcats.NAME}</a></p>
<!-- END subcats -->
<div style="clear:both;"></div>
<div class="textbox">

<!-- BEGIN cols -->
	<form name="display_cols" method="post" action="{cols.FORM_ACTION}">

	<div class="cat_title2" style="margin-bottom:10px;">{cols.TITLE_PARAM}</div>
	
	<!-- BEGIN groupby -->
		<label>{cols.groupby.TEXT}</label>
		
		<select name="groupby">
		<!-- BEGIN list -->
			<option value="{cols.groupby.list.VALUE}" {cols.groupby.list.SELECTED}>{cols.groupby.list.LABEL}</option>
		<!-- END list -->
		</select><br/>
	<!-- END groupby -->
	
	<!-- BEGIN sortby -->
		<label>{cols.sortby.TEXT}</label>
		
		<select name="sortby">
		<!-- BEGIN list -->
			<option value="{cols.sortby.list.VALUE}" {cols.sortby.list.SELECTED}>{cols.sortby.list.LABEL}</option>
		<!-- END list -->
		</select>
	<!-- END sortby -->
	
	<div class="cat_title2" style="margin-bottom:10px;margin-top:20px;">{cols.TITLE_DISPLAY}</div>

	<div id="mainContainer">
		<input type="hidden" name="del_col" value="" disabled="disabled" />
		<input type="hidden" name="add_col" value="" disabled="disabled" />
		<input type="hidden" name="subcategory" value="{cols.SUBCATEGORY}" />
		
		<div id="dragableElementsParentBox">

		<!-- BEGIN displayed -->
			<div class="{cols.displayed.CLASS}" dragableBox="true" id="{cols.displayed.ID}">
				<p>
				<input type="image" name="del" value="{cols.displayed.ID}" title="{cols.displayed.DEL_TEXT}" src="{cols.displayed.IMG}" class="dbox_tool" 
				onclick="this.form.del_col.disabled='';this.form.del_col.value='{cols.displayed.ID}';saveData(this.form);" />
				</p>
				<p class="colnamebox">{cols.displayed.TEXT}</p>
			</div>
		<!-- END displayed -->
			
		<div style="clear:both;margin-bottom:20px;"  id="clear"></div>		
		</div>
		<input type="hidden" name="col_order" value="" />
	</div>
	
	<div id="insertionMarker">
		<img src="images/marker_top.gif" alt="" />
		<img src="images/marker_middle.gif" id="insertionMarkerLine" alt="" />
		<img src="images/marker_bottom.gif" alt="" />
	</div>

	<div class="cat_title2" style="margin-bottom:10px;">{cols.TITLE_NOTDISPLAY}</div>
	
	<!-- BEGIN not_displayed -->
	<div class="{cols.not_displayed.CLASS}" id="{cols.not_displayed.ID}">
		<p>
		<input type="image" name="del" value="{cols.not_displayed.ID}" title="{cols.not_displayed.ADD_TEXT}" src="{cols.not_displayed.IMG}" class="dbox_tool" 
		onclick="this.form.add_col.disabled='';this.form.add_col.value='{cols.not_displayed.ID}';saveData(this.form);" />
		</p>
		<p class="colnamebox">{cols.not_displayed.TEXT}</p>
	</div>
	<!-- END not_displayed -->
	
	<!-- BEGIN no_record -->
		<p><i>{cols.no_record.TEXT}</i></p>
	<!-- END no_record -->
	
	<div style="clear:both;margin-bottom:20px;"></div>		

	<center><input type="button" value="{BUTTON}" onclick="saveData(this.form)" class="non_form"/></center>

	</form>
<!-- END cols -->

</div>
