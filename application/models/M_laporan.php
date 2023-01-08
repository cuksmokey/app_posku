<?php
class M_laporan extends CI_Model {

	function lpr_default() {
		$query="SELECT t.invoice,t.id_transaksi,t.tanggal_transaksi, o.nama_lengkap, sum(td.harga*td.qty) AS total,SUM(td.discrp2) AS disc
                FROM transaksi AS t,transaksi_dtl AS td, operator AS o
                WHERE td.id_transaksi = t.id_transaksi AND o.operator_id = t.operator_id 
                GROUP BY t.invoice DESC,t.id_transaksi";
		return $this->db->query($query);
	}

	function laporan_periode($tanggal1,$tanggal2) {
		$query="SELECT t.invoice,t.id_transaksi,t.tanggal_transaksi, o.nama_lengkap, sum(td.harga*td.qty) AS total,SUM(td.discrp2) AS disc
                FROM transaksi AS t,transaksi_dtl AS td, operator AS o
                WHERE td.id_transaksi = t.id_transaksi AND o.operator_id = t.operator_id 
                AND t.tanggal_transaksi BETWEEN '$tanggal1' AND '$tanggal2'
                GROUP BY t.invoice DESC,t.id_transaksi";
		return $this->db->query($query);
	}
}
