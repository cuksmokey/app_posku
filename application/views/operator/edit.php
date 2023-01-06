<h3 style="margin-bottom:12px">Edit Operator</h3>
<?php foreach($operator as $s) { ?>
	<form action="<?php echo base_url('operator/load_edit') ?>" method="POST">
		<div class="form-group">
			<label>Nama Lengkap</label>
			<input name="operator_id" type="hidden" value="<?php echo $s->operator_id ?>">
			<input name="nama_lengkap" type="text" class="form-control" value="<?php echo $s->nama_lengkap ?>">
		</div>
		<div class="form-group">
			<label>Username</label>
			<input name="username" type="text" class="form-control" value="<?php echo $s->username ?>">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input name="password" type="password" class="form-control" placeholder="Password ..">
		</div>
		<?php echo anchor('operator','Kembali',array('class'=>'btn btn-danger'))?> || <input type="submit" class="btn btn-primary" value="Simpan">
	</form>
<?php } ?>