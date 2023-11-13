<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdgs_model extends CI_Model {

	function tambah_sdgs(){
        $post = $this->input->post();
        //show_array($post); exit;
        $id = $post['id'];

        $cek = $this->db->where('id', $id)->get('sdgs')->row_array();

        $config['upload_path']          = './uploads/sdgs/';
		$config['allowed_types']        = 'jpg|png';
		//$config['overwrite']            = false;
		//$config['encrypt_name']			= true;
		$config['max_size']             = 1024; // 1MB

		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('gambar')){
        	$data =  $this->upload->data();
        	$post['gambar'] = $data['file_name'];
        }

        $post['gambar'] = $post['gambar'] ? $post['gambar'] : $cek['gambar'];
        unset($post['id']);

        if($cek > 0){
        	if ($post['gambar'] <> $cek['gambar']) {
        		delete_file('sdgs',$cek['gambar']);
        	}
            $this->db->where('id',$id)->update('sdgs',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Diupdate");
        }
        else{
            $this->db->insert('sdgs',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Disimpan");
        }
        
        return $ket;
    }

    function hapus_sdgs($id){
		$db = $this->db->where('id',$id)->get('sdgs')->row_array();

		$this->db->where('id',$id)->delete('sdgs');
        delete_file('sdgs',$db['gambar']);

        $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        
        return $ket;
    }

    function target_sdgs($sdgs_id){
        $sesi = $this->session->userdata('user_dataku');
        if ($sesi['level'] == 0) {
            $this->db->where('id_dinas', $sesi['id_dinas']);
        }

        $this->db->where('sdgs_id', $sdgs_id);
        $this->db->where('parent_id', 0);
        $db = $this->db->get('sdgs_val')->result();

        $arr = array();
        $n = 0; foreach ($db as $row): $n++;
            $target = $sdgs_id.'.'.$row->kode.'.';

            $arr[] = array(
                'target' => 'Target '. $target .' '.$row->indikator,
                'sdgs_id' => $sdgs_id,
                'target_id' => $row->id,
                'kode' => $row->kode,
                'id_dinas' => $row->id_dinas
            ); 
        endforeach;

        return $arr;
    }

    function tambah_target(){
        $post = $this->input->post();
        $id = $post['id'];

        $cek = $this->db->where('id', $id)->get('sdgs_val')->row_array();

        unset($post['id']);
        unset($post['nama_elemen']);

        if($cek > 0){
            $this->db->where('id',$id)->update('sdgs_val',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Diupdate");
        }
        else{
            $this->db->insert('sdgs_val',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Disimpan");
        }
        
        return $ket;
    }

    function sdgs_val($param){
        $sesi = $this->session->userdata('user_dataku');

        $this->db->select('*, sv.id as sv_id');
        $this->db->from('sdgs_val sv');
        $this->db->join('elemen e', 'e.id = sv.elemen_id', 'left');
        $this->db->where('sv.parent_id', $param['id']);
        if ($sesi['level'] == 0) {
            $this->db->where('sv.id_dinas', $sesi['id_dinas']);
        }


        ($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');

        $res = $this->db->get();

        return $res;
    }

    function hapus_sdgs_val($id){
        $cek = $this->db->where('id',$id)->get('sdgs_val')->row_array();
        if ($cek['parent_id'] == 0) {
            $this->db->where('id',$id)->delete('sdgs_val');
            $this->db->where('parent_id',$id)->delete('sdgs_val');
            $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        }
        else{
            $this->db->where('id',$id)->delete('sdgs_val');
            $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        }

        return $ket;
    }

    function sdgs_val_elemen($param){
        $this->db->select('*');
        $this->db->from('elemen e');

        if($param['elemen'] <> '') {
            $this->db->like('e.nama_elemen',$param['elemen'], TRUE);
        }

        if($param['id_urusan'] <> '') {
            $this->db->where('e.id_urusan',$param['id_urusan']);
        }

        ($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');

        $res = $this->db->get();

        return $res;
    }

}

/* End of file Sdgs_model.php */
/* Location: ./application/models/Sdgs_model.php */