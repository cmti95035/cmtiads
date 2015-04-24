<script src="assets/javascripts/jquery-1.7.1.min.js"></script>

<script
	src="assets/javascripts/plugins/autocomplete/jquery.autoSuggest.js"></script>
<link rel="stylesheet" type="text/css"
	href="assets/javascripts/plugins/autocomplete/autoSuggest.css">

<SCRIPT LANGUAGE="JavaScript">
<!-- 	
// by Nannette Thacker
// http://www.shiningstar.net
// This script checks and unchecks boxes on a form
// Checks and unchecks unlimited number in the group...
// Pass the Checkbox group name...
// call buttons as so:
// <input type=button name="CheckAll"   value="Check All"
	//onClick="checkAll(document.myform.list)">
// <input type=button name="UnCheckAll" value="Uncheck All"
	//onClick="uncheckAll(document.myform.list)">
// -->


function geo_targeting(status){
	
	if (status=="off"){
$("#geo_targeting_all").attr("checked", "true");
document.getElementById('country_target').style.display='none';
	}
	if (status=="on"){
	$("#geo_targeting_co").attr("checked", "true");
	document.getElementById('country_target').style.display='block';
	}

}


function device_targeting(status){
	if (status=="off"){
		$("#device_targeting_all").attr("checked", "true");
		document.getElementById('devicetargetingtable').style.display='none';
	}
	if (status=="on"){
		$("#device_targeting_co").attr("checked", "true");
		document.getElementById('devicetargetingtable').style.display='block';
	}
}

function publication_targeting(status){
	if (status=="off"){
		$("#publication_targeting_all").attr("checked", "true");
		document.getElementById('publicationtargetingtable').style.display='none';
	}
	if (status=="on"){
		$("#publication_targeting_co").attr("checked", "true");
		document.getElementById('publicationtargetingtable').style.display='block';
	}
}

function channel_targeting(status){
	if (status=="off"){
		$("#channel_targeting_all").attr("checked", "true");
		document.getElementById('channeltargetingtable').style.display='none';
	}
	if (status=="on"){
		$("#channel_targeting_co").attr("checked", "true");
		document.getElementById('channeltargetingtable').style.display='block';
	}
}

function gender_targeting(status){
	
	if (status=="off"){
		$("#gender_targeting_all").attr("checked", "true");
		document.getElementById('gendertargetingtable').style.display='none';
	}
	if (status=="on"){
		$("#gender_targeting_co").attr("checked", "true");
		document.getElementById('gendertargetingtable').style.display='block';
	}

}

function income_targeting(status){
	if (status=="off"){
		$("#income_targeting_all").attr("checked", "true");
		document.getElementById('incometargetingtable').style.display='none';
	}
	if (status=="on"){
		$("#income_targeting_co").attr("checked", "true");
		document.getElementById('incometargetingtable').style.display='block';
	}
}

function interest_targeting(status){
	if (status=="off"){
		$("#interest_targeting_all").attr("checked", "true");
		document.getElementById('interesttargetingtable').style.display='none';
	}
	if (status=="on"){
		$("#interest_targeting_co").attr("checked", "true");
		document.getElementById('interesttargetingtable').style.display='block';
	}
}

function chroniccondition_targeting(status){
	
	if (status=="off"){
		$("#chroniccondition_targeting_all").attr("checked", "true");
		document.getElementById('chronicconditiontargetingtable').style.display='none';
	}
	if (status=="on"){
		$("#chroniccondition_targeting_co").attr("checked", "true");
		document.getElementById('chronicconditiontargetingtable').style.display='block';
	}
}

function startdate(status){
	
	if (status=="off"){
$("#start_date_im").attr("checked", "true");
document.getElementById('startdate').style.display='none';
	}
	if (status=="on"){
	$("#start_date_co").attr("checked", "true");
	document.getElementById('startdate').style.display='block';
	}

}

function enddate(status){
	
	if (status=="off"){
$("#end_date_no").attr("checked", "true");
document.getElementById('enddate').style.display='none';
	}
	if (status=="on"){
	$("#end_date_co").attr("checked", "true");
	document.getElementById('enddate').style.display='block';
	}

}

