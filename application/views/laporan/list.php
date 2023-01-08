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
                                <th style="text-align:center">Tanggal Transaksi</th>
                                <th style="text-align:center">Operator</th>
                                <th style="text-align:center">Total Transaksi</th>
                                <th style="text-align:center">Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; $total=0; foreach ($record->result() as $r){ ?>
                            <tr class="gradeU">
                                <td><?= $no ?></td>
                                <td><?= $r->invoice ?></td>
                                <td><?= $this->M_cetak->tanggal_format_indonesia($r->tanggal_transaksi) ?></td>
                                <td><?= $r->nama_lengkap ?></td>
                                <td style="text-align:right">Rp. <?= number_format($r->total - $r->disc) ?></td>
                                <td style="text-align:center">
                                    <button type="button" onclick="cetak_nota('<?= $r->id_transaksi ?>')" class="btn btn-warning"><b>
                                        <i class="fa fa-print"></i>&nbsp; Cetak</b>
                                    </button>
                                </td>
                            </tr>
                        <?php $no++; $total=$total+$r->total; } ?>
                            <tr>
                                <td colspan="4">Total</td>
                                <td style="text-align:right">Rp. <?= number_format($total);?></td>
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
