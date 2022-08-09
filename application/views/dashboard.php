<div style="display: none;" id="browsercheck" class="row">
	<div style="background-color: orange; border-radius: 5px; text-align: center; padding-top: 15px; padding-bottom: 15px; border: 1px solid black; color: black; font-weight: bold; text-transform: uppercase;"
	     class="col-md-6">
		<p style="margin-bottom:0;">Pour la meilleure expérience possible, il est recommandé d'utiliser un navigateur
			plus récent.</p>
		<a href="https://www.google.com/intl/fr/chrome/" target="_blank"> CHROME </a>
		<label> | </label>
		<a href="https://www.mozilla.org/fr/firefox/" target="_blank"> FIREFOX </a>
	</div>
</div>

<?php if (get_current_user_status() == "admin") { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						Tableau de bord - Administrateur
					</h3>
				</div>
			</div>
		</div>
	</div>
<?php }
if (get_current_user_status() == "teacher") { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">
						Tableau de bord - Enseignants
					</h3>
				</div>
				<div class="box-body">
					<div class="row" style="display: flex; justify-content: center; align-items: center;">
						<div class="col-md-3">
							<div class="small-box bg-blue">
								<div class="inner">
									<h3><?= get_student_count_by_teacher($this->session->userdata("userid"), "SELF") ?></h3>
									<p>ÉLÈVES ASSIGNÉS</p>
								</div>
								<div class="icon">
									<i class="ion ion-person"></i>
								</div>
								<p class="small-box-footer">&nbsp;</p>
							</div>
						</div>

						<div class="col-md-3 ">
							<div class="small-box bg-red">
								<div class="inner">
									<h3><?= count(get_obligations_unopen_by_teacher($this->session->userdata("userid"))) ?></h3>
									<p>NOUVELLES OBLIGATIONS</p>
								</div>
								<div class="icon">
									<i class="ion ion-edit"></i>
								</div>
								<p class="small-box-footer">&nbsp;</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading with-border">
									<h3 class="panel-title">PROFIL DE L'UTILISATEUR</h3>
								</div>
								<?= form_open('user/profile/') ?>
								<div class="panel-body">
									<div class="row clearfix">
										<div class="col-md-12">
											<img class="center-block" src="<?= site_url('resources/img/logo_gestage.png') ?>">
											<br>
											<h3 class="profile-username text-center"><?= $user["NAME"] ?></h3>
											<h3 class="profile-username text-center"><?= $user["EMAIL_CS"] ?></h3>
											<p class="text-muted text-center"><?= $type ?></p>
											<ul class="list-group list-group-unbordered">
												<?php if ($typeid == 1) { ?>
													<li class="list-group-item">
														<b>Tuteur de stage</b>
														<a class="pull-right"><?= get_user_fullname_by_id_and_type($user["TEACHER_ID"], "2") ?></a>
													</li>
													<li class="list-group-item">
														<b>Programme</b>
														<a class="pull-right"><?= get_program_name_by_id($user["PROGRAM_ID"]) ?></a>
													</li>
													<li class="list-group-item">
														<b>Groupe</b>
														<a class="pull-right"><?= $user["GROUP_ID"] ?></a>
													</li>
												<?php } ?>
												<?php if ($typeid == 2) {
													foreach ($programs as $program) {
														echo "<li class=\"list-group-item\"><b>Membre du programme</b> <a class=\"pull-right\">" . $program["NAME"] . "</a></li>";
													}
													foreach ($students as $student) {
														echo "<li class=\"list-group-item\"><b>Élève: </b>" . $student["NAME"] . "<a class=\"pull-right\">" . get_program_name_by_id($student["PROGRAM_ID"]) . "</a></li>";
													}
												} ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }
