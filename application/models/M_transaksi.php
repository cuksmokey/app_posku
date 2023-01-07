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

	function bayarDong(){
		// CEK JIKA SUDAH ISI
		$cek = $this->db->query("SELECT*FROM bayar WHERE id_transaksi='0'");
		if($cek->num_rows() == 0){
			$this->db->set('id_transaksi', 0);
			$this->db->set('bayar', $_POST['bayar']);
			return $this->db->insert('bayar');
		}else{
			$bayar = $_POST['bayar'] + $cek->row()->bayar;
			$this->db->set('bayar', $bayar);
			$this->db->where('id_transaksi', $cek->row()->id_transaksi);
			return $this->db->update('bayar');
		}
	}

    function selesai($data) {
        $this->db->insert('transaksi',$data);
        $last_id=  $this->db->query("SELECT id_transaksi from transaksi order by id_transaksi desc")->row_array();
        $this->db->query("UPDATE transaksi_dtl set id_transaksi='".$last_id['id_transaksi']."' where status='0'");
        $this->db->query("UPDATE transaksi_dtl set status='1' where status='0'");
        $this->db->query("UPDATE nourut set nourut=nourut+1 where kode_urut='TR'");
        $this->db->query("UPDATE bayar set id_transaksi='".$last_id['id_transaksi']."' WHERE id_transaksi='0'");
    }

    function hapus($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

}

?>
