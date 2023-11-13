<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url('admin/sdgs') ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<div class="kt-container kt-container--fluid ">
	<div class="kt-portlet">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon"><i class="flaticon-open-box"></i></span>
				<h3 class="kt-portlet__head-title">Form Sustainable Development Goals (SDGS)</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="kt_form" action="<?php echo site_url("tambah/sdgs"); ?>" method="post" enctype="multipart/form-data">
			<div class="kt-portlet__content">
				<div class="row">
					<div class="col-md-2">
						<div class="form-group text-center">
							<?php 
								if (isset($gambar)){
									$gbr = base_url('uploads/sdgs/'.$gambar.'');
								}
								else{
									$gbr = '';
								}
							?>
							<div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
								<div class="kt-avatar__holder" style="background-image: url(<?php echo $gbr ?>)"></div>
								<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ganti Gambar">
									<i class="fa fa-pen"></i>
									<input type="file" name="gambar" id="gambar">
								</label>
								<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Hapus Gambar">
									<i class="fa fa-times"></i>
								</span>
							</div>
							<span class="form-text text-muted">* png, jpg</span>
						</div>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<label>Nama Sustainable Development Goals (SDGS)</label>
							<input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" value="<?php echo isset($nama)?$nama:""?>">
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<input type="text" class="form-control" placeholder="Deskripsi" id="desc" name="desc" value="<?php echo isset($desc)?$desc:""?>">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Detail</label>
							<textarea class="form-control" id="info" name="info" rows="15"><?php echo isset($info)?$info:""?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
				<input type="hidden" id="id" name="id" value="<?php echo isset($id)?$id:""?>">
				<div class="kt-form__actions">
					<a href="<?php echo site_url('admin/sdgs') ?>" class="btn btn-danger btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"><i class="flaticon2-fast-back"></i> Batal</a>
					<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var gambar = '<?php echo isset($gambar)?$gambar:""?>';
</script>

<?php echo $js ?>