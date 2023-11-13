<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_utama_model extends CI_Model {

	function get_elemen($id = null, $thn = null){
        $s = $this->session->userdata('user_dataku');
        $this->db->select('*');
        $this->db->from('elemen');
        $this->db->where('id_parent', 0);
        //$this->db->order_by('id', 'asc');
        $this->db->order_by('id_urusan', 'asc');

        if ($s['level'] == 0) {
            $s['akses'] = unserialize($s['akses']);
            $this->db->where_in('id_urusan', $s['akses']);
        }

        $parent = $this->db->get();

        $arr = array();

        $i=0; foreach ($parent->result() as $el) : $i++;

            $val = $this->db->where('id_elemen', $el->id)->get('elemen_val')->result();
            foreach ($val as $val) {
                if ($val->tahun == $thn) {
                    $el->tahun[] = $val;
                }

                if (!isset($thn)) {
                    $el->tahun[] = $val;
                }
                
            }

            $el->sub = $this->sub_elemen($el->id, $thn);
            $el->tahun = isset($el->tahun) ? $el->tahun : array();

            if ($el->id == $id) {
                $arr[] = $el;
            }
            
            if (!isset($id)) {
                $arr[] = $el;
            }

        endforeach;

        return $arr;
        
    }

    function sub_elemen($id, $thn = null){
        $this->db->select('*');
        $this->db->from('elemen');
        $this->db->where('id_parent', $id);
        $child = $this->db->get();

        $arr = array();
        $i=0; foreach ($child->result() as $el) : $i++;
            $val = $this->db->where('id_elemen', $el->id)->get('elemen_val')->result();
            foreach ($val as $val) {
                if ($val->tahun == $thn) {
                    $el->tahun[] = $val;
                }

                if (!isset($thn)) {
                    $el->tahun[] = $val;
                }
            }

            $el->sub = $this->sub_elemen($el->id, $thn);
            $el->tahun = isset($el->tahun) ? $el->tahun : array();

            $arr[] = $el;

        endforeach;

        return $arr;

    }

    function data_utama($param = null){
        
        $outputArray = array();
        $inputArray = $this->get_elemen();
        $this->list_nomor($inputArray, $outputArray);
        $arr = array();
        
        foreach ($outputArray as $row) {
            $row['id_el'] = $row['id'].',';
            $this->db->select('*');
            $this->db->from('elemen');

            if (isset($param['urusan']) && $param['urusan'] != null) {
                $this->db->where('id_urusan', $param['urusan']);
            }
            
            $this->db->where('id', $row['id']);
            $db = $this->db->get()->row_array();

            //================= GET TAHUN ===================
            $arr_thn = array('','','','','');
            if (isset($param['tahun']) && $param['tahun'] != null) {
                $max = ($param['tahun'] + 4);
                $arr_thn = range($param['tahun'], $max);
            }
            //================== END TAHUN ==================

            if ($db > 0) {
                if ($db['id_parent'] == 0) {
                    $row['nama_elemen'] = $this->list($row['no'], $db['nama_elemen']);
                    $row['tahun1_val'] = '<b>'.$this->sub_total($row['id'], $arr_thn[0]).'</b>';
                    $row['tahun2_val'] = '<b>'.$this->sub_total($row['id'], $arr_thn[1]).'</b>';
                    $row['tahun3_val'] = '<b>'.$this->sub_total($row['id'], $arr_thn[2]).'</b>';
                    $row['tahun4_val'] = '<b>'.$this->sub_total($row['id'], $arr_thn[3]).'</b>';
                    $row['tahun5_val'] = '<b>'.$this->sub_total($row['id'], $arr_thn[4]).'</b>';
                    $row['satuan'] = '<b>'.$db['satuan'].'</b>';
                }

                else{
                    $row['nama_elemen'] = $this->list2($row['no'], $db['nama_elemen']);
                    $row['tahun1_val'] = $this->sub_total($row['id'], $arr_thn[0]);
                    $row['tahun2_val'] = $this->sub_total($row['id'], $arr_thn[1]);
                    $row['tahun3_val'] = $this->sub_total($row['id'], $arr_thn[2]);
                    $row['tahun4_val'] = $this->sub_total($row['id'], $arr_thn[3]);
                    $row['tahun5_val'] = $this->sub_total($row['id'], $arr_thn[4]);
                    $row['satuan'] = $db['satuan'];
                }

                $arr[] = $row;
            }
        }
        
        $this->session->set_userdata("data_utama",$arr);
    }

	function list_nomor($in, &$out, $prefixLevel = '') {
        $level = 1;
        $last = '';
	    foreach ($in as $v) {
            if ($last != $v->id_urusan) {
                $level = 1;
            }
	        $out[] = array(
                'id' => $v->id,
                //'pr_ur' => prev($v->id_urusan),
                'no' => $prefixLevel . $level .'. ',
            );
	        if (!empty($v->sub)) {
	            $this->list_nomor($v->sub, $out, '&nbsp;&nbsp;&nbsp;&nbsp;'.$prefixLevel . $level . '.');
	        }
            $last = $v->id_urusan;
	        $level++;
	    }
	}

    function total($in, &$out) {
        foreach ($in as $v) {

            if (isset($v->tahun)) {
                foreach ($v->tahun as $t) {
                    $out[] = $t->nilai;
                }
            }

            if (!empty($v->sub)) {
                $this->total($v->sub, $out);
            }            
        }
    }

    function get_sub_id($in, &$out) {
        foreach ($in as $v) {
            $out[] = $v->id;
            if (!empty($v->sub)) {
                $this->get_sub_id($v->sub, $out);
            }
        }
    }

	function sub_total($id = null, $tahun = null){
		$this->db->select('*');
        $this->db->from('elemen_val');
        $this->db->where('id_elemen', $id);
        $this->db->where('tahun', $tahun);

        $db = $this->db->get();

        if ($db->num_rows() > 0) {
            $row = $db->row_array();
            $total = angka($row['nilai']);
        }
        else{
            $total = '-';
        }

        return $total;
	}

    function list($no, $text){
        $l = '<div class="media">
                <span class="mr-2"><b>'.$no.'</b></span>
              <div class="media-body"><b>
              '.$text.'
              </b></div>
            </div>'; 

        return $l;
    }

    function list2($no, $text){
        $l = '<div class="media">
                <span class="mr-2">'.$no.'</span>
              <div class="media-body">
              '.$text.'
              </div>
            </div>'; 

        return $l;
    }

    function tambah_data_utama()
    {
        $post = $this->input->post();
        $id = $post['id'];

        $cek = $this->db->where('id', $id)->get('elemen')->row_array();

        $nilai = isset($post['tahun']) && isset($post['nilai']) ? array_combine($post['tahun'], $post['nilai']) : array();

        unset($post['id']);
        unset($post['tahun']);
        unset($post['nilai']);

        if($cek > 0){
             $this->db->where('id',$id)->update('elemen',$post);

            if (!empty($nilai)) {
                $this->db->where('id_elemen',$id)->delete('elemen_val');
                foreach ($nilai as $key => $value) {
                    $arr[] = array(
                        'tahun' => $key,
                        'nilai' => $value,
                        'id_elemen' => $id,
                    );
                }
                $this->db->insert_batch('elemen_val', $arr);
            }
           
            $ket = array("error"=>false,'message'=>"Data Berhasil Diupdate");
        }

        else{
            $this->db->insert('elemen',$post);
            if (!empty($nilai)) {
                foreach ($nilai as $key => $value) {
                    $arr[] = array(
                        'tahun' => $key,
                        'nilai' => $value,
                        'id_elemen' => $this->db->insert_id(),
                    );
                }
                $this->db->insert_batch('elemen_val', $arr);
            }
            $ket = array("error"=>false,'message'=>"Data Berhasil Disimpan");
        }
        
        $this->data_utama();
        return $ket;
    }


    function hapus_data_utama(){
        $id = $this->input->post('id');
        $db = $this->db->where_in('id',$id)->get('elemen')->result();

        foreach ($db as $row) {
            $db1 = $this->db->where('id',$row->id)->get('elemen')->row_array();
            $db2 = $this->db->where('id_elemen',$row->id)->get('elemen_val')->row_array();

            if ($db1 > 0) {
                $this->db->where('id',$row->id)->delete('elemen');
            }
            if ($db2 > 0) {
                $this->db->where('id_elemen',$row->id)->delete('elemen_val');
            }     
            
        }
        
        $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        
        return $ket;
    }

    function get_par($id){
        $this->db->from('elemen');
        $this->db->where('id_urusan', $id);
        $this->db->where('id_parent', 0);
        $db = $this->db->get()->result();

        $arr = [];
        foreach ($db as $row) {
            $arr[] = [
                'id' => $row->id,
                'nama_elemen' => $row->nama_elemen,
                'sub' => $this->get_par_sub($row->id),
            ];
        }

        return $arr;

    }

    function get_par_sub($id){
        $this->db->from('elemen');
        $this->db->where('id_parent', $id);
        $db = $this->db->get()->result();

        $arr = [];
        foreach ($db as $row) {
            $arr[] = [
                'id' => $row->id,
                'nama_elemen' => $row->nama_elemen,
                'sub' => $this->get_par_sub($row->id),
            ];
        }

        return $arr;
    } 

    function get_par_option($in, &$out, $prefixLevel = ''){
        $id_parent = $this->input->post('id_parent');
        $id_parent = isset($id_parent) ? $id_parent : '';

        //$_out = '<option value="0">- Pilih Elemen Parent -</option>';
        $sel = '';
        $level = 1;

        foreach ($in as $row) {
            $sel = ($id_parent == $row['id']) ? 'selected' : '';
            $elemen = $prefixLevel . $level .'. ' . $row['nama_elemen'];

            $out .= '<option value="'.$row['id'].'" '.$sel.'>'.$elemen.'</option>';

            if (!empty($row['sub'])) {
                $this->get_par_option($row['sub'], $out,'&nbsp;&nbsp;&nbsp;&nbsp;'.$prefixLevel . $level . '.');
            }

            $level++;
        }
    } 

}

/* End of file data_utama_model.php */
/* Location: ./application/models/data_utama_model.php */