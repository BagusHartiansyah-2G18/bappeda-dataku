<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<?php if ($sesi['level'] > 0) : ?>
			<a href="<?php echo site_url() ?>admin/sdgs?form=baru" class="btn btn-label-warning btn-bold btn-sm btn-icon-h" id="tambah">Tambah</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<?php foreach ($sdgs as $row) : ?>
	<div class="kt-portlet" id="sdgs_<?php echo $row->id ?>">
	    <div class="kt-portlet__body">
	        <div class="kt-widget kt-widget--user-profile-3">
	            <div class="kt-widget__top">
	                <div class="kt-widget__media kt-hidden-">
	                    <img src="<?php echo base_url('uploads/sdgs/'.$row->gambar) ?>" alt="<?php echo $row->nama ?>">
	                </div>
	                <div class="kt-widget__content">
	                    <div class="kt-widget__head">
	                        <a href="#" class="kt-widget__username">
	                        	<?php echo $row->nama ?>
	                        </a>

	                        <div class="kt-widget__action">
	                        	<?php if ($sesi['level'] > 0) : ?>
	                            <a href="<?php echo site_url('admin/sdgs?form='.$row->id) ?>" class="btn btn-label-warning btn-bold btn-sm btn-icon-h" id="tambah">Edit</a>&nbsp;
	                            <a href="#!" onclick="hapus(<?php echo $row->id ?>)" class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="tambah">Hapus</a>
	                            <?php endif; ?> &nbsp;
	                            <a href="<?php echo site_url('admin/sdgs?detail='.$row->id) ?>" class="btn btn-label-info btn-bold btn-sm btn-icon-h" id="tambah">Detail</a>
	                        </div>
	                    </div>

	                    <div class="kt-widget__subhead">
	                        <i class="flaticon2-new-email"></i> : <?php echo $row->desc ?>
	                    </div>

	                    <div class="kt-widget__info d-none d-md-block">
	                        <div class="kt-widget__desc kt-inbox__summary">
	                            <i class="flaticon-truck"></i> : <?php echo substr($row->info,0,150).' . . .' ?>
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
			    	url : '<?php echo site_url('hapus/sdgs/'); ?>'+id,
			    	type : 'post',
			    	dataType : 'json',
			    	success : function(){
		            	$('#sdgs_'+id).fadeOut(500);
		            }
			    });
			    return true;
			}
		})
	}
</script>