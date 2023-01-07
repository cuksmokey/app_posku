<?php
class Identitas extends CI_Controller {

	function __construct() {
		parent::__construct();
		// $this->load->model('m_barang');
		chek_session();
	}

	function index() {
		// $data['barang'] = $this->m_barang->list_barang()->result();
		$this->template->load('template','identitas/list');
	}

}


?>
