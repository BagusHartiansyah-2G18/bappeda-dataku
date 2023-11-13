<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url() ?>admin/ikk/tambah" class="btn btn-label-primary btn-bold btn-sm btn-icon-h" id="tambah">Tambah</a>
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

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<!--begin: Datatable -->
			<div class="table-responsive">
				<table id="ikk_tbl" class="table table-striped table-bordered" style="margin-top: 0 !important">
					<thead class="text-center bg-dark text-white">
						<tr>
							<th rowspan="2">
								<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
			                        <input type="checkbox" name="checkAll" class="kt-group-checkable">
			                        <span></span>
			                    </label>
							</th>
							<th rowspan="2" class="text-white">Indikator Kinerja Kunci</th>
							<th colspan="5" class="text-white">Capaian Kinerja</th>
							<th rowspan="2" class="text-white">Status</th>
						</tr>
						<tr>
							<th class="thn1 text-white"></th>
							<th class="thn2 text-white"></th>
							<th class="thn3 text-white"></th>
							<th class="thn4 text-white"></th>
							<th class="thn5 border-right text-white"></th>
						</tr>
					</thead>
				</table>
			</div>
			<!--end: Datatable -->
		</div>
	</div>
</div>


<!-- end:: Content -->


<?php echo $datatable ?>
<?php echo $js ?>