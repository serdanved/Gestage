<div class="row">
	<?php if (is_current_user_having_program() != true && is_teacher()) { ?>
		<?php die("Vous n'êtes actuellement associé à aucun programme. Veuillez parler à votre administrateur système."); ?>
	<?php } ?>

	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">LISTE DES STAGES</h3>
			</div>
			<div class="box-body">
				<!-- SECTION POUR STAGE EN COURS -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-heading-with-add">
							<h3 class="panel-title">STAGES EN COURS</h3>
							<div class="panel-tools ">
								<?php if (is_teacher()) { ?>
									<a href="<?= site_url('internship/add') ?>"
									   style="float:right;"
									   class="btn btn-success btn-xs">
										<span class="glyphicon glyphicon-plus"></span>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="panel-body cell-border table-responsive">
						<table class="table table-hover internship-table-actives">
							<thead>
							<tr>
								<th>ÉLÈVE</th>
								<th>ENSEIGNANT</th>
								<th>PROGRAMME</th>
								<th>EMPLOYEUR</th>
								<th>DÉBUT DU STAGE</th>
								<th>FIN DU STAGE</th>
								<th>ACTIONS</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($internships as $I) { ?>
								<?php if (($I['INTERNSHIP_STATUS'] == 'NOW' || $I['INTERNSHIP_STATUS'] == 'FUTUR') && $I['INACTIVE'] == 0) { ?>
									<tr>
										<td><?= $I['STUDENT_NAME'] ?></td>
										<td><?= $I['TEACHER_NAME'] ?></td>
										<td><?= $I['PROGRAM_NAME'] ?></td>
										<td><?= $I['EMPLOYER_NAME'] ?></td>
										<td><?= $I['DATE_START'] ?></td>
										<td><?= $I['DATE_END'] ?></td>
										<td>
											<a href="<?= site_url('internship/edit/' . $I['ID']) ?>" class="btn btn-info btn-xs">
												<i class="fas fa-pencil-alt"></i>
											</a>
											<?php if (!is_student() && !is_employer()) { ?>
												<a href="<?= site_url('internship/setinactive/' . $I['ID']) ?>"
												   class="btn btn-danger btn-xs"
												   data-toggle="tooltip"
												   data-placement="bottom"
												   title="Mettre 'supprimé'">
													<span class="fa fa-trash"></span>
												</a>
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- SECTION POUR STAGE EN COURS -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<button class="btn_collapsed"
						        style="background:unset !important;border:unset !important;"
						        data-toggle="collapse"
						        aria-expanded="false"
						        href='#collapse-completed'
						        style="position:relative !important;"
						        class="panel-title collapsed">
							<i class="fa fa-plus"></i> STAGES ARCHIVÉS
						</button>
						<div class="panel-tools"></div>
					</div>
					<div class="panel-body cell-border table-responsive">
						<div id="collapse-completed" class="panel-collapse collapse">
							<table class="table table-hover internship-table-actives">
								<thead>
								<tr>
									<th>ÉLÈVE</th>
									<th>ENSEIGNANT</th>
									<th>PROGRAMME</th>
									<th>EMPLOYEUR</th>
									<th>DÉBUT DU STAGE</th>
									<th>FIN DU STAGE</th>
									<th>ACTIONS</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($internships as $I) { ?>
									<?php if (($I['INTERNSHIP_STATUS'] == 'PAST') && ($I['INACTIVE'] != '1')) { ?>
										<tr>
											<td><?= $I['STUDENT_NAME'] ?></td>
											<td><?= $I['TEACHER_NAME'] ?></td>
											<td><?= $I['PROGRAM_NAME'] ?></td>
											<td><?= $I['EMPLOYER_NAME'] ?></td>
											<td><?= date_in_french($I['DATE_START']) ?></td>
											<td><?= date_in_french($I['DATE_END']) ?></td>
											<td>
												<a href="<?= site_url('internship/edit/' . $I['ID']) ?>" class="btn btn-info btn-xs">
													<i class="fas fa-pencil-alt"></i>
												</a>
												<a href="<?= site_url('internship/setinactive/' . $I['ID']) ?>" class="btn btn-danger btn-xs">
													<span class="fa fa-trash"></span>
												</a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<?php if (!is_student() && !is_employer()) { ?>
					<!-- SECTION POUR STAGE SUPPRIMÉS -->
					<div class="panel panel-primary">
						<div class="panel-heading">
							<button class="btn_collapsed"
							        style="background:unset !important;border:unset !important;"
							        data-toggle="collapse"
							        aria-expanded="false"
							        href='#collapse'
							        style="position:relative !important;"
							        class="panel-title collapsed">
								<i class="fa fa-plus"></i> STAGES SUPPRIMÉS
							</button>
						</div>
						<div class="panel-body table-responsive">
							<div id="collapse" class="panel-collapse collapse">
								<table class="table table-hover internship-table">
									<thead>
									<tr>
										<th>ÉLÈVE</th>
										<th>ENSEIGNANT</th>
										<th>PROGRAMME</th>
										<th>EMPLOYEUR</th>
										<th>DÉBUT DU STAGE</th>
										<th>FIN DU STAGE</th>
										<th>ACTIONS</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($internships as $I) { ?>
										<?php if ($I['INACTIVE'] == '1') { ?>
											<tr>
												<td><?= $I['STUDENT_NAME'] ?></td>
												<td><?= $I['TEACHER_NAME'] ?></td>
												<td><?= $I['PROGRAM_NAME'] ?></td>
												<td><?= $I['EMPLOYER_NAME'] ?></td>
												<td></td>
												<td></td>
												<td>
													<a href="<?= site_url('internship/setactive/' . $I['ID']) ?>"
													   class="btn btn-success btn-xs"><span class="fas fa-arrow-alt-circle-up"></span>
													</a>
													<a href="<?= site_url('internship/delete/' . $I['ID']) ?>"
													   class="btn btn-danger btn-xs"
													   data-toggle="confirmation"
													   data-placement="top"
													   data-title="Supprimé définitivement du système?">
														<span class="fa fa-trash"></span>
													</a>
												</td>
											</tr>
										<?php } ?>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
