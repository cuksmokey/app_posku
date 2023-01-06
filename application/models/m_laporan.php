<?php
class M_laporan extends CI_Model {

	function lpr_default() {
        $query="SELECT t.id_transaksi,t.tanggal_transaksi, o.nama_lengkap, sum((td.harga*td.qty)-td.discrp2) as total
                FROM transaksi     as t,
                	 transaksi_dtl as td,
                	 operator      as o
                WHERE td.id_transaksi = t.id_transaksi and o.operator_id = t.operator_id
                group by t.id_transaksi ORDER BY t.tanggal_transaksi DESC";
        return $this->db->query($query);
    }

    function laporan_periode($tanggal1,$tanggal2) {
        $query="SELECT t.id_transaksi,t.tanggal_transaksi, o.nama_lengkap, sum(td.harga*td.qty) as total
                FROM transaksi     as t,
                	 transaksi_dtl as td,
                	 operator      as o
                WHERE td.id_transaksi = t.id_transaksi and o.operator_id = t.operator_id 
                and t.tanggal_transaksi between '$tanggal1' and '$tanggal2'
                group by t.id_transaksi ORDER BY t.tanggal_transaksi DESC";
        return $this->db->query($query);
    }


}


?>