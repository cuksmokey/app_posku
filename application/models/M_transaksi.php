<?php
class M_transaksi extends CI_Model {

	function simpan_barang() {
        $id_barang = $this->input->post('barang');
		$expIdBarang = explode("_ex_", $id_barang);
		$idB = $expIdBarang[0];

        $qty = $this->input->post('qty');
        $disc = $this->input->post('disc');
        $discrp = $this->input->post('discrp');
        $idbarang = $this->db->get_where('barang',array('id_barang'=>$idB))->row_array();
        $data = array('id_barang' => $idbarang['id_barang'],
			'qty' => $qty,
			'disc' => $disc,
			'discrp2' => $discrp,
			'harga' => $idbarang['harga'],
			'status' => '0'
		);
        $this->db->insert('transaksi_dtl', $data);
    }
    
    function tampil_transaksi_dtl() {
        $query  ="SELECT td.discrp2,td.disc,td.potongan,td.id_transaksi_dtl,td.qty,td.harga,b.nama_barang
                FROM transaksi_dtl as td, barang as b
                WHERE b.id_barang = td.id_barang and td.status = '0'";
        return $this->db->query($query);
    }

	function tambahBarang(){
		// 66_ex_200000_ex_Balayage Long
		$id_barang = explode("_ex_", $_POST['id_barang']);
		$qty = $_POST['qty'];
		$barang_plh = $_POST['barang_plh'];
		$potongan = $_POST['potongan'];
		// $potrp = $_POST['potrp'];
		$disc = $_POST['disc'];
		// $discrp = $_POST['discrp'];

		if($barang_plh == 'tdk'){
			$vpotongan = 0;
			$vdisc = 0;
			$discrp2 = 0;
		}else if($barang_plh == 'dsc'){
			$vpotongan = 0;
			$vdisc = $disc;
			$discrp2 = ($disc * $id_barang[1] * $qty) / 100;
		}else{ // ptg
			$vpotongan = $potongan;
			$vdisc = 0;
			$discrp2 = ($id_barang[1] * $qty) - $potongan;
		}

		// id_transaksi_dtl id_barang  qty id_transaksi  harga status opsi potongan disc discrp2  
		$data = array(
			'id_barang' => $id_barang[0],
			'qty' => $qty,
			'id_transaksi' => 0,
			'harga' => $id_barang[1],
			'status' => '0',
			'opsi' => $barang_plh,
			'potongan' => $vpotongan,
			'disc' => $vdisc,
			'discrp2' => $discrp2,
		);
		return $this->db->insert('transaksi_dtl', $data);
	}

	function pencarianBarang($cari=""){
		$users = $this->db->query("SELECT*FROM barang WHERE id_barang NOT IN (SELECT id_barang FROM transaksi_dtl WHERE id_transaksi=0) AND (nama_barang LIKE '%$cari%' OR harga LIKE '%$cari%')
		ORDER BY nama_barang")->result_array();

        $data = array();
        foreach($users as $user){
            // id pimpinan nm_perusahaan alamat no_telp
            $txt = '[ Rp. '.number_format($user['harga']).' ] '.$user['nama_barang'];
            $data[] = array(
                "id" => $user['id_barang'].'_ex_'.$user['harga'].'_ex_'.$user['nama_barang'],
                "text" => $txt, 
            );
        }

        return $data;
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
