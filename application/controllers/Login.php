<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        if ($this->session->userdata('user_dataku')) {
        	redirect('admin');
        	exit();
        }
    }

	function index(){
		$this->load->model('Themes_model', 'tm');

		$data['css'] = $this->tm->css_admin();
		$data['js'] = $this->tm->js_admin();
		$data['datajs'] = '<script src="'.base_url().'/assets/datajs/login.js"></script>';
		$data['title'] = 'Login';

		$this->load->view('themes/login', $data, False);
	}

	function cek_login(){
		$post = $this->input->post();
		if (!$post) redirect();

		$username = $post['username'];
		$password = $post['password'];

		$db = $this->db->where('username', $username)->get('m_user')->row_array();

		if(password_verify($password, $db['password'])){
			unset($db['password']);
			unset($db['email']);
			unset($db['gambar']);
			$this->session->set_userdata("user_dataku",$db);
			$ket = array("error"=>false,'message'=>"Login berhasil");
		}
		else{
			$ket = array("error"=>true,'message'=>"Login Gagal Silahkan Coba Lagi");
		}
		echo json_encode($ket);
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */