'use strict';

var Dinas = function(){
	var data_dinas = function(hash){
		$.ajax({
            type  : 'ajax',
            url   : site_url + '/data/bidang/' + hash,
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += `<div class="kt-widget2__item">
								<div class="kt-widget2__info">
									<a href="#" class="kt-widget2__title">
										`+data[i].nama_pendek.toUpperCase()+`
									</a>
									<a href="#" class="kt-widget2__username">
										Dinas Pendidikan Pemuda dan Olahraga
									</a>
								</div>
								<div class="kt-widget2__actions">
									<a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
										<i class="flaticon-more-1"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
										<ul class="kt-nav">
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link">
													<i class="kt-nav__link-icon flaticon2-send"></i>
													<span class="kt-nav__link-text">Hapus</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>`;
                }
                $('#bidang').html(html);
            }
        });
	};

	var hash_f = function(){
		var hash = window.location.hash;
		hash = hash.replace('%20','');
		if(hash){
			var id = hash.toUpperCase();
			$('.kt-widget2__item').removeClass('kt-widget2__item--primary');
			$(id).addClass('kt-widget2__item--primary');
			//hash = hash.replace('#','');
			//data_dinas(hash);
		}
	}

	var dinas_f = function(){
		var $dinas = $('.kt-widget2__item');
		$dinas.on('click', function(){
			var id = $(this).attr('id');
			$('.kt-widget2__item').removeClass('kt-widget2__item--primary');
			$('#'+id).addClass('kt-widget2__item--primary');
			//var hash = $('.'+id).attr('href').replace('#','');

			//console.log(id);
			//data_dinas(hash);
		})
	}

	return {
		init: function() {
			//data_dinas(dinas_id);
			hash_f();
			dinas_f();

		},
	};
}();

jQuery(document).ready(function() {
	Dinas.init();
});