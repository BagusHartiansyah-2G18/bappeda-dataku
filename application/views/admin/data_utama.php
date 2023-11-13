<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url() ?>admin/data_utama?du=baru" class="btn btn-label-primary btn-bold btn-sm btn-icon-h" id="tambah">Tambah</a>
			<button class="btn btn-label-warning btn-bold btn-sm btn-icon-h" id="edit">Edit</button>
			<button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="hapus">Hapus</button>

			<div class="kt-input-icon kt-input-icon--right kt-subheader__search mr-2">
				<?php 
	                echo form_dropdown("id_urusan",$arr_urusan,'','id="id_urusan" class="form-control"');
	            ?>
			</div>

			<div class="kt-subheader__search" style="width: 100px">
				<?php 
					$year = (date("Y") - 10);
					$now = (date("Y") - 4);
			        $arr_thn = array_combine(range(date("Y"), $year),range(date("Y"), $year));
	                echo form_dropdown("dr_thn",$arr_thn,$now,'id="dr_thn" class="form-control"');
	            ?>
			</div>


		</div>

	</div>
</div>
<!-- end:: Content Head -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<!--begin: Datatable -->
			<div class="table-responsive">
				<table id="tbl_data_utama" class="table table-striped table-bordered" style="margin-top: 0 !important">
					<thead class="bg-dark text-center">
						<tr>
							<th>
								<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
			                        <input type="checkbox" class="kt-group-checkable">
			                        <span></span>
			                    </label>
							</th>
							<th class="text-white font-weight-bold">Elemen</th>	                        
							<th class="text-white font-weight-bold thn1"></th>
							<th class="text-white font-weight-bold thn2"></th>
							<th class="text-white font-weight-bold thn3"></th>
							<th class="text-white font-weight-bold thn4"></th>
							<th class="text-white font-weight-bold thn5"></th>
							<th class="text-white font-weight-bold">Satuan</th>
						</tr>
					</thead>
				</table>
			</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>


<?php echo $datatable ?>
<?php echo $js ?>