<!--*********************************************************************************************
*                                                                                               *
*          Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint									        *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License										        *
*																																                                *
**********************************************************************************************-->
<!-- BEGIN soft_infos -->
<div class="information" style="height:65px;margin-top:0;"><img src="{soft_infos.ICON}" alt="" style="float:left;margin-right:20px;" />
  <font style="font-weight:bold;font-size:16px;">{soft_infos.NAME}</font><br/>
  {soft_infos.MARQUE}<br/>{soft_infos.VERSION}
</div>
<!-- END soft_infos -->
<div style="clear:both"></div>
<div class="cat_title">{CAT_TITLE}</div>
<div class="textbox">
	<table class="table">
	<!-- BEGIN tab_hard -->
		<!-- BEGIN header -->
		<tr>
			<td class="titre2" colspan="6">{tab_hard.header.TYPE_NAME}</td>
		</tr>
		<tr>
			<td class="titre3" width="15%">{tab_hard.header.L_HARDNAME}</td>
			<td class="titre3" width="10%">{tab_hard.header.L_USER}</td>
			<td class="titre3" width="10%">{tab_hard.header.L_EMPL}</td>
			<td class="titre3" width="10%">{tab_hard.header.L_SERIAL}</td>
			<td class="titre3" width="30%">{tab_hard.header.L_VERSION}</td>
			<!-- BEGIN col_serial -->
				<td class="titre3" width="25%">{tab_hard.header.col_serial.L_LICENCE}</td>
			<!-- END col_serial -->

		</tr>
			<!-- BEGIN list -->
			<tr>
				<td class="row1">{tab_hard.header.list.L_HARDNAME}</td>
				<td class="row1">{tab_hard.header.list.L_USER}</td>
				<td class="row1">{tab_hard.header.list.L_EMPL}</td>
				<td class="row1">{tab_hard.header.list.L_SERIAL}</td>
				<td class="row1">
          <!-- BEGIN status -->
          <img src="{tab_hard.header.list.status.IMAGE}" alt="" style="vertical-align:middle;" /> {tab_hard.header.list.status.TEXT}	
            <!-- BEGIN tools -->
            <form name="{tab_hard.header.list.status.tools.FORM_ID}" action="" method="post" style="float:right;">
              <input type="hidden" value="{tab_hard.header.list.status.tools.HARD_ID}" name="hard_id" />
              <input type="hidden" value="1" name="{tab_hard.header.list.status.tools.ACTION_NAME}" />
              <button type="submit">{tab_hard.header.list.status.tools.BUTTON_TEXT}&nbsp;<img src="{tab_hard.header.list.status.tools.BUTTON_IMAGE}" alt=""/></button>
            </form>									
            <!-- END tools -->
          <!-- END status -->
          
          <!-- BEGIN ocs_status -->
          <img src="{tab_hard.header.list.ocs_status.IMAGE}" alt="" style="vertical-align:middle;" /> {tab_hard.header.list.ocs_status.TEXT}<br/>
          <!-- END ocs_status -->

				
				</td>
				<!-- BEGIN col_serial -->
					<td class="row1" style="vertical-align:top">
					
					<!-- BEGIN serial -->
						<div style="line-height:21px;">{tab_hard.header.list.col_serial.serial.NUM}
						<form name="form_{tab_hard.header.list.col_serial.serial.DEL_SERIAL_ID}" action="" method="post" style="float:right;">
							<input type="hidden" value="{tab_hard.header.list.col_serial.serial.ID}" name="serial_id" />
							<input type="hidden" name="del_serial" value="1" />
							<button type="submit">{tab_hard.header.list.col_serial.DEL_SERIAL}&nbsp;<img src="{tab_hard.header.list.col_serial.DEL_SERIAL_IMG}" alt="" /></button>
						</form>					
						</div>
						<div style="clear:both"></div>
					<!-- END serial -->
					<!-- BEGIN no_serial -->
						<div style="line-height:21px;">{tab_hard.header.list.col_serial.no_serial.NUM}</div>
						<div style="clear:both"></div>
					<!-- END no_serial -->
					
					<div style="text-align:right;"><button onclick="javascript:document.getElementById('{tab_hard.header.list.col_serial.ADD_SERIAL_ID}').style.display='block';this.style.display='none'">{tab_hard.header.list.col_serial.ADD_SERIAL}&nbsp;<img src="{tab_hard.header.list.col_serial.ADD_SERIAL_IMG}" alt="" /></button>
          </div>
					<div style="margin:0;display:none;" id="{tab_hard.header.list.col_serial.ADD_SERIAL_ID}"> 
					<form name="form_{tab_hard.header.list.col_serial.ADD_SERIAL_ID}" action="" method="post">
						<input type="text" value="" name="serial_num" class="non_form" />
						<input type="hidden" value="{tab_hard.header.list.HARD_ID}" name="h_id" />
						<input type="submit" name="add_serial" value="{tab_hard.header.list.col_serial.ADD_SERIAL_BTN}" class="non_form" />
					</form>
					</div>				
				</td>
				<!-- END col_serial -->
			</tr>
			<!-- END list -->	
		<!-- END header -->	
	<!-- END tab_hard -->
	</table>
</div>