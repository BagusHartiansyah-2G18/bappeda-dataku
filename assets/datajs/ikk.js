'use strict';

var Ikk = function(){
	var edit = $('#edit');
	var hapus = $('#hapus');
	var tbl = $('#ikk_tbl');

	var table_ikk = function(){
		var option = function(url){
			var opt = {
	            processing : true,
	            serverSide : true,
	            ajax : url,
	            searching: false,
				lengthChange : false,
				ordering : false,
				pageLength: 25,
				columnDefs: [
					{targets: 0, orderable: false,width: "6%"},
	                {targets: 7, width: "7%"},
	                {targets: 1, className : "text-left"},
	                {targets : '_all', className : "text-center"}
	            ],
			}

			return opt;
		}

		var url = site_url + '/data/ikk';
		var tabel = tbl.DataTable(option(url));
	};

	var initFilter = function(){
		$('#dr_thn').on('change', function(){
			var tahun = parseInt($(this).val());
			var urusan = $('#id_urusan').val();
			var url = site_url + '/data/ikk?t='+ tahun;
			//console.log(tahun);

			if (urusan != 0) {
				url = site_url + '/data/ikk?t=' + tahun + '&u=' + urusan;
			}

			$('.thn1').html(tahun);
			$('.thn2').html(tahun+1);
			$('.thn3').html(tahun+2);
			$('.thn4').html(tahun+3);
			$('.thn5').html(tahun+4);
			tbl.DataTable().ajax.url(url).load();
			
		}).change();

		$('#id_urusan').on('change', function(){
			var tahun = $('#dr_thn').val();
			var urusan = $(this).val();

			if (urusan != 0) {
				var url = site_url + '/data/ikk?t=' + tahun + '&u=' + urusan;
			}
			else{
				var url = site_url + '/data/ikk?t='+ tahun;
			}

			tbl.DataTable().ajax.url(url).load();

		});
	}

	var initSelect = function(){
		tbl.on('change', '.kt-group-checkable', function() {
			var set = $(this).closest('table').find('td:first-child .kt-checkable');
			var checked = $(this).is(':checked');

			$(set).each(function() {
				if (checked) {
					$(this).prop('checked', true);
					$(this).closest('tr').addClass('active');
				}
				else {
					$(this).prop('checked', false);
					$(this).closest('tr').removeClass('active');
				}
			});
		});

		tbl.on('change', 'tbody tr .kt-checkbox', function() {
			$(this).parents('tr').toggleClass('active');
		});

		tbl.change(function(){
			var jml_cek = $('.kt-checkable').filter(':checked').length;
			if (jml_cek > 1) {
				edit.addClass('d-none');
			}
			else{
				edit.removeClass('d-none');	
			}
		}); 
	}

	var initEdit = function(){
		tbl.on('click', 'tbody tr .kt-checkable', function() {
			var id = $(this).val();
			var link = 'admin/ikk/edit?id=';

			if ($(this).filter(':checked').length == 1) {
				edit.on('click',function(){
					location.href = site_url + link + id;
				})
			}
		});
	}

	var initHapus = function(){
		hapus.on('click', function() {
			var checked = $('.kt-checkable').filter(':checked');
			var id = [];

			for (var i = 0; i < checked.length; i++) {
				id.push(checked[i].value);
			}

			//console.log(id);
			aksi(id);
		});
	}

	var aksi = function(id){
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
			    	url : site_url + '/hapus/ikk/',
			    	data : {id : id}, 
			    	type : 'post',
			    	dataType : 'json',
			    	success : function(){
		            	setTimeout(function(){window.location.reload()},300);
		            }
			    });
			    return true;
			}
		});
	}

	return {
		// public functions
		init: function() {
			table_ikk();
			initFilter();
			initSelect();
			initEdit();
			initHapus();
		},
	};
}();

jQuery(document).ready(function() {
	Ikk.init();
});