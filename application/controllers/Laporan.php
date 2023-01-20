<?php
class Laporan extends CI_Controller {

	function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_cetak');
        $this->load->model('m_laporan');
        $this->load->helper('url');
        chek_session();
    }

	function index() {
        if(isset($_POST['submit'])) {
            $tanggal1 		= $this->input->post('tanggal1');
            $tanggal2 		= $this->input->post('tanggal2');
            $data['record'] = $this->m_laporan->laporan_periode($tanggal1, $tanggal2);
            $this->template->load('template','laporan/list', $data);
        }
        else 
        {
            $data['record']=  $this->m_laporan->lpr_default();
            $this->template->load('template','laporan/list', $data);
    	}   
    }

    function pdf() {
        $this->load->library('cfpdf');
        $pdf=new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B','L');
        $pdf->SetFontSize(14);
        $pdf->Text(10, 10, 'LAPORAN TRANSAKSI');
        $pdf->SetFont('Arial','B','L');
        $pdf->SetFontSize(10);
        $pdf->Cell(10, 10,'','',1);
        $pdf->Cell(10, 8, 'No', 1,0);
        $pdf->Cell(27, 8, 'Tanggal', 1,0);
        $pdf->Cell(50, 8, 'Operator', 1,0);
        $pdf->Cell(50, 8, 'Total Transaksi', 1,1);
        // tampilkan dari database
        $pdf->SetFont('Arial','','L');
        $data=  $this->m_laporan->lpr_default();
        $no=1;
        $total=0;
        foreach ($data->result() as $r) {
            $pdf->Cell(10, 8, $no, 1,0);
            $pdf->Cell(27, 8, $r->tanggal_transaksi, 1,0);
            $pdf->Cell(50, 8, $r->nama_lengkap, 1,0);
            $pdf->Cell(50, 8, $r->total, 1,1);
            $no++;
            $total=$total+$r->total;
        }
        // end
        $pdf->Cell(87,9,'Total',1,0,'R');
        $pdf->Cell(50,9,$total,1,0);
        $pdf->Output();
    }

    function cetak()
    {   

        
        $tgl1       = $this->input->get('tgl1');
        $tgl2       = $this->input->get('tgl2');
        $cekpdf     = $this->input->get('cek');
        $unit       = 'ORG';
        $position   = 'P';
        $body       = '';
        $date       = '-';
        

        $body .= "<table style=\"border-collapse:collapse;font-family: tahoma; font-size:12px\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
    
        <tr>
            <td bgcolor=\"#cccccc\" align=\"center\" style=\"\"><b>No</b> </td>
            <td bgcolor=\"#cccccc\" align=\"center\" style=\"\"><b>Tanggal</b> </td>
            <td bgcolor=\"#cccccc\" align=\"center\" style=\"\"><b>Operator</b> </td>
            <td bgcolor=\"#cccccc\" align=\"center\" style=\"\"><b>Total Transaksi</b> </td>
        </tr>";

        $data=  $this->m_laporan->lpr_default()->result();
        
        $i        = 0;
        $total    = 0;

        foreach ($data as $datas)
        {
            $i++;
            $tgll=$this->M_cetak->tanggal_format_indonesia($datas->tanggal_transaksi);
            $total = number_format($datas->total,2);
            $body .="
            <tr>
                <td align=\"center\" style=\"\">$i</td>
                <td align=\"center\" style=\"\">$tgll</td>
                <td align=\"LEFT\" style=\"\">$datas->nama_lengkap</td>
                <td align=\"right\" style=\"\">$total</td>
            </tr>
            ";

        }

		$body .= "</table>";
		$judul                = 'REKAP DATA TRANSAKSI';

        $this->M_cetak->template($judul, $body, $position, $date, $cekpdf);

    }

    function cetak_nota()
    {
        // $tgl1       = $this->input->get('tgl1');
        $id       = $this->input->get('id_transaksi');
        $cekpdf     = 1;
        $unit       = 'ORG';
        $position   = 'P';
        $body       = '';
        $date       = '-';

		if($id == 'ceknota'){
			$data_atas=  $this->db->query("SELECT (SELECT nama_lengkap FROM operator WHERE operator.operator_id=transaksi.operator_id)nm,transaksi.* FROM transaksi ORDER BY transaksi.id_transaksi DESC")->row();
			$datetgl = date("Y-m-d");
			$invx = explode("-", $data_atas->invoice);
			$noinv = intval($invx[1]+1);
			$panjang = strlen(intval($invx[1]));
			if($panjang == 1){
				$ninv = '00000';
			}else if($panjang == 2){
				$ninv = '0000';
			}else if($panjang == 3){
				$ninv = '000';
			}else if($panjang == 4){
				$ninv = '00';
			}else if($panjang == 5){
				$ninv = '00';
			}else if($panjang == 6){
				$ninv = '0';
			}else{
				$ninv = '';
			}
			$inv = $invx[0].'-'.$ninv.$noinv;
			$username = $this->session->userdata('username');
		}else{
			$data_atas=  $this->db->query("SELECT (select nama_lengkap from operator where operator.operator_id=transaksi.operator_id)nm,transaksi.* FROM transaksi where id_transaksi='$id'")->row();
			$datetgl = $data_atas->tanggal_transaksi;
			$inv = $data_atas->invoice;
			$username = $data_atas->nm;
		}

        $body .= '<table style="margin:0;padding:0;border-collapse:collapse;font-weight:bold;font-family:tahoma;font-size:10px;width:100%">
			<tr>
				<td style="width:25%"></td>
				<td style="width:1%"></td>
				<td style="width:74%"></td>
			</tr>
			<tr>
				<td>Tanggal/Waktu</td>
				<td>:</td>
				<td>'.$this->tglInd($datetgl).' '.date("H:i").'</td>
			</tr>
			<tr>
				<td>No. Nota</td>
				<td>:</td>
				<td>'.$inv.'</td>
			</tr>
			<tr>
				<td>Kasir</td>
				<td>:</td>
				<td>'.$username.'</td>
			</tr>
        </table>';

		if($id == 'ceknota'){
			$datad=  $this->db->query("SELECT (select nama_barang from barang where barang.id_barang=transaksi_dtl.id_barang)nm_brg,transaksi_dtl.*FROM transaksi_dtl where id_transaksi='0'")->result();
			$bayar = $this->db->query("SELECT*FROM bayar WHERE id_transaksi='0'")->row();
		}else{
			$datad=  $this->db->query("SELECT (select nama_barang from barang where barang.id_barang=transaksi_dtl.id_barang)nm_brg,transaksi_dtl.*FROM transaksi_dtl where id_transaksi='$id'")->result();
			$bayar = $this->db->query("SELECT*FROM bayar WHERE id_transaksi='$id'")->row();
		}
        
        $body .='<table style="vertical-align:top;padding:0;border-collapse:collapse;font-size:10px;width:100%">
			<tr>
				<td style="border:0;width:7%"></td>
				<td style="border:0;width:65%"></td>
				<td style="border:0;width:28%"></td>
			</tr>
			<tr>
				<td style="border-top:1px dashed #000;padding:5px 0;font-family:tahoma;font-weight:bold" colspan="3">ITEM :</td>
			</tr>';

		$i = 0;
		$subtotal = 0;
		$total = 0;
		$discrp = 0;
		$totot = 0;
        foreach ($datad as $datadet) {
			$i++;
			if($datadet->qty == 1){
				$kQty = '';
			}else{
				$kQty = '('.$datadet->qty.'x)';
			}

			if($datadet->discrp2 == 0){
				$subTotal = $datadet->harga;
				$jumdis = 0;
			}else{
				if($datadet->disc == 0){
					$subTotal = (($datadet->qty * $datadet->harga) - $datadet->potongan);
					$jumdis = $datadet->potongan;
				}else{
					$subTotal = ($datadet->qty * $datadet->harga) - $datadet->discrp2;
					$jumdis = $datadet->discrp2;
				}
			}

            $body .='<tr>
                <td>'.$i.'.</td>
                <td>'.$datadet->nm_brg.' '.$kQty.'</td>
                <td style="text-align:right">Rp. '.number_format($datadet->qty * $datadet->harga).'</td>
            </tr>
            ';

			$totot += $datadet->qty * $datadet->harga;
            $subtotal += $subTotal;
            $discrp += $jumdis;
        }

        $total = $totot - $discrp;
		$body .="</table>";

        $body .='<table style="border-collapse:collapse;margin-top:5px;border-top:1px dashed #000;font-size:10px;width:100%">
            <tr>
                <td style="padding-top:5px">Sub Total</td>
                <td style="padding-top:5px;text-align:right">Rp. '.number_format($totot).'</td>
            </tr>
            <tr>
                <td style="padding-bottom:5px">Diskon</td>
                <td style="padding-bottom:5px;text-align:right">- Rp. '.number_format($discrp).'</td>
            </tr>
			<tr>
				<td colspan="2" style="border-top:1px dashed #000"></td>
			</tr>
            <tr>
                <td style="padding:5px 0">Total Bayar</td>
                <td style="padding:5px 0;text-align:right">Rp. '.number_format($total).'</td>
            </tr>
			<tr>
				<td colspan="2" style="border-top:1px dashed #000"></td>
			</tr>
			<tr>
                <td style="padding:5px 0 0">Cash</td>
                <td style="padding:5px 0 0;text-align:right">Rp. '.number_format($bayar->bayar).'</td>
            </tr>
			<tr>
                <td style="padding:0 0 5px">Change</td>
                <td style="padding:0 0 5px;text-align:right">Rp. '.number_format($bayar->bayar - $total).'</td>
            </tr>
			<tr>
				<td colspan="2" style="border-top:1px dashed #000"></td>
			</tr>';
		$body .= "</table>";

		$body .='<table style="margin-top:8px;border-collapse:collapse;font-size:10px;width:100%">';
		$body .='<tr>
			<td style="width:5%;text-align:right"><img src="'.base_url().'assets/css/ig.png" width="15" height="15" /></td>
			<td style="width:65%">beautyndream.id</td>
			<td style="width:5%;text-align:right"><img src="'.base_url().'assets/css/wa.png" width="15" height="15" /></td>
			<td style="width:25%">0895-1315-5559</td>
		</tr>
		<tr>
			<td style="padding-top:5px;text-align:center;font-weight:bold" colspan="4">~ Have a Nice Day ~</td>
		</tr>';
		$body .='</table>';

		$judul = '-';

        $this->M_cetak->template_nota($judul, $body, $position, $date, $cekpdf);

    }

	function tglInd($tgl){
        $tanggal = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;
	}

	function  getBulan($bln) {
        switch  ($bln) {
	        case  1:
	        return  "Januari";
	        break;
	        case  2:
	        return  "Februari";
	        break;
	        case  3:
	        return  "Maret";
	        break;
	        case  4:
	        return  "April";
	        break;
	        case  5:
	        return  "Mei";
	        break;
	        case  6:
	        return  "Juni";
	        break;
	        case  7:
	        return  "Juli";
	        break;
	        case  8:
	        return  "Agustus";
	        break;
	        case  9:
	        return  "September";
	        break;
	        case  10:
	        return  "Oktober";
	        break;
	        case  11:
	        return  "November";
	        break;
	        case  12:
	        return  "Desember";
	        break;
	    }
    }

}


?>
