<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard | OTI Secure</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/skins/_all-skins.min.css">
	<script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400i
talic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?= site_url('dashboard') ?>" class="logo">
				<span class="logo-mini"><b>O</b>TI</span>
				<span class="logo-lg"><b>Secure</b>OTI</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"> </span><span class="icon-bar"></span> <span class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?= base_url('assets') ?>/dist/img/inix.jpg" class="user-image">
								<span class="hidden-xs"><?= $this->session->userdata('nama') ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?= base_url('assets') ?>/dist/img/inix.jpg" class="img-circle">
									<p> <?= $this->session->userdata('nama') ?> - <?= $this->session->userdata('level') ?></p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?= site_url('login/logout') ?>" class="btn btn-default btn-flat"> SignOut </a>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						<li> <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> </li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- =======================SIDEBARS======================== -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?= base_url('assets') ?>/dist/img/inix.jpg" class="img-circle">
					</div>
					<div class="pull-left info">
						<p><?= $this->session->userdata('nama') ?></p>
					</div>
				</div>
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MENU UTAMA</li>
				</ul>
			</section>
		</aside>
		<!-- ======================CONTENT CENTER========================= -->
		<div class="content-wrapper">
			<section class="content">
				<?php
				if(isset($center)){
					$this->load->view($center);
				}
				?>
			</section>
		</div>
		<aside class="control-sidebar control-sidebar-dark"></aside>
		<div class="control-sidebar-bg"></div>
	</div>
	<script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.sidebar-menu').tree()
		})
	</script>
</body>

</html>
