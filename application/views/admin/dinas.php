<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<?php if ($sesi['level'] > 0) : ?>
			<a href="<?php echo site_url() ?>admin/dinas?d=baru" class="btn btn-label-warning btn-bold btn-sm btn-icon-h" id="tambah">Tambah</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<div class="kt-container kt-container--fluid ">
	<!--
	<div class="row">
		<div class="col-md-6">
	-->
			<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Data Dinas 
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="tab-content">
						<div class="tab-pane active" id="kt_widget2_tab1_content">
							<div class="kt-widget2">

								<?php foreach ($data as $row => $value) : ?>
								<div id="din_<?php echo $value->id ?>">
								<div id="<?php echo str_replace(' ', '', $value->nama_pendek) ?>" class="kt-widget2__item <?php echo ($row == 0) ? 'kt-widget2__item--primary' : '' ?>">
									<div class="kt-widget2__checkbox"><span></span></div>

									<a class="<?php echo $value->nama_pendek ?>" href="#<?php echo strtolower($value->nama_pendek) ?>">
										<div class="kt-widget2__info">
											<span class="kt-widget2__title"><?php echo $value->nama_pendek ?></span>
											<span class="kt-widget2__username"><?php echo $value->nama_panjang ?></span>
										</div>
									</a>

									<div class="kt-widget2__actions">
										<a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
											<i class="flaticon-more-1"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
											<ul class="kt-nav">
												<li class="kt-nav__item">
													<a href="<?php echo site_url('admin/dinas?d='.$value->id) ?>" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-contract"></i>
														<span class="kt-nav__link-text">Edit</span>
													</a>
												</li>
												<?php if ($sesi['level'] > 0) : ?>
												<li class="kt-nav__item">
													<a href="#!" onclick="hapus(<?php echo $value->id ?>)" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-trash"></i>
														<span class="kt-nav__link-text">Hapus</span>
													</a>
												</li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--
		<div class="col-md-6">
			<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Data Bidang
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="tab-content">
						<div class="tab-pane active" id="kt_widget2_tab1_content">
							<div class="kt-widget2" id="bidang">

								

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->

<script type="text/javascript">
	var dinas_id = '<?php echo strtolower($data[0]->nama_pendek) ?>';

	function hapus(id){
		swal.fire({
			title: 'Hapus Data!',
            text: "Apakah anda yakin mau menghapus data ini?",
            type:'warning',
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
		}).then((result) => {
			if (result.value){
			    $.ajax({
			    	url : '<?php echo site_url('hapus/dinas/'); ?>'+id,
			    	type : 'post',
			    	dataType : 'json',
			    	success : function(){
		            	$('#din_'+id).fadeOut(500);
		            }
			    });
			    return true;
			}
		})
	}
</script>

<?php echo $js ?>