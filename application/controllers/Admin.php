<?php
require_once APPPATH . 'core/Admin_core.php';

class Admin extends Admin_core {
    
    function __construct(){
        parent::__construct();
    }

	function index(){

		$data['title'] = 'Beranda';
        
		//show_array($data); exit;

        $content = $this->load->view('admin/beranda', $data, true);
        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();

	}

    function ikk($param = null)
    {
        $this->load->model('Ikk_model', 'model');
        $data = $this->model->index($param);

        $this->set_title($data['title']);
        $this->set_content($data['content']);
        $this->render();
    }

    function urusan(){
        $this->load->model('Master_model', 'mm');
        $this->load->model('Themes_model', 'tm');
        $get = $this->input->get();

        $data['title'] = 'Urusan';
        $data['data'] = $this->mm->list_urusan();
        $data['sesi'] = $this->session->userdata('user_dataku');
        //show_array($data); exit;
        $data['plugin'] = $this->tm->tinymce();
        $data['js'] = '<script src="'.base_url().'/assets/datajs/urusan.js"></script>';
        $content = $this->load->view('admin/urusan', $data, true);

        if (count($get) > 0) {

//================ TAMBAH URUSAN ========================            
            if (isset($get['u'])) {
                unset($data['data']);
                $data['js'] = '<script src="'.base_url().'/assets/datajs/urusan_form.js"></script>';

                if ($get['u'] == 'baru') {
                    $data['title'] = 'Tambah Urusan Baru';
                }
                else{
                    $db = $this->db->where('id', $get['u'])->get('m_urusan')->row_array();
                    if ($db > 0) {
                        $db['aktif'] = $db['aktif'] == 1 ? 'checked="checked"' : "";
                        $data = array_merge($db, $data);
                        $data['title'] = 'Edit Urusan "'.ucwords(strtolower($db['urusan'])).'"';
                    }
                    else{
                        redirect('admin/urusan');
                    }
                }
                //show_array($data); exit;
                $content = $this->load->view('admin/form/urusan', $data, true);
            }

            else{
                redirect('admin/urusan');
            }
        }

        //show_array($data); exit;

        
        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();
    }

    function dinas(){
        $this->load->model('Master_model', 'mm');
        $get = $this->input->get();

        $data['title'] = 'Dinas';
        $data['data'] = $this->mm->list_dinas();
        $data['sesi'] = $this->session->userdata('user_dataku');
        $data['bidang'] = $this->db->get('m_bidang')->result();
        $data['js'] = '<script src="'.base_url().'/assets/datajs/dinas.js" type="text/javascript"></script>';
        $content = $this->load->view('admin/dinas', $data, true);

//================ TAMBAH DINAS =======================
        if (count($get) > 0) {
            if (isset($get['d'])) {
                $data['js'] = '<script src="'.base_url().'/assets/datajs/dinas_form.js"></script>';

                if ($get['d'] == 'baru') {
                    $data['title'] = 'Tambah Dinas Baru';
                }
                else{
                    $db = $this->db->where('id', $get['d'])->get('m_dinas')->row_array();
                    if ($db > 0) {
                        $data = array_merge($db, $data);
                        $data['title'] = 'Edit Dinas "'.ucwords(strtolower($db['nama_panjang'])).'"';
                    }
                    else{
                        redirect('admin/dinas');
                    }
                }
                //show_array($data); exit;
                $content = $this->load->view('admin/form/dinas', $data, true);
            }

            else{
                redirect('admin/dinas');
            }
        }

        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();
    }

