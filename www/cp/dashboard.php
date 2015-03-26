<?php
global $current_section;
$current_section='dashboard';
require_once '../../init.php';

// Required files
require_once MAD_PATH . '/www/cp/auth.php';

require_once MAD_PATH . '/functions/adminredirect.php';

require_once MAD_PATH . '/www/cp/restricted.php';

require_once MAD_PATH . '/www/cp/admin_functions.php';

require_once MAD_PATH . '/www/cp/templates/header.tpl.php';

?>
<div id="content">		
		
		<div id="contentHeader">
			<h1>控制面板</h1>
		</div> <!-- #contentHeader -->	
		
		<div class="container">
			
			
			<div class="grid-17">
            
            <?php show_notifications(); ?>
				
				<div class="widget widget-plain">
					
					<div class="widget-content">
				
					  <h2 class="dashboard_title">
							今天 - 服务器统计数据
							<span>所有的数据都是实时显示的</span></h2>				
						<?php
						$reportingdata_main=get_reporting_data("publisher", $today_day, $today_month, $today_year, '');
						?>
						<div class="dashboard_report first activeState">
							<div class="pad">
								<span class="value"><?php echo number_format($reportingdata_main['total_requests']); ?></span> 广告请求
							</div> <!-- .pad -->
						</div>
						
						<div class="dashboard_report defaultState">
							<div class="pad">
								<span class="value"><?php echo number_format($reportingdata_main['total_impressions']); ?></span> 收视数
							</div> <!-- .pad -->
						</div>
						
						<div class="dashboard_report defaultState">
							<div class="pad">
								<span class="value"><?php echo number_format($reportingdata_main['total_clicks']); ?></span> 点击数
							</div> <!-- .pad -->
						</div>
						
						<div class="dashboard_report defaultState last">
							<div class="pad">
								<span class="value"><?php echo $reportingdata_main['ctr']; ?>%</span> 点击率
							</div> <!-- .pad -->
						</div>
						
					</div> <!-- .widget-content -->
					
				</div> <!-- .widget -->
				<?php graph_report_widget("dashboard", "publisher-all", "lastsevendays"); ?>
				<?php quick_publication_report(); ?>
			</div> <!-- .grid -->			
			<div class="grid-7">
		<!-- Q: grid 7 code moved to dashboard_grid7.php -->
			</div> <!-- .grid -->
		</div> <!-- .container -->
	</div> <!-- #content -->
	<?php
require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>