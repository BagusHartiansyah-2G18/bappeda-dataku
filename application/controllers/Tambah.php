<?php
require_once APPPATH . 'core/Admin_core.php';

class Tambah extends Admin_core {

	function __construct(){
        parent::__construct();
    }

	function index(){
		redirect('admin');
	}

	function ikk(){
		$this->load->model('Ikk_model', 'im');
		$data = $this->im->tambah();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function urusan(){
		$this->load->model('Master_model', 'mm');
		$data = $this->mm->tambah_urusan();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function dinas(){
		$this->load->model('Master_model', 'mm');
		$data = $this->mm->tambah_dinas();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function data_utama(){
		$this->load->model('Data_utama_model', 'dum');
        $data = $this->dum->tambah_data_utama();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function user(){
		$this->load->model('Master_model', 'mm');
		$data = $this->mm->tambah_user();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function sdgs(){
		$this->load->model('Sdgs_model', 'sm');
		$data = $this->sm->tambah_sdgs();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function target(){
		$this->load->model('Sdgs_model', 'sm');
		$data = $this->sm->tambah_target();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

}

/* End of file tambah.php */
/* Location: ./application/controllers/tambah.php */