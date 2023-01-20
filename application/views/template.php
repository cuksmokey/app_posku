<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Beauty N Dream</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url()."assets/"; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- favicon -->
	<link href="<?php echo base_url(); ?>assets/img/logo.ico" rel="shortcut icon" />
	<!-- Font Awesome -->

	<link rel="stylesheet" href="<?= base_url()."assets/"; ?>bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url()."assets/"; ?>bower_components/Ionicons/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?= base_url()."assets/"; ?>bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Theme style -->
	<!-- <link href="<?= base_url(); ?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" /> -->
	<!-- <script type="text/javascript" src="<?= base_url(); ?>assets/modal/shCore.js" language="javascript"></script> -->
	<!-- <script type="text/javascript" src="<?= base_url(); ?>assets/modal/shBrushJScript.js" language="javascript"></script> -->
	<!-- <script type="text/javascript" src="<?= base_url(); ?>assets/modal/ModalPopups.js" language="javascript"></script> -->
	<!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?= base_url()."assets/"; ?>dist/css/skins/_all-skins.min.css">
	<!-- TABLE STYLES-->
	<link rel="stylesheet" href="<?= base_url()."assets/"; ?>dist/js/js/dataTables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="<?= base_url()."assets/"; ?>css/gdw.css">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- SWEET ALERT -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.min.css"; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.css"; ?>">

	<!-- select2 -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/plugins/select2/select2.min.css"; ?>">
	<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div id="header">

		<Table border="0" width="100%">
			<tr>
				<td align="center" width="10%">
					<img src="<?= base_url(); ?>assets/css/logo3.jpeg" width="45" height="45" class="img-responsive" />
				</td>
				<td width="90%">
					<h1 class="heading">
						<a href="#" name="top"> Kasir Beauty n Dream </a>
					</h1>
				</td>
			</tr>
		</Table>

	</div>

	<div id="content-pinggir">
		<div class="content-pinggir-link">
			<ul>
				<li><a href="dashboard"><span class="glyphicon glyphicon-home"></span>Beranda</a></li>
				<li><a href="barang"><span class="glyphicon glyphicon-briefcase"></span>Data Barang</a></li>
				<li><a href="jasa"><span class="glyphicon glyphicon-tasks"></span>Data Jasa</a></li>
				<li><a href="transaksi"><span class="fa fa-edit"></span>Transaksi</a></li>
				<li><a href="operator"><span class="glyphicon glyphicon-user"></span>Operator</a></li>
				<li><a href="laporan"><span class="fa fa-print"></span>Laporan</a></li>
				<li><a href="identitas"><span class="glyphicon glyphicon-heart"></span>Identitas</a></li>
				<li><a href="auth/logout"><span class="glyphicon glyphicon-off"></span>Keluar</a></li>
			</ul>
		</div>
	</div>

	<div id="content-utama">
		<div id="content-isi">
			<?= $contents; ?>
		</div>
	</div>

	<div id="footer">
		<table width="100%" border="0">
			<tr>
				<td style="font-size: 15px;color:black">
					<marquee behavior="" direction=""><b>Hak Cipta &copy; 2023 &nbsp;&nbsp;|&nbsp;&nbsp; <a href="dashboard">HAW Production</a> &nbsp;&nbsp;|&nbsp;&nbsp; <span id="jam24"></span> </b></marquee>
				</td>
			</tr>
		</table>

	</div>

	<!-- SWEET ALERT -->
	<script src="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.min.js"; ?>"></script>
	<script src="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.js"; ?>"></script>

	<!-- jQuery 3 -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
	<script src="<?= base_url()."assets/"; ?>bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?= base_url()."assets/"; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?= base_url()."assets/"; ?>bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url()."assets/"; ?>dist/js/adminlte.min.js"></script>
	<!-- Sparkline -->
	<script src="<?= base_url()."assets/"; ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap  -->
	<script src="<?= base_url()."assets/"; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?= base_url()."assets/"; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- SlimScroll -->
	<script src="<?= base_url()."assets/"; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ChartJS -->
	<script src="<?= base_url()."assets/"; ?>bower_components/chart.js/Chart.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?= base_url()."assets/"; ?>dist/js/pages/dashboard2.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?= base_url()."assets/"; ?>dist/js/demo.js"></script>
	<!-- DATA TABLE SCRIPTS -->
	<script src="<?= base_url() ?>/assets/dist/js/js/dataTables/jquery.dataTables.js"></script>
	<script src="<?= base_url() ?>/assets/dist/js/js/dataTables/dataTables.bootstrap.js"></script>

	<script src="<?php echo base_url(); ?>assets/dist/js/jam.js" type="text/javascript"></script>

	<!-- SELECT -->
	<script src="<?= base_url()."assets/"; ?>plugins/select2/select2.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

	<script>
		$(document).ready(function() {
			pencarianBarang();
			$('#dataTables-example').dataTable();
			show3();

			$(".fg-rp-tdk").show();
			$(".fg-potongan").hide();
			$(".fg-potongan-txt").hide();
			$(".fg-dics").hide();
			$(".fg-dics-txt").hide();
			$('#barang_plh').prop("disabled", true);
			$("#qty").prop("disabled", true);
		});

		$('#barang_plh').on('change', function() {
			kosong();
			plh = $('#barang_plh').val();
			if(plh == 'tdk'){
				$(".fg-rp-tdk").show();
				$(".fg-dics").hide();
				$(".fg-dics-txt").hide();
				$(".fg-potongan").hide();
				$(".fg-potongan-txt").hide();
			}else if(plh == 'dsc'){
				$(".fg-rp-tdk").hide();
				$(".fg-dics").show();
				$(".fg-dics-txt").show();
				$(".fg-potongan").hide();
				$(".fg-potongan-txt").hide();
			}else{
				$(".fg-rp-tdk").hide();
				$(".fg-dics").hide();
				$(".fg-dics-txt").hide();
				$(".fg-potongan").show();
				$(".fg-potongan-txt").show();
			}
		});

		function kosong() {
			$("#potongan").val("");
			$("#potrp").val("");
			$("#disc").val("");
			$("#discrp").val("");
			$("#rptdk").val("0");

			$(".fg-rp-tdk").show();
			$(".fg-dics").hide();
			$(".fg-dics-txt").hide();
			$(".fg-potongan").hide();
			$(".fg-potongan-txt").hide();
		}

		$('#barang').on('change', function() {
			kosong();
			$('#barang_plh').prop("disabled", true);
			idb = $("#barang").val();
			if(idb == '' || idb == null){
				$("#qty").val("").prop("disabled", true);
			}else{
				$("#qty").val("").prop("disabled", false);
			}
		});

		$("#qty").keyup(function() {
			kosong();
			idb = $("#id_barang").val().split('_ex_')[1];
			qty = $("#qty").val();
			// alert(qty);
			if(qty == '' || qty == 0){
				$("#rptdk").val("0");
				$('#barang_plh').val("tdk").prop("disabled", true);
			}else{
				rptdk = idb * qty;
				$("#rptdk").val(rptdk);
				$('#barang_plh').val("tdk").prop("disabled", false);
			}
		});

		// DISKON
		$("#disc").keyup(function() {
			idb = $("#id_barang").val().split('_ex_')[1];
			qty = $("#qty").val();
			disc = $("#disc").val();
			discrp = (disc * idb * qty) / 100;

			$("#discrp").val(discrp);
		});

		// POTONGAN
		$("#potongan").keyup(function() {
			idb = $("#id_barang").val().split('_ex_')[1];
			qty = $("#qty").val();
			potongan = $("#potongan").val();
			potrp = (idb * qty) - potongan;

			$("#potrp").val(potrp);
		});

	</script>
	
</body>

</html>
