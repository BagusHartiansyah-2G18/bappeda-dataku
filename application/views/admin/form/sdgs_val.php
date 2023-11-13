<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url('admin/sdgs?detail='.$sdgs_id) ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<div class="kt-container kt-container--fluid ">
	<div class="kt-portlet">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon"><i class="flaticon-open-box"></i></span>
				<h3 class="kt-portlet__head-title">Form Indikator Sustainable Development Goals (SDGS)</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="kt_form" action="<?php echo site_url("tambah/target"); ?>" method="post" enctype="multipart/form-data">
			<div class="kt-portlet__content">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama Indikator</label>
							<input class="form-control" type="text" name="indikator" value="<?php echo isset($indikator)?$indikator:""?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Dinas</label>
							<?php 
								$id_dinas = isset($id_dinas)?$id_dinas:"";
				                echo form_dropdown("id_dinas",$arr_dinas,$id_dinas,'id="id_dinas" class="form-control"');
				            ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group ">
							<label>Sumber Data</label>
							<div class="input-group">
								<input class="form-control" type="text" name="nama_elemen" value="<?php echo isset($nama_elemen)?$nama_elemen:""?>" autocomplete="off">
								<div class="input-group-append">
									<a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#frm_elemen">Pilih</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
				<!-- === HIIDDEN === -->
				<input type="hidden" name="id" value="<?php echo isset($id)?$id:""?>">
				<input type="hidden" name="elemen_id" value="<?php echo isset($elemen_id)?$elemen_id:""?>">
				<input type="hidden" name="sdgs_id" value="<?php echo isset($sdgs_id)?$sdgs_id:""?>">
				<input type="hidden" name="parent_id" value="<?php echo isset($parent_id)?$parent_id:""?>">

				<div class="kt-form__actions">
					<a href="<?php echo site_url('admin/sdgs?detail='.$sdgs_id) ?>" class="btn btn-danger btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"><i class="flaticon-reply"></i> Batal</a>
					
					<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit"><i class="flaticon-like"></i> Simpan</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="frm_elemen" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pilih Sumber Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive" style="overflow: hidden;">
					<div class="row">
						<div class="col-md-6">
							<?php echo form_dropdown("id_urusan",$arr_urusan,'','id="id_urusan" class="form-control"');?>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<input class="form-control" type="text" id="cari" placeholder="Cari Sumber Data ....">
								<div class="input-group-append">
									<a href="#" class="btn btn-secondary">Cari</a>
								</div>
							</div>
						</div>
					</div>
					
					<table id="elemen" class="table table-striped table-sm">
						<thead class="bg-primary text-center">
							<tr>
								<th class="text-white">No</th>
								<th class="text-white">Nama Sumber Data</th>
								<th class="text-white">Status</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!--end::Modal-->
<?php echo $datatable ?>
<?php echo $js ?>