function network_campaign(status){
	
	if (status=="off"){
	document.getElementById('network_select').style.display='none'; document.getElementById('create_adunit').style.display='block';
	}
	if (status=="on"){
	document.getElementById('network_select').style.display='block'; document.getElementById('create_adunit').style.display='none';
	}

}

function checkAll(theForm, cName, status) {
		for (i=0,n=theForm.elements.length;i<n;i++)
		  if (theForm.elements[i].className.indexOf(cName) !=-1) {
		    theForm.elements[i].checked = status;
		  }
		}

</script>



<div class="widget">

	<div class="widget-header">
		<span class="icon-article"></span>
		<h3>广告活动详情</h3>
	</div>
	<!-- .widget-header -->

	<div class="widget-content">
                        
                        <?php if ($user_detail['tooltip_setting']==1){ ?>
                         <div class="notify notify-info">

			<p>请在下面输入一些关于你的广告活动的细节.</p>
		</div>
		<!-- .notify -->
                        <?php } ?>

						  <div class="field-group">

			<div class="field">
				<select <?php if ($current_action=='create'){?>
					onchange="if (this.options[this.selectedIndex].value=='network'){document.getElementById('network_select').style.display='block'; document.getElementById('create_adunit').style.display='none';} else {document.getElementById('network_select').style.display='none'; document.getElementById('create_adunit').style.display='block';}"
					<?php } ?> <?php if ($current_action=='edit'){?>
					onchange="if (this.options[this.selectedIndex].value=='network'){document.getElementById('network_select').style.display='block';} else {document.getElementById('network_select').style.display='none';}"
					<?php } ?> id="campaign_type" name="campaign_type">
					<option
						<?php if (isset($editdata['campaign_type']) && $editdata['campaign_type']==1){echo 'selected="selected"'; } ?>
						value="1">直接售出</option>
					<option
						<?php if (isset($editdata['campaign_type']) && $editdata['campaign_type']==2){echo 'selected="selected"'; } ?>
						value="2">推广</option>
					<option
						<?php if (isset($editdata['campaign_type']) && $editdata['campaign_type']=='network'){echo 'selected="selected"'; } ?>
						value="network">广告网络</option>

				</select> <a style="font-size: 11px;" href="#"
					onclick="$.modal ({title: 'Campaign Types', html: '<div 
					
					
					
					
					
					
					
					style=width:500px;;><h3>直接售出</h3>直接售出的广告活动是固定的，通常优先级较高，收视数量有限.<br>
					<br>
					<h3>推广</h3>推广广告活动相互推广其他应用和产品. 一般优先级较低，在没有合适的直接售出广告或广告网络广告的时候显示.<br>
					<br>
					<h3>广告网络</h3>将请求直接发向特定的广告网络。 如果一个网络无法满足广工请求,
					系统会选择下一个更低优先权的广告网络直到广告被找到. 广告网路广告活动一般针对国家投放以取得按地区获得最好收益. 
			
			</div>
			'});" title="点击获得更多信息">信息</a> <label for="campaign_type">活动类型</label>
		</div>
	</div>
	<!-- .field-group -->

	<div id="network_select" style="display: none;" class="field-group">

		<div class="field">
			<select id="campaign_networkid" name="campaign_networkid">
<?php if (!isset($editdata['campaign_networkid'])){$editdata['campaign_networkid']='';} get_network_dropdown($editdata['campaign_networkid']); ?>							  </select>
			<a class="tooltip" style="font-size: 11px;" href="#"
				onclick="$.modal ({title: 'Network Publisher IDs', html: '<div 
				
				
				
				
				
				
				
				style=width:500px;;><h3>Ad Networks</h3>In order to start sending
				mobile traffic to an ad network of your choice, you will have to
				create an account with the advertising network and then enter the
				Publisher IDs/Site IDs on the <a href=\ 'ad_networks.php\' target=\'_blank\'>Network
					Configuration</a> page in your cmtiads ad server. cmtiads will then
				automatically send all your traffic to the respective ad network.
				Revenue and other Reporting metrics will be reported and visible
				directly in your account with the ad network. 
		
		</div>
		'});">Publisher ID Info</a> <label for="campaign_networkid">广告网络</label>
	</div>
