<h3 style="margin-bottom:12px">Edit Barang</h3>
<?php foreach($barang as $s) { ?>
	<form action="<?= base_url('barang/load_edit') ?>" method="POST">
		<div class="form-group">
			<label>Nama Barang</label>
			<input name="id_barang" type="hidden" value="<?= $s->id_barang ?>">
			<input name="nama_barang" type="text" class="form-control" value="<?= $s->nama_barang ?>">
		</div>
		<div class="form-group">
			<label>Harga</label>
			<input name="harga" type="text" class="form-control" value="<?= $s->harga ?>">
		</div>
		<div class="form-group">
			<label>Quantity</label>
			<input name="qty" type="text" class="form-control" value="<?= $s->stok ?>">
		</div>
		<button type="submit" class="btn btn-primary" value="Simpan"><i class="fa fa-save"></i>&nbsp; <b>Simpan</b></button> &nbsp; 
		<?= anchor('barang','Kembali',array('class'=>'btn btn-danger'),'undo')?>
							
	</form>
<?php } ?>