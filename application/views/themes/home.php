<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name='viewport' content='initial-scale=1, viewport-fit=cover'>
	<link rel="shortcut icon" href="<?= base_url(); ?>/assets/media/logos/favicon.ico" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900" rel="stylesheet" type="text/css" />
	<?= $css ?>
	
	<!-- Document Title
	============================================= -->
	<title><?= $title ?> || Bappeda Litbang KSB</title>

</head>

<body class="stretched side-panel-left">
	<div class="body-overlay"></div>
	<div id="side-panel">
		<div id="side-panel-trigger-close" class="side-panel-trigger">
			<a href="#"><i class="icon-line-cross"></i></a>
		</div>

		<div class="side-panel-wrap py-2 px-2">
			<div class="widget clearfix" style="width: 90%">
				<!-- CARI FORM --->
				<div class="input-group input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">
							<i class="icon-line-search"></i>
						</span>
					</div>
					<input type="text" class="form-control" placeholder="Cari">
				</div>

				<div id="checkboxesTree"></div> 

			</div>
		</div>
	</div>


	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
		<!-- Header
		============================================= -->
		<header id="header" class="sticky-style-2">
			<div class="container clearfix">
				<!-- Logo
				============================================= -->
				<div id="logo" class="divcenter">
					<a href="<?= site_url() ?>" class="standard-logo" data-dark-logo="<?= base_url();?>assets/home/images/logo.png" alt="Bappeda KSB">
						<img class="divcenter" src="<?= base_url();?>assets/home/images/logo.png" alt="Bappeda KSB">
					</a>
				</div><!-- #logo end -->
			</div>

			<div id="header-wrap">
				<!-- Primary Navigation
				============================================= -->
				<nav id="primary-menu" class="style-2 center">
					<div class="container clearfix">
						<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
						<ul>
							<li class="<?= $menu == '' ? 'current' : ''; ?>"><a href="<?= site_url() ?>"><div>Beranda</div></a></li>
							<li class="<?= $menu == 'ikk' ? 'current' : ''; ?>"><a href="<?= site_url('home/ikk') ?>"><div>IKK</div></a></li>
							<li class="<?= $menu == 'sdgs' ? 'current' : ''; ?>"><a href="<?= site_url('home/sdgs') ?>"><div>Sdgs</div></a></li>
							<li class="<?= $menu == 'data_utama' ? 'current' : ''; ?>"><a href="<?= site_url('home/data_utama') ?>"><div>Data Utama</div></a></li>
							<li class="<?= $menu == 'data_dasar' ? 'current' : ''; ?>"><a href="<?= site_url('home/data_dasar') ?>"><div>Data Dasar</div></a></li>
							<li><a href="<?= site_url('admin') ?>"><div>Login</div></a></li>
						</ul>

						<!-- Top Search
						============================================= -->
						<div id="top-search">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="<?= site_url('home/cari'); ?>" method="get">
								<input type="text" name="d" class="form-control" value="" placeholder="Isi &amp; Tekan enter..">
							</form>
						</div><!-- #top-search end -->
					</div>
				</nav><!-- #primary-menu end -->
			</div>
		</header><!-- #header end -->

		<!-- Content -->
		
		<?= $content ?>

		<!-- #content end -->

	
		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
			<!-- Copyrights
			============================================= -->
			<div id="copyrights" class="py-2">
				<div class="container clearfix">
					<div class="col_full nobottommargin center">
						Copyrights &copy; 2019 Dibuat dan dikelola Bappeda Jarlitbang Sumbawa Barat. Hak cipta dilindungi.
					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->
	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<?= $js ?>

</body>
</html>