</div>
<!-- .field-group -->

<div class="field-group">

	<div class="field">
		<select id="campaign_priority" name="campaign_priority">
								  <?php if (!isset($editdata['campaign_priority'])){$editdata['campaign_priority']='';}  get_priority_dropdown($editdata['campaign_priority']); ?>
							  </select> <a class="tooltip" style="font-size: 11px;" href="#"
			title="高优先级的活动会在低优先级的活动之前收视. 如果优先级相同，流量会随机分配.">信息</a> <label
			for="campaign_priority">活动优先级</label>
	</div>
</div>
<!-- .field-group -->

<div class="field-group">

	<div class="field">
		<input type="text"
			value="<?php if (isset($editdata['campaign_name'])){ echo $editdata['campaign_name']; } ?>"
			name="campaign_name" id="campaign_name" size="28" class="" /> <label
			for="campaign_name">活动名称</label>
	</div>
</div>
<!-- .field-group -->

<div class="field-group">

	<div class="field">
		<textarea name="campaign_desc" id="campaign_desc" rows="3" cols="29"><?php if (isset($editdata['campaign_desc'])){ echo $editdata['campaign_desc']; } ?></textarea>
		<label for="campaign_desc">活动注释</label>
	</div>
</div>
<!-- .field-group -->

<div class="field-group control-group inline">

	<div class="field">
		<input type="radio"
			onclick="document.getElementById('startdate').style.display='none';"
			name="start_date_type" id="start_date_im" value="1" /> <label
			for="start_date_im">马上开始</label>
	</div>

	<div id="interstitialoptiobutton" class="field">
		<input type="radio"
			onclick="document.getElementById('startdate').style.display='block';"
			name="start_date_type" id="start_date_co" value="2" /> <label
			for="start_date_co">自定义开始日期</label>
	</div>

	<div style="color: #999; font-size: 11px;">Start Date</div>


</div>
<div style="display: none;" id="startdate"
	class="field-group inlineField">

	<div class="field">
		<div id="startdatepicker"></div>
	</div>
	<!-- .field -->
</div>
<!-- .field-group -->

<input type="hidden" name="startdate_value" id="startdate_value" />

<div class="field-group control-group inline">

	<div class="field">
		<input type="radio"
			onclick="document.getElementById('enddate').style.display='none';"
			name="end_date_type" id="end_date_no" value="1" /> <label
			for="end_date_no">无结束日期</label>
	</div>

	<div id="interstitialoptiobutton" class="field">
		<input type="radio"
			onclick="document.getElementById('enddate').style.display='block';"
			name="end_date_type" id="end_date_co" value="2" /> <label
			for="end_date_co">自定义结束日期</label>
	</div>
	<div style="color: #999; font-size: 11px;">结束日期</div>


</div>

<div id="enddate" style="display: none;" class="field-group inlineField">

	<div class="field">
		<div id="enddatepicker"></div>
	</div>
	<!-- .field -->
</div>
<!-- .field-group -->
<input type="hidden" name="enddate_value" id="enddate_value" />
<div class="field-group">
	<div class="field">
		<label for="textfield"></label> <input size="10" type="text"
			value="<?php if (isset($editdata['total_amount'])){ echo $editdata['total_amount']; } ?>"
			name="total_amount" id="total_amount" /> <select id="cap_type	"
			name="cap_type">
			<option
				<?php if (isset($editdata['cap_type']) && $editdata['cap_type']==1){echo 'selected="selected"'; } ?>
				value="1">每日收视数</option>
			<option
				<?php if (isset($editdata['cap_type']) && $editdata['cap_type']==2){echo 'selected="selected"'; } ?>
				value="2">总收视数</option>

		</select> <a class="tooltip" style="font-size: 11px;" href="#"
			title="你可以添加每日收视数上限或总收视数上限。对于广告网络没有意义，只是对直接售出和推广活动有用.">信息</a> <label
			for="total_amount">收视上限 (可选)</label>
	</div>
