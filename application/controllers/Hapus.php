<?php 
require_once APPPATH . 'core/Admin_core.php';

class Hapus extends Admin_core {

	function __construct(){
        parent::__construct();
    }

	function index(){
		redirect('admin');
	}

	function ikk(){
		$this->load->model('Ikk_model', 'model');
		$data = $this->model->hapus();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function urusan($id){
		$this->load->model('Master_model', 'mm');
		$data = $this->mm->hapus_urusan($id);
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function dinas($id){
		$this->load->model('Master_model', 'mm');
		$data = $this->mm->hapus_dinas($id);
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function data_utama(){
		$this->load->model('Data_utama_model', 'dum');
        $data = $this->dum->hapus_data_utama();
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function user($id){
		$this->load->model('Master_model', 'mm');
		$data = $this->mm->hapus_user($id);
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function sdgs($id){
		$this->load->model('Sdgs_model', 'sm');
		$data = $this->sm->hapus_sdgs($id);
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function sdgs_val($id){
		$this->load->model('Sdgs_model', 'sm');
		$data = $this->sm->hapus_sdgs_val($id);
		
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}
}

/* End of file hapus.php */
/* Location: ./application/controllers/hapus.php */