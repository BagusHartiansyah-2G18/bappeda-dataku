<?php
require_once APPPATH . 'core/Admin_core.php';

class Data extends Admin_core {

	function __construct(){
        parent::__construct();
    }

    function index(){
		redirect('admin');
	}

    function ikk(){
        $this->load->model('Ikk_model', 'model');
        $get = $this->input->get();

        $param = array(
            "limit" => null,
            "tahun" => isset($get['t']) ? $get['t'] : '',
            'urusan' => isset($get['u']) ? $get['u'] : '',
        );
        $data = $this->model->data($param);
        $draw = '';
        $count = 0;
        $arr_data = [];

        //show_array($data); exit();

        if (!empty($data)) {
            
            $draw = $_REQUEST['draw']; 
            $start = $_REQUEST['start'];
            $limit = $_REQUEST['length'];

            $count = count($data);

            $param['limit'] = array(
                'start' => $start,
                'end' => $limit
            );
            
            $result = $this->model->data($param);

            $n=0; foreach($result as $row) : $n++;

                $status = '<a href="'.site_url('home/ikk/'.$row['id_dinas']).'" target="_blank" class="badge badge-info">Lihat</a>';
                $cek = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                            <input type="checkbox" class="kt-checkable" value="'.$row['id_ikk'].'">
                            <span></span>
                        </label>';
                            
                $arr_data[] = array(
                    $cek,
                    $row['nama_ikk'],
                    $row['tahun1'].' %',
                    $row['tahun2'].' %',
                    $row['tahun3'].' %',
                    $row['tahun4'].' %',
                    $row['tahun5'].' %',
                    $status,
                );
                
            endforeach;
        }
        
        //show_array($arr_data); exit();

        $responce = array(
            'draw' => $draw,
            'recordsTotal' => $count, 
            'recordsFiltered' => $count,
            'data'=>$arr_data
        );
        
        echo json_encode($responce);
    }


