<h3 style="margin-bottom:12px"><b>Transaksi</b></h3>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<?= form_open('transaksi', array('class' => 'form-horizontal')); ?>
				<!-- <div class="form-horizontal"> -->
				<div class="form-group">
					<label class="col-sm-5 control-label">~ Barang ~</label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">No. Invoice</label>
					<div class="col-sm-4">
						<input type="text" id="inv" name="inv" class="form-control" value="<?= $inv ?>" readonly>
					</div>
					<label class="col-sm-2 control-label">Nama User</label>
					<div class="col-sm-4">
						<input type="text" id="user" name="user" class="form-control" value="<?= $user ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-4">
						<select name="barang" id="barang" class="form-control" required>
							<option value="">-- Pilih Barang --</option>
							<?php foreach ($barang->result() as $b) { ?>
								<option value="<?= $b->id_barang ?>">
									[ Rp.<?= number_format($b->harga) ?> ] <?= $b->nama_barang ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Quantity</label>
					<div class="col-sm-4">
						<input type="number" name="qty" id="qty" placeholder="QTY" class="form-control" required>
						<input type="hidden" name="harga" id="harga" placeholder="QTY" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Diskon</label>
					<div class="col-sm-3">
						<input type="number" name="disc" id="disc" onchange="hitung();" placeholder="disc" class="form-control" required>
					</div>
					<label class="control-label col-sm-1"><b>%</b></label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Diskon Rp</label>
					<div class="col-sm-4">
						<input type="number" name="discrp" id="discrp" placeholder="DISKON" class="form-control" required readonly>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <b>Tambah Barang</b></button>
					</div>
				</div>

				<?php if ($this->session->flashdata('warning')) { ?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Warning !! </strong> <?= $this->session->flashdata('warning'); ?>
					</div>
				<?php } ?>

				<!-- <hr>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">~ Pembayaran ~</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Total Bayar</label>
                        <div class="col-sm-4">
                            <input type="number" name="tbayar" id="tbayar" placeholder="Rp." class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nominal</label>
                        <div class="col-sm-4">
                            <input type="number" name="bayar" id="bayar" onchange="cekhitung();" placeholder="Rp." class="form-control" required>
                        </div>
                        <label class="col-sm-2 control-label">Sisa Kembalian</label>
                        <div class="col-sm-4">
                            <input type="number" name="sisa" id="sisa" onchange="cekhitung();" placeholder="Rp." class="form-control" required readonly>
                        </div>
                    </div>
                <datalist id="barang">
                    <?php foreach ($barang->result() as $b) {
						echo "<option value='$b->nama_barang'>";
					} ?>
                </datalist> -->
			</div>
		</div>
	</div>
</div>

<div class="xxx">
	<div class="panell">
		<div class="panell-body">
			<div class="table">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style="text-align:center">No.</th>
							<th style="text-align:center">Nama Barang</th>
							<th style="text-align:center">Qty</th>
							<th style="text-align:center">Harga</th>
							<th style="text-align:center">Diskon</th>
							<th style="text-align:center">Sub Total</th>
							<th style="text-align:center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						$total = 0;
						foreach ($detail as $r) {
							if($r->discrp2 == 0){
								$diss = '-';
							}else{
								$diss = 'Rp. '.number_format($r->discrp2);
							}
						?>
							<tr class="gradeU">
								<td style="text-align:center"><?= $no ?></td>
								<td><?= $r->nama_barang ?></td>
								<td style="text-align:center"><?= number_format($r->qty) ?></td>
								<td style="text-align:right">Rp. <?= number_format($r->harga) ?></td>
								<td style="text-align:right"><?= $diss ?></td>
								<td style="text-align:right">Rp. <?= number_format(($r->qty * $r->harga) - $r->discrp2) ?></td>
								<td style="text-align:center">
									<?= anchor('transaksi/hapusitem/' . $r->id_transaksi_dtl, 'Hapus', array('class' => 'btn btn-danger'), 'trash') ?>
								</td>
							</tr>
						<?php $total = $total + (($r->qty * $r->harga) - $r->discrp2);
							$no++;
						} ?>
						<tr class="gradeA">
							<td style="text-align:right" colspan="5"><b>TOTAL</b></td>
							<td style="text-align:right"><b>Rp. <?= number_format($total); ?></b></td>
							<td></td>
						</tr>
						<?php if ($bayar->num_rows() > 0) {
							$tbayar = $bayar->row()->bayar
						?>
							<tr class="gradeA">
								<td style="text-align:right" colspan="5"><b>PEMBAYARAN</b></td>
								<td style="text-align:right"><b>Rp. <?= number_format($bayar->row()->bayar); ?></b></td>
								<td style="text-align:center">
									<?= anchor('transaksi/hapusBayar/'.$bayar->row()->id_transaksi, 'Hapus', array('class' => 'btn btn-danger'), 'trash') ?>
								</td>
							</tr>
							<tr class="gradeA">
								<td style="text-align:right" colspan="5"><b>KEMBALIAN</b></td>
								<td style="text-align:right"><b>Rp. <?= number_format($bayar->row()->bayar - $total); ?></b></td>
								<td></td>
							</tr>
						<?php }else{
							$tbayar = 0;
						}
						?>
					</tbody>
				</table>
			</div>
			<!-- /. TABLE  -->
		</div>
	</div>
</div>
<!-- /. ROW  -->
<?php if ($bayar->num_rows() > 0) { ?>
	<?= anchor('transaksi/selesai/'.$inv, 'SIMPAN', array('class' => 'btn btn-primary btn-sm'), 'save') ?>
	<br><br>
	</form>
<?php } ?>

<?php if ($bayar->num_rows() > 0) { ?>
<div style="padding-bottom:10px">
	<button type="button" onclick="cetak_nota('ceknota')" class="btn btn-warning btn-sm"><b>
		<i class="fa fa-print"></i>&nbsp; CETAK NOTA</b>
	</button>
</div>
<?php } ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table style="width:100%">
					<tr>
						<td style="width:50%;padding:5px;text-align:right;font-weight:bold">PEMBAYARAN :</td>
						<td style="width:50%;padding:5px">
							<input type="text" name="bayardong" id="bayardong" placeholder="BAYAR" class="form-control">
						</td>
					</tr>
					<tr>
						<td></td>
						<td><button onclick="bayarDong()" class="btn btn-primary btn-sm btn-bayar" style="font-weight:bold"><i class="fa fa-money"></i> BAYAR</button></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- <div style="padding-bottom: 20px;">
	<button class="btn btn-primary btn-sm" style="font-weight:bold"><i class="fa fa-save"></i> SIMPAN</button>
</div> -->

<script type="application/javascript">
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 3000);

	// BUTTON BAYAR
	function bayarDong() {
		bayar = $("#bayardong").val().split('.').join("");
		// alert(bayar)
		if (bayar == 0 || bayar == '') {
			swal("PEMBAYARAN TIDAK BOLEH KOSONG", "", "error");
			return
		}

		$("#btn-bayar").prop("disabled", true);
		$.ajax({
			url: '<?php echo base_url('Transaksi/bayarDong') ?>',
			type: "POST",
			data: ({
				bayar
			}),
			success: function(res) {
				data = JSON.parse(res)
				if (data.res) {
					window.location.href = data.url;
					$("#btn-bayar").prop("disabled", false);
				} else {
					swal(data.msg, "", "error");
					$("#btn-bayar").prop("disabled", false);
				}
			}
		})
	}

	function hitung() {

		var barang = $('#barang').val();
		var qty = $('#qty').val();
		var discc = $('#disc').val();

		$.ajax({
			// url: '<?php echo site_url() ?>transaksi/barang/' + barang,
			url: '<?php echo base_url() ?>transaksi/barang/' + barang,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				discrp = (discc * data.harga * qty) / 100;
				$('#discrp').val(discrp);
				$('#harga').val(data.harga);
				var tbayar = ((data.harga * qty) - discrp);
				document.getElementById("tbayar").innerHTML = formatCurrency1(tbayar);
				// $('#tbayar').val(tbayar);
			},
			error: function(data) {
				swal({
					title: "Data ERROR",
					html: " PILIH BARANG TERLEBIH DAHULU",
					type: "error",
					confirmButtonText: "OK"
				});
				$('#disc').val('');
			}
		});
	};

	function formatCurrency1(num) {
		num = num.toString().replace(/\$|\,/g, '');
		if (isNaN(num))
			num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num * 100 + 0.50000000001);
		cents = num % 100;
		num = Math.floor(num / 100).toString();
		if (cents < 10)
			cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
			num = num.substring(0, num.length - (4 * i + 3)) + ',' +
			num.substring(num.length - (4 * i + 3));
		return (((sign) ? '' : '-') + '' + num + '.' + cents);
		//return (((sign)?'':'-') + '' + num);
	}

	function cekhitung() {

		var barang = $('#barang').val();
		var harga = $('#harga').val();
		var qty = $('#qty').val();
		var cdisc = $('#disc').val();
		var cdiscrp = $('#discrp').val();

		totalbayar = (harga * qty - cdiscrp);

		if (barang == '' || barang == null) {
			swal({
				title: "Barang Masih Kosong",
				html: "<p>CEK LAGI</p>",
				type: "error",
				confirmButtonText: "OK"
			});
			return;
		}

		if (qty == '' || qty == null) {
			swal({
				title: "Quantity Masih Kosong",
				html: "<p>CEK LAGI</p>",
				type: "error",
				confirmButtonText: "OK"
			});
			return;
		}

		if (discc == '' || discc == null) {
			swal({
				title: "Diskon Masih Kosong",
				html: "<p>CEK LAGI</p>",
				type: "error",
				confirmButtonText: "OK"
			});
			return;
		}

		$.ajax({
			// url: '<?php echo site_url() ?>transaksi/barang/' + barang,
			url: '<?php echo base_url() ?>transaksi/barang/' + barang,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				discrp = (discc * data.harga * qty) / 100;
				$('#discrp').val(discrp);
			},
			error: function(data) {
				swal({
					title: "Data ERROR",
					html: " PILIH BARANG TERLEBIH DAHULU",
					type: "error",
					confirmButtonText: "OK"
				});
			}
		});
	};

	let rfharga = document.getElementById('bayardong');
	rfharga.addEventListener('keyup', function(e) {
		rfharga.value = formatRupiah(this.value);
	});
	/* Fungsi formatRupiah */
	function formatRupiah(angka) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	}

	function cetak_nota(id_transaksi)
    {
		var baseurl   = "<?= base_url() ?>";
		var cetak1    = baseurl + 'Laporan/cetak_nota/?id_transaksi=' + id_transaksi;

		window.open(cetak1,'_blank');
    }
</script>