</div>
<!-- .field-group -->

</div>
<!-- .widget-content -->

</div>
<!-- .widget -->

<div class="widget">

	<div class="widget-header">
		<span class="icon-article"></span>
		<h3>投放</h3>
	</div>
	<!-- .widget-header -->

	<div class="widget-content">
                        
                        <?php if ($user_detail['tooltip_setting']==1){ ?>
                         <div class="notify notify-info">

			<p>Enter targeting details for your campaign below. You can target
				your campaign by country, region, device type, and Android/iOS
				version.</p>
		</div>
		<!-- .notify -->
                        <?php } ?>
                        
                        <div class="field-group control-group inline">

			<div class="field">
				<input type="radio"
					onclick="document.getElementById('country_target').style.display='none';"
					name="geo_targeting" id="geo_targeting_all" value="1" /> <label
					for="geo_targeting_all">所有国家</label>
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('country_target').style.display='block';"
					name="geo_targeting" id="geo_targeting_co" value="2" /> <label
					for="geo_targeting_co">特定国家/地区</label>
			</div>

			<!--                                    <div style="color:#999; font-size:11px;">Geographic Targeting</div>
 -->
			<div
				style="margin-top: 7px; list-style: none; list-style-type: none; z-index: 10000;"
				id="country_target" class="field-group">

				<div class="field">
					<input type="text"
						value="<?php if (isset($editdata['inv_name'])){ echo $editdata['inv_name']; } ?>"
						placeholder="Start typing a country or region name..."
						name="country_targeting" id="country_targeting"
						style="width: 280px; background-color: #EBEBEB; -moz-border-radius: 5px; border-radius: 5px;" />
				</div>
			</div>
			<!-- .field-group -->

			<script language="javascript">
<?php json_regions('', 'data'); ?>

<?php 
if ($current_action=='create' && !empty($editdata['as_values_1'])){
json_prefill_countrylist('create', $editdata['as_values_1']);
}
else if ($current_action=='edit' && isset($editdata['preload_country']) && $editdata['preload_country']==1){
json_prefill_countrylist('edit', $_GET['id']);
}
else if ($current_action=='edit' && !empty($editdata['as_values_1'])){
json_prefill_countrylist('create', $editdata['as_values_1']);
}
else {
?>

var selecteddata = {items: [
]};
<?php } ?>
$("input[id=country_targeting]").autoSuggest(data.items, {selectedItemProp: "name", searchObjProps: "name", asHtmlID: "1", preFill:selecteddata.items, neverSubmit:true});
</script>
		</div>
		<div class="field-group control-group inline">
			<div class="field">
				<input type="radio"
					onclick="document.getElementById('publicationtargetingtable').style.display='none';"
					name="publication_targeting" id="publication_targeting_all"
					value="1" /> <label for="publication_targeting_all">所有出版物</label>
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('publicationtargetingtable').style.display='block';"
					name="publication_targeting" id="publication_targeting_co"
					value="2" /> <label for="publication_targeting_co">特定出版物和广告位</label>
			</div>

			<!--                                    <div style="color:#999; font-size:11px;">Device Targeting</div>
 -->

			<table width="584" border="0" cellpadding="6" cellspacing="0"
				id="publicationtargetingtable"
				style="-moz-border-radius: 5px; border-radius: 5px; margin-top: 5px;">
  <?php if (!isset($editdata['placement_select'])){$editdata['placement_select']='';} list_placements_campaign($editdata['placement_select']); ?>
  
  <!--<tr>
    <td><div align="left"><a class="tooltip" style="font-size:11px;" onclick="" href="#" >Select All</a> | <a class="tooltip" style="font-size:11px;" href="#" >Un-Select All</a></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr> -->
			</table>
		</div>
		<div class="field-group control-group inline">
			<div class="field">
				<input type="radio"
					onclick="document.getElementById('channeltargetingtable').style.display='none';"
					name="channel_targeting" id="channel_targeting_all" value="1" /> <label
					for="channel_targeting_all">所有频道</label>
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('channeltargetingtable').style.display='block';"
					name="channel_targeting" id="channel_targeting_co" value="2" /> <label
					for="channel_targeting_co">特定频道</label>
			</div>

			<!--                                    <div style="color:#999; font-size:11px;">Device Targeting</div>
 -->

			<table width="584" border="0" cellpadding="6" cellspacing="0"
				id="channeltargetingtable"
				style="-moz-border-radius: 5px; border-radius: 5px; margin-top: 5px;">
  <?php if (!isset($editdata['channel_select'])){$editdata['channel_select']='';} list_channels_campaign($editdata['channel_select']); ?>
 
