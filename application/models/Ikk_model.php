<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ikk_model extends CI_Model {

    function __construct()
    {
        $this->load->model('Master_model', 'mm');
        $this->load->model('Themes_model', 'tm');
        $this->model = 'IKK';
    }

    function index($param = null)
    {
        $data['title'] = 'Data '. $this->model;
        $data['datatable'] = $this->tm->datatable();
        $data['menu'] =$this->uri->segment(2);
        $data['sesi'] = $this->session->userdata('user_dataku');
        $data['js'] = '<script src="'.base_url().'/assets/datajs/ikk.js"></script>';

        $arr_urusan = $this->mm->list_urusan();
        $arr_urusan = arr_dropdown2($arr_urusan, 'id', 'urusan');
        $data['arr_urusan'] = add_arr_head($arr_urusan,'','- Pilih Urusan -');

        $arr_dinas = $this->mm->list_dinas();
        $arr_dinas = arr_dropdown2($arr_dinas, 'id', 'nama_panjang');
        $data['arr_dinas'] = add_arr_head($arr_dinas,'','- Pilih Dinas -');

        $content = $this->load->view('admin/'.strtolower($this->model), $data, true);

        //=============== FORM =========================================
        $data['js'] = '<script src="'.base_url().'/assets/datajs/ikk_form.js"></script>';
        
        if ($param == 'tambah') {            
            $data['title'] = 'Tambah Data '. $this->model;
            $data['action'] = 'tambah';
            $data['data_2'] = [];
            $data['data_1'] = [];

            $content = $this->load->view('admin/form/'.strtolower($this->model), $data, TRUE);
        }

        if ($param == 'edit') {
            $get = $this->input->get();
            if (!isset($get['id']) || $get['id'] == null) {
                redirect('admin/'.strtolower($this->model));
            }
            $res = $this->db->where('id', $get['id'])->get(strtolower($this->model))->row_array();
            $el_1 = $this->db->where('id', $res['data_1'])->get('elemen')->row_array();


            $res['data_2'] = unserialize($res['data_2']);
            $res['data_1'] = unserialize($res['data_1']);

            foreach ($res['data_2'] as $row) {
                $el = $this->db->where('id', $row)->get('elemen')->row_array();
                $res['d2_urusan'] = $el['id_urusan'];
                $arr_el2[] = [
                    'id_el' => $row,
                    'nama_elemen' => $el['nama_elemen']
                ];
            }

            foreach ($res['data_1'] as $row) {
                $el = $this->db->where('id', $row)->get('elemen')->row_array();
                $res['d1_urusan'] = $el['id_urusan'];
                $arr_el1[] = [
                    'id_el' => $row,
                    'nama_elemen' => $el['nama_elemen']
                ];
            }

            $res['data_1'] = $arr_el1;
            $res['data_2'] = $arr_el2;
            
            // $res['d1_urusan'] = $el_1['id_urusan'];
            
            $data['title'] = 'Edit Data ' . $this->model;
            $data['action'] = 'tambah';
            $data = array_merge($data, $res);

            //show_array($data); exit();
            $content = $this->load->view('admin/form/'. strtolower($this->model), $data, TRUE);
        }

        return ['title' => $data['title'], 'content' => $content];
    }

    function data($param = null){
        $this->db->select('*, ikk.id as id_ikk');
        $this->db->from('ikk');
        $this->db->join('m_urusan', 'm_urusan.id = ikk.id_urusan', 'left');
        if ($param['urusan'] != '') {
            $this->db->where('ikk.id_urusan', $param['urusan']);
        }
        $db = $this->db->get()->result_array();

        //================= GET TAHUN ===================
        $arr_thn = array('','','','','');
        if (isset($param['tahun']) && $param['tahun'] != null) {
            $max = ($param['tahun'] + 4);
            $arr_thn = range($param['tahun'], $max);
        }
        //================== END TAHUN ==================
        
        $arr = [];

        foreach ($db as $row) {
            $nilai = ['nilai_1' => $row['data_1'], 'nilai_2'=>$row['data_2']];
            $row['tahun1'] = $this->total(array_merge($nilai,['tahun'=>$arr_thn[0]]));
            $row['tahun2'] = $this->total(array_merge($nilai,['tahun'=>$arr_thn[1]]));
            $row['tahun3'] = $this->total(array_merge($nilai,['tahun'=>$arr_thn[2]]));
            $row['tahun4'] = $this->total(array_merge($nilai,['tahun'=>$arr_thn[3]]));
            $row['tahun5'] = $this->total(array_merge($nilai,['tahun'=>$arr_thn[4]]));

            $arr[] = $row;
        }

        return $arr;
    }


    function nilai_2($id = null, $tahun = null){
        $id = unserialize($id);
        $arr = [];

        foreach ($id as $row) {
            $this->db->select('*');
            $this->db->from('elemen_val');
            $this->db->where('id_elemen', $row);
            $this->db->where('tahun', $tahun);
            $db = $this->db->get()->row_array();

            $arr[] = $db['nilai'];

        }

        return array_sum($arr);
    }

    function total($param){
        $nilai_1 = $this->nilai_2($param['nilai_1'], $param['tahun']);
        $nilai_2 = $this->nilai_2($param['nilai_2'], $param['tahun']);

        $total = 0;

        if ($nilai_2 != 0) {
            $total = round($nilai_1 / $nilai_2 * 100);
        }

        return $total;
        
    }

    function tambah(){
        $post = $this->input->post();
        $id = $post['id'];
        //show_array($post); exit();
        
        $cek = $this->db->where('id', $id)->get('ikk')->row_array();
        unset($post['id']);
        unset($post['d1_urusan']);
        unset($post['d2_urusan']);
        unset($post['nama_elemen']);
        $post['data_1'] = serialize($post['data_1']);
        $post['data_2'] = serialize($post['data_2']);

        if($cek > 0){
            $this->db->where('id',$id)->update('ikk',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Diupdate");
        }
        else{
            $this->db->insert('ikk',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Disimpan");
        }
        
        return $ket;
    }

    function hapus(){
        $id = $this->input->post('id');
        $db = $this->db->where_in('id',$id)->get('ikk')->result();

        foreach ($db as $row) {
            $this->db->where('id',$row->id)->delete('ikk');  
        }
        
        $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        
        return $ket;
    }

}

/* End of file Ikk_model.php */
/* Location: ./application/models/Ikk_model.php */