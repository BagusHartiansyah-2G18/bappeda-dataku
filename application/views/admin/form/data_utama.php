<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<a href="<?php echo site_url('admin/data_utama') ?>" class="btn btn-label-danger btn-bold btn-sm btn-icon-h"><i class="flaticon-reply"></i> Kembali</a>
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
											Data Elemen
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
											Nilai Elemen
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
					<form class="kt-form" id="kt_form" action="<?php echo site_url("tambah/data_utama"); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo isset($id)?$id:""?>">
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
										<?php 
				                            echo form_dropdown("id_parent",array(),'','id="id_parent" class="form-control"');
				                        ?>
				                    </div>

									<div class="form-group">
										<label>Nama Elemen</label>
										<input type="text" class="form-control" placeholder="Nama Elemen" id="nama_elemen" name="nama_elemen" value="<?php echo isset($nama_elemen)?$nama_elemen:""?>">
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
										<button id="tambah_nilai" class="btn btn-label-primary btn-bold btn-sm btn-icon-h">
											<i class="flaticon-add"></i> Tambah Nilai
										</button>
									</div>
									<div class="form-group">
										<label>Satuan</label>
										<input type="text" class="form-control" placeholder="Satuan" id="satuan" name="satuan" value="<?php echo isset($satuan)?$satuan:""?>">
									</div>

									<table class="border-0" id="tbl_nilai" width="100%">
										<?php foreach ($nilai as $n) : ?>
										<tr>
											<td><div class="form-group">
												<?php 
													$year = (date("Y") - 10);
													$tahun = isset($n->tahun) ? $n->tahun:"";
											        $arr_thn = array('Pilih Tahun') + array_combine(range(date("Y"), $year),range(date("Y"), $year));
									                echo form_dropdown("tahun[]",$arr_thn,$tahun,'id="tahun" class="form-control"');
									            ?>
									            </div>
								            </td>
											<td><div class="form-group">
												<div class="input-group">
													<input type="text" class="form-control" placeholder="Nilai" id="nilai" name="nilai[]" value="<?php echo isset($n->nilai)?$n->nilai:""?>">
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
 
	var thn = `<?php 
                $year = (date("Y") - 10);
                $arr_thn = array('Pilih Tahun') + array_combine(range(date("Y"), $year),range(date("Y"), $year));
                echo form_dropdown("tahun[]",$arr_thn,"",'id="tahun" class="form-control"');
            ?>`;

    var thn_n = `<div class="input-group">
                    <input type="text" class="form-control" placeholder="Nilai" id="nilai" name="nilai[]">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button" id="remove">
                            <i class="flaticon-delete-1"></i></button>
                    </div>
                </div>`;

    var id_parent = `<?php echo isset($id_parent) ? $id_parent : "" ?>`;

</script>

<?php echo $js ?>