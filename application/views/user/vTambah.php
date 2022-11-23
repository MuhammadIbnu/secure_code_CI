<div class="box box-primary">
	<?php
	if (validation_errors()) {
		echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
	}
	if ($this->session->flashdata('pesan_error')) {
		echo "<div class='alert alert-danger'>" . $this->session->flashdata('pesan_error') . "</div>";
	}
	?>
	<div class="box-header with-border">
		<h3 class="box-title">Tambah Data User</h3>
	</div>
	<form role="form" action="<?= site_url($this->uri->uri_string()) ?>" method="POST">
		<div class="box-body">
			<div class="form-group">
				<label>Username</label>
				<input type="email" class="form-control" name='username' placeholder="Enter email">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name='password' placeholder="Password">
			</div>
			<div class="form-group">
				<label>Confirm</label>
				<input type="password" class="form-control" name='confirm' placeholder="Password">
			</div>
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name='nama' placeholder="Enter Nama">
			</div>
			<div class="form-group">
				<label>Level</label>
				<select name='level' class='form-control' required>
					<option value='' disabled selected> Pilih Level Pengguna
					</option>
					<option value='1'> Admin </option>
					<option value='2'> Operator </option>
				</select>
				<input type='hidden' name='<?= $this->security->get_csrf_token_name() ?>' value='<?= $this->security->get_csrf_hash() ?>' />
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
	</form>
</div>
