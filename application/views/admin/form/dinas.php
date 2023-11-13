<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url('admin/dinas') ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
										<i class="flaticon-home"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Data Dinas
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
					<form class="kt-form" id="kt_form" action="<?php echo site_url("tambah/dinas"); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo isset($id)?$id:""?>">
						<!--begin: Form Wizard Step 1-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group">
										<label>Nama Dinas</label>
										<input type="text" class="form-control" placeholder="Nama Panjang Dinas" id="nama_panjang" name="nama_panjang" value="<?php echo isset($nama_panjang)?$nama_panjang:""?>">
									</div>
								
									<div class="form-group">
										<label>Singkatan Dinas</label>
										<input type="text" class="form-control" placeholder="Nama Singkat Dinas" id="nama_pendek" name="nama_pendek" value="<?php echo isset($nama_pendek)?$nama_pendek:""?>">
									</div>
								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 1-->

						<!--begin: Form Wizard Step 2-->
						
						<!--end: Form Wizard Step 2-->
						<div class="kt-form__actions">
							<a href="<?php echo site_url('admin/dinas') ?>" class="btn btn-danger btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"><i class="flaticon2-fast-back"></i> Batal</a>
							<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end:: Content -->

<?php echo $js ?>