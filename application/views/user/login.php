<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gestage | Connexion</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?= site_url('resources/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= site_url('resources/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= site_url('resources/css/bootstrap-datetimepicker.min.css') ?>">
	<link rel="stylesheet" href="<?= site_url('resources/css/AdminLTE.min.css') ?>">
	<link rel="stylesheet" href="<?= site_url('resources/css/_all-skins.min.css') ?>">
	<link rel="stylesheet" href="<?= site_url('resources/css/sortable-minimal.css') ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="<?= site_url(); ?>" class="logo">
			<img height="80" src="<?php echo site_url('resources/img/logo_gestage.png'); ?>">
		</a>
		<p>Connexion</p>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Connectez-vous pour commencer votre session</p>

        <?= form_open("/user/login") ?>
			<div class="form-group has-feedback">
				<input type="text" name="login_id" class="form-control" placeholder="Identifiant" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="login_pass" class="form-control" placeholder="Mot de passe" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php if ($this->uri->segment(3) == "errorlogin") { ?>
						<p style="color: red">Identifiant ou mot de passe incorrect.</p>
					<?php } ?>
					<button type="submit" class="btn btn-primary btn-block btn-flat">Se connecter</button>
				</div>
            </div>
        <?= form_close() ?>
	</div>
</div>

<script src="<?= site_url('resources/js/jquery-2.2.3.min.js') ?>"></script>
<script src="<?= site_url('resources/js/jquery.tablesorter.min.js') ?>"></script>
<script src="<?= site_url('resources/js/bootstrap.min.js') ?>"></script>
<script src="<?= site_url('resources/js/fastclick.js') ?>"></script>
<script src="<?= site_url('resources/js/app.min.js') ?>"></script>
<script src="<?= site_url('resources/js/demo.js') ?>"></script>
<script src="<?= site_url('resources/js/moment.js') ?>"></script>
<script src="<?= site_url('resources/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?= site_url('resources/js/global.js') ?>"></script>

</body>
</html>
