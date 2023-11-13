<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url('admin/sdgs') ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>

			<button type="button" class="btn btn-label-warning btn-bold btn-sm btn-icon-h" data-toggle="modal" data-target="#frm_target"> Tambah</button>

			<div class="kt-input-icon kt-input-icon--right kt-subheader__search">
				<?php 
					$year = (date("Y") - 10);
					$now = (date("Y") - 4);
			        $arr_thn = array_combine(range(date("Y"), $year),range(date("Y"), $year));
	                echo form_dropdown("dr_thn",$arr_thn,$now,'id="dr_thn" class="form-control"');
	            ?>
				<span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="flaticon-event-calendar-symbol"></i></span>
				</span>
			</div>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<?php $target_id = array(); ?>
	<?php foreach ($target as $row) : ?>
	<?php $target_id[] = array(
		'target_id' => $row['target_id'],
		'kode' => $row['kode']
	); ?>
	<div class="kt-portlet kt-portlet--collapsed" data-ktportlet="true" id="<?php echo $row['target_id'] ?>">
		<div class="kt-portlet__head kt-ribbon kt-ribbon--success">
			<div data-ktportlet-tool="toggle" class="kt-ribbon__target" style="top: -14px; left: 25px;">
				<i class="flaticon2-down"></i>
			</div>

			<a href="#" class="kt-ribbon__target edit"
				data="<?php echo $row['target_id'] ?>" 
				style="top: -14px; left: 60px;"><i class="flaticon-edit"></i>
			</a>

			<a href="#" class="kt-ribbon__target hapus"
				data="<?php echo $row['target_id'] ?>"
				style="top: -14px; left: 95px;"><i class="flaticon-delete-1"></i>
			</a>

			<div class="kt-portlet__head-label py-4 text-justify">
				<?php echo $row['target'] ?>
			</div>
		</div>
		<div class="kt-portlet__body py-1">
			<div class="kt-portlet__content">
				<a 
					href="<?php echo site_url('admin/sdgs?detail='.$row['sdgs_id'].'&target='.$row['target_id'].'&val=baru') ?>" 
					class="btn btn-label-primary btn-bold btn-sm btn-icon-h">Tambah
				</a>
				<div class="table-responsive">
					<table id="target_<?php echo $row['target_id'] ?>" class="table table-striped">
						<thead class="bg-primary text-center">
							<tr>
								<th class="text-white">Kode</th>
								<th class="text-white">Indikator</th>
		                        <th class="text-white">Sumber Data</th>
		                        <th class="text-white">Satuan</th>
								<th class="text-white thn1"></th>
								<th class="text-white thn2"></th>
								<th class="text-white thn3"></th>
								<th class="text-white thn4"></th>
								<th class="text-white thn5"></th>
								<th class="text-white"><i class="flaticon-more"></i></a></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php 
		$target_id = json_encode($target_id, JSON_NUMERIC_CHECK);
	?>
</div>

<!--begin::Modal-->
<div class="modal fade" id="frm_target" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="kt-form" id="kt_form" action="<?php echo site_url("tambah/target"); ?>" method="post" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Tambah Target Sustainable Development Goals
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Kode Target</label>
					<input type="number" class="form-control" id="kode" name="kode">
				</div>
				<div class="form-group">
					<label>Nama Target</label>
					<textarea class="form-control" id="indikator" name="indikator" rows="5"></textarea>
				</div>
				<div class="form-group">
					<?php 
						$id_dinas = isset($id_dinas)?$id_dinas:"";
		                echo form_dropdown("id_dinas",$arr_dinas,$id_dinas,'id="id_dinas" class="form-control"');
		            ?>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="id" name="id">
				<input type="hidden" id="sdgs_id" name="sdgs_id" value="<?php echo isset($sdgs_id)?$sdgs_id:""?>">
				<div class="kt-form__actions">
					<button type="button" class="btn btn-danger btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-dismiss="modal" onclick="window.location.reload()">Batal</button>

					<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">Simpan</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<!--end::Modal-->

<?php echo $datatable ?>
<?php echo $js ?>

<script type="text/javascript">
	var target = '<?php echo $target_id ?>';
	//console.log(target);
</script>