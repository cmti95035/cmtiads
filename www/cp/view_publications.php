<?php
global $current_section;
$current_section = 'inventory';

require_once '../../init.php';

// Required files
require_once MAD_PATH . '/www/cp/auth.php';

require_once MAD_PATH . '/functions/adminredirect.php';

require_once MAD_PATH . '/www/cp/restricted.php';

require_once MAD_PATH . '/www/cp/admin_functions.php';

require_once MAD_PATH . '/www/cp/templates/header.tpl.php';

if (! check_permission ( 'inventory', $user_detail ['user_id'] )) {
	exit ();
}

if (check_permission_simple ( 'modify_publications', $user_detail ['user_id'] )) {
	if (isset ( $_GET ['delete'] ) && $_GET ['delete'] == 1 && is_numeric ( $_GET ['id'] )) {
		delete_publication ( $_GET ['id'] );
	}
}

?>
<div id="content">

	<div id="contentHeader">
		<h1>广告位库存</h1>
	</div>
	<!-- #contentHeader -->

	<div class="container">

		<div class="grid-24">

			<div class="widget widget-table">

				<div class="widget-header">
					<span class="icon-list"></span>
					<h3 class="icon chart">出版物列表</h3>
				</div>

				<div class="widget-content">

					<table id="syslog"
						class="table table-bordered table-striped data-table">
						<thead>
							<tr>
								<th>出版物名称</th>
								<th>类型</th>
								<th>默认频道</th>
								<th>状态</th>
								<th>广告位</th>
								<th>动作</th>
							</tr>
						</thead>
						<tbody>
<?php get_publications(); ?>					
</tbody>
					</table>
				</div>
				<!-- .widget-content -->

			</div>
			<!-- .widget -->

			<div class="actions">
				<button onclick="window.location='add_publication.php';"
					class="btn btn-quaternary">
					<span class="icon-plus"></span>创建新的出版物
				</button>
			</div>
			<!-- .actions -->
		</div>
		<!-- .grid -->
	</div>
	<!-- .container -->

</div>
<!-- #content -->
<?php global $jsload; $jsload=1; print_deletionjs('publications'); ?>
<?php

require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>