	function bidang($dinas){
		$this->load->model('Master_model', 'mm');

        $data = $this->mm->list_bidang($dinas);
		//show_array($data); exit();
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function data_utama(){
        $draw = $_REQUEST['draw']; 
        $start = $_REQUEST['start'];
        $limit = $_REQUEST['length'];
        $data = $this->session->userdata('data_utama'); 
        
        $count = count($data);
        $result = array_slice($data,$start,$limit);

        $arr_data = array();
        $n=0; foreach($result as $row) : $n++;
            $cek = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" class="kt-checkable" value="'.$row['id'].'">
                        <span></span>
                    </label>';
                        
            $arr_data[] = array(
                $cek,
                $row['nama_elemen'],
                $row['tahun1_val'],
                $row['tahun2_val'],
                $row['tahun3_val'],
                $row['tahun4_val'],
                $row['tahun5_val'],
                $row['satuan'],
            );
            
        endforeach;

        //show_array($arr_data); exit();

        $responce = array(
            'draw' => $draw,
            'recordsTotal' => $count, 
            'recordsFiltered' => $count,
            'data'=>$arr_data
        );
        
        echo json_encode($responce);
	}

	function get_par($id = null){
		$this->load->model('Data_utama_model', 'dum');
        $id_parent = $this->input->post('id_parent');
        $id_parent = isset($id_parent) ? $id_parent : '';

        $out = '<option value="0">- Pilih Elemen Parent -</option>';
        $in = $this->dum->get_par($id);

        $this->dum->get_par_option($in,$out);

		//show_array($out); exit();
		echo $out;
	}

	function sdgs_val(){
		$this->load->model('Sdgs_model', 'sm');
		$get = $this->input->get();
		
		$sdgs_val_id = isset($get['id']) ? $get['id'] : '';
		$kode_target = isset($get['kode']) ? $get['kode'] : '';
		$tahun = isset($get['thn']) ? $get['thn'] : '';

		$draw = $_REQUEST['draw']; 
        $start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"daft_id";
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"asc";

        $req_param = array(
            "sort_by" => $sidx,
            "sort_direction" => $sord,
            "limit" => null,
            "id" => $sdgs_val_id
        );     
        
        $row = $this->sm->sdgs_val($req_param)->result();
        $count = count($row); 
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
        
        $result = $this->sm->sdgs_val($req_param)->result();
        
        $arr_data = array();
        $n=0; foreach($result as $row) : $n++;
			$id = $row->sv_id;
			$kode = $row->sdgs_id .'.'. $kode_target .'.'. $n;
			$dinas = $this->db->where('id',$row->id_dinas)->get('m_dinas')->row_array();
			$row->id_dinas = $dinas['nama_panjang'];

			$arr_data[] = array(
				$kode,
				$row->indikator,
				$row->id_dinas,
				$row->satuan,
				$this->tahun($row->elemen_id, $tahun),
				$this->tahun($row->elemen_id, ($tahun+1)),
				$this->tahun($row->elemen_id, ($tahun+2)),
				$this->tahun($row->elemen_id, ($tahun+3)),
				$this->tahun($row->elemen_id, ($tahun+4)),
				'<span class="dropdown">
                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
						<i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item edit" href="'.site_url('admin/sdgs?detail='.$row->sdgs_id.'&target='.$row->parent_id.'&val='.$id).'"><i class="la la-edit"></i> Edit</a>
                        <a class="dropdown-item hapus" data="'.$id.'" href="#"><i class="la la-trash"></i> Hapus</a>
                    </div>
                </span>',
			);
            
        endforeach;

        $responce = array(
            'draw' => $draw,
            'recordsTotal' => $count, 
            'recordsFiltered' => $count,
            'data'=>$arr_data
        );
        
        echo json_encode($responce); 
	}

	function tahun($id, $thn){
		$db = $this->db->where('id_elemen',$id)->where('tahun',$thn)->get('elemen_val')->row_array();
		$db['nilai'] = $db > 0 ? $db['nilai'] : '-';
		return $db['nilai'];
	}

	function get_target($id){
		$db = $this->db
				->where('parent_id', 0)
				->where('id', $id)
				->get('sdgs_val')->row_array();

		echo json_encode($db);
	}

	function sdgs_val_elemen($id_urusan = null){
		$this->load->model('Sdgs_model', 'sm');

		$draw = $_REQUEST['draw']; 
        $start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"daft_id";
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"asc";
        $elemen = $_REQUEST['columns'][0]['search']['value'];

        $req_param = array(
            "sort_by" => $sidx,
            "sort_direction" => $sord,
            "limit" => null,
            "elemen" => $elemen,
            "id_urusan" => $id_urusan
        );     
        
        $row = $this->sm->sdgs_val_elemen($req_param)->result();
        $count = count($row); 
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
        
        $result = $this->sm->sdgs_val_elemen($req_param)->result();
        
        $arr_data = array();
        $n=0; foreach($result as $row) : $n++;
			$arr_data[] = array(
				$n,
				$row->nama_elemen,
				'<button class="btn btn-label-success btn-bold btn-sm btn-icon-h pilih_item"
					nama_el="'.$row->nama_elemen.'"
					id_el="'.$row->id.'"
					data-dismiss="modal">Pilih</button>'
			);
            
        endforeach;

        $responce = array(
            'draw' => $draw,
            'recordsTotal' => $count, 
            'recordsFiltered' => $count,
            'data'=>$arr_data
        );
        
        echo json_encode($responce); 
	}

	function cek(){
		$this->load->model('Data_utama_model', 'dum');

        //$data = $this->dum->get_elemen($tahun);

        $outputArray = array();
        $inputArray = $this->dum->get_elemen();
        $this->dum->list_nomor($inputArray, $outputArray);
        
		show_array($outputArray); exit();
	}
}