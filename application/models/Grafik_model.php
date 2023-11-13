<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_model extends CI_Model {

	function get_chart($id = null){
        $tahun = date("Y");

        $this->db->where('id', $id);
        $db = $this->db->get('elemen')->row_array();

        for ($i=4; $i >= 0; --$i) {
            $db['tahun'][] = $tahun-$i;
        }

        $db['tahun'] = implode(',',$db['tahun']);

        for ($i=4; $i >= 0; --$i) {
            $hasil = $this->tahun($id, ($tahun-$i));

            $db['tahun_val'][] = $hasil == "-" ? 0 : $hasil;
        }
        $db['tahun_val'] = implode(',', $db['tahun_val']);


        //$this->tahun($row['id'], ($tahun-4));

        return $db;
    }

    function tahun($id, $thn){
        $db = $this->db->where('id_elemen',$id)->where('tahun',$thn)->get('elemen_val')->row_array();
        $db['nilai'] = $db > 0 ? $db['nilai'] : '-';
        return $db['nilai'];
    }

    function data_utama_chart($id, $limit = null){
        $tahun = date("Y");
        $arr = [];

        $db = $this->db->order_by('id', 'random')->where('id_urusan', $id)->get('elemen', $limit)->result();

        foreach ($db as $row) {
            $arr_par = $this->db->where('id',$row->id_parent)->get('elemen')->row_array();
            $arr_dinas = $this->db->where('id', $row->id_dinas)->get('m_dinas')->row_array();

            $row->parent = ($arr_par > 0) ? $arr_par['nama_elemen'] : $row->nama_elemen;
            $row->judul = $row->nama_elemen;
            $row->dinas = $arr_dinas['nama_panjang'];

            for ($i=4; $i >= 0; --$i) {
                $row->tahun[] = $tahun-$i;
            }

            $row->tahun = implode(',',$row->tahun);

            for ($i=4; $i >= 0; --$i) {
                $hasil = $this->tahun($row->id, ($tahun-$i));

                $row->nilai[] = $hasil == "-" ? 0 : $hasil;
            }
            $row->nilai = implode(',', $row->nilai);

            $arr[] = $row;
        }

        return $arr;
    }

    function ikk_chart($id){
        $this->load->model('Ikk_model', 'im');

        $tahun = date("Y");
        $arr = [];

        $this->db->select('*, ikk.id as id, ikk.id_dinas as id_dinas');
        $this->db->from('ikk');
        $this->db->join('m_dinas', 'm_dinas.id = ikk.id_dinas');
        $this->db->where('ikk.id_urusan', $id);
        $db = $this->db->get()->result();

        foreach ($db as $row) {

            $nilai = ['nilai_1' => $row->data_1, 'nilai_2' => $row->data_2];
            $_tahun = [];
            $_nilai = [];

            for ($i=4; $i >= 0; --$i) {
                $_tahun[] = $tahun-$i;
            }
            $_tahun = implode(',',$_tahun);

            for ($i=4; $i >= 0; --$i) {
                $_nilai[] = $this->im->total(array_merge($nilai,['tahun'=>$tahun-$i]));
            }
            $_nilai = implode(',', $_nilai);

            $arr[] = (object)[
                'id' => $row->id,
                'nama_ikk' => $row->nama_ikk,
                'dinas' => $row->nama_panjang,
                'satuan' => 'Porsen (%)',
                'tahun' => $_tahun,
                'nilai' => $_nilai,
            ];
        }

        return $arr;
    }

}

/* End of file Grafik_model.php */
/* Location: ./application/models/Grafik_model.php */