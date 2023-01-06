<h3 style="margin-bottom:12px;">Operator</h3>
<button style="margin-bottom:12px;" data-toggle="modal" data-target="#tmbop" class="btn btn-tosca"><span class="glyphicon glyphicon-plus"></span>   Tambah Operator</button>

<div class="table">
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<th style="text-align:center" >No</th>
			<th style="text-align:center" >Nama Lengkap</th>
			<th style="text-align:center" >Username</th>
			<th style="text-align:center" >Login Terakhir</th>
			<th style="text-align:center"  colspan="2">Aksi</th>
		</thead>
		<tbody>
		<?php $no = 1; foreach($operator as $s) { ?>
			<tr class="gradeU">
				<td><?php echo $no++ ?></td>
				<td><?php echo $s->nama_lengkap ?></td>
				<td><?php echo $s->username ?></td>
				<td><?php echo $s->last_login ?></td>
				<td align="center"><?php echo anchor('operator/edit/'.$s->operator_id,'Edit',array('class'=>'btn btn-warning'),'pencil'); ?></td>
				<td align="center"><?php echo anchor('operator/hapus/'.$s->operator_id,'Hapus',array('class'=>'btn btn-danger'),'trash'); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<div id="tmbop" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Operator Baru</h4>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url('operator/tambah'); ?>" method="POST">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input name="nama" type="text" class="form-control" placeholder="Nama Lengkap ..">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input name="username" type="text" class="form-control" placeholder="Username ..">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input name="password" type="password" class="form-control" placeholder="Password ..">
						</div>																	
				</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
							<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
					</form>
			</div>
		</div>
	</div>