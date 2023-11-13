<?php 

class Home_core extends CI_Controller {

	var $title; 
	var $content;
	function __construct(){
		parent::__construct();
	}

	function set_title($str){
		$this->title = $str;
	}

	function set_content($str) {
		$this->content = $str;
	}

	function render(){
		$this->load->model('Themes_model');
		
		$data['title'] = $this->title;
		$data['content'] = $this->content;
		$data['css'] = $this->Themes_model->css_home();
		$data['js'] = $this->Themes_model->js_home();
		$data['menu'] = $this->uri->segment(2);
		//show_array($data); exit();
		$this->load->view("themes/home",$data);
	}
}
?>