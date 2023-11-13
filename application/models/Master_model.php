<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model {

	function list_urusan(){
		$this->load->helper('array');
        $s = $this->session->userdata('user_dataku');

        if ($s['level'] == 0) {
            $s['akses'] = unserialize($s['akses']);
            $this->db->where_in('id', $s['akses']);
        }

		$db = $this->db->get('m_urusan')->result();

		foreach ($db as $row) {
			$ini = explode(' ',trim($row->urusan));
			$color = array("primary","success","danger","warning","info");
			$row->color = random_element($color);
			$row->ini = strtoupper(substr($ini[0],0,2));
			$arr[] = $row;
		}

		return $arr;
	}

	function list_dinas(){
        $s = $this->session->userdata('user_dataku');

        if ($s['level'] == 0) {
            $this->db->where('id', $s['id_dinas']);
        }
        $db = $this->db->get('m_dinas')->result();

		foreach ($db as $row) {
			$row->nama_pendek = strtoupper($row->nama_pendek);
			$row->nama_panjang = ucwords(strtolower($row->nama_panjang));
			$arr[] = $row;
		}

		return $arr;
	}

	function list_bidang($dinas){
		$dinas = $this->db->where('nama_pendek', $dinas)->get('m_dinas')->row_array();
		$db = $this->db->where('id_dinas', $dinas['id'])->get('m_bidang')->result();

		foreach ($db as $row){
			$row->nama_pendek = strtoupper($row->nama_pendek);
			$row->nama_bidang = ucwords(strtolower($row->nama_bidang));
			$arr[] = $row;
		}

		return $arr;

	}

	function tambah_urusan(){
        $post = $this->input->post();
        $id = $post['id'];
        //show_array($post); exit();
        $cek = $this->db->where('id', $id)->get('m_urusan')->row_array();

        $config['upload_path']          = './uploads/urusan/';
		$config['allowed_types']        = 'jpg|png';
		$config['overwrite']            = false;
		$config['encrypt_name']			= true;
		$config['max_size']             = 1024; // 1MB

		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('gambar')){
        	$data =  $this->upload->data();
        	$post['gambar'] = $data['file_name'];
        }

        $post['gambar'] = $post['gambar'] ? $post['gambar'] : $cek['gambar'];
        $post['aktif'] = isset($post['aktif']) ? 1 : 0;
        unset($post['id']);

        if($cek > 0){
        	if ($post['gambar'] <> $cek['gambar']) {
        		delete_file('urusan',$cek['gambar']);
        	}
            $this->db->where('id',$id)->update('m_urusan',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Diupdate");
        }
        else{
            $this->db->insert('m_urusan',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Disimpan");
        }
        
        return $ket;
    }

    function hapus_urusan($id){
		$db = $this->db->where('id',$id)->get('m_urusan')->row_array();

		$this->db->where('id',$id)->delete('m_urusan');
        delete_file('urusan',$db['gambar']);

        $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        
        return $ket;
    }


    function tambah_dinas()
    {
        $post = $this->input->post();
        $id = $post['id'];

        $cek = $this->db->where('id', $id)->get('m_dinas')->row_array();

        unset($post['id']);

        if($cek > 0){
            $this->db->where('id',$id)->update('m_dinas',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Diupdate");
        }
        else{
            $this->db->insert('m_dinas',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Disimpan");
        }
        
        return $ket;
    }

    function hapus_dinas($id){
		$db = $this->db->where('id',$id)->get('m_dinas')->row_array();

		$this->db->where('id',$id)->delete('m_dinas');

        $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        
        return $ket;
    }

    function list_user(){
        $s = $this->session->userdata('user_dataku');

        if ($s['level'] == 0) {
            $this->db->where('id_user', $s['id_user']);
        }
        $this->db->where('level <>', 9);
    	$db = $this->db->get('m_user')->result();

    	foreach ($db as $row) {
    		$gbr = base_url('uploads/user/');
    		$row->gambar = $row->gambar ? $gbr . $row->gambar : $gbr .'default.jpg';
    		$row->nama = ucwords(strtolower($row->nama));

    		$akses = unserialize($row->akses);

    		$db_u = $this->db->where_in('id', $akses)->get('m_urusan')->result_array();
    		$db_d = $this->db->where('id', $row->id_dinas)->get('m_dinas')->row_array();
    		$row->id_dinas = $db_d['nama_panjang'];

    		$row->akses = '';
    		foreach ($db_u as $u) {
    			$row->akses .= $u['urusan'].', ';
    		}
    		


    		$arr[] = $row;
    	}
    	return $arr;
    }

    function tambah_user()
    {
        $post = $this->input->post();
        $id = $post['id'];

        $cek = $this->db->where('id_user', $id)->get('m_user')->row_array();
        $cek_u = $this->db->where('username', $post['username'])->get('m_user')->row_array();

        $config['upload_path']          = './uploads/user/';
		$config['allowed_types']        = 'jpg|png';
		$config['overwrite']            = false;
		$config['encrypt_name']			= true;
		$config['max_size']             = 1024; // 1MB

		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('gambar')){
        	$data =  $this->upload->data();
        	$post['gambar'] = $data['file_name'];
        }

        $post['gambar'] = $post['gambar'] ? $post['gambar'] : $cek['gambar'];
        $password = password_hash($post['password'], PASSWORD_DEFAULT);

        $post['password'] = $post['password'] ? $password : $cek['password'];
        $post['akses'] = isset($post['akses']) ? serialize($post['akses']) : '';
        unset($post['password2']);
        unset($post['id']);

        if($cek > 0){
        	unset($post['username']);
        	if ($post['gambar'] <> $cek['gambar']) {
        		delete_file('user',$cek['gambar']);
        	}
            $this->db->where('id_user',$id)->update('m_user',$post);
            $ket = array("error"=>false,'message'=>"Data Berhasil Diupdate");
        }
        else{
        	if ($cek_u > 0) {
	        	$ket = array("error"=>true,'message'=>"Username sudah terdaftar");
	        }
	        if (!isset($post['password']) || empty($post['password'])) {
	        	$ket = array("error"=>true,'message'=>"Password Harap Diisi");
	        }
	        else{
	        	$this->db->insert('m_user',$post);
	            $ket = array("error"=>false,'message'=>"Data Berhasil Disimpan");
	        }
            
        }
        
        return $ket;
    }

    function hapus_user($id){
		$db = $this->db->where('id_user',$id)->get('m_user')->row_array();

		if ($db['level'] <> 1) {
			$this->db->where('id_user',$id)->delete('m_user');
	    	delete_file('user',$db['gambar']);
		}

        $ket = array("error"=>false,'message'=>"Data Berhasil Dihapus");
        
        return $ket;
    }

}

/* End of file master_model.php */
/* Location: ./application/models/master_model.php */