<?php
class Operator extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_operator');
        $this->load->helper('url');
        chek_session();
    }

	function index() {
		$data['operator'] = $this->m_operator->list_op()->result();
		$this->template->load('template','operator/list', $data);
	}

	function tambah() {
		$nama       =  $this->input->post('nama');
		$username   =  $this->input->post('username');
		$password   =  $this->input->post('password');

		$data       =  array(   'nama_lengkap' => $nama,
					            'username'     => $username,
					            'password'     => md5($password));

		$this->m_operator->tambah($data, 'operator');
		redirect('operator');
	}

	function edit($id) {
		$where 			= array('operator_id' => $id);
		$data['operator'] = $this->m_operator->edit($where, 'operator')->result();
		$this->template->load('template','operator/edit', $data);
	}

	function load_edit() {
		$id       = $this->input->post('operator_id');
		$nama  	  = $this->input->post('nama_lengkap');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(	'operator_id'  => $id,
						'nama_lengkap' => $nama,
			            'username'     => $username,
			            'password'     => md5($password));

		$where = array(
			'operator_id' => $id
		);

		$this->m_operator->load_edit($where, $data, 'operator');
		redirect('operator');
	}

	function hapus($id) {
		$where = array('operator_id' => $id);
		$this->m_operator->hapus($where, 'operator');
		redirect('operator');
	}

}

?>