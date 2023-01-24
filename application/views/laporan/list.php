<h3 style="margin-bottom:12px" >Laporan</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= form_open('laporan', array('class'=>'form-inline')); ?>
                    <div class="form-group">
                        <label for="exampleInputName2">Tanggal</label>
                        <input type="date" name="tanggal1" class="form-control" placeholder="Tanggal Mulai">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2"> s/d </label>
                        <input type="date" name="tanggal2" class="form-control" placeholder="Tanggal Selesai">
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit" name="submit"><b>Tampilkan</b></button>
                    <button class="btn btn-danger btn-sm" onclick="cetak()" type="button" name="submit"><i class="fa fa-print"></i>&nbsp;<b>CETAK PDF</b></button>
                </form>
            </div>
        </div>
        <!-- /. PANEL  -->
    </div>


    <div class="col-md-12">
        <div class="panell">
            <div class="panell-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align:center">No.</th>
                                <th style="text-align:center">ID Transaksi</th>
                                <th style="text-align:center">Tgl Transaksi</th>
                                <th style="text-align:center">Operator</th>
                                <th style="text-align:center">Total Transaksi</th>
                                <th style="text-align:center">Total Diskon</th>
                                <th style="text-align:center">Total Bayar</th>
                                <th style="text-align:center">Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
							$no = 0;
							$toTotal = 0;
							$totDis = 0;
							$totSubTotal = 0;
							foreach ($record->result() as $r) {
								$no++;
								$idt = $this->db->query("SELECT*FROM transaksi_dtl WHERE id_transaksi='$r->id_transaksi'");
								$totTransaksi = 0;
								$sumSubTotal = 0;
								$subDis = 0;
								foreach($idt->result() as $r2){
									if($r2->discrp2 == 0){
										$subTotal = $r2->qty * $r2->harga;
										$jumdis = 0;
									}else{
										if($r2->disc == 0){
											$subTotal = (($r2->qty * $r2->harga) - $r2->potongan);
											$jumdis = $r2->potongan;
										}else{
											$subTotal = ($r2->qty * $r2->harga) - $r2->discrp2;
											$jumdis = $r2->discrp2;
										}
									}
									$totTransaksi += $r2->qty * $r2->harga;
									$sumSubTotal += $subTotal;
									$subDis += $jumdis;
								}

							$toTotal += $totTransaksi;
							$totDis += $subDis;
							$totSubTotal += $sumSubTotal;
						?>
                            <tr class="gradeU">
                                <td style="text-align:center"><?= $no ?></td>
                                <td><?= $r->invoice ?></td>
                                <td><?= $this->M_cetak->tanggal_format_indonesia($r->tanggal_transaksi) ?></td>
                                <td><?= $r->nama_lengkap ?></td>
                                <td style="text-align:right">Rp. <?= number_format($totTransaksi) ?></td>
                                <td style="text-align:right">Rp. <?= number_format($subDis) ?></td>
                                <td style="text-align:right">Rp. <?= number_format($sumSubTotal) ?></td>
                                <td style="text-align:center">
                                    <button type="button" onclick="cetak_nota('<?= $r->id_transaksi ?>')" class="btn btn-warning"><b>
                                        <i class="fa fa-print"></i>&nbsp; Cetak</b>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td style="text-align:center;font-weight:bold" colspan="4">Total</td>
                                <td style="text-align:right;font-weight:bold">Rp. <?= number_format($toTotal);?></td>
                                <td style="text-align:right;font-weight:bold">Rp. <?= number_format($totDis);?></td>
                                <td style="text-align:right;font-weight:bold">Rp. <?= number_format($totSubTotal);?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /. TABLE  -->
            </div>
        </div>
    </div>
</div>
<!-- /. ROW  -->
<script>
    function cetak()
    {
		var baseurl   = "<?= base_url() ?>";
		var tgl1      = $('[name="tanggal1"]').val();
		var tgl2      = $('[name="tanggal2"]').val();
		var cetak1    = baseurl + 'Laporan/cetak/?tgl1=' + tgl1 + '&tgl2=' + tgl2+ '&cek=1';

		window.open(cetak1,'_blank');
    } 

    function cetak_nota(id_transaksi)
    {
		var baseurl   = "<?= base_url() ?>";
		var cetak1    = baseurl + 'Laporan/cetak_nota/?id_transaksi=' + id_transaksi;

		window.open(cetak1,'_blank');
    }
</script>
