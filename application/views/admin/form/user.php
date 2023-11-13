<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url('admin/user') ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>
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
										<i class="flaticon-user-settings"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Data Pengguna
										</div>
									</div>
								</div>
							</div>

							<?php if ($level <> 1) : ?>
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-buildings"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Instansi
										</div>
									</div>
								</div>
							</div>
							<?php endif; ?>
							
							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-lock"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Password
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
					<form class="kt-form" id="kt_form" action="<?php echo site_url("tambah/user"); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo isset($id_user)?$id_user:""?>">
						<!--begin: Form Wizard Step 1-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group text-center">
										<?php 
											if (isset($gambar)){
												$gbr = base_url('uploads/user/'.$gambar.'');
											}
											else{
												$gbr = '';
											}
										?>
										<div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
											<div class="kt-avatar__holder" style="background-image: url(<?php echo $gbr ?>)"></div>
											<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ganti Photo">
												<i class="fa fa-pen"></i>
												<input type="file" name="gambar" id="gambar">
											</label>
											<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Hapus Photo">
												<i class="fa fa-times"></i>
											</span>
										</div>
										<span class="form-text text-muted">Allowed file types: png, jpg</span>
									</div>

									<div class="form-group">
										<label>Nama Pengguna</label>
										<input type="text" class="form-control" placeholder="Nama Lengkap" id="nama" name="nama" value="<?php echo isset($nama)?$nama:""?>">
									</div>

									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control" placeholder="Username" id="username" name="username" value="<?php echo isset($username)?$username:""?>">
									</div>

									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" id="email" name="email" value="<?php echo isset($email)?$email:""?>">
									</div>

								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 1-->
						<?php if ($level <> 1) : ?>
						<!--begin: Form Wizard Step 2-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group">
										<?php 
											$id_dinas = isset($id_dinas)?$id_dinas:"";
							                echo form_dropdown("id_dinas",$arr_dinas,$id_dinas,'id="id_dinas" class="form-control"');
							            ?>
									</div>

									<div class="form-group">
										<label>Pilih Urusan</label>
										<div class="kt-checkbox-list">
											<?php foreach ($urusan as $u) : ?>
											<label class="kt-checkbox">
												<input 
													name="akses[]" 
													type="checkbox" 
													value="<?php echo $u->id ?>"
													<?php echo in_array($u->id, $akses)  ? 'checked="checked"' : ''?>>
													<?php echo $u->urusan ?>
												<span></span>
											</label>

											
											<?php endforeach; ?>
										</div>

									</div>

								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 2-->
						<?php endif; ?>
						<!--begin: Form Wizard Step 3-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" placeholder="Password" id="password" name="password">
									</div>

									<div class="form-group">
										<label>Konfirmasi Password</label>
										<input type="password" class="form-control" placeholder="Konfirmasi Password" id="password2" name="password2">
									</div>

								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 3-->

						<div class="kt-form__actions">
							<button class="btn btn-warning btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev"><i class="flaticon2-fast-back"></i>
								Sebelumnya
							</button>
							<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
								Simpan <i class="fa fa-save"></i> 
							</button>
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
<!-- end:: Content -->
<?php echo $js ?>

<script type="text/javascript">
	var gambar = '<?php echo isset($gambar)?$gambar:""?>';
</script>