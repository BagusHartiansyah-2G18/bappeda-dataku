'use strict';

var Detail_sdgs = function(){
	//====== NAMA VARIABEL =====
	var formEl;
    var validator;
	var tahun = $('#dr_thn');
	var edit = $('.edit');
	var hapus = $('.hapus');
	var table = $('.table');
	//==========================

	var initable = function(){
		var option = function(url){
			var opt = {
	            processing : true,
	            serverSide : true,
	            ajax : url,
	            searching: false,
				lengthChange : false,
				ordering : false
			}

			return opt;
		}

		$.each(JSON.parse(target), function(i, item){
			var id = '#target_' + item.target_id;
			var url = site_url + '/data/sdgs_val?id=' + item.target_id + '&thn=' + $('#dr_thn').val() + '&kode=' + item.kode;
			var tbl = $(id).DataTable(option(url));

			tahun.on('change', function(){
				var thn = $(this).val();
				url = site_url + '/data/sdgs_val?id=' + item.target_id + '&thn=' + thn + '&kode=' + item.kode;
				tbl.ajax.url(url).load();
			});
		});

		//========== Hapus ==========
		table.on('click', 'tbody tr .dropdown .dropdown-menu .hapus', function(){
			var id = $(this).attr('data');
			var url = site_url + 'hapus/sdgs_val/' + id;
			var tbl = $(this).closest('table').attr('id');
			aksi(url,'table',tbl);
			console.log(url);
		});

		tahun.on('change', function(){
			var thn = $(this).val();
			thn = thn++;
			$('.thn1').html(thn);
			$('.thn2').html(thn+1);
			$('.thn3').html(thn+2);
			$('.thn4').html(thn+3);
			$('.thn5').html(thn+4);
		}).change();
	};

	var initHapus = function(){
		hapus.on('click', function(){
			var id = $(this).attr('data');
			var url = site_url + 'hapus/sdgs_val/' + id;
			aksi(url,'',id);
		});
	}

	var initEdit = function(){
		edit.on('click',function(){
	        var id = $(this).attr('data');
	        $.ajax({
	            type : "GET",
	            url  : site_url + "data/get_target/" + id,
	            dataType : "JSON",
	            success: function(data){
	                $.each(data,function(){
	                    $('#frm_target').modal('show');
	                    $('[name="kode"]').val(data.kode);
	                    $('[name="indikator"]').val(data.indikator);
	                    $('[name="id"]').val(data.id);
	                    $('[name="id_dinas"]').val(data.id_dinas);
	                });
	            }
	        });
	        return false;
	    });
	}

	var aksi = function(url, tipe, id){
		swal.fire({
			title: 'Hapus Data!',
            text: "Apakah anda yakin mau menghapus data ini?",
            type:'warning',
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
		}).then((result) => {
			if (result.value){
			    $.ajax({
			    	url : url, 
			    	type : 'POST',
			    	dataType : 'JSON',
			    	success : function(){
		            	if (tipe == 'table') {
		            		$('#'+id).DataTable().ajax.reload();
		            	}
		            	else{
		            		$('#'+id).fadeOut(500);
		            	}
		            }
			    });
			    return true;
			}
		});
	}

	var initValidation = function() {
        validator = formEl.validate({
            ignore: ":hidden",
            rules: {
                kode: {
                    required: true
                },
                indikator: {
                    required: true
                },
                id_dinas: {
                    required: true
                },
            },

            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();
                swal.fire({
                    "title": "",
                    "text": "Ada beberapa kesalahan dalam Permohonan anda. Mohon diperbaiki",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            },
        });
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function(e) {
            e.preventDefault();
            if (validator.form()) {
                KTApp.progress(btn);
                formEl.ajaxSubmit({
                    type : "POST",
                    dataType : "JSON",
                    success: function(data) {
                        KTApp.unprogress(btn);
                        if(data.error==false){
                            swal.fire({
                                title: '',
                                text: data.message,
                                type: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function(){window.location.reload()},1000);
                        }
                        if (data.error == true) {
                            swal.fire('Error','Gagal Disimpan','error');
                        }
                    }
                });
            }
        });
    }

	
	return {
		init: function() {
			formEl = $('#kt_form');

            initValidation();
            initSubmit();
			initable();
			initHapus();
			initEdit();
		},
	};
}();

jQuery(document).ready(function() {
	Detail_sdgs.init();
});