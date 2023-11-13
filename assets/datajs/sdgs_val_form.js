'use strict';

var Detail_sdgs = function(){
	//====== NAMA VARIABEL =====
	var formEl;
    var validator;
	var table = $('#elemen');
	var urusan = $('#id_urusan');
	//==========================

	var initable = function(){
		var tbl = table.DataTable({
			processing : true,
            serverSide : true,
            ajax : site_url + '/data/sdgs_val_elemen/',
            //searching: false,
			lengthChange : false,
			ordering : false,
			dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
			columnDefs : [
				{
	            	targets : 2,
	            	className: 'text-center',
	            },
	            {
	            	targets : 0,
	            	className: 'text-center',
	            }
	        ],
		});

		urusan.on('change', function(){
			var id = $(this).val();
			var url = site_url + '/data/sdgs_val_elemen/'+id;
			table.DataTable().ajax.url(url).load();
		}).change();

		$('#cari').on('keyup change', function () {
			tbl.column(0).search($(this).val()).draw();
		});

		table.on('click', 'tbody tr .pilih_item', function(){
			var nama_el = $(this).attr('nama_el');
			var id_el = $(this).attr('id_el');
			$('[name="nama_elemen"]').val(nama_el);
			$('[name="elemen_id"]').val(id_el);
			//console.log(nama_el);
		});
	};

	var initValidation = function() {
        validator = formEl.validate({
            ignore: ":hidden",
            rules: {
                indikator: {
                    required: true
                },
                nama_elemen: {
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
		},
	};
}();

jQuery(document).ready(function() {
	Detail_sdgs.init();
});