    function data_utama(){
        $this->load->model('Master_model', 'mm');
        $this->load->model('Themes_model', 'tm');
        $this->session_du();


        $get = $this->input->get();

        $arr_urusan = $this->mm->list_urusan();
        $arr_urusan = arr_dropdown2($arr_urusan, 'id', 'urusan');
        $data['title'] = 'Data Utama';
        $data['arr_urusan'] = add_arr_head($arr_urusan,'','- Pilih Urusan -');
        $data['js'] = '<script src="'.base_url().'/assets/datajs/data_utama.js"></script>';
        $data['datatable'] = $this->tm->datatable();
        $content = $this->load->view('admin/data_utama', $data, true);

//================ TAMBAH DATA UTAMA =======================
        if (count($get) > 0) {
            if (isset($get['du'])) {
                $data['js'] = '<script src="'.base_url().'/assets/datajs/data_utama_form.js"></script>';

                $arr_dinas = $this->mm->list_dinas();
                $arr_dinas = arr_dropdown2($arr_dinas, 'id', 'nama_panjang');
                $data['arr_dinas'] = add_arr_head($arr_dinas,'','- Pilih Dinas -');

                if ($get['du'] == 'baru') {
                    $data['title'] = 'Tambah Data Utama Baru';
                    $data['nilai'] = array();
                }
                else{
                    $db = $this->db->where('id', $get['du'])->get('elemen')->row_array();
                    $nilai = $this->db->where('id_elemen', $get['du'])->get('elemen_val')->result();
                    if ($db > 0) {
                        $data = array_merge($db, $data);
                        $data['title'] = 'Edit Data Utama "'.ucwords(strtolower($db['nama_elemen'])).'"';
                        $data['nilai'] = $nilai;
                    }
                    else{
                        redirect('admin/data_utama');
                    }
                }
                //show_array($data); exit;
                $content = $this->load->view('admin/form/data_utama', $data, true);
            }

            else{
                redirect('admin/data_utama');
            }
        }

        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();
    }

    function sdgs(){
        $this->load->model('Sdgs_model', 'sm');
        $get = $this->input->get();

        $data['title'] = 'Sustainable Development Goals';
        $data['sesi'] = $this->session->userdata('user_dataku');
        $data['sdgs'] = $this->db->get('sdgs')->result();
        $data['js'] = '<script src="'.base_url().'/assets/datajs/sdgs.js"></script>';
        $content = $this->load->view('admin/sdgs', $data, true);

//================ TAMBAH SDGS =======================
        if (count($get) > 0) {
            $this->load->model('Themes_model', 'tm');
            $this->load->model('Master_model', 'mm');
            $data['datatable'] = $this->tm->datatable();
            unset($data['sdgs']);

            if (isset($get['form'])) {
                unset($data['datatable']);
                $data['js'] = '<script src="'.base_url().'/assets/datajs/sdgs_form.js"></script>';

                if ($get['form'] == 'baru') {
                    $data['title'] = 'Tambah Sustainable Development Goals Baru';
                }
                else{
                    $db = $this->db->where('id', $get['form'])->get('sdgs')->row_array();
                    if ($db > 0) {
                        $data = array_merge($db, $data);
                        $data['title'] = 'Edit Data SDGS "'.ucwords(strtolower($db['nama'])).'"';
                    }
                    else{
                        redirect('admin/sdgs');
                    }
                }
                //show_array($data); exit;
                $content = $this->load->view('admin/form/sdgs', $data, true);
            }

            if (isset($get['detail'])) {
                $data['sdgs_id'] = $get['detail'];
                $data['js'] = '<script src="'.base_url().'/assets/datajs/detail_sdgs.js"></script>';
                $data['target'] = $this->sm->target_sdgs($get['detail']);
                $sdgs = $this->db->where('id',$get['detail'])->get('sdgs')->row_array();
                $data['title'] = 'Detail SDGS "'.ucwords(strtolower($sdgs['nama'])).'"';
                $arr_dinas = $this->mm->list_dinas();
                $arr_dinas = arr_dropdown2($arr_dinas, 'id', 'nama_panjang');
                $data['arr_dinas'] = add_arr_head($arr_dinas,'','- Pilih Dinas -');

                //show_array($data); exit;
                $content = $this->load->view('admin/detail_sdgs', $data, true);
            }

            if (isset($get['detail']) && isset($get['target']) && isset($get['val'])) {
                unset($data['target']);

                $arr_urusan = $this->mm->list_urusan();
                $arr_urusan = arr_dropdown2($arr_urusan, 'id', 'urusan');
                $arr_dinas = $this->mm->list_dinas();
                $arr_dinas = arr_dropdown2($arr_dinas, 'id', 'nama_panjang');

                $data['arr_dinas'] = add_arr_head($arr_dinas,'','- Pilih Dinas -');
                $data['arr_urusan'] = add_arr_head($arr_urusan,'','- Pilih Urusan -');
                $data['js'] = '<script src="'.base_url().'/assets/datajs/sdgs_val_form.js"></script>';
                $data['parent_id'] = $get['target'];

                if ($get['val'] == 'baru') {
                    $data['title'] = 'Tambah Indikator Sustainable Development Goals';
                }
                else{
                    $db = $this->db->where('id', $get['val'])->get('sdgs_val')->row_array();
                    if ($db > 0) {
                        $el = $this->db->where('id', $db['elemen_id'])->get('elemen')->row_array();
                        $data = array_merge($db, $data);
                        $data['nama_elemen'] = $el['nama_elemen'];
                        $data['title'] = 'Edit Indikator "'.ucwords(strtolower($db['indikator'])).'"';
                    }
                    else{
                        redirect('admin/sdgs');
                    }
                }
                //show_array($data); exit;
                $content = $this->load->view('admin/form/sdgs_val', $data, true);
            }
        }
        
        //show_array($data); exit;

        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();

    }

