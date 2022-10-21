<?php include("main_header.php"); ?>
<body class="hold-transition skin-black-light sidebar-mini fixed">
<div class="pace  pace-inactive pace-inactive">
	<div class="pace-progress" data-progress-text="100%" data-progress="99"
	     style="transform: translate3d(100%, 0px, 0px);">
		<div class="pace-progress-inner"></div>
	</div>
	<div class="pace-activity"></div>
</div>
<div class="wrapper">
	<header class="main-header">
		<a href="<?= site_url() ?>" class="logo" style="font-size: 13px;height: 65px; display: flex; justify-content: center; align-items: center;">
			<span class="logo-lg"><img style='height:40px' src="<?= site_url('resources/img/logo_gestage.png') ?>"></span>
		</a>
		<nav class="navbar navbar-static-top">
			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a style="height:65px;display:flex;justify-content:center;align-items:center;"
						   href="javascript:history.go(-1);">< Précédent</a>
					</li>
					<li>
						<a style="height:65px;display:flex;justify-content:center;align-items:center;"
						   href="javascript:history.go(+1);">Suivant ></a>
					</li>
				</ul>
			</div>
			<a href="#" style="height:65px;" data-toggle="offcanvas" role="button">
				<i style="font-size:25px;margin: 20px 25px;" class="fas fa-bars"></i>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown notifications-menu">
						<a style="font-size: 35px;" href="#" class="dropdown-toggle" data-toggle="dropdown"
						   aria-expanded="false">
							<i class="far fa-bell"></i>
							<span style="right: 2px;font-size:20px;" class="label label-warning">
                                <?php if (is_teacher()) {
	                                echo count(get_obligations_unopen_by_teacher($this->session->userdata("userid")));
                                }
                                if (is_employer()) {
	                                echo count(get_obligations_unopen_by_employer($this->session->userdata("userid")));
                                }
                                if (is_student()) {
	                                echo count(get_obligations_unopen_by_student($this->session->userdata("userid")));
                                }

                                if (is_teacher()) {
	                                $obligations = array();
	                                foreach (get_obligations_unopen_by_teacher($this->session->userdata("userid")) as $obligation) {
		                                $obligations[] = $obligation["INTERNSHIP_ID"];
	                                }
	                                $unique_obligations = array_unique($obligations);
	                                sort($obligations);

	                                $obligations_count = array_count_values($obligations);
                                }

                                if (is_employer()) {
	                                $obligations = array();
	                                foreach (get_obligations_unopen_by_employer($this->session->userdata("userid")) as $obligation) {
		                                $obligations[] = $obligation["INTERNSHIP_ID"];
	                                }
	                                $unique_obligations = array_unique($obligations);
	                                sort($obligations);

	                                $obligations_count = array_count_values($obligations);
                                }

                                if (is_student()) {
	                                $obligations = array();
	                                foreach (get_obligations_unopen_by_student($this->session->userdata("userid")) as $obligation) {
		                                $obligations[] = $obligation["INTERNSHIP_ID"];
	                                }
	                                $unique_obligations = array_unique($obligations);
	                                sort($obligations);

	                                $obligations_count = array_count_values($obligations);
                                } ?>
                            </span>
						</a>
						<ul class="dropdown-menu border border-primary">
							<li class="message-header text-center">
								<?php if (isset($unique_obligations)) { ?>
								<h4>VOS OBLIGATIONS</h4>
								<table class="table table-striped">
									<thead>
									<tr>
										<th style="text-align:center;" class="col-md-6">STAGE</th>
										<th style="text-align:center;" class="col-md-6">NOMBRE</th>
									</tr>
									</thead>
									<?php foreach ($unique_obligations as $uo) { ?>
										<tr>
											<td>
												<a href="/internship/edit/<?= $uo ?>/#vosobligations">STAGE #<?= $uo ?></a>
											</td>
											<td><?= $obligations_count[$uo] ?></td>
										</tr>
									<?php } ?>
								</table>
								<?php } ?>
							</li>
							<li class="message-footer"></li>
						</ul>
					</li>

					<li class="dropdown user user-menu">
						<a style="height: 60px; display: flex; justify-content: center; align-items: center;" href="#"
						   class="dropdown-toggle" data-toggle="dropdown">
							<span class="">Bonjour, <strong><?= get_current_user_name(); ?></strong></span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src="/resources/img/gestage-small-logo.png" class="img-circle" alt="User Image">
								<p>
									<?= get_current_user_name(); ?>
									<?php if ($this->session->userdata("status_id") == 0) {
										echo "<small>Administrateur</small>";
									}
									if ($this->session->userdata("status_id") == 1) {
										echo "<small>Élève</small>";
									}
									if ($this->session->userdata("status_id") == 2) {
										echo "<small>Enseignant</small>";
									}
									if ($this->session->userdata("status_id") == 3) {
										echo "<small>Employeur</small>";
									} ?>
								</p>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<?php if ($this->session->userdata("status_id") != 3) { ?>
										<a href="<?= site_url("user/profile") ?>" class="btn btn-default btn-flat">Profil</a>
									<?php } else { ?>
										<a href="<?= site_url("employer/profile") ?>" class="btn btn-default btn-flat">Profil</a>
									<?php } ?>
								</div>
								<div class="pull-right">
									<a href="<?= site_url("user/disconnect") ?>" class="btn btn-default btn-flat">Déconnecter</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>

		<?php if (($this->uri->segment(1) == "internship") && ($this->uri->segment(2) == "edit")) { ?>
		<nav class="hidden-xs navbar navbar-static-top" style='border:1px solid #eee;'>
			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="scroll">
						<a href="javascript:scrollToAnchor('informations');">INFORMATIONS</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('blocs');">BLOCS</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('presences');">PRÉSENCES</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('horairestage');">HORAIRE</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('vosobligations');">VOS OBLIGATIONS</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('obligationsgenerales');">OBLIGATIONS GÉNÉRALES</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('documents');">DOCUMENTS</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('notes');">NOTES</a>
					</li>
					<li class="scroll">
						<a href="javascript:scrollToAnchor('pdf');">DOCUMENTS PDF</a>
					</li>
				</ul>
			</div>
		</nav>
		<?php } ?>
	</header>

	<aside class="main-sidebar">
		<section class="sidebar">
			<ul class="sidebar-menu">
				<li>
					<a href="<?= site_url() ?>">
						<i class="fas fa-tachometer-alt" style="margin: 0 4px"></i> <span>MENU PRINCIPAL</span>
					</a>
				</li>
				<?php if (get_current_user_status() == "admin") {
					include("menu_admin.php");
				}
				if (get_current_user_status() == "student") {
					include("menu_student.php");
				}
				if (get_current_user_status() == "teacher") {
					include("menu_teacher.php");
				}
				if (get_current_user_status() == "employer") {
					include("menu_employer.php");
				} ?>
			</ul>
		</section>
	</aside>

	<div class="content-wrapper">
		<section class="content">
			<?php if (isset($_view) && $_view) {
				$this->load->view($_view);
			} ?>
		</section>
	</div>

	<footer class="main-footer">
		<strong>Logiciel créé par <a href="https://blitzmedia.io/" target="_blank">Blitz Média</a></strong>
	</footer>

	<aside class="control-sidebar control-sidebar-dark">
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
		<div class="tab-content">
			<div class="tab-pane" id="control-sidebar-home-tab"></div>
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
		</div>
	</aside>
	<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<?php include("main_footer.php"); ?>
</body>
</html>
