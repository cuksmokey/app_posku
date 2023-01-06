<?php
class M_transaksi extends CI_Model {

	function simpan_barang() {
        $id_barang    = $this->input->post('barang');
        $qty            = $this->input->post('qty');
        $disc            = $this->input->post('disc');
        $discrp            = $this->input->post('discrp');
        $idbarang       = $this->db->get_where('barang',array('id_barang'=>$id_barang))->row_array();
        $data           = array('id_barang' => $idbarang['id_barang'],
                                'qty' 		=> $qty,
                                'disc' 		=> $disc,
                                'discrp2' 		=> $discrp,
                                'harga' 	=> $idbarang['harga'],
                                'status' 	=> '0');
        $this->db->insert('transaksi_dtl', $data);
    }
    
    function tampil_transaksi_dtl() {
        $query  ="SELECT td.discrp2,td.id_transaksi_dtl,td.qty,td.harga,b.nama_barang
                FROM transaksi_dtl as td, barang as b
                WHERE b.id_barang = td.id_barang and td.status = '0'";
        return $this->db->query($query);
    }

    function selesai($data) {
        $this->db->insert('transaksi',$data);
        $last_id=  $this->db->query("SELECT id_transaksi from transaksi order by id_transaksi desc")->row_array();
        $this->db->query("UPDATE transaksi_dtl set id_transaksi='".$last_id['id_transaksi']."' where status='0'");
        $this->db->query("UPDATE transaksi_dtl set status='1' where status='0'");
        $this->db->query("UPDATE nourut set nourut=nourut+1 where kode_urut='TR'");
    }

    function hapus($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

}

?>
