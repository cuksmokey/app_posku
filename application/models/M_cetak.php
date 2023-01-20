<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cetak extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function mpdf($form='',$uk='' , $judul='',$isi='',$jdlsave='',$lMargin='',$rMargin='',$font=10,$orientasi='',$hal='',$tab='',$tMargin='')
	{
		// hussain change
		ini_set("pcre.backtrack_limit", "5000000");
		// ini_set('memory_limit', '1500000M');
		// end husain

				// ori
		ini_set('max_execution_time', 0);
		ini_set("memory_limit","-1");
		set_time_limit(0);
				// end ori
		
		$jam = date("H:i:s");
		if ($hal==''){
			$hal1=1;
		} 
		if($hal!==''){
			$hal1=$hal;
		}
		if ($font==''){
			$size=12;
		}else{
			$size=$font;
		} 

		if ($tMargin=='' ){
			$tMargin=16;
		}
		
		if($lMargin==''){
			$lMargin=15;
		}

		if($rMargin==''){
			$rMargin=15;
		}

		$this->mpdf = new \Mpdf\Mpdf( array(190,236),$size,'',$lMargin,$rMargin,$tMargin);

		$this->mpdf->AddPage($form,$uk);

		$this->mpdf->SetFooter('Tercetak {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');

		$this->mpdf->setTitle($judul);

		$this->mpdf->writeHTML($isi);

		$this->mpdf->output($jdlsave,'I');
	}

	function mpdf_nota($form='',$uk='' , $judul='',$isi='',$jdlsave='',$lMargin='',$rMargin='',$font=10,$orientasi='',$hal='',$tab='',$tMargin='')
	{
		ini_set("pcre.backtrack_limit", "5000000");
		ini_set('max_execution_time', 0);
		ini_set("memory_limit","-1");
		set_time_limit(0);
				// end ori
		
		$jam = date("H:i:s");
		if ($hal==''){
			$hal1=1;
		} 
		if($hal!==''){
			$hal1=$hal;
		}
		if ($font==''){
			$size=12;
		}else{
			$size=$font;
		} 

		if ($tMargin=='' ){
			$tMargin=16;
		}
		
		if($lMargin==''){
			$lMargin=15;
		}

		if($rMargin==''){
			$rMargin=15;
		}

		// $this->mpdf = new \Mpdf\Mpdf( array(10,20),$size,'',$lMargin,$rMargin,$tMargin);
		$this->mpdf = new \Mpdf\Mpdf([
			'default_font_size' => 9,
			'margin_top' => 3,
			'margin_left' => 5,
			'margin_right' => 5,
			'margin_bottom' => 1,
			'format' => [80, 190]
		]);

		$this->mpdf->AddPage($form,$uk);

		// $this->mpdf->SetFooter('Tercetak {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');

		$this->mpdf->setTitle($judul);

		$this->mpdf->writeHTML($isi);

		$this->mpdf->output($jdlsave,'I');
	}

	function kop($unit='')
	{

		$sql="SELECT*FROM tbl_namers where koders='$unit'";
			$query1    = $this->db->query($sql);

			$lcno        = 0;$koders        = 0;$namars        = 0;$alamat        = 0;$kota          = 0;$phone         = 0;$whatsapp      = 0;$fax           = 0;$email         = 0;$website       = 0;$pejabat1      = 0;$jabatan1      = 0;$ketbank       = 0;$ketbank2      = 0;$ketbank3      = 0;$pejabat2      = 0;$jabatan2      = 0;$jabatan3      = 0;$pejabat3      = 0;$jabatan4      = 0;$pejabat4      = 0;$namaapotik    = 0;$apoteker      = 0;$jabatan       = 0;$noijin        = 0;$npwp          = 0;$pkpno         = 0;$tglpkp        = 0;$wahost        = 0;$watoken       = 0;$mou           = 0;$tgl_awal      = 0;$tgl_akhir     = 0;

			foreach ($query1->result() as $row) {
				$lcno       = $lcno + 1;
				$koders     = $row->koders;
				$namars     = $row->namars;
				$alamat     = $row->alamat;
				$alamat2    = $row->alamat2;
				$kota       = $row->kota;
				$phone      = $row->phone;
				$whatsapp   = $row->whatsapp;
				$fax        = $row->fax;
				$email      = $row->email;
				$website    = $row->website;
				$pejabat1   = $row->pejabat1;
				$jabatan1   = $row->jabatan1;
				$ketbank    = $row->ketbank;
				$ketbank2   = $row->ketbank2;
				$ketbank3   = $row->ketbank3;
				$pejabat2   = $row->pejabat2;
				$jabatan2   = $row->jabatan2;
				$jabatan3   = $row->jabatan3;
				$pejabat3   = $row->pejabat3;
				$jabatan4   = $row->jabatan4;
				$pejabat4   = $row->pejabat4;
				$namaapotik = $row->namaapotik;
				$apoteker   = $row->apoteker;
				$jabatan    = $row->jabatan;
				$noijin     = $row->noijin;
				$npwp       = $row->npwp;
				$pkpno      = $row->pkpno;
				$tglpkp     = $row->tglpkp;
				$wahost     = $row->wahost;
				$watoken    = $row->watoken;
				$mou        = $row->mou;
				$tgl_awal   = $row->tgl_awal;
				$tgl_akhir  = $row->tgl_akhir;

			}
			$hasil =  array(
					'namars'    => $namars,
					'alamat'    => $alamat,
					'alamat2'   => $alamat2,
					'kota'      => $kota,
					'phone'     => $phone,
					'whatsapp'  => $whatsapp,
					'npwp'      => $npwp
					);
			return $hasil;
	}

	function template($judul, $body, $position, $date, $cekpdf)
	{
		$param       = $judul;
		$kop         = $this->kop('BND');
		$namars      = $kop['namars'];
		$alamat      = $kop['alamat'];
		$alamat2     = $kop['alamat2'];
		$kota        = $kop['kota'];
		$phone       = $kop['phone'];
		$whatsapp    = $kop['whatsapp'];
		$npwp        = $kop['npwp'];
		$chari       = '';
		$chari .= "<table style=\"border-collapse:collapse;font-family: Century Gothic; font-size:12px; color:#000;\" width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					
			<thead>
			<tr>
				<td rowspan=\"6\" align=\"center\">
				<img src=\"" . base_url() . "assets/css/logo2.jpeg\"  width=\"100\" height=\"100\" /></td>

				<td colspan=\"20\"><b>
					<tr><td align=\"center\" style=\"font-size:14px;border-bottom: none;\"><b>$namars</b></td></tr>
					<tr><td align=\"center\" style=\"font-size:13px;\">$alamat</td></tr>
					<tr><td align=\"center\" style=\"font-size:13px;\">$alamat2</td></tr>
					<tr><td align=\"center\" style=\"font-size:13px;\">Wa :$whatsapp    Telp :$phone </td></tr>
					<tr><td align=\"center\" style=\"font-size:13px;\">No. NPWP : $npwp</td></tr>

				</b></td>
			</tr> 
			
			
		</table>";
		$chari .= "
			<table style=\"border-collapse:collapse;font-family: tahoma; font-size:12px\" width=\"100%\" align=\"center\" border=\"0\">
				<tr>
						<td> &nbsp; </td>
				</tr> 
			</table>";
								
		$chari .= "
			<table style=\"border-collapse:collapse;font-family: tahoma; font-size:2px\" width=\"100%\" align=\"center\" border=\"1\">     
				<tr>
						<td style=\"border-top: none;border-right: none;border-left: none;\"></td>
				</tr> 
			</table>";
		$chari .= "
			<table style=\"border-collapse:collapse;font-family: tahoma; font-size:2px\" width=\"100%\" align=\"center\" border=\"1\">     
				<tr>
						<td style=\"border-top: none;border-right: none;border-left: none;\"></td>
				</tr> 
			</table>";
		$chari .= "
			<table style=\"border-collapse:collapse;font-family: tahoma; font-size:12px\" width=\"100%\" align=\"center\" border=\"0\">     
				<tr>
						<td>&nbsp;</td>
				</tr> 
			</table>";
		$chari .= "
			<table style=\"border-collapse:collapse;font-family: Tahoma; font-size:11px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				<tr>
						<td colspan=\"20\" width=\"15%\" style=\"text-align:center; font-size:20px;\"><b>$param</b></td>
				</tr>
				<tr>
						<td colspan=\"20\" width=\"15%\" style=\"text-align:center; font-size:12px;\">$date</td>
				</tr>
			</table>";
		$chari .= "
			<table style=\"border-collapse:collapse;font-family: tahoma; font-size:12px\" width=\"100%\" align=\"center\" border=\"0\">
				<tr>
						<td> &nbsp; </td>
				</tr> 
			</table>";
		$chari .= $body;
		$data['prev']   = $chari;
		$judul          = $param;

		switch ($cekpdf) {
			case 0;
				echo ("<title>$judul</title>");
				echo ($chari);
				break;

			case 1;
				// echo ("<title>$judul</title>");
				$this->M_cetak->mpdf($position, 'A4', $judul, $chari, '.PDF', 10, 10, 10, 2);
				break;

			case 2;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd-ms-excel");
				header("Content-Disposition: attachment; filename= $judul.xls");
				$this->load->view('app/master_cetak', $data);
				break;
				
			case 3;
				echo ("<title>$judul</title>");
				echo ($chari);
				echo "<script>window.print();</script>";
			break;
		}
		// $this->M_cetak->mpdf($position, 'A4', $judul, $chari, '.PDF', 10, 10, 10, 2);
	}

	function template_nota($judul, $body, $position, $date, $cekpdf)
	{
		$param       = $judul;
		$kop         = $this->kop('BND');
		$namars      = $kop['namars'];
		$alamat      = $kop['alamat'];
		$alamat2     = $kop['alamat2'];
		$kota        = $kop['kota'];
		$phone       = $kop['phone'];
		$whatsapp    = $kop['whatsapp'];
		$npwp        = $kop['npwp'];
		$chari       = '';
		$chari .= "<table style=\"margin-bottom:5px;border-collapse:collapse;font-family:Century Gothic;color:#000;border-bottom:1px dashed #000;\" width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			<tr>
				<td align=\"center\"><img src=\"".base_url()."assets/css/newlogo.png\"  width=\"100\" height=\"100\" /></td>
			</tr> 
			<br>
			<br>
				<tr><td style=\"text-align:center;font-size:10px;\"><b>$namars</b></td></tr>
				<tr><td style=\"text-align:center;font-size:10px;padding-bottom:10px;\">$alamat</td></tr> 
		</table>"; //$alamat
		
		$chari .= $body;
		$data['prev']   = $chari;
		$judul          = $param;

		switch ($cekpdf) {
			case 0;
				echo ("<title>$judul</title>");
				echo ($chari);
				break;

			case 1;
				// echo ("<title>$judul</title>");
				$this->M_cetak->mpdf_nota($position, 'A4', $judul, $chari, '.PDF', 10, 10, 10, 2);
				break;

			case 2;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd-ms-excel");
				header("Content-Disposition: attachment; filename= $judul.xls");
				$this->load->view('app/master_cetak', $data);
				break;
				
			case 3;
				echo ("<title>$judul</title>");
				echo ($chari);
				echo "<script>window.print();</script>";
			break;
		}
		// $this->M_cetak->mpdf($position, 'A4', $judul, $chari, '.PDF', 10, 10, 10, 2);
	}

	function hari_indo($tgl)
	{
	
		//   $_hari = date_format($tgl, 'l');
		$_hari    = date('l', strtotime($tgl));
		$hari     = '';

		switch ($_hari) {
			case 'Sunday';
				$hari = 'Minggu';
			break;
			
			case 'Monday';
				$hari = 'Senin';
			break;
			case 'Tuesday';
				$hari = 'Selasa';
			break;
			case 'Wednesday';
				$hari = 'Rabu';
			break;
			case 'Thursday';
				$hari = 'Kamis';
			break;
			case 'Friday';
				$hari = 'Jumat';
			break;
			case 'Saturday';
				$hari = 'Sabtu';
			break;

		}
		return $hari;
	}

	function  tanggal_format_indonesia($tgl)
	{
			
		$tanggal   = explode('-',$tgl);
		$bulan     = $this-> getBulan($tanggal[1]);
		$tahun     = $tanggal[0];
		return  $tanggal[2].' '.$bulan.' '.$tahun;
	
	}
	
	function  getBulan($bln)
	{
		switch  ($bln){
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