</table>


		</div>


		<div class="field-group control-group inline">


			<div class="field">
				<input type="radio"
					onclick="document.getElementById('devicetargetingtable').style.display='none';"
					name="device_targeting" id="device_targeting_all" value="1" /> <label
					for="device_targeting_all">所有设备</label>
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('devicetargetingtable').style.display='block';"
					name="device_targeting" id="device_targeting_co" value="2" /> <label
					for="device_targeting_co">特定设备/操作系统</label>
			</div>

			<!--      <div style="color:#999; font-size:11px;">Device Targeting</div>
 -->
			<table
				style="-moz-border-radius: 5px; border-radius: 5px; margin-top: 5px;"
				id="devicetargetingtable" width="800" border="0">
				<tr>
					<td width="26%"><div>
							<input
								<?php if (isset($editdata['target_iphone']) && $editdata['target_iphone']==1){echo 'checked="checked"'; }?>
								name="target_iphone" value="1" type="checkbox" />iPhone <input
								<?php if (isset($editdata['target_ipod']) && $editdata['target_ipod']==1){echo 'checked="checked"'; }?>
								name="target_ipod" value="1" type="checkbox" />iPod <input
								<?php if (isset($editdata['target_ipad']) && $editdata['target_ipad']==1){echo 'checked="checked"'; }?>
								name="target_ipad" value="1" type="checkbox" />iPad
						</div>
						<div>
							<input
								<?php if (isset($editdata['target_android']) && $editdata['target_android']==1){echo 'checked="checked"'; }?>
								name="target_android" value="1" type="checkbox" />Android
						</div>
						<div>
							<input
								<?php if (isset($editdata['target_other']) && $editdata['target_other']==1){echo 'checked="checked"'; }?>
								name="target_other" value="1" type="checkbox" />Other
						</div></td>
					<td width="2%">&nbsp;</td>
					<td width="72%"><div>
							Min: <select name="ios_version_min" id="id_ios_version_min">

								<option
									<?php if (empty($editdata['ios_version_min'])){echo 'selected="selected"'; } ?>
									value="">No Min</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="2.0"){echo 'selected="selected"'; } ?>
									value="2.0">2.0</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="2.1"){echo 'selected="selected"'; } ?>
									value="2.1">2.1</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="3.0"){echo 'selected="selected"'; } ?>
									value="3.0">3.0</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="3.1"){echo 'selected="selected"'; } ?>
									value="3.1">3.1</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="3.2"){echo 'selected="selected"'; } ?>
									value="3.2">3.2</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="4.0"){echo 'selected="selected"'; } ?>
									value="4.0">4.0</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="4.1"){echo 'selected="selected"'; } ?>
									value="4.1">4.1</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="4.2"){echo 'selected="selected"'; } ?>
									value="4.2">4.2</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="4.3"){echo 'selected="selected"'; } ?>
									value="4.3">4.3</option>  
								<option
									<?php if (isset ($editdata['ios_version_min']) && $editdata['ios_version_min']=="5.0"){echo 'selected="selected"'; } ?>
									value="5.0">5.0</option>  
							</select> Max:   <select name="ios_version_max"
								id="id_ios_version_max">  
								<option
									<?php if (empty($editdata['ios_version_max'])){echo 'selected="selected"'; } ?>
									value="">No Max</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="2.0"){echo 'selected="selected"'; } ?>
									value="2.0">2.0</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="2.1"){echo 'selected="selected"'; } ?>
									value="2.1">2.1</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="3.0"){echo 'selected="selected"'; } ?>
									value="3.0">3.0</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="3.1"){echo 'selected="selected"'; } ?>
									value="3.1">3.1</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="3.2"){echo 'selected="selected"'; } ?>
									value="3.2">3.2</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="4.0"){echo 'selected="selected"'; } ?>
									value="4.0">4.0</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="4.1"){echo 'selected="selected"'; } ?>
									value="4.1">4.1</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="4.2"){echo 'selected="selected"'; } ?>
									value="4.2">4.2</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="4.3"){echo 'selected="selected"'; } ?>
									value="4.3">4.3</option>  
								<option
									<?php if (isset ($editdata['ios_version_max']) && $editdata['ios_version_max']=="5.0"){echo 'selected="selected"'; } ?>
									value="5.0">5.0</option>  
							</select>
						</div>
						<div>
							Min: <select name="android_version_min" id="android_version_min">

								<option
									<?php if (empty($editdata['android_version_min'])){echo 'selected="selected"'; } ?>
									value="">No Min</option>  
								<option
									<?php if (isset ($editdata['android_version_min']) && $editdata['android_version_min']=="1.5"){echo 'selected="selected"'; } ?>
									value="1.5">1.5</option>  
								<option
									<?php if (isset ($editdata['android_version_min']) && $editdata['android_version_min']=="1.6"){echo 'selected="selected"'; } ?>
									value="1.6">1.6</option>  
								<option
									<?php if (isset ($editdata['android_version_min']) && $editdata['android_version_min']=="2.0"){echo 'selected="selected"'; } ?>
									value="2.0">2.0</option>  
								<option
									<?php if (isset ($editdata['android_version_min']) && $editdata['android_version_min']=="2.1"){echo 'selected="selected"'; } ?>
									value="2.1">2.1</option>  
								<option
									<?php if (isset ($editdata['android_version_min']) && $editdata['android_version_min']=="2.2"){echo 'selected="selected"'; } ?>
									value="2.2">2.2</option>  
								<option
									<?php if (isset ($editdata['android_version_min']) && $editdata['android_version_min']=="2.3"){echo 'selected="selected"'; } ?>
									value="2.3">2.3</option>  
								<option
									<?php if (isset ($editdata['android_version_min']) && $editdata['android_version_min']=="3.0"){echo 'selected="selected"'; } ?>
									value="3.0">3.0</option>

							</select> Max:   <select name="android_version_max"
								id="android_version_max">

								<option
									<?php if (empty($editdata['android_version_max'])){echo 'selected="selected"'; } ?>
									value="">No Max</option>  
								<option
									<?php if (isset ($editdata['android_version_max']) && $editdata['android_version_max']=="1.5"){echo 'selected="selected"'; } ?>
									value="1.5">1.5</option>  
								<option
									<?php if (isset ($editdata['android_version_max']) && $editdata['android_version_max']=="1.6"){echo 'selected="selected"'; } ?>
									value="1.6">1.6</option>  
								<option
									<?php if (isset ($editdata['android_version_max']) && $editdata['android_version_max']=="2.0"){echo 'selected="selected"'; } ?>
									value="2.0">2.0</option>  
								<option
									<?php if (isset ($editdata['android_version_max']) && $editdata['android_version_max']=="2.1"){echo 'selected="selected"'; } ?>
									value="2.1">2.1</option>  
								<option
									<?php if (isset ($editdata['android_version_max']) && $editdata['android_version_max']=="2.2"){echo 'selected="selected"'; } ?>
									value="2.2">2.2</option>  
								<option
									<?php if (isset ($editdata['android_version_max']) && $editdata['android_version_max']=="2.3"){echo 'selected="selected"'; } ?>
									value="2.3">2.3</option>  
								<option
									<?php if (isset ($editdata['android_version_max']) && $editdata['android_version_max']=="3.0"){echo 'selected="selected"'; } ?>
									value="3.0">3.0</option>  
							</select>
						</div>
						<div>-</div></td>
				</tr>
			</table>
		</div>
		<div class="field-group control-group inline">
			<div class="field">
				<input type="radio"
					onclick="document.getElementById('gendertargetingtable').style.display='none';"
					name="gender_targeting" id="gender_targeting_all" value="1" /> <label
					for="gender_targeting_all">所有性别</label>
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('gendertargetingtable').style.display='block';"
					name="gender_targeting" id="gender_targeting_co" value="2" /> <label
					for="gender_targeting_co">特定性别</label>
			</div>

			<table width="584" border="0" cellpadding="6" cellspacing="0"
				id="gendertargetingtable"
				style="-moz-border-radius: 5px; border-radius: 5px; margin-top: 5px;">
 				 <?php if (!isset($editdata['gender_select'])){$editdata['gender_select']='';} list_gender_campaign($editdata['gender_select']); ?>
 
			</table>
		</div>

		<div class="field-group control-group inline">
			<div class="field">
				<input type="radio"
					onclick="document.getElementById('incometargetingtable').style.display='none';"
					name="income_targeting" id="income_targeting_all" value="1" /> <label
					for="income_targeting_all">所有月收入</label>
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('incometargetingtable').style.display='block';"
					name="income_targeting" id="income_targeting_co" value="2" /> <label
					for="income_targeting_co">特定月收入</label>
			</div>

			<table width="584" border="0" cellpadding="6" cellspacing="0"
				id="incometargetingtable"
				style="-moz-border-radius: 5px; border-radius: 5px; margin-top: 5px;">
  			<?php if (!isset($editdata['income_select'])){$editdata['income_select']='';} list_income_campaign($editdata['income_select']); ?>

				</table>
		</div>
		
		<div class="field-group control-group inline">
			<div class="field">
				<input type="radio"
					onclick="document.getElementById('interesttargetingtable').style.display='none';"
					name="interest_targeting" id="interest_targeting_all" value="1" /> <label
					for="interest_targeting_all">所有兴趣</label>
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('interesttargetingtable').style.display='block';"
					name="interest_targeting" id="interest_targeting_co" value="2" /> <label
					for="interest_targeting_co">特定兴趣</label>
			</div>

			<table width="584" border="0" cellpadding="6" cellspacing="0"
				id="interesttargetingtable"
				style="-moz-border-radius: 5px; border-radius: 5px; margin-top: 5px;">
  			<?php if (!isset($editdata['interest_select'])){$editdata['interest_select']='';} list_interest_campaign($editdata['interest_select']); ?>
				</table>
		</div>
		<div class="field-group control-group inline">
			<div class="field">
				<input type="radio"
					onclick="document.getElementById('chronicconditiontargetingtable').style.display='none';"
					name="chroniccondition_targeting"
					id="chroniccondition_targeting_all" value="1" /> <label
					for="chroniccondition_targeting_all"> 所有的慢性病</ label > 
			
			</div>

			<div id="interstitialoptiobutton" class="field">
				<input type="radio"
					onclick="document.getElementById('chronicconditiontargetingtable').style.display='block';"
					name="chroniccondition_targeting"
					id="chroniccondition_targeting_co" value="2" /> <label
					for="chroniccondition_targeting_co"> 特定的慢性病</ label > 
			
			</div>

			<table width="584" border="0" cellpadding="6" cellspacing="0"
				id="chronicconditiontargetingtable"
				style="-moz-border-radius: 5px; border-radius: 5px; margin-top: 5px;">
  <?php if (! isset($editdata[ 'chroniccondition_select' ])){$editdata['chroniccondition_select' ]='' ;} list_chroniccondition_campaign($editdata['chroniccondition_select' ]); ?>
 
</table>
		</div>

	</div>
	<!-- .widget-content -->
</div>
<!-- .widget -->
<script src='assets/javascripts/all.js'></script>
