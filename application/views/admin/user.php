<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<?php if ($sesi['level'] > 0) : ?>
			<a href="<?php echo site_url() ?>admin/user?p=baru" class="btn btn-label-warning btn-bold btn-sm btn-icon-h" id="tambah">Tambah</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

	<?php foreach ($data as $row) : ?>
	<div class="kt-portlet" id="user_<?php echo $row->id_user; ?>">
	    <div class="kt-portlet__body">
	        <div class="kt-widget kt-widget--user-profile-3">
	            <div class="kt-widget__top">
	                <div class="kt-widget__media kt-hidden-">
	                    <img src="<?php echo $row->gambar; ?>" alt="<?php echo $row->username; ?>">
	                </div>
	                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
	                    JM
	                </div>
	                <div class="kt-widget__content">
	                    <div class="kt-widget__head">
	                        <a href="#" class="kt-widget__username">
	                            <?php echo $row->nama; ?>    
	                            <i class="flaticon2-correct kt-font-success"></i>                       
	                        </a>

	                        <div class="kt-widget__action">
	                            <a href="<?php echo site_url('admin/user?p='.$row->id_user.'') ?>" class="btn btn-label-warning btn-bold btn-sm btn-icon-h" id="tambah">Edit</a>&nbsp;
	                            <?php if ($sesi['level'] > 0) : ?>
	                            <a href="#!" onclick="hapus(<?php echo $row->id_user ?>)" class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="tambah">Hapus</a>
	                            <?php endif; ?>


	                        </div>
	                    </div>

	                    <div class="kt-widget__subhead">
	                    	<a href="#"><i class="flaticon2-calendar-3"></i><?php echo $row->username; ?></a>
	                        <a href="#"><i class="flaticon2-new-email"></i><?php echo $row->email; ?></a>
	                        <a href="#"><i class="flaticon-home-2"></i><?php echo $row->id_dinas; ?></a>
	                    </div>

	                    <div class="kt-widget__info">
	                        <div class="kt-widget__desc">
	                            <i class="flaticon-truck"></i> : <?php echo $row->akses; ?>
	                        </div>
	                    </div>
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php endforeach; ?>
</div>


<script type="text/javascript">

	function hapus(id){
		swal.fire({
			title: 'Hapus Data!',
            text: "Apakah anda yakin mau menghapus data ini?",
            type:'warning',
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal"
		}).then((result) => {
			if (result.value){
			    $.ajax({
			    	url : '<?php echo site_url('hapus/user/'); ?>'+id,
			    	type : 'post',
			    	dataType : 'json',
			    	success : function(){
		            	$('#user_'+id).fadeOut(500);
		            }
			    });
			    return true;
			}
		})
	}
</script>