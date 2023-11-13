<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title><?= $title ?> || Bappeda Litbang KSB</title>
		<meta name="description" content="Updates and statistics">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="<?= base_url(); ?>/assets/media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
		
		<!--- CSS UTAMA --->
		<?= $css ?>

		<!-- JS UTAMA -->
		<?= $js ?>

		<script type="text/javascript">
			var site_url = '<?= site_url() ?>';
			var base_url = '<?= base_url() ?>';
		</script>

	</head>

	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed">
			<div class="kt-header-mobile__logo">
				<a href="<?= site_url('admin') ?>">
					<img alt="Logo" src="<?= base_url(); ?>/assets/media/logos/logo-light.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler" id="kt_aside_mobile_toggler"><span></span></button>
			</div>
		</div>
		<!-- end:: Header Mobile -->

		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="<?= site_url('admin') ?>">
								<img alt="Logo" src="<?= base_url(); ?>/assets/media/logos/logo-light.png" />
							</a>
						</div>

						<div class="kt-aside__brand-tools">
							<button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span class="text-primary"><i class="flaticon2-fast-back"></i></span>
								<span class="text-primary"><i class="flaticon2-fast-next"></i></span>
							</button>
						</div>
					</div>
					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">

							<ul class="kt-menu__nav ">
								<li class="kt-menu__item" aria-haspopup="true">
									<a href="<?= site_url() ?>" class="kt-menu__link" target="_blank">
										<span class="kt-menu__link-icon"><i class="flaticon2-fast-next"></i></span>
										<span class="kt-menu__link-text">Halaman Depan</span>
									</a>
								</li>

								<li class="kt-menu__item <?= ($menu =='') ? 'kt-menu__item--active' : ''; ?>" aria-haspopup="true">
									<a href="<?= site_url('admin') ?>" class="kt-menu__link ">
										<span class="kt-menu__link-icon"><i class="flaticon-home-2"></i></span>
										<span class="kt-menu__link-text">Beranda</span>
									</a>
								</li>


								<li class="kt-menu__section">
									<h4 class="kt-menu__section-text">Master Data</h4>
								</li>

								<li class="kt-menu__item <?= ($menu =='urusan') ? 'kt-menu__item--active' : ''; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<a href="<?= site_url('admin/urusan') ?>" class="kt-menu__link kt-menu__toggle">
										<span class="kt-menu__link-icon"><i class="flaticon-squares"></i></span>
										<span class="kt-menu__link-text">Urusan</span>
									</a>
								</li>

								<li class="kt-menu__item <?= ($menu =='dinas') ? 'kt-menu__item--active' : ''; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<a href="<?= site_url('admin/dinas') ?>" class="kt-menu__link kt-menu__toggle">
										<span class="kt-menu__link-icon"><i class="flaticon-home"></i></i></span>
										<span class="kt-menu__link-text">Dinas</span>
									</a>
								</li>

								<li class="kt-menu__section">
									<h4 class="kt-menu__section-text">Dataku</h4>
								</li>

								<li class="kt-menu__item <?= ($menu =='data_utama') ? 'kt-menu__item--active' : ''; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<a href="<?= site_url('admin/data_utama') ?>" class="kt-menu__link kt-menu__toggle">
										<span class="kt-menu__link-icon"><i class="flaticon-folder-1"></i></span>
										<span class="kt-menu__link-text">Data Utama</span>
									</a>
								</li>

								<?php if ($sesi['level'] > 0) : ?>
								<li class="kt-menu__item <?= ($menu =='sdgs') ? 'kt-menu__item--active' : ''; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<a href="<?= site_url('admin/sdgs') ?>" class="kt-menu__link kt-menu__toggle">
										<span class="kt-menu__link-icon"><i class="flaticon-map"></i></span>
										<span class="kt-menu__link-text">SDGS</span>
									</a>
								</li>

								<li class="kt-menu__item <?= ($menu =='ikk') ? 'kt-menu__item--active' : ''; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<a href="<?= site_url('admin/ikk') ?>" class="kt-menu__link kt-menu__toggle">
										<span class="kt-menu__link-icon"><i class="flaticon-layer"></i></span>
										<span class="kt-menu__link-text">Indikator Kenierja Kunci</span>
									</a>
								</li>
								<?php endif; ?>

								<li class="kt-menu__section">
									<h4 class="kt-menu__section-text">Lain-Lain</h4>
								</li>

								<li class="kt-menu__item <?= ($menu =='user') ? 'kt-menu__item--active' : ''; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<a href="<?= site_url('admin/user') ?>" class="kt-menu__link kt-menu__toggle">
										<span class="kt-menu__link-icon"><i class="flaticon-users"></i></span>
										<span class="kt-menu__link-text">Pengguna</span>
									</a>
								</li>

								<li class="kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<a href="<?= site_url('admin/logout') ?>" class="kt-menu__link kt-menu__toggle">
										<span class="kt-menu__link-icon"><i class="flaticon2-cancel"></i></span>
										<span class="kt-menu__link-text">Keluar / Logout</span>
									</a>
								</li>

							</ul>
						</div>
					</div>
					<!-- end:: Aside Menu -->
				</div>
				<!-- end:: Aside -->


				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<div class="kt-header-menu-wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
								<ul class="kt-menu__nav">
									<li class="kt-menu__item kt-menu__item--active">
										<span class="kt-menu__link kt-menu__toggle">
											<span class=""><i class="fa fa-home"></i></span>
										</span>
									</li>
									<li class="kt-menu__item kt-menu__item--active" >
										<span class="kt-menu__link kt-menu__toggle">
											<span class="kt-menu__link-text"><?= $title ?></span>
										</span>
									</li>
								</ul>
							</div>
						</div>

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">
							<!--begin: Notifications -->
							<div class="kt-header__topbar-item dropdown">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
									<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
												<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
											</g>
										</svg> <span class="kt-pulse__ring"></span>
									</span>
								</div>

								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
									<form>
										<!--begin: Head -->
										<div class="kt-head kt-head--skin-dark kt-head--fit-x" style="background-image: url(<?= base_url(); ?>/assets/media/misc/bg-1.jpg)">
											<h3 class="kt-head__title">
												User Notifications
												&nbsp;
												<span class="btn btn-success btn-sm btn-bold btn-font-md">23 new</span>
											</h3>
										</div>
										<!--end: Head -->
										<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
											<a href="#" class="kt-notification__item">
												<div class="kt-notification__item-icon">
													<i class="flaticon2-line-chart kt-font-success"></i>
												</div>
												<div class="kt-notification__item-details">
													<div class="kt-notification__item-title">
														New order has been received
													</div>
													<div class="kt-notification__item-time">
														2 hrs ago
													</div>
												</div>
											</a>
										</div>
									</form>
								</div>
							</div>
							<!--end: Notifications -->

							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
										<span class="kt-header__topbar-username kt-hidden-mobile"><?= $nama ?></span>
										<img class="kt-hidden" alt="Pic" src="<?= base_url(); ?>/assets/media/users/300_25.jpg" />
										<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?= $ini ?></span>
									</div>
								</div>
							</div>
							<!--end: User Bar -->
						</div>
						<!-- end:: Header Topbar -->
					</div>
					<!-- end:: Header -->


					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						<?= $content ?>
					</div>

					<!-- begin:: Footer -->
					<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-footer__copyright"></div>
							<div class="kt-footer__menu">
								2019&nbsp;&copy;&nbsp; Bappeda Litbang Sumbawa Barat
							</div>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- end::Scrolltop -->

		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

	</body>
</html>