<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	function target($sdgs_id){
        $this->db->select('*');
        $this->db->where('sdgs_id', $sdgs_id);
        $this->db->where('parent_id', 0);
        $db = $this->db->get('sdgs_val')->result();

        $arr = array();

        $n = 0; foreach ($db as $row): $n++;
            $target = $sdgs_id.'.'.$row->kode.'.';

            $get = array(
                'parent_id' => $row->id,
                'kode' => $row->kode
            );

            $arr[] = array(
                'target' => 'Target '. $target .' '.$row->indikator,
                'sdgs_val' => $this->sdgs_val($get),
            ); 
        endforeach;

        return $arr;
    }

    function sdgs_val($get){
        $this->db->select('*, sv.id as sv_id');
        $this->db->from('sdgs_val sv');
        $this->db->join('elemen e', 'e.id = sv.elemen_id', 'left');
        $this->db->where('sv.parent_id', $get['parent_id']);

        $db = $this->db->get()->result();

        $arr = array();
        $n = 0; foreach ($db as $row): $n++;
            $kode = $row->sdgs_id .'.'. $get['kode'] .'.'. $n;
            $dinas = $this->db->where('id',$row->id_dinas)->get('m_dinas')->row_array();
            $row->id_dinas = $dinas['nama_panjang'];
            $tahun = date("Y");

            $arr[] = array(
                'kode' => $kode,
                'indikator' => $row->indikator,
                'sumber' => $row->id_dinas,
                'satuan' => $row->satuan,
                'tahun1' => $this->tahun($row->elemen_id, ($tahun-4)),
                'tahun2' => $this->tahun($row->elemen_id, ($tahun-3)),
                'tahun3' => $this->tahun($row->elemen_id, ($tahun-2)),
                'tahun4' => $this->tahun($row->elemen_id, ($tahun-1)),
                'tahun5' => $this->tahun($row->elemen_id, ($tahun)),

            );

        endforeach;

        return $arr;

    }

    function tahun($id, $thn){
        $db = $this->db->where('id_elemen',$id)->where('tahun',$thn)->get('elemen_val')->row_array();
        $db['nilai'] = $db > 0 ? angka($db['nilai']) : '-';
        return $db['nilai'];
    }

    function list_data_dasar(){
		$arr_urusan = array();
		$urusan = $this->db->get('m_urusan')->result();
		foreach ($urusan as $row) {
			$titik = strlen($row->urusan) > 38 ? '...' : '';
			$row->urusan = substr($row->urusan,0,38);

			$arr_urusan[] = array(
				'id' => ($row->id) ? 'u_'.$row->id : 'no_u',
				'parent' => '#',
				'text' => ($row->urusan) ? $row->urusan.''.$titik : 'Urusan',
				'icon' => 'icon-folder',
			);
		}

		$arr_data_par = array();
		$data_par = $this->db->where('id_parent', 0)->get('elemen')->result();
		foreach ($data_par as $row) {
			$titik = strlen($row->nama_elemen) > 35 ? '...' : '';
			$row->nama_elemen = substr($row->nama_elemen,0,35);

			$arr_data_par[] = array(
				'id' => ($row->id) ? 'd_'.$row->id : 'no_d',
				'parent' => ($row->id_urusan) ? 'u_'.$row->id_urusan : 'no_p',
				'text' => ($row->nama_elemen) ? $row->nama_elemen.''.$titik : 'Elemen',
				'icon' => 'icon-line-file',
			);
		}
		
		$marge_arr = array_merge($arr_urusan, $arr_data_par);

		return $marge_arr;
	}

	function get_elemen($id = null, $limit = null){
        $this->db->select('*');
        $this->db->from('elemen');
        $this->db->where('id_parent', 0);
        if ($id) {
        	$this->db->where_in('id', $id);
        }
        if ($limit) {
        	$this->db->limit($limit);
        	$this->db->order_by('id', 'desc');
        }
        $parent = $this->db->get();

        $arr = array();

        $i=0; foreach ($parent->result() as $el) : $i++;
            $el->sub = $this->sub_elemen($el->id);
            $arr[] = $el;
        endforeach;

        return $arr;
    }

    function sub_elemen($id){
        $this->db->select('*');
        $this->db->from('elemen');
        $this->db->where('id_parent', $id);
        $child = $this->db->get();

        $arr = array();
        $i=0; foreach ($child->result() as $el) : $i++;
            $el->sub = $this->sub_elemen($el->id);
            $arr[] = $el;
        endforeach;

        return $arr;
    }

    function get_no($in, &$out, $prefixLevel = '') {
        $level = 1;
        $last = '';
	    foreach ($in as $v) {
            if ($last != $v->id_urusan) {
                $level = 1;
            }
	        $out[] = array(
                'id' => $v->id,
                'no' => $prefixLevel . $level .'. ',
            );
	        if (!empty($v->sub)) {
	            $this->get_no($v->sub, $out, '&nbsp;&nbsp;&nbsp;&nbsp;'.$prefixLevel . $level . '.');
	        }
            $last = $v->id_urusan;
	        $level++;
	    }
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

    function val_data_dasar(){
    	$get = $this->input->get();
    	$tahun = date("Y");
    	$u_id = array();
    	$d_id = array();

    	if (count($get) > 0) {
    		$id = explode(',', $get['id']);
	        $arr_u = array_filter($id,function($var){return(strpos($var,'u_') !== FALSE);});
	        $arr_d = array_filter($id,function($var){return(strpos($var,'d_') !== FALSE);});

	        $u_id = str_replace('u_', '', $arr_u);
	        $d_id = str_replace('d_', '', $arr_d);
    	}

    	$outputArray = array();
    	$inputArray = (count($d_id) > 0) ? $this->get_elemen($d_id) : $this->get_elemen('',1);
        $this->get_no($inputArray, $outputArray);
        $arr = array();
        
        foreach ($outputArray as $row) {
            if (count($u_id) > 0) {
                $this->db->where_in('id_urusan', $u_id);
            }
            $this->db->where('id', $row['id']);
            $db = $this->db->get('elemen')->row_array();

            if ($db > 0) {
                if ($db['id_parent'] == 0) {
                    $row['nama_elemen'] = $this->list($row['no'], $db['nama_elemen']);
                    $row['tahun1'] = '<b>'.$this->tahun($row['id'], ($tahun-4)).'</b>';
                    $row['tahun2'] = '<b>'.$this->tahun($row['id'], ($tahun-3)).'</b>';
                    $row['tahun3'] = '<b>'.$this->tahun($row['id'], ($tahun-2)).'</b>';
                    $row['tahun4'] = '<b>'.$this->tahun($row['id'], ($tahun-1)).'</b>';
                    $row['tahun5'] = '<b>'.$this->tahun($row['id'], ($tahun)).'</b>';
                    $row['satuan'] = '<b>'.$db['satuan'].'</b>';
                    $row['grafik'] = '<button id="'.$row['id'].'" class="button button-mini button-border button-circle button-yellow button-light chart m-0"><i class="icon-chart-line py-0"> </i></button>';
                }

                else{
                    $row['nama_elemen'] = $this->list2($row['no'], $db['nama_elemen']);
                    $row['tahun1'] = $this->tahun($row['id'], ($tahun-4));
                    $row['tahun2'] = $this->tahun($row['id'], ($tahun-3));
                    $row['tahun3'] = $this->tahun($row['id'], ($tahun-2));
                    $row['tahun4'] = $this->tahun($row['id'], ($tahun-1));
                    $row['tahun5'] = $this->tahun($row['id'], ($tahun));
                    $row['satuan'] = $db['satuan'].'</b>';
                    $row['grafik'] = '<button id="'.$row['id'].'" class="button button-mini button-border button-circle button-yellow button-light chart m-0"><i class="icon-chart-line"> </i></button>';
                }

                $arr[] = $row;
            }
        }

        $table['meta'] = array(
            'page' => 1,
            'pages' => 1,
            'perpage' => -1,
            'total' => count($arr),
        );

        $table['data'] = $arr;
        
        return $table;

	}
    
}
