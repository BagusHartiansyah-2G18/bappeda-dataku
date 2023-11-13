<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<div class="heading-block center py-0">
				<h3><?php echo $title; ?></h3>
				<span><?php echo $sub_ttl; ?></span>
			</div>

			<!-- Post Content
			============================================= -->
			<div class="single-post nobottommargin clearfix">

				<!-- Posts
				============================================= -->
				<div id="posts" class="small-thumbs">
					<div class="entry clearfix">
						<div class="entry-image nobottommargin">
							<img class="image_fade" src="<?php echo base_url('uploads/urusan/'.$gambar) ?>" alt="<?php echo $sub_ttl; ?>">
						</div>
						<div class="entry-content text-justify">
							<?php echo $desk_ikk; ?>
						</div>
					</div>
				</div>

				<div class="row">
					<?php foreach ($chart as $row): ?>
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-header"><?php echo $row->nama_ikk; ?></div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3">
											Sumber Data
										</div>
										<div class="col-md-9">
											<?php echo $row->dinas; ?>
										</div>
										<div class="col-md-3">
											Satuan
										</div>
										<div class="col-md-9">
											<?php echo $row->satuan; ?>
										</div>
									</div>

									<div class="single-post nobottommargin clearfix">
										<div class="table-responsive">
											<table class="table table-bordered table-sm" style="width: 99.99%">
												<thead class="text-center bg-dark text-white font-weight-bold">
													<tr>
														<th colspan="5" class="border-bottom">Tahun</th>
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
												<tbody>
													<?php $r = explode(',', $row->nilai); ?>
													<tr class="text-center">
														<td><?php echo $r[0]; ?></td>
														<td><?php echo $r[1]; ?></td>
														<td><?php echo $r[2]; ?></td>
														<td><?php echo $r[3]; ?></td>
														<td><?php echo $r[4]; ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 chart">

							<div class="tabs tabs-alt tabs-tb clearfix" id="tab-8">
								<ul class="tab-nav clearfix">
									<li id="pie_chart_<?= $row->id; ?>"><a href="#tabs-pie">Grafik PIE</a></li>
									<li id="bar_chart_<?= $row->id; ?>"><a href="#tabs-batang">Grafik BATANG</a></li>
									<li id="line_chart_<?= $row->id; ?>"><a href="#tabs-line">Grafik LINE</a></li>
								</ul>
								<div class="tab-container">
									<div class="tab-content clearfix" id="tabs-pie"></div>
									<div class="tab-content clearfix" id="tabs-batang"></div>
									<div class="tab-content clearfix" id="tabs-line"></div>
									
									<canvas id="chart_<?php echo $row->id; ?>" style="max-height: 250px;" label="<?php echo $row->tahun; ?>" nilai="<?php echo $row->nilai; ?>" judul="<?php echo $row->nama_ikk; ?>"></canvas>
								</div>
							</div>

							
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo base_url(); ?>assets/home/js/jquery.js"></script>
<?php echo $plugin ?>

<script type="text/javascript">
	//var canvas_id = [];

	$('canvas').each(function(index,value){
        //canvas_id.push($(this).attr('id'));
        var canvas_id = $(this).attr('id');
        var label = $(this).attr('label').split(',');
        var nilai = $(this).attr('nilai').split(',');
        var judul = $(this).attr('judul');

        var _line = 'line_' + $(this).attr('id');
        var _bar = 'bar_' + $(this).attr('id');
        var _pie = 'pie_' + $(this).attr('id');

        //console.log(_line);

        var config = {
        	type: 'pie',
        	data: {
        		labels: label,
        		datasets: [{
        			label: judul,
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

		var ctx = document.getElementById(canvas_id).getContext("2d");
		var grafik_dataku = new Chart(ctx, config);

		$('#'+ _line).on('click', function(){
			config.type = 'line';
			config.options.scales.xAxes = [{
				display: true,
			}];
			config.options.scales.yAxes = [{
				display: true,
			}];
			grafik_dataku.update();
		})

		$('#'+ _bar).on('click', function(){
			config.type = 'bar';
			config.options.scales.xAxes = [{
				display: true,
			}];
			config.options.scales.yAxes = [{
				display: true,
			}];
			grafik_dataku.update();
		})

		$('#'+ _pie).on('click', function(){
			config.options.scales.xAxes = [{
				display: false,
			}];
			config.options.scales.yAxes = [{
				display: false,
			}];
			config.type = 'pie';
			grafik_dataku.update();
		}).click();

    });

	
</script>


