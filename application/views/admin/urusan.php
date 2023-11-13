<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<?php if ($sesi['level'] > 0) : ?>
			<a href="<?php echo site_url() ?>/admin/urusan?u=baru" class="btn btn-label-warning btn-bold btn-sm btn-icon-h" id="tambah">Tambah</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<div class="kt-container kt-container--fluid ">
	<div class="row">
		<?php foreach ($data as $row) : ?>
		<div class="col-md-4" id="ur_<?php echo $row->id ?>">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head kt-portlet__head--noborder">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
						</h3>
					</div>
					<?php if ($sesi['level'] > 0) : ?>
					<div class="kt-portlet__head-toolbar">
						<a href="#" class="btn btn-clean btn-icon" data-toggle="dropdown">
							<i class="flaticon-more-1"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<ul class="kt-nav">
								<li class="kt-nav__item ">
									<a href="<?php echo site_url('admin/urusan?u='.$row->id) ?>" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon-edit-1"></i>
										<span class="kt-nav__link-text">Edit</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#!" onclick="hapus(<?php echo $row->id ?>)" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon-delete"></i>
										<span class="kt-nav__link-text">Hapus</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fit-y kt-margin-b-40">
					<div class="kt-widget kt-widget--user-profile-4">
						<div class="kt-widget__head">
							<div class="kt-widget__media">
							<?php if ($row->gambar) : ?>
								<img class="kt-widget__img" src="<?php echo base_url('uploads/urusan/'.$row->gambar) ?>" alt="image">
							<?php else : ?>
								<div class="kt-widget__pic kt-widget__pic--<?php echo $row->color ?> kt-font-<?php echo $row->color ?> kt-font-boldest">
									<?php echo $row->ini ?>
								</div>
							<?php endif; ?>
							</div>
							<div class="kt-widget__content">
								<div class="kt-widget__section">
									<a href="#" class="kt-widget__username">
										<?php echo $row->urusan ?>
									</a>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>

	</div>
</div>

<script type="text/javascript">
	
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
			    	url : '<?php echo site_url('hapus/urusan/'); ?>'+id,
			    	type : 'post',
			    	dataType : 'json',
			    	success : function(){
		            	$('#ur_'+id).fadeOut(500);
		            }
			    });
			    return true;
			}
		})
	}
</script>

