<?php
global $current_section;
$current_section='campaigns';

require_once '../../init.php';

// Required files
require_once MAD_PATH . '/www/cp/auth.php';

require_once MAD_PATH . '/functions/adminredirect.php';

require_once MAD_PATH . '/www/cp/restricted.php';

require_once MAD_PATH . '/www/cp/admin_functions.php';

require_once MAD_PATH . '/www/cp/templates/header.tpl.php';

if (!check_permission('campaigns', $user_detail['user_id'])){
exit;
}

if (isset ($_GET['action']) && $_GET['action']==1 && isset($_POST['select_campaign']) && is_array($_POST['select_campaign'])){
$selected_items = $_POST['select_campaign'];
	
foreach ($selected_items as $item_id) {
	
switch ($_POST['form_action']){

case '暂停':
pause_campaign($item_id);
break;	

case '运行':
run_campaign($item_id);
break;	

case '删除':
delete_campaign($item_id);
break;	

}
}

global $successmessage;
$successmessage='你的广告活动已被成功更新.';
	
}

?>
<script type="text/javascript" language="javascript">
function SetAction(x) {
var answer = confirm("你确定要 "+x+"选定的广告活动吗?")
	if (answer){
document.listform.form_action.value = x;
document.listform.submit();	}
	else{
		return false;
	}

}
</script>
<div id="content">		
		
		<div id="contentHeader">
			<h1>广告活动</h1>
		</div> <!-- #contentHeader -->	
		
		<div class="container">
        
        <FORM method="POST" name="listform" action="view_campaigns.php?action=1" id="listform">
        <INPUT value="action_set" type="hidden" name="form_action">
				
				<div class="grid-24">	
	                  <div style="margin-bottom:10px;">
  				<button onClick="return SetAction('暂停')" class="btn btn-small btn-quaternary">暂停</button>&nbsp;&nbsp;
					<button onClick="return SetAction('运行')" class="btn btn-small btn-quaternary">运行</button>&nbsp;&nbsp;
					<button onClick="return SetAction('删除')" class="btn btn-small btn-quaternary">删除</button></div>
					<div class="widget widget-table">
						<div class="widget-header">
							<span class="icon-list"></span>
							<h3 class="icon chart">广告活动列表</h3>		
						</div>
						<div class="widget-content">							
							<table id="campaignlistt" class="table table-bordered table-striped data-table">
						<thead>
							<tr>
								<th>名称</th>
								<th>类型</th>
								<th>优先级</th>
								<th>状态</th>
								<th>广告单元</th>
								<th>请求数</th>
								<th>收视数</th>
								<th>点击数</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
<?php get_campaigns(); ?>					
</tbody>
					</table>
                    </FORM>
        </div> 
						<!-- .widget-content -->
					
				</div> <!-- .widget -->
					
					<div class="actions">						
								<button type="button" onclick="window.location='create_campaign.php';" class="btn btn-quaternary">
								<span class="icon-plus"></span>创建新的广告活动</button>
								</div> <!-- .actions -->                      
			</div> <!-- .grid -->
		</div> <!-- .container -->
</div> <!-- #content -->	
    
<?php
require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>