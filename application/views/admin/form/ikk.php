<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?= site_url('admin/ikk') ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>
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
										<i class="flaticon-folder-1"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Data Indikator Kinerja Kunci
										</div>
									</div>
								</div>
							</div>


							<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
								<div class="kt-wizard-v2__nav-body">
									<div class="kt-wizard-v2__nav-icon">
										<i class="flaticon-list"></i>
									</div>
									<div class="kt-wizard-v2__nav-label">
										<div class="kt-wizard-v2__nav-label-title">
											Data IKK
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
					<form class="kt-form" id="kt_form" action="<?= site_url("tambah/ikk"); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?= isset($id)?$id:""?>">
						<!--begin: Form Wizard Step 1-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<div class="form-group">
										<?php 
											$id_urusan = isset($id_urusan)?$id_urusan:"";
							                echo form_dropdown("id_urusan",$arr_urusan,$id_urusan,'id="id_urusan" class="form-control"');
							            ?>
									</div>
									<div class="form-group">
										<?php 
											$id_dinas = isset($id_dinas)?$id_dinas:"";
							                echo form_dropdown("id_dinas",$arr_dinas,$id_dinas,'id="id_dinas" class="form-control"');
							            ?>
									</div>
									<div class="form-group">
										<label>Nama Indikator Kinerja Kunci</label>
										<input type="text" class="form-control" placeholder="Nama Indikator Kinerja Kunci" id="nama_ikk" name="nama_ikk" value="<?= isset($nama_ikk)?$nama_ikk:""?>">
									</div>

									
								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 1-->

						<!--begin: Form Wizard Step 2-->

						<!--end: Form Wizard Step 2-->
	
						<!--begin: Form Wizard Step 2-->
						<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v2__form">
									<label class="h5">Data 1 / Pembilang</label>
									<button id="tambah_el_1" class="btn btn-label-primary btn-bold btn-sm btn-icon-h float-right"><i class="flaticon-add"></i> Tambah Data (Elemen)</button>

									<div class="form-group mt-3">
										<?php 
											$d1_urusan = isset($d1_urusan)?$d1_urusan:"";
							                echo form_dropdown("d1_urusan",$arr_urusan,$d1_urusan,'id="d1_urusan" class="form-control"');
							            ?>
									</div>

				                    <table class="border-0" id="tbl_data1" width="100%">
										<?php $n=0; foreach ($data_1 as $row) : $n++; ?>
										<tr>
											<td><div class="form-group">
												<div class="input-group">
													<input type="hidden" name="data_1[]" value="<?= isset($row['id_el'])?$row['id_el']:""?>">

													<input type="text" class="form-control" placeholder="Nama Elemen" name="nama_elemen[]" value="<?= isset($row['nama_elemen'])?$row['nama_elemen']:""?>">
													
													<div class="input-group-append">
														<button class="btn btn-secondary" type="button" id="remove">
															<i class="flaticon-delete-1"></i></button>
													</div>
												</div>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</table>

									<hr>

									<label class="h5">Data 2 / Penyebut</label>
									<button id="tambah_el" class="btn btn-label-primary btn-bold btn-sm btn-icon-h float-right"><i class="flaticon-add"></i> Tambah Data (Elemen)</button>

									<div class="form-group mt-3">
										<?php 
											$d2_urusan = isset($d2_urusan)?$d2_urusan:"";
							                echo form_dropdown("d2_urusan",$arr_urusan,$d2_urusan,'id="d2_urusan" class="form-control"');
							            ?>
									</div>

									<table class="border-0" id="tbl_data2" width="100%">
										<?php $n=0; foreach ($data_2 as $row) : $n++; ?>
										<tr>
											<td><div class="form-group">
												<div class="input-group">
													<input type="hidden" name="data_2[]" value="<?= isset($row['id_el'])?$row['id_el']:""?>">

													<input type="text" class="form-control" placeholder="Nama Elemen" name="nama_elemen[]" value="<?= isset($row['nama_elemen'])?$row['nama_elemen']:""?>">
													
													<div class="input-group-append">
														<button class="btn btn-secondary" type="button" id="remove">
															<i class="flaticon-delete-1"></i></button>
													</div>
												</div>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</table>
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
<!-- end:: Content -->
<script type="text/javascript">

	var data_1 = `<div class="input-group">
        <?php echo form_dropdown('data_1[]',array(),'','class="form-control data_1"'); ?>
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button" id="remove">
                <i class="flaticon-delete-1"></i></button>
        </div>
    </div>`; 

	var data_2 = `<div class="input-group">
        <?php echo form_dropdown('data_2[]',array(),'','class="form-control data_2"'); ?>
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button" id="remove">
                <i class="flaticon-delete-1"></i></button>
        </div>
    </div>`; 

</script>

<?= $js ?>