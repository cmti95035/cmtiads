
<script language="javascript">
				
			function dateselect(status){
	
	if (status=="off"){
	document.getElementById('dateselection').style.display='none'; document.getElementById('create_adunit').style.display='block';
	}
	if (status=="on"){
	document.getElementById('dateselection').style.display='block'; document.getElementById('create_adunit').style.display='none';
	}

}

				</script>
<form method="post" enctype="multipart/form-data" id="crudcampaign"
	name="crudcampaign" class="form uniformForm">
	<input type="hidden" name="startreport" value="1" /> <input
		type="hidden" name="report_type" value="<?php echo $report_type; ?>" />

	<div class="widget">

		<div class="widget-header">
			<span class="icon-article"></span>
			<h3>报告详情</h3>
		</div>
		<!-- .widget-header -->

		<div class="widget-content">
                       <?php if ($report_type=='campaign'){?>
                            <div class="field-group">

				<div class="field">
					<select id="reporting_campaign" name="reporting_campaign">
                                    <?php
																								if (check_permission_simple ( 'campaign_reporting', $user_detail ['user_id'] )) {
																									?>
								  <option value="0">- 所有的广告活动 -</option>
                                  <?php } ?>
<?php if (!isset($_GET['reporting_campaign'])){$_GET['reporting_campaign']='';} get_campaign_dropdown($_GET['reporting_campaign']); ?>								</select>
					<label for="reporting_campaign">Campaign</label>
				</div>
			</div>
			<!-- .field-group -->
                            <?php } ?>
                            
                            <?php if ($report_type=='publication'){?>
                            <div class="field-group">

				<div class="field">
					<select id="reporting_publication" name="reporting_publication">
						<option value="0">- 所有的出版物 -</option>
<?php if (!isset($editdata['reporting_publication'])){$editdata['reporting_publication']='';} get_publication_dropdown_report($editdata['reporting_publication']); ?>								</select>
					<label for="reporting_publication">Publication</label>
				</div>
			</div>
			<!-- .field-group -->
                            <?php } ?>
                            
                            <?php if ($report_type=='network'){?>
                            <div class="field-group">

				<div class="field">
					<select id="reporting_network" name="reporting_network">
						<option value="0">- 所有的网络 -</option>
<?php  if (!isset($editdata['reporting_network'])){$editdata['reporting_network']='';} get_network_dropdown_report($editdata['reporting_network']); ?>								</select>
					<label for="reporting_network">网络</label>
				</div>
			</div>
			<!-- .field-group -->
                            <?php } ?>
                            
                            <div class="field-group">

				<div class="field">
					<select id="reporting_sort" name="reporting_sort">
						<option value="0">-</option>
						<option value="1">广告活动</option>
						<option value="2">广告单位</option>
						<option value="3">出版物</option>
						<option value="4">位置</option>
						<option value="5">月</option>
						<option value="6">日</option>
						<option value="7">广告网络</option>
					</select> <label for="inv_defaultchannel">排序条件 #1</label>
				</div>
			</div>
			<!-- .field-group -->

			<div class="field-group">

				<div class="field">
					<select id="reporting_sort2" name="reporting_sort2">
						<option value="0">-</option>
						<option value="1">广告活动</option>
						<option value="2">广告单位</option>
						<option value="3">出版物</option>
						<option value="4">位置</option>
						<option value="5">月</option>
						<option value="6">日</option>
						<option value="7">广告网络</option>
					</select> <label for="inv_defaultchannel">排序条件 #2</label>
				</div>
			</div>
			<!-- .field-group -->

			<div class="field-group">

				<div class="field">
					<select
						onchange="if (this.options[this.selectedIndex].value=='custom'){document.getElementById('dateselection').style.display='block'; } else {document.getElementById('dateselection').style.display='none';}"
						id="reporting_date" name="reporting_date">
						<option value="7">所有时间</option>
						<option value="1">今日</option>
						<option value="2">昨日</option>
						<option value="3">本周</option>
						<option value="4">上周</option>
						<option value="5">本月至今</option>
						<option value="6">上月</option>
						<option value="custom">- 自定义 -</option>
					</select> <label for="inv_defaultchannel">日期</label>
				</div>
			</div>
			<!-- .field-group -->

			<div id="dateselection" class="field-group inlineField">

				<div class="field">
					<div id="startdatepicker"></div>
					<label for="inv_defaultchannel">开始日期</label>
				</div>
				<!-- .field -->

				<div class="field">
					<div id="enddatepicker"></div>
					<label for="inv_defaultchannel">结束日期</label>
				</div>
				<!-- .field -->
			</div>
			<!-- .field-group -->

			<input type="hidden" name="startdate_value" id="startdate_value" /> <input
				type="hidden" name="enddate_value" id="enddate_value" />

		</div>
		<!-- .widget-content -->

	</div>
	<!-- .widget -->

	<div class="actions">
		<button type="submit" class="btn btn-quaternary btn-large">生成报告</button>
	</div>
	<!-- .actions -->
</form>
