<?php
class Barang extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_barang');
		chek_session();
	}

	function index() {
		$data['barang'] = $this->m_barang->list_barang()->result();
		$this->template->load('template','barang/list', $data);
	}

	function tambah() {
		$nama   = $this->input->post('nama_barang');
		$harga  = $this->input->post('harga');
		$qty    = $this->input->post('qty');

		$data = array(
			'nama_barang' => $nama,
			'harga'       => $harga,
			'stok'        => $qty,
			);

		$this->m_barang->tambah($data, 'barang');
		redirect('barang');
	}

	function hapus($id) {
		// $id       = $this->input->post('id');
		$where    = array('id_barang' => $id);
		$asc      = $this->m_barang->hapus($where, 'barang');
		if($asc){
            
            echo json_encode(array("status" => 1));
			// redirect('barang');

        }else{
            echo json_encode(array("status" => 2));
			// redirect('barang');
            
        }
	}

	function edit($id) {
		$where 			= array('id_barang' => $id);
		$data['barang'] = $this->m_barang->edit($where, 'barang')->result();
		$this->template->load('template','barang/edit', $data);
	}

	function load_edit() {
		$id    = $this->input->post('id_barang');
		$nama  = $this->input->post('nama_barang');
		$harga = $this->input->post('harga');
		$qty = $this->input->post('qty');

		$data = array(
			'id_barang'   => $id,
			'nama_barang' => $nama,
			'harga' 	  => $harga,
			'stok' 	      => $qty,
		);

		$where = array(
			'id_barang' => $id
		);

		$this->m_barang->load_edit($where, $data, 'barang');
		redirect('barang');
	}

}


?>