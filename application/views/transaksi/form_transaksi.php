<h3 style="margin-bottom:12px" ><b>Transaksi</b></h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= form_open('transaksi', array('class'=>'form-horizontal')); ?>

                    
                    <div class="form-group">
                        <label class="col-sm-5 control-label">~ Barang ~</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No. Invoice</label>
                        <div class="col-sm-4">
                        <input type="text" id="inv" name="inv" class="form-control" value="<?= $inv?>" readonly>
                        </div>
                        
                        <label class="col-sm-2 control-label">Nama User</label>
                        <div class="col-sm-4">
                        <input type="text" id="user" name="user" class="form-control" value="<?= $user?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-4">
                        <select name="barang" id="barang" class="form-control" required>
                                <option value="" >-- Pilih Barang --</option>
                                <?php foreach ($barang->result() as $b) { ?>
                                    <option value="<?= $b->id_barang ?>">
                                    [ Rp.<?= $b->harga ?> ]  <?= $b->nama_barang ?>  
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
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

                        <label class="col-sm-2 control-label">Diskon Rp</label>
                        <div class="col-sm-4">
                            <input type="number" name="discrp" id="discrp" placeholder="discrp" class="form-control" required readonly>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> <b>Tambah Barang</b></button> 
                        </div>
                    </div>
                    
                    <?php if($this->session->flashdata('warning')){ ?>  
                        <div class="alert alert-danger">  
                            <a href="#" class="close" data-dismiss="alert">&times;</a>  
                            <strong>Warning !! </strong> <?= $this->session->flashdata('warning'); ?>  
                        </div>  
                    <?php } ?>  
                    
                    

                    <hr>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">~ Pembayaran ~</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Total Bayar</label>
                        <div class="col-sm-4">
                            <input type="number" name="tbayar" id="tbayar" placeholder="Rp." class="form-control" required readonly>
                            <!-- <span id="tbayar"></b></font></span> -->
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
                </datalist>
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
                                    <th style="text-align:center" >No.</th>
                                    <th style="text-align:center" >Nama Barang</th>
                                    <th style="text-align:center" >Qty</th>
                                    <th style="text-align:center" >Harga</th>
                                    <th style="text-align:center" >Diskon</th>
                                    <th style="text-align:center" >Sub Total</th>
                                    <th style="text-align:center" >Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; $total=0; foreach ($detail as $r){ ?>
                                <tr class="gradeU">
                                    <td align="center"><?= $no ?></td>
                                    <td><?= $r->nama_barang ?></td>
                                    <td><?= $r->qty ?></td>
                                    <td>Rp. <?= number_format($r->harga,2) ?></td>
                                    <td>Rp. <?= number_format($r->discrp2,2) ?></td>
                                    <td>Rp. <?= number_format(($r->qty*$r->harga)-$r->discrp2,2) ?></td>
                                    <td align="center">
                                        <?=anchor('transaksi/hapusitem/'.$r->id_transaksi_dtl,'Hapus',array('class'=>'btn btn-danger'),'trash') ?>
                                    </td>
                                </tr>
                            <?php $total=$total+(($r->qty*$r->harga)-$r->discrp2);
                            $no++; } ?>
                                <tr class="gradeA">
                                    <td colspan="4" align="center"><b>T O T A L</b></td>
                                    <td><b>Rp. <?= number_format($total,2);?></b></td>
                                    <td><b></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /. TABLE  -->
                </div>
            </div>
        </div>
    <!-- /. ROW  -->
    <?= anchor('transaksi/selesai/'.$inv,'Simpan',array('class'=>'btn btn-primary btn-sm'),'save')?>
    <br><br>
    </form>

    <script type="application/javascript"> 

    window.setTimeout(function() {  
        $(".alert").fadeTo(500, 0).slideUp(500, function() {  
        $(this).remove();  
        });  
    }, 3000);  

    function hitung() {
        
        var barang    = $('#barang').val();
        var qty       = $('#qty').val();
        var discc     = $('#disc').val();

        $.ajax({
            // url: '<?php echo site_url() ?>transaksi/barang/' + barang,
            url: '<?php echo base_url() ?>transaksi/barang/' + barang,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                discrp = (discc*data.harga*qty)/100;
                $('#discrp').val(discrp);
                $('#harga').val(data.harga);
                var tbayar = ((data.harga*qty)-discrp);
                document.getElementById("tbayar").innerHTML=formatCurrency1(tbayar);
                // $('#tbayar').val(tbayar);
            },
            error: function(data) {
                swal({
                    title   : "Data ERROR",
                    html    : " PILIH BARANG TERLEBIH DAHULU",
                    type    : "error",
                    confirmButtonText   : "OK"
                });
                $('#disc').val('');
            }
        });
    };

    function formatCurrency1(num) {
        num   = num.toString().replace(/\$|\,/g,'');
        if(isNaN(num))
        num   = "0";
        sign  = (num == (num = Math.abs(num)));
        num   = Math.floor(num*100+0.50000000001);
        cents = num%100;
        num   = Math.floor(num/100).toString();
        if(cents<10)
        cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num   = num.substring(0,num.length-(4*i+3))+','+
        num.substring(num.length-(4*i+3));
        return (((sign)?''    : '-') + '' + num + '.' + cents);
        //return (((sign)?'':'-') + '' + num);
	}

    function cekhitung() {
        
        var barang    = $('#barang').val();
        var harga     = $('#harga').val();
        var qty       = $('#qty').val();
        var cdisc     = $('#disc').val();
        var cdiscrp   = $('#discrp').val();

        totalbayar = (harga*qty-cdiscrp);

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
                discrp= (discc*data.harga*qty)/100;
                $('#discrp').val(discrp);
            },
            error: function(data) {
                swal({
                    title   : "Data ERROR",
                    html    : " PILIH BARANG TERLEBIH DAHULU",
                    type    : "error",
                    confirmButtonText   : "OK"
                });
            }
        });
    };
</script>
