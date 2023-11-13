<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cari_model extends CI_Model {


    function tahun($id, $thn){
        $db = $this->db->where('id_elemen',$id)->where('tahun',$thn)->get('elemen_val')->row_array();
        $db['nilai'] = $db > 0 ? $db['nilai'] : '-';
        return $db['nilai'];
    }

    function hasil_cari($get){
        $hasil = array();
        $head = array();
        $tahun = date("Y");

        $get = explode(' ', $get);

        for ($i=0; $i < count($get); $i++) { 
            $this->db->like('nama_elemen', $get[$i], TRUE);
        }
        $db = $this->db->get('elemen')->result();

        foreach ($db as $row) {
            $arr_par = $this->db->where('id',$row->id_parent)->get('elemen')->row_array();
            $arr_dinas = $this->db->where('id', $row->id_dinas)->get('m_dinas')->row_array();
            $arr_ur = $this->db->where('id', $row->id_urusan)->get('m_urusan')->row_array();

            $row->parent = ($arr_par > 0) ? $arr_par['nama_elemen'] : $row->nama_elemen;
            $row->judul = $row->nama_elemen;
            $row->dinas = $arr_dinas['nama_panjang'];
            $row->urusan = $arr_ur['urusan'];

            for ($i=4; $i >= 0; --$i) {
                $row->tahun[] = $tahun-$i;
            }
            $row->tahun = implode(',',$row->tahun);

            for ($i=4; $i >= 0; --$i) {
                $n = $this->tahun($row->id, ($tahun-$i));
                $row->nilai[] = $n == "-" ? 0 : $n;
            }
            $row->nilai = implode(',', $row->nilai);

            $hasil[] = $row;
        }

        return $hasil;
    }
    


}

/* End of file Cari_model.php */
/* Location: ./application/models/Cari_model.php */