<?php
require_once APPPATH . 'core/Home_core.php';

class Home extends Home_core {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Themes_model', 'tm');
        $this->load->model('Home_model', 'hm');
        $this->load->model('Grafik_model', 'gm');
        $this->load->model('Cari_model', 'cm');
    }

	function index(){
        $data['css'] = $this->tm->css_home();
        $data['js'] = $this->tm->js_home();
		$data['title'] = 'Aplikasi E-Database';

        $data['sdgs'] = $this->db->get('sdgs')->result();
        $data['data_utama'] = $this->db->where('aktif', 1)->get('m_urusan')->result();
		//show_array($data); exit;

        $this->load->view('themes/beranda', $data);

	}

    function ikk($id = null){
        $data['title'] = 'Indikator Kinerja Kunci (IKK)';

        if (!isset($id)){
            $this->db->select('*, ikk.id as id');
            $this->db->from('ikk');
            $this->db->join('m_urusan', 'm_urusan.id = ikk.id_urusan');
            $data['ikk'] = $this->db->get()->result();

            $content = $this->load->view('home/d_ikk', $data, true);

        }
        else{
            $row = $this->db->where('id', $id)->get('m_urusan')->row_array();
            $data['sub_ttl'] = $row['urusan'];
            $data['gambar'] = $row['gambar'] ? $row['gambar'] : 'default.jpg';
            $data['desk_ikk'] = $row['desk_ikk'];
            $data['chart'] = $this->gm->ikk_chart($id);
            $data['plugin'] = $this->tm->chart();
            $content = $this->load->view('home/ikk', $data, true);
        }

        // show_array($data); exit();

        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();
    }


    function sdgs($id = null){
        if (!isset($id)){
            $data = $this->db->where('id',$id)->get('sdgs')->row_array();
            $data['title'] = 'Sustainable Development Goals';
            $data['sdgs'] = $this->db->get('sdgs')->result();
            $content = $this->load->view('home/d_sdgs', $data, true);
        }
        else{
            $data = $this->db->where('id',$id)->get('sdgs')->row_array();
            $data['title'] = $data['nama'];
            $data['sub_ttl'] = 'Sustainable Development Goals';
            $data['target'] = $this->hm->target($id);
            $content = $this->load->view('home/sdgs', $data, true);
        }

        //show_array($data); exit;

        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();
    }

    function data_utama($id = null){
        if (!isset($id)){
            $data['title'] = 'Data Utama';
            $data['data_utama'] = $this->db->where('aktif', 1)->get('m_urusan')->result();
            $content = $this->load->view('home/d_data_utama', $data, true);
        }
        else{
            $row = $this->db->where('id', $id)->get('m_urusan')->row_array();
            $data['title'] = 'Data Utama';
            $data['sub_ttl'] = $row['urusan'];
            $data['chart'] = $this->gm->data_utama_chart($id,3);
            $data['plugin'] = $this->tm->chart();
            $content = $this->load->view('home/data_utama', $data, true);
        }

        //show_array($data); exit();

        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();

    }

    function data_dasar(){
        $data['title'] = 'Data Dasar';
        $data['plugin'] = $this->tm->jstree().'
                        '.$this->tm->datatable().'
                        '.$this->tm->chart();
        
        //show_array($data); exit;

        $content = $this->load->view('home/data_dasar', $data, true);
        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();
    }

    function list_data_dasar(){
        $data  = $this->hm->list_data_dasar();
        echo json_encode($data);
    }

    function val_data_dasar(){
        $data  = $this->hm->val_data_dasar();
        echo json_encode($data);
    }

    function get_chart($id){
        $data  = $this->gm->get_chart($id);
        //show_array($data); exit();
        echo json_encode($data);
    }

    function cari(){
        $data['hasil'] = array();
        $get = $this->input->get();

        if (count($get) > 0) {
            if (isset($get['d']) && !empty($get['d'])) {
                $data['hasil'] = $this->cm->hasil_cari($get['d']);
            }
        }
        
        $data['title'] = 'Hasil Pencarian...';
        $data['plugin'] = $this->tm->chart();

        //show_array($data); exit();

        $content = $this->load->view('home/cari', $data, true);
        $this->set_title($data['title']);
        $this->set_content($content);
        $this->render();

    }

}