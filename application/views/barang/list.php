<div id="barang">
	<h3 style="margin-bottom:12px" ><b>Data Barang</b></h3>
	<button data-toggle="modal" data-target="#tmbhbarang" class="btn btn-tosca"><span class="glyphicon glyphicon-plus"></span>  <b> Tambah Barang<b></button>

<div class="tablle">
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<th style="text-align:center" >No</th>
			<th style="text-align:center" >Nama Barang</th>
			<th style="text-align:center" >Harga</th>
			<th style="text-align:center" >Qty</th>
			<th style="text-align:center"  colspan="2">Aksi</th>
		</thead>
		<tbody>
		<?php $no = 1; foreach($barang as $s) { ?>
			<tr class="gradeU">
				<td align="center" ><?= $no++ ?></td>
				<td><?= $s->nama_barang ?></td>
				<td>Rp. <?= number_format($s->harga,2) ?></td>
				<td align="center" ><?= $s->stok ?></td>
				<td align="center" ><?= anchor('barang/edit/'.$s->id_barang,'Edit',array('class'=>'btn btn-warning'),'pencil'); ?></td>
				<td align="center" >
				<button type="button" onclick="hapus('<?= $s->id_barang ?>','<?= $s->nama_barang ?>')" class="btn btn-danger"><b><i class="fa fa-trash-o"></i>&nbsp; Hapus</b></button> 
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

	<div id="tmbhbarang" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Barang Baru</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('barang/tambah'); ?>" method="POST">
						<div class="form-group">
							<label>Nama Barang</label>
							<input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang ..">
						</div>
						<div class="form-group">
							<label>Harga</label>
							<input name="harga" type="text" class="form-control" placeholder="Harga ..">
						</div>	
						<div class="form-group">
							<label>QTY</label>
							<input name="qty" type="number" class="form-control" placeholder="Quantity ..">
						</div>	
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" value="Simpan"><i class="fa fa-save"></i>&nbsp; <b>Simpan</b></button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function hapus(id,nm){
		// swal({
        //     html: "Apakah Yakin Kamu Ingin Menghapus <br> Barang '<b>"+nm+"</b>'  ?",
        //     type: "question",
        //     confirmButtonColor: "#c9302c",
        //     confirmButtonText: "<b>Hapus</b>",
        //     cancelButtonColor: "#1000c9",
        //     cancelButtonText: "<b>Batal</b>",
        //     showCancelButton: true
        // }).then((willDelete) => {
        //     if (willDelete) {
                $.ajax({
                    url         : "<?php echo base_url('barang/hapus')?>/"+id,
                    type        : "POST",
                    dataType    : "JSON",
                    success: function(data){
                        if(data.status == 0){
                            swal({
                                html: "Barang Gagal Dihapus",
                                type: "error",
                                confirmButtonText: "Ok" 
                            });
                        } else {

							swal({
								title: "DATA",
								html: "<p> Berhasil Terhapus </p>",
								type: "success",
								confirmButtonText: "OK" 
							}).then((value) => {                        
								window.location.reload();
							});	
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        swal({
                            html: "Barang Gagal Dihapus ",
                            type: "error",
                            confirmButtonText: "Ok" 
                        });
                    }
                });
	}
    //     });
	// }
</script>
