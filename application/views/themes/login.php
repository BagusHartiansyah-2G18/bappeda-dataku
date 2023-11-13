<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title><?php echo $title ?> || Bappeda Litbang KSB</title>
		<meta name="description" content="Updates and statistics">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--- CSS UTAMA --->
		<?php echo $css ?>
		<link href="<?php echo base_url(); ?>/assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />

		<!-- JS UTAMA -->
		<?php echo $js ?>

	</head>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading" style="background-image: url(<?php echo base_url() ?>/assets/media/bg/bg-1.jpg);">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="<?php echo base_url() ?>/uploads/ksb.png">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Aplikasi Dataku</h3>
									<h3 class="kt-login__title">Bappeda Litbang Kab. Sumbawa Barat</h3>
								</div>

								<form class="kt-form mt-1">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Username" id="username" name="username" autocomplete="off">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" id="password" name="password">
									</div>
									<div id="pesan"></div>
									<div class="kt-login__actions">
										<button id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary">Login</button>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->
		<?php echo $datajs ?>
		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var site_url = '<?php echo site_url() ?>';

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
		<!--end::Page Scripts -->
	</body>
	<!-- end::Body -->
</html>