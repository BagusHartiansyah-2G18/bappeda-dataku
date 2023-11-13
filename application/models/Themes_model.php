<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Themes_model extends CI_Model {

	function css_admin(){
		$css = '<link href="'.base_url().'assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css">
		<link href="'.base_url().'assets/css/style.bundle.css" rel="stylesheet" type="text/css">
		<link href="'.base_url().'assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="'.base_url().'assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="'.base_url().'assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="'.base_url().'assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />
		<link href="'.base_url().'assets/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css"/>';

		return $css;
	}
	
	function js_admin(){
		$js = '<script src="'.base_url().'assets/plugins/global/plugins.bundle.js"></script>
		<script src="'.base_url().'assets/js/scripts.bundle.js"></script>
		<script src="'.base_url().'assets/js/pages/dashboard.js"></script>';

		return $js;
	}

	function css_home(){
		$css = '<link rel="stylesheet" href="'.base_url().'assets/home/css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="'.base_url().'assets/home/style.css" type="text/css" />

		<link rel="stylesheet" href="'.base_url().'assets/home/css/dark.css" type="text/css" />
		<link rel="stylesheet" href="'.base_url().'assets/home/css/font-icons.css" type="text/css" />
		<link rel="stylesheet" href="'.base_url().'assets/home/css/animate.css" type="text/css" />
		<link rel="stylesheet" href="'.base_url().'assets/home/css/magnific-popup.css" type="text/css" />

		<!-- Bootstrap Switch CSS -->
		<link rel="stylesheet" href="'.base_url().'assets/home/css/components/bs-switches.css" type="text/css" />
		<link rel="stylesheet" href="'.base_url().'assets/home/css/responsive.css" type="text/css" />
		
		<!-- Seo Demo Specific Stylesheet -->
		<link rel="stylesheet" href="'.base_url().'assets/home/css/colors.php?color=FE9603" type="text/css" />';

		return $css;
	}
	
	function js_home(){
		$js = '<script src="'.base_url().'assets/home/js/jquery.js"></script>
	<script src="'.base_url().'assets/home/js/plugins.js"></script>
	<script src="'.base_url().'assets/home/js/functions.js"></script>';

		return $js;
	}

	function datatable(){
		$plugins = '<link href="'.base_url().'/assets/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
		<link href="'.base_url().'/assets/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<script src="'.base_url().'/assets/plugins/custom/datatables.net/js/jquery.dataTables.js"></script>
		<script src="'.base_url().'/assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
		<script src="'.base_url().'/assets/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js"></script>
		<script src="'.base_url().'/assets/plugins/custom/datatables.net-rowgroup-bs4/js/rowGroup.bootstrap4.min.js"></script>';

		return $plugins;
	}

	function jstree(){
		$plugins = '<link rel="stylesheet" href="'.base_url().'/assets/home/js/jstree/style.min.css" type="text/css" />
		<script src="'.base_url().'/assets/home/js/jstree/jstree.min.js"></script>';

		return $plugins;

	}

	function chart(){
		$plugins = '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="'.base_url().'assets/home/js/chart-utils.js"></script>';

		return $plugins;
	}

	function tinymce(){
		$plugins = '<script src="'.base_url().'/assets/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>';

		return $plugins;
	}


}

/* End of file themes_model.php */
/* Location: ./application/models/themes_model.php */