    function user(){
        $this->load->model('Master_model', 'mm');
        $get = $this->input->get();

        $data['title'] = 'Pengguna';
        $data['sesi'] = $this->session->userdata('user_dataku');
        $data['data'] = $this->mm->list_user();
        $data['js'] = '<script src="'.base_url().'/assets/datajs/user.js" type="text/javascript"></script>';
        
        $content = $this->load->view('admin/user', $data, true);

//================ TAMBAH USER =======================
        if (count($get) > 0) {
            if (isset($get['p'])) {
                unset($data['data']);
                $data['js'] = '<script src="'.base_url().'/assets/datajs/user_form.js"></script>';
                $arr_dinas = arr_dropdown('m_dinas', 'id', 'nama_panjang', 'nama_panjang');
                $data['arr_dinas'] = add_arr_head($arr_dinas,'','- Pilih Dinas -');
                $data['urusan'] = $this->db->get('m_urusan')->result();

                if ($get['p'] == 'baru') {
                    $data['title'] = 'Tambah Pengguna Baru';
                    $data['akses'] = array();
                    $data['level'] = '';
                }
                else{
                    $db = $this->db->where('id_user', $get['p'])->get('m_user')->row_array();
                    $db['akses'] = unserialize($db['akses']);
                    if ($db > 0) {
                        $data = array_merge($db, $data);
                        $data['title'] = 'Edit Pengguna "'.ucwords(strtolower($db['nama'])).'"';
                    }
                    else{
                        redirect('admin/user');
                    }
                }
                //show_array($data); exit;
                $content = $this->load->view('admin/form/user', $data, true);
            }

            else{
                redirect('admin/user');
            }
        }

        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();
    }
    
    function session_du($reload = null){
        $this->load->model('Data_utama_model', 'dum');
        $sesi = $this->session->userdata();

        $get = $this->input->get();

        $req_param = array(
            "urusan" => isset($get['u']) ? $get['u'] : null,
            'tahun' => isset($get['t']) ? $get['t'] : null,
        );

        if (isset($sesi['data_utama']) && $req_param['urusan'] == null && $req_param['tahun'] == null) {
            return false;
        }
        else{
            return $this->dum->data_utama($req_param);
        }
    }

    function session_du_h(){
        $data = $this->session_du();

        echo json_encode('sukses');
    }

    function logout()
    {
        $this->session->unset_userdata("user_dataku");
        $this->session->unset_userdata("data_utama");
        redirect();
    }
}