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

        $data_atas=  $this->db->query("SELECT (select nama_lengkap from operator where operator.operator_id=transaksi.operator_id)nm,transaksi.* FROM transaksi where id_transaksi='$id' ")->row();

        $body .= '<table style="margin:0;padding:0;border-collapse:collapse;font-weight:bold;font-family:tahoma;font-size:10px;width:100%">
			<tr>
				<td>Tanggal/Waktu</td>
				<td>: '.$this->tglInd($data_atas->tanggal_transaksi).' '.date("H:i").'</td>
			</tr>
			<tr>
				<td>No. Nota</td>
				<td>: '.$data_atas->invoice.'</td>
			</tr>
			<tr>
				<td style="padding:0 0 10px">Kasir</td>
				<td style="padding:0 0 10px">: '.$data_atas->nm.'</td>
			</tr>
			<tr>
				<td colspan="2" style="border-top:1px dashed #000;padding:10px 0">ITEM :</td>
			</tr>
        </table>';

        $datad=  $this->db->query("SELECT (select nama_barang from barang where barang.id_barang=transaksi_dtl.id_barang)nm_brg,transaksi_dtl.*FROM transaksi_dtl where id_transaksi='$id'")->result();
        
        $i        = 0;
        $total    = 0;
        $subtotal = 0;
        $discrp   = 0;
        
        $body .="<table style=\"vertical-align:top;margin-bottom:10px;padding:0;border-collapse:collapse;font-size:10px;width:100%\">
			<tr>
				<td style=\"border:0;width:7%\"></td>
				<td style=\"border:0;width:73%\"></td>
				<td style=\"border:0;width:20%\"></td>
			</tr>
		";

        foreach ($datad as $datadet)
        {
            $i++;
            $body .='
            <tr>
                <td>'.$i.'.</td>
                <td>'.$datadet->nm_brg.'</td>
                <td style="text-align:right">Rp. '.number_format($datadet->harga).'</td>
            </tr>
            ';

            $subtotal   = $subtotal + $datadet->harga;
            $discrp     = $discrp + $datadet->discrp2;
        }

        $total = $subtotal-$discrp;
		$body .="</table>";

        $body .='<table style="border-collapse:collapse;border-top:1px dashed #000;font-size:10px;width:100%">
            <tr>
                <td style="padding-top:10px">Sub Total</td>
                <td style="padding-top:10px;text-align:right">Rp. '.number_format($subtotal).'</td>
            </tr>
            <tr>
                <td style="padding-bottom:10px">Diskon</td>
                <td style="padding-bottom:10px;text-align:right">- Rp. '.number_format($discrp).'</td>
            </tr>
			<tr>
				<td colspan="2" style="border-top:1px dashed #000"></td>
			</tr>
            <tr>
                <td style="padding:10px 0">Total</td>
                <td style="padding:10px 0;text-align:right">Rp. '.number_format($total).'</td>
            </tr>
			<tr>
				<td colspan="2" style="border-top:1px dashed #000"></td>
			</tr>
            <tr>
                <td style="padding-top:10px" colspan="2">
					<img src="'.base_url().'assets/css/ig.png" width="15" height="15" /> beautyndream.id
				</td>
            </tr>
            <tr>
                <td style="padding-top:10px;text-align:center;font-weight:bold" colspan="2">~ Have a Nice Day ~</td>
            </tr>
            ';
		$body .= "</table>";
		$judul                = '-';

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
