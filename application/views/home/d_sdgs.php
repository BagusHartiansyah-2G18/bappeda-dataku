<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<div class="heading-block center py-0">
				<h3><?php echo $title; ?></h3>
			</div>

			<!-- Post Content
			============================================= -->
			<div class="single-post nobottommargin clearfix">

				<div class="row grid-container" data-layout="masonry" style="overflow: visible">
					<?php foreach ($sdgs as $row) : ?>

					<div class="col-md-3 mb-4">
						<div class="flip-card text-center">
							<div class="flip-card-front dark" style="background-image: url('<?php echo base_url('uploads/sdgs/'.$row->gambar) ?>')">
								<div class="flip-card-inner">
									<div class="card nobg noborder text-center">
										<div class="card-body">
											<h4 class="card-title"><?php echo $row->nama ?></h4>
										</div>
									</div>
								</div>
							</div>

							<div class="flip-card-back dark" style="background-image: url('<?php echo base_url('uploads/sdgs/'.$row->gambar) ?>')">

								<div class="flip-card-inner">
									<p class="mb-2 text-white"><?php echo $row->desc ?></p>

									<a href="<?php echo site_url('home/sdgs/'.$row->id) ?>" class="btn btn-outline-light mt-2">Lihat</a>

								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
	</div>
</section>
