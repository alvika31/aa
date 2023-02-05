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
    												<?php foreach ($i_list as $key) { ?>
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

    			</div>
    			<!-- /content area -->

    		</div>
    		<!-- /main content -->

    	</div>
    	<!-- /page content -->

    </div>
    <!-- /page container -->