if (get_current_user_status() == "employer") { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">
						Tableau de bord - Employeurs
					</h3>
				</div>

				<div class="box-body">
					<div class="col-md-3">
						<div class="small-box bg-blue">
							<div class="inner">
								<h3><?= get_internship_count_by_employer($this->session->userdata("userid"), "SELF") ?></h3>
								<p>STAGES ASSIGNÉS</p>
							</div>
							<div class="icon">
								<i class="ion ion-monitor"></i>
							</div>
							<p class="small-box-footer">&nbsp;</p>
						</div>
					</div>

					<div class="col-md-3">
						<div class="small-box bg-blue">
							<div class="inner">
								<h3><?= get_student_count_by_employer($this->session->userdata("userid"), "SELF") ?></h3>
								<p>ÉLÈVES ASSIGNÉS</p>
							</div>
							<div class="icon">
								<i class="ion ion-person"></i>
							</div>
							<p class="small-box-footer">&nbsp;</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="small-box bg-blue">
							<div class="inner">
								<h3><?= get_count_programs_by_employer_id($this->session->userdata("userid"), "PROGRAM") ?></h3>
								<p>PROGRAMMES ASSIGNÉS</p>
							</div>
							<div class="icon">
								<i class="ion ion-person"></i>
							</div>
							<p class="small-box-footer">&nbsp;</p>
						</div>
					</div>
					<div class="col-md-3 ">
						<div class="small-box bg-red">
							<div class="inner">
								<h3><?= count(get_obligations_unopen_by_employer($this->session->userdata("userid"))) ?></h3>
								<p>NOUVELLES OBLIGATIONS</p>
							</div>
							<div class="icon">
								<i class="ion ion-edit"></i>
							</div>
							<p class="small-box-footer">&nbsp;</p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading with-border">
									<h3 class="panel-title">PROFIL DE L'UTILISATEUR</h3>
								</div>
								<div class="panel-body">
									<div class="row clearfix">
										<div class="col-md-12">
											<img class="center-block" src="<?= site_url('resources/img/logo_gestage.png') ?>"> <br>
											<h3 class="profile-username text-center"><?= $user["EMPLOYER_NAME"] ?></h3>
											<h3 class="profile-username text-center"><?= $user["CONTACT_NAME"] ?></h3>
											<p class="text-muted text-center"><?= $type ?></p>
											<p class="text-muted text-center"><?= $user["USERNAME"] ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }
if (get_current_user_status() == "student") { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">
						Tableau de bord - ÉLÈVE
					</h3>
				</div>
				<div class="box-body">
					<div class="row" style="display:flex;justify-content:center;align-items:center;">
						<div class="col-md-3 ">
							<div class="small-box bg-blue">
								<div class="inner">
									<h3><?= get_internship_count_by_student($this->session->userdata("userid"), $user["PROGRAM_ID"]) ?></h3>
									<p>STAGES ASSIGNÉS</p>
								</div>
								<div class="icon">
									<i class="ion ion-monitor"></i>
								</div>
								<p class="small-box-footer">&nbsp;</p>
							</div>
						</div>

						<div class="col-md-3 ">
							<div class="small-box bg-red">
								<div class="inner">
									<h3><?= count(get_obligations_unopen_by_student($this->session->userdata("userid"))) ?></h3>
									<p>NOUVELLES OBLIGATIONS</p>
								</div>
								<div class="icon">
									<i class="ion ion-edit"></i>
								</div>
								<p class="small-box-footer">&nbsp;</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading with-border">
									<h3 class="panel-title">PROFIL DE L'UTILISATEUR</h3>
								</div>
								<?= form_open('user/profile/') ?>
								<div class="panel-body">
									<div class="row clearfix">
										<div class="col-md-12">
											<img class="center-block" src="<?= site_url('resources/img/logo_gestage.png') ?>">
											<br>
											<h3 class="profile-username text-center"><?= $user["NAME"] ?></h3>
											<h3 class="profile-username text-center"><?= $user["EMAIL_CS"] ?></h3>
											<p class="text-muted text-center"><?= $type ?></p>
											<p class="text-muted text-center"><?= $user["SCHOOL"] ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
