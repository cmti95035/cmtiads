<?php
if (!isset($_GET['zone'])){$_GET['zone']='';}
if (!isset($_GET['publication'])){$_GET['publication']='';}
if (!isset($integration_active)){$integration_active='';}
?><div class="widget">
						
						<div class="widget-header">
							<span class="icon-article"></span>
							<h3>出版物和位置选择</h3>
						</div> <!-- .widget-header -->
						<div class="widget-content">
                                    <div class="field-group">
			
								<div class="field">
								<select onchange="this.form.submit();" id="publication_id" name="publication">
								  <?php get_publication_dropdown($_GET['publication']); ?>
								</select>		
									<label for="inv_type">选择出版物</label>
								</div>
							</div> <!-- .field-group -->
                            
                               <div class="field-group">
			
								<div class="field">
								<select onchange="this.form.submit();"  id="publication_id" name="zone">
								  <?php get_placement_integration_dropdown($_GET['zone'], $_GET['publication']); ?>
								</select>		
									<label for="inv_type">选择位置</label>
								</div>
							</div> <!-- .field-group -->
                            
                            <?php if ($integration_active==1){?>
                              <div class="field-group">
			
								<div class="field">
									<span style="margin-left:4px;"><?php echo $zone_detail['zone_hash']; ?></span>
									<label for="allow_statistical_info">位置集成ID</label>
								</div>
							</div> <!-- .field-group -->
                            
                            <div class="field-group">
			
								<div class="field">
									<span style="margin-left:4px;"><?php echo MAD_ADSERVING_PROTOCOL . $_SERVER['HTTP_HOST']. str_replace('/www/cp', '', dirname($_SERVER['PHP_SELF'])) . "/md.request.php"; ?></span>
									<label for="allow_statistical_info">广告请求 URL (SDK集成必须)</label>
								</div>
							</div> <!-- .field-group -->
                            <?php } ?>
     				</div> <!-- .widget-content -->
						
					</div> <!-- .widget -->
                    
                    <?php if (!is_numeric($_GET['zone']) or !is_numeric($_GET['publication'])){ ?>
                                         <div class="box plain"><div class="notify notify-warning">
                                         <p>请在上方选择你想集成的出版物和位置.</p></div> <!-- .notify --></div>
                                         <?php } ?>