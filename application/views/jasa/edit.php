<h3 style="margin-bottom:12px">Edit Jasa</h3>
<?php foreach($jasa as $s) { ?>
	<form action="<?= base_url('jasa/load_edit') ?>" method="POST">
		<div class="form-group">
			<label>Nama Jasa</label>
			<input name="id_jasa" type="hidden" value="<?= $s->id_jasa ?>">
			<input name="nama_jasa" type="text" class="form-control" value="<?= $s->nama_jasa ?>">
		</div>
		<div class="form-group">
			<label>Harga</label>
			<input name="harga" type="text" class="form-control" value="<?= $s->harga ?>">
		</div>
		<button type="submit" class="btn btn-primary" value="Simpan"><i class="fa fa-save"></i>&nbsp; <b>Simpan</b></button> &nbsp; 
		<?= anchor('jasa','Kembali',array('class'=>'btn btn-danger'),'undo')?>
							
	</form>
<?php } ?>