<?php
class Transaksi extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_barang','m_transaksi'));
        chek_session();
    }
    
    function index() {
		$data['user'] 	= $this->session->userdata('username');
		$data['inv'] 	= urut_transaksi('TR', 12);
		$data['barang'] = $this->db->query("SELECT*FROM barang where id_barang not in (select id_barang from transaksi_dtl where id_transaksi=0) ORDER BY nama_barang");
		$data['bayardong'] = $this->db->query("SELECT*FROM transaksi_dtl WHERE status='0' AND id_transaksi='0'");
		$data['detail'] = $this->m_transaksi->tampil_transaksi_dtl()->result();
		$data['bayar'] = $this->db->query("SELECT*FROM bayar WHERE id_transaksi='0'");
		$this->template->load('template', 'transaksi/form_transaksi', $data);
    }

	function tambahBarang(){
		$return = $this->m_transaksi->tambahBarang();
		$url = base_url().'transaksi';
		echo json_encode(array(
			'res' => $return,
			'url' => $url,
		));
	}

	function pencarianBarang(){ 
		$cari = $_GET['search'];
		$response = $this->m_transaksi->pencarianBarang($cari);
		echo json_encode($response);
	}

	function bayarDong(){
		$bayar = $_POST['bayar'];
		// CEK JIKA PEMBAYARAN LEBIH KECIL DARI TRANSAKSI
		$cek = $this->db->query("SELECT*FROM transaksi_dtl WHERE id_transaksi='0'");
		
		$qbayar = 0;
		foreach($cek->result() as $r){
			if($r->discrp2 == 0){
				$subTotal = $r->qty * $r->harga;
				$jumdis = 0;
			}else{
				if($r->disc == 0){
					$subTotal = (($r->qty * $r->harga) - $r->potongan);
					$jumdis = $r->potongan;
				}else{
					$subTotal = ($r->qty * $r->harga) - $r->discrp2;
					$jumdis = $r->discrp2;
				}
			}
			$qbayar += $subTotal;
		}

		if($bayar < $qbayar){
			echo json_encode(
				array(
					'res' => false,
					'msg' => 'PEMBAYARAN TIDAK BOLEH KURANG DARI PEMBAYARAN!',
			));
		}else{
			$return = $this->m_transaksi->bayarDong();
			$url = base_url().'transaksi';
			echo json_encode(
				array(
					'res' => $return,
					'url' => $url,
			));
		}

	}

    function selesai($inv) {
        $tanggal    = date('Y-m-d');
        $user       = $this->session->userdata('username');
        $id_op      = $this->db->get_where('operator',array('username'=>$user))->row_array();
        $data       = array('operator_id'=>$id_op['operator_id'],'tanggal_transaksi'=>$tanggal,'invoice'=>$inv);
        $this->m_transaksi->selesai($data);
        redirect('Transaksi');
    }

    function barang($brg){
        $brg = $this->db->query("SELECT*FROM barang where id_barang in ('$brg')")->row();
        if($brg){
            echo json_encode(array("barang" => $brg->id_barang,"harga" => $brg->harga,"status" => 1));
        }else{
            echo json_encode(array("status" => 2));
        }
    }

    function hapusitem($id) {
		$where = array('id_transaksi_dtl' => $id);
		$this->m_transaksi->hapus($where, 'transaksi_dtl');
		redirect('Transaksi');
	}

	function hapusBayar($id) {
		$where = array('id_transaksi' => $id);
		$this->m_transaksi->hapus($where, 'bayar');
		redirect('Transaksi');
	}

}

?>
