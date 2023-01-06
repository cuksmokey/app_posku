<?php
class M_barang extends CI_Model {
	
	function list_barang() {
		return $this->db->get('barang');
	}

	function tambah($data, $table) {
		$this->db->insert($table, $data);
	}

	function hapus($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	function edit($where, $table) {
		return $this->db->get_where($table, $where);
	}

	function load_edit($where, $data, $table) {
		$this->db->where($where);
		$this->db->update($table, $data);
	}

}

?>