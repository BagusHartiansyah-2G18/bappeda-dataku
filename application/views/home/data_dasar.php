<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap py-4">
		<div class="container clearfix">

			<button class="button button-mini button-border button-circle button-yellow button-light side-panel-trigger"><i class="icon-signal"> </i> List Data Dasar</button>

			<!-- ====== TABLE ==== -->

			<div class="fancy-title title-dotted-border title-center mb-2">
				<h3 class="text-uppercase"><?php echo $title; ?></h3>
			</div>

			<div class="single-post nobottommargin clearfix">

				<div class="table-responsive">
					<table id="tbl_data_dasar" class="table table-bordered table-sm" style="width: 99.99%">
						<thead class="text-center bg-dark text-white font-weight-bold">
							<tr>
								<th rowspan="2" class="align-middle">Klasifikasi</th>
								<th colspan="5" class="border-bottom">Tahun</th>
								<th rowspan="2" class="align-middle">Satuan</th>
								<th rowspan="2" class="align-middle" style="width: 3%">Grafik</th>
							</tr>
							<tr>
								<?php
									$tahun = date("Y"); 
								?>
								<th><?php echo ($tahun-4) ?></th>
								<th><?php echo ($tahun-3) ?></th>
								<th><?php echo ($tahun-2) ?></th>
								<th><?php echo ($tahun-1) ?></th>
								<th class="border-right"><?php echo ($tahun) ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>

			<!-- ====== END TABLE ==== -->

		</div>
	</div>
</section>

<!-- ============ GRAFIK =======-->

<div class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-body">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="m_judul"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
					<div class="tabs tabs-alt tabs-tb clearfix" id="tab-8">
						<ul class="tab-nav clearfix">
							<li id="pie"><a href="#tabs-pie">Grafik PIE</a></li>
							<li id="batang"><a href="#tabs-batang">Grafik BATANG</a></li>
							<li id="line"><a href="#tabs-line">Grafik LINE</a></li>
						</ul>
						<div class="tab-container">
							<div class="tab-content clearfix" id="tabs-pie"></div>
							<div class="tab-content clearfix" id="tabs-batang"></div>
							<div class="tab-content clearfix" id="tabs-line"></div>
							<canvas id="chart_data_dasar" style="max-height: 500px;"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ============ GRAFIK =======-->


<script src="<?php echo base_url(); ?>assets/home/js/jquery.js"></script>
<?php echo $plugin ?>

<style type="text/css">
	.jstree-children {
		font-size: 11px;
	}
</style>

<script type="text/javascript">

	var site_url = '<?php echo site_url(); ?>';
	var table = $('#tbl_data_dasar');
		table.DataTable({
			responsive: true,
			autoWidth: false,
			searching: false,
			lengthChange : false,
			ordering : false,
			ajax: {
				url: site_url + '/home/val_data_dasar',
				type: 'POST',
			},
			columns: [
				{data: 'nama_elemen'},
				{data: 'tahun1'},
				{data: 'tahun2'},
				{data: 'tahun3'},
				{data: 'tahun4'},
				{data: 'tahun5'},
				{data: 'satuan'},
				{data: 'grafik'},
			],			
		});

	$('#checkboxesTree').jstree({
        'core' : {
            'themes' : {
                'responsive': false,
                'variant' : 'small'
            },

            'data' : {
                url : site_url + '/home/list_data_dasar',
                dataType : 'json',
                success : function(data){
                    return {'id':data.id};
                }
            }
        },
        'plugins' : ['types', 'checkbox']
    });

    $('#checkboxesTree').on('changed.jstree', function (e, data) {
        var i, j, r = [];
        
        for(i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }

        var id = r.join(',');
        var url = site_url + '/home/val_data_dasar?id='+id;

        table.DataTable().ajax.url(url).load();

    }).jstree();


    // BUKA MODAL 
    $('#tbl_data_dasar tbody').on( 'click', 'tr .chart', function(){
    	//console.log($(this).attr('id'));
    	var id = $(this).attr('id');

    	$.ajax({
            type : "GET",
            url  : site_url + "/home/get_chart/" + id,
            dataType : "JSON",
            success: function(db){
                $.each(db,function(){
                    $('.modal').modal('show');
			    	$('#m_judul').html('Grafik ' + db.nama_elemen);
			    	//console.log(db.tahun);
			    	var nilai = db.tahun_val.split(',');
			    	var tahun = db.tahun.split(',');

			    	var config = {
		    			type: 'pie',
		    			data: {
		    				labels: tahun,
		    				datasets: [{
		    					label: db.nama_elemen,
		    					backgroundColor: [
			    					window.chartColors.red,
			    					window.chartColors.orange,
			    					window.chartColors.yellow,
			    					window.chartColors.green,
			    					window.chartColors.blue,
			    					],
		    					borderColor: window.chartColors.red,
		    					data: nilai,
		    					fill: false,
		    				}]
		    			},
		    			options: {
		    				scales: {
		    					xAxes: [{
		    						display: false,
		    					}],
		    					yAxes: [{
		    						display: false,
		    					}]
		    				}
		    			}
		    		}

					$('.modal').on('shown.bs.modal',function(){
						var ctx = document.getElementById("chart_data_dasar").getContext("2d");
						var grafik_dataku = new Chart(ctx, config);

						$('#line').on('click', function(){
							config.type = 'line';
							config.options.scales.xAxes = [{
	    						display: true,
	    					}];
	    					config.options.scales.yAxes = [{
	    						display: true,
	    					}];
							grafik_dataku.update();
						})

						$('#batang').on('click', function(){
							config.type = 'bar';
							config.options.scales.xAxes = [{
	    						display: true,
	    					}];
	    					config.options.scales.yAxes = [{
	    						display: true,
	    					}];
							grafik_dataku.update();
						})

						$('#pie').on('click', function(){
							config.options.scales.xAxes = [{
	    						display: false,
	    					}];
	    					config.options.scales.yAxes = [{
	    						display: false,
	    					}];
							config.type = 'pie';
							grafik_dataku.update();
						}).click();
					}).on('hidden.bs.modal',function(){
						$('.tabs ul li').attr('aria-selected', 'false');
						$('.tabs ul li').removeClass('ui-tabs-active ui-state-active');
					   grafik_dataku.destroy();
					});		
                });
            }
        });
    });

</script>

