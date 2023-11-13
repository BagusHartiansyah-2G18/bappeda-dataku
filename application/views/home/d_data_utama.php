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

				<div id="portfolio" class="portfolio portfolio-3 grid-container clearfix">

					<?php foreach ($data_utama as $row) : ?>
					<?php 
						if ($row->gambar) {
							$row->gambar = base_url('uploads/urusan/'.$row->gambar);
						}
						else{
							$row->gambar = base_url('uploads/urusan/default.png');	
						}
					?>
					<article class="portfolio-item">
						<div class="portfolio-image">
							<img src="<?php echo $row->gambar ?>">
							<div class="portfolio-overlay">
								<a href="<?php echo site_url('home/data_utama/'.$row->id); ?>" class="center-icon">
									<i class="icon-line-ellipsis"></i>
								</a>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3><a href="<?php echo site_url('home/data_utama/'.$row->id); ?>"><?php echo $row->urusan ?></a></h3>
						</div>
					</article>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
	</div>
</section>
