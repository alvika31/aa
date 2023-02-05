    <!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Call Sidebar -->
			<?php $this->load->view('core/core_sidebar'); ?>
			<!-- /Call Sidebar -->
			
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Call Head Navi -->
                <?php $this->load->view('core/core_headnavi'); ?>
				<!-- /Call Head Navi -->

				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">
								Report Range Selector
							</h5>

							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							<form class="form-horizontal" action="<?php echo BASE_URL('Sr/report_bg_search/') ?>" method="post" enctype="multipart/form-data">
								<div class="col-lg-12">
									<fieldset class="content-group">
										<div class="form-group">
											<div class="col-lg-2">
												<label class="control-label">Periode Awal</label>
												<input type="date" name="date_1" id="date_1" class="form-control" autocomplete="off" required><br>
											</div>

											<div class="col-lg-2">
												<label class="control-label">Periode Akhir</label>
												<input type="date" name="date_2" id="date_2" class="form-control" autocomplete="off" required><br>
											</div>

											<div class="col-lg-2">
												<label class="control-label">Item / Barang</label>
												<select class="select-search" name="stock_item">
													<option></option>
													<?php foreach($i_list as $key){ ?>													
													<option value="<?php echo $key->primary ?>"><?php echo $key->item ?></option>
													<?php } ?>
												</select>												
											</div>

											<div class="col-lg-2" style="vertical-align: middle; margin-top: 25px;">
												<button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
												<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</fieldset>
								</div>
							</form>
						</div>
					</div>
					<!-- /basic datatable -->

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">
								Stock Barang Masuk Periode : <span style="color: blue"><?php echo $periode ?></span>
							</h5>

							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							<!-- Basic datatable -->
							<table class="table datatable-button-html5-basic" id="stock_table">
								<thead>
									<tr>
										<th>No.</th>
										<th>Tanggal</th>
										<th>Distributor</th>
										<th>Faktur</th>
										<th>Nama Barang</th>
										<th>Unit</th>
										<th>Price</th>
										<th>Received Qty</th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php $count = 1; foreach($bg_list as $key){ ?>
										<?php if($key->stock_id == '1'){ ?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td><?php echo $key->f_date_arv; ?></td>
												<td><?php echo $key->distributor; ?></td>
												<td><?php echo $key->invoice; ?></td>
												<td><?php echo $key->nm_item; ?></td>
												<td>
													<?php  
														if($key->stock_id == '1'){
															echo 'Cs';
														}else if($key->stock_id == '2'){
															echo 'Dz';
														}else if($key->stock_id == '3'){
															echo 'Pc';
														} 
													?>
												</td>
												<td><?php echo number_format($key->stock_price , 0, ",", "."); ?></td>												
												<td><?php echo number_format($key->stock_qty_rcv , 0, ",", "."); ?></td>									
												<td> 
													<?php  
														if($key->stock_id == '1'){
															echo 'Non Promo Disc';
														}else if($key->stock_id == '2'){
															echo 'Promo Disc';
														}else if($key->stock_id == '3'){
															echo 'Net Price';
														} 
													?>
												</td>
												<td> 
													<?php  
														if($key->stock_id == '1'){
															echo number_format($key->ext_non_promo , 0, ",", ".");
														}else if($key->stock_id == '2'){
															echo number_format($key->ext_promo , 0, ",", ".");
														}else if($key->stock_id == '3'){
															echo number_format($key->ext_net , 0, ",", ".");
														} 
													?>
												</td>
												<td> 
													<?php  
														if($key->stock_id == '1'){
															echo number_format($key->ext_non_promo_price , 0, ",", ".");
														}else if($key->stock_id == '2'){
															echo number_format($key->ext_promo_price , 0, ",", ".");
														}else if($key->stock_id == '3'){
															echo number_format($key->ext_net_price , 0, ",", ".");
														} 
													?>
												</td>									
											</tr>
										<?php }else{ ?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>
													<?php  
														if($key->stock_id == '1'){
															echo 'Cs';
														}else if($key->stock_id == '2'){
															echo 'Dz';
														}else if($key->stock_id == '3'){
															echo 'Pc';
														} 
													?>
												</td>
												<td><?php echo number_format($key->stock_price , 0, ",", "."); ?></td>
												<td><?php echo number_format($key->stock_qty_rcv , 0, ",", "."); ?></td>							
												<td> 
													<?php  
														if($key->stock_id == '1'){
															echo 'Non Promo Disc';
														}else if($key->stock_id == '2'){
															echo 'Promo Disc';
														}else if($key->stock_id == '3'){
															echo 'Net Price';
														} 
													?>
												</td>
												<td> 
													<?php  
														if($key->stock_id == '1'){
															echo number_format($key->ext_non_promo , 0, ",", ".");
														}else if($key->stock_id == '2'){
															echo number_format($key->ext_promo , 0, ",", ".");
														}else if($key->stock_id == '3'){
															echo number_format($key->ext_net , 0, ",", ".");
														} 
													?>
												</td>
												<td> 
													<?php  
														if($key->stock_id == '1'){
															echo number_format($key->ext_non_promo_price , 0, ",", ".");
														}else if($key->stock_id == '2'){
															echo number_format($key->ext_promo_price , 0, ",", ".");
														}else if($key->stock_id == '3'){
															echo number_format($key->ext_net_price , 0, ",", ".");
														} 
													?>
												</td>									
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
							<!-- /basic datatable -->
						</div>
					</div>
					<!-- /basic datatable -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->