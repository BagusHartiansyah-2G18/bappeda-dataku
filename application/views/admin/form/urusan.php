<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url('admin/urusan') ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<div class="kt-container kt-container--fluid ">
	<div class="kt-portlet">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
				<div class="kt-grid__item kt-wizard-v2__aside">

					<!--begin: Form Wizard Nav -->
					<div class="kt-wizard-v2__nav">
						<div class="kt-wizard-v2__nav-items">

							<!--doc: Replace A tag with SPAN tag to disable the step link click -->
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-squares"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Data Urusan
										</div>
									</div>
								</div>
							</div>

							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-file-2"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Deskripsi Indikator Kinerja Kunci (IKK)
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>

					<!--end: Form Wizard Nav -->
				</div>

				<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">
					<!--begin: Form Wizard Form-->
					<form class="kt-form" id="kt_form" action="<?php echo site_url("tambah/urusan"); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo isset($id)?$id:""?>">
						<!--begin: Form Wizard Step 1-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group text-center">
										<?php 
											if (isset($gambar)){
												$gbr = base_url('uploads/urusan/'.$gambar.'');
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
										<span class="form-text text-muted">Allowed file types: png, jpg</span>
									</div>
									<div class="row">
										<div class="col-md-10">
											<div class="form-group">
												<label>Nama Urusan</label>
												<input type="text" class="form-control" placeholder="Nama Urusan" id="urusan" name="urusan" value="<?php echo isset($urusan)?$urusan:""?>">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Aktif</label>
												<span class="kt-switch kt-switch--icon">
													<label>
														<input type="checkbox" <?php echo isset($aktif)?$aktif:""?> name="aktif">
														<span></span>
													</label>
												</span>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 1-->

						<!--begin: Form Wizard Step 2-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group">
										<textarea class="form-control" id="desk_ikk" name="desk_ikk" rows="5"><?php echo isset($desk_ikk)?$desk_ikk:""?></textarea>
									</div>
								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 2-->

						<div class="kt-form__actions">
							<button class="btn btn-warning btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev"><i class="flaticon2-fast-back"></i>
								Sebelumnya
							</button>
							<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit"><i class="fa fa-save"></i> Simpan</button>
							<button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
								Selanjutnya <i class="flaticon2-fast-next"></i> 
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var gambar = '<?php echo isset($gambar)?$gambar:""?>';
</script>

<?php echo $plugin ?>
<?php echo $js ?>