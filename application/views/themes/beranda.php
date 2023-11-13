<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name='viewport' content='initial-scale=1, viewport-fit=cover'>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/media/logos/favicon.ico" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/home/demos/seo/css/fonts.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/home/demos/seo/seo.css" type="text/css" />
	<?php echo $css ?>
	
	<!-- Document Title
	============================================= -->
	<title><?php echo $title ?> || Bappeda Litbang KSB</title>

</head>

<body class="stretched" id="home">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
		<!-- Top Bar
		============================================= -->
		<div id="top-bar" class="transparent-topbar">
			<div class="container clearfix">
				<div class="col_half nobottommargin clearfix">
					<!-- Top Links
					============================================= -->
					<div class="top-links">
						<ul>
							<li><a href="<?php echo site_url();?>">Beranda</a></li>
							<li><a href="<?php echo site_url('admin');?>">Login</a></li>
						</ul>
					</div><!-- .top-links end -->
				</div>

				<div class="col_half fright dark col_last clearfix nobottommargin">
					<!-- Top Social
					============================================= -->
					<div id="top-social">
						<ul>
							<li><a href="http://facebook.com/" class="si-facebook" target="_blank"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
							<li><a href="http://twitter.com/" class="si-twitter" target="_blank"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
							<li><a href="http://youtube.com/" class="si-youtube" target="_blank"><span class="ts-icon"><i class="icon-youtube"></i></span><span class="ts-text">Youtube</span></a></li>
							<li><a href="http://instagram.com/" class="si-instagram" target="_blank"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
							<li><a href="" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+6281239349090</span></a></li>
							<li><a href="" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">drdksb08@gmail.com</span></a></li>
						</ul>
					</div><!-- #top-social end -->
				</div>
			</div>
		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header" class="transparent-header floating-header clearfix">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="<?php echo site_url();?>" class="standard-logo" data-dark-logo="images/logo.png">
							<img src="<?php echo base_url();?>assets/home/images/logo.png" alt="Logo">
						</a>

						<a href="<?php echo site_url();?>" class="retina-logo" data-dark-logo="images/logo.png">
							<img src="<?php echo base_url();?>assets/home/images/logo.png">
						</a>
					</div><!-- #logo end -->

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu" class="with-arrows">
						<ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1500">
							<li><a href="<?= site_url('home/ikk') ?>"><div>IKK</div></a></li>
							<li><a href="#" data-href="#sdgs"><div>SDGS</div></a></li>
							<li><a href="#" data-href="#data_utama"><div>DATA UTAMA</div></a></li>
							<li><a href="<?= site_url('home/data_dasar') ?>"><div>DATA DASAR</div></a></li>
						</ul>

						<!-- Top Search
						============================================= -->
						<div id="top-search" class="fleft">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="<?php echo site_url('home/cari'); ?>" method="get">
								<input type="text" name="d" class="form-control" value="" placeholder="Masukan kata kunci &amp; Tekan enter..">
							</form>
						</div><!-- #top-search end -->
					</nav><!-- #primary-menu end -->

				</div>

			</div>

		</header><!-- #header end -->

		<!-- Slider
		============================================= -->
		<section id="slider" class="slider-element slider-parallax full-screen clearfix" style="background: #FFF url('<?php echo base_url();?>assets/home/demos/seo/images/hero/hero-1.jpg') center center no-repeat; background-size: cover;">

			<div class="vertical-middle">
				<div class="container topmargin-sm">
					<div class="row">
						<div class="col-lg-5 col-md-8">
							<div class="slider-title">
								<h2>Bappeda Litbang Sumbawa Barat</h2>
								<p>Tanpa data yang baik, pembangunan dapat salah sasaran. Perencanaan pembangunan yang objektif adalah perencanaan yang berbasiskan pada sebuah data.</p>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="video-wrap h-100 d-block d-lg-none">
				<div class="video-overlay" style="background: rgba(255,255,255,0.85);"></div>
			</div>
		</section>

		<section id="content">
			<div class="content-wrap pt-0 page-section">
				<!-- Works/Projects
				============================================= -->
				<div class="section m-0" style="background: url('<?php echo base_url();?>assets/home/demos/seo/images/sections/5.jpg') no-repeat center center; background-size: cover;padding: 80px 0;">
					<div class="container" id="data_utama">
						<div class="heading-block nobottomborder center">
							<h3 class="nott ls0">DATA UTAMA</h3>
						</div>

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

			<div class="container py-4" id="sdgs">
				<div class="heading-block nobottomborder center">
					<h3 class="nott ls0">Sustainable Development Goals (SDGS)</h3>
				</div>


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
		</section>

		<footer id="footer" class="noborder bg-white">
			<div id="copyrights" style="background: url('<?php echo base_url();?>assets/home/demos/seo/images/hero/footer.svg') no-repeat top center; background-size: cover; padding-top: 70px;">

				<div class="container clearfix">
					<div class="col_half">
						Copyrights &copy; <?php echo date("Y") ?> Dibuat dan dikelola Bappeda Jarlitbang Sumbawa Barat. 
					</div>

					<div class="col_half col_last tright">
						<div class="copyrights-menu copyright-links clearfix one-page-menu" data-easing="easeInOutExpo" data-speed="1500" >
							<a href="<?php echo site_url() ?>" data-href="#home">Beranda</a>/
							<a href="#" data-href="#sdgs">Sdgs</a>/
							<a href="#" data-href="#data_utama">Data Utama</a>/
							<a href="<?php echo site_url('home/data_dasar') ?>" >Data Dasar</a>/
							<a href="<?php echo site_url('admin');?>">Login</a>
						</div>
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->
	</div>


	<!-- External JavaScripts
	============================================= -->
	<?php echo $js ?>

	<script type="text/javascript">
		var site_url = '<?php echo site_url() ?>';
		var base_url = '<?php echo base_url() ?>';

		jQuery(document).ready( function($){
			function pricingSwitcher( elementCheck, elementParent, elementPricing ) {
				elementParent.find('.pts-left,.pts-right').removeClass('pts-switch-active');
				elementPricing.find('.pts-switch-content-left,.pts-switch-content-right').addClass('hidden');

				if( elementCheck.filter(':checked').length > 0 ) {
					elementParent.find('.pts-right').addClass('pts-switch-active');
					elementPricing.find('.pts-switch-content-right').removeClass('hidden');
				} else {
					elementParent.find('.pts-left').addClass('pts-switch-active');
					elementPricing.find('.pts-switch-content-left').removeClass('hidden');
				}
			}

			$('.pts-switcher').each( function(){
				var element = $(this),
					elementCheck = element.find(':checkbox'),
					elementParent = $(this).parents('.pricing-tenure-switcher'),
					elementPricing = $( elementParent.attr('data-container') );

				pricingSwitcher( elementCheck, elementParent, elementPricing );

				elementCheck.on( 'change', function(){
					pricingSwitcher( elementCheck, elementParent, elementPricing );
				});
			});
		});
	</script>


</body>
</html>