<div class="box box-primary">
		<?php
			if ($this->session->flashdata('pesan_error')) {
				echo "<div class='alert alert-danger'>" . $this->session->flashdata('pesan_error') . "</div>";
			}
			?>
	<div class="box-body box-profile">
		<img class="profile-user-img img-responsive img-circle" src="<?= base_url("assets/profile/$user_data->user_id" . "f.jpg") ?>">
		<form method="post" enctype="multipart/form-data" action="<?= site_url('profile/do_upload') ?>">
			<input type='hidden' name='<?= $this->security->get_csrf_token_name() ?>' value='<?= $this->security->get_csrf_hash() ?>' />
			<input type='file' name='userfile'>
			<input type='submit' value='Upload' class='btn btn-primary center' />
		</form>
		<h3 class="profile-username text-center"><?= $user_data->nama ?></h3>
		<p class="text-muted text-center"><?= $user_data->user_level_id ?></p>
		<ul class="list-group list-group-unbordered">
			<li class="list-group-item">
				<b>Username</b> <a class="pull-right"><?= $user_data->username ?></a>
			</li>
			<li class="list-group-item">
				<b>Last Login</b> <a class="pull-right"><?= $user_data->user_last_login ?></a>
			</li>
			<li class="list-group-item">
				<b>Last IP</b> <a class="pull-right"><?= $user_data->user_last_ip ?></a>
			</li>
		</ul>
		<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
	</div>
	<!-- /.box-body -->
</div>
