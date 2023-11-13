'use strict';

var DataUtama = function(){
	var edit = $('#edit');
	var hapus = $('#hapus');
	var tbl = $('#tbl_data_utama');

	var table_datautama = function(){
		var option = function(url){
			var opt = {
	            processing : true,
	            serverSide : true,
	            ajax : url,
	            searching: false,
				lengthChange : false,
				ordering : false,
				pageLength: 100,
			}

			return opt;
		}

		var tahun = $('#dr_thn').val();
		var thn = parseInt(tahun);
		$('.thn1').html(thn);
		$('.thn2').html(thn+1);
		$('.thn3').html(thn+2);
		$('.thn4').html(thn+3);
		$('.thn5').html(thn+4);

		var url = site_url + '/data/data_utama';
		var tabel = tbl.DataTable(option(url));

		$('#dr_thn').on('change', function(){
			var tahun = parseInt($(this).val());
			var urusan = $('#id_urusan').val();
			//var thn = tahun++;

			var url = site_url + '/admin/session_du_h?t='+ tahun;

			//console.log(url);

			if (urusan != 0) {
				url = site_url + '/admin/session_du_h?t=' + tahun + '&u=' + urusan;
			}
			
			$.ajax({
		    	url : url,
		    	dataType : 'json',
		    	success : function(){
		    		tabel.ajax.reload();
		    		$('.thn1').html(tahun);
					$('.thn2').html(tahun+1);
					$('.thn3').html(tahun+2);
					$('.thn4').html(tahun+3);
					$('.thn5').html(tahun+4);
		    	}
		    });
		    return true;

		}).change();

		$('#id_urusan').on('change', function(){
			var tahun = $('#dr_thn').val();
			var urusan = $(this).val();

			if (urusan != 0) {
				var url = site_url + '/admin/session_du_h?t=' + tahun + '&u=' + urusan;
			}
			else{
				var url = site_url + '/admin/session_du_h?t='+ tahun;
			}

			$.ajax({
		    	url : url,
		    	dataType : 'json',
		    	success : function(){tabel.ajax.reload();}
		    });
		    return true;	

		});

	};

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
			var link = 'admin/data_utama?du=';

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

			console.log(id);
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
			    	url : site_url + '/hapus/data_utama/',
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
			table_datautama();
			initSelect();
			initEdit();
			initHapus();
		},
	};
}();

jQuery(document).ready(function() {
	DataUtama.init();
});