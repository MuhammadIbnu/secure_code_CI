<div class="box">
	<div class="box-header">
		<h3 class="box-title">Responsive Hover Table</h3>
		<div class="box-tools">
			<div class="input-group input-group-sm" style="width: 150px;">
				<div class="input-group-btn">
					<a href="<?= site_url('user/tambah') ?>" class="btn btn-default"><i class="fa fa-plus"></i></a>
				</div>
				<input type="text" style='width:250px' name="table_search" class="form-control pull-right" placeholder="Search">
				<div class="input-group-btn">
					<button type="submit" class="btn btn-default cari"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive no-padding">
		<?php
		if ($this->session->flashdata('pesan_error')) {
			echo "<div class='alert alert-danger'>" . $this->session->flashdata('pesan_error') . "</div>";
		}
		?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Username</th>
					<th>Nama</th>
					<th>Level</th>
					<th>LastLogin</th>
					<th>LastIP</th>
					<th>Token</th>
					<th>Tools</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($data_user->num_rows() > 0) {
					foreach ($data_user->result() as $row) {
						echo "<tr>
 <td>
<a href='" . site_url("user/edit/" . encode($row->user_id)) . "' class='fa fa-pencil'></a>
 <a href='" . site_url("user/hapus/" . encode($row->user_id)) . "' onclick='return confirm(\"YAkin????\")'
class='fa fa-trash'> </a>
 </td>
<td>$row->username</td>
 <td>$row->nama</td>
 <td>$row->user_level_id</td>
 <td>$row->user_last_login</td>
 <td>$row->user_last_ip</td>
 <td>$row->token</td>
 </tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div>
	<!-- /.box-body -->
	<div class='box-footer clearfix'>
	</div>
</div>

<script>
	$(document).ready(function(){
		var csrfHash = "<?=$this->security->get_csrf_hash()?>";
		$('.cari').click(function(){
			$.ajax({
				url:'<?=site_url('/user/cari')?>',
				method:'POST',
				dataType:'json',
				data:{
					q:$('input[name=table_search]').val(),
					<?=$this->security->get_csrf_token_name()?>:csrfHash
				},
				success:function(a){
					$('tbody').html(a.body); csrfHash=a.csrfHash
				}
			})
		});
	});
</script>
