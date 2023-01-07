<?php
class Jasa extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_jasa');
		chek_session();
	}

	function index() {
		$data['jasa'] = $this->m_jasa->list_jasa()->result();
		$this->template->load('template','jasa/list', $data);
	}

	function tambah() {
		$nama  = $this->input->post('nama_jasa');
		$harga = $this->input->post('harga');

		$data = array(
			'nama_jasa' => $nama,
			'harga'       => $harga,
			);

		$this->m_jasa->tambah($data, 'jasa');
		redirect('jasa');
	}

	function hapus($id) {
		// $id       = $this->input->post('id');
		$where    = array('id_jasa' => $id);
		$asc      = $this->m_jasa->hapus($where, 'jasa');
		if($asc){
            
            echo json_encode(array("status" => 1));
			// redirect('jasa');

        }else{
            echo json_encode(array("status" => 2));
			// redirect('jasa');
            
        }
	}

	function edit($id) {
		$where 			= array('id_jasa' => $id);
		$data['jasa'] = $this->m_jasa->edit($where, 'jasa')->result();
		$this->template->load('template','jasa/edit', $data);
	}

	function load_edit() {
		$id    = $this->input->post('id_jasa');
		$nama  = $this->input->post('nama_jasa');
		$harga = $this->input->post('harga');

		$data = array(
			'id_jasa'   => $id,
			'nama_jasa' => $nama,
			'harga' 	  => $harga,
		);

		$where = array(
			'id_jasa' => $id
		);

		$this->m_jasa->load_edit($where, $data, 'jasa');
		redirect('jasa');
	}

}


?>
