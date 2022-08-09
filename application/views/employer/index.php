<?php if (is_teacher()) { ?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">LISTE DES EMPLOYEURS DE MES PROGRAMMES</h3>
			</div>
			<div class="box-body">
				<?php foreach ($teacher_programs as $T) { ?>
					<!-- SECTION POUR EMPLOYEURS ACTIFS -->
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-heading-with-add">
								<h3 class="panel-title"><?= $T['NAME']; ?></h3>
								<?php if (is_teacher() || is_admin()) { ?>
									<a href="<?= site_url('employer/add') ?>" class="btn btn-success btn-xs">
										<span class="glyphicon glyphicon-plus"></span>
									</a>
								<?php } ?>
							</div>
						</div>
						<div class="panel-body cell-border table-responsive ">
							<table class="table table-hover employer-table">
								<thead>
								<tr>
									<th>EMPLOYEUR</th>
									<th>NB STAGES</th>
									<th>VILLE</th>
									<th>ADRESSE</th>
									<th>ACTIONS</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($employers as &$E) {
									if ($E["VISIBLE"] == 1 && $E['PROGRAM_ID'] == $T['ID']) { ?>
										<tr>
											<td><?= $E['EMPLOYER_NAME'] ?></td>
											<td><?php get_employer_internship_count($E['ID']); ?></td>
											<td><?= $E['CITY'] ?></td>
											<td><?= $E['ADDRESS'] ?></td>
											<td>
												<a href="<?= site_url('employer/edit/' . $E['ID']) ?>" class="btn btn-info btn-xs">
													<i class="fas fa-pencil-alt"></i>
												</a>
												<a href="#" data-employerid="<?= $E['ID'] ?>" class="btn btn-warning btn-xs employer_send_info">
													<i class="far fa-envelope"></i>
												</a>
												<a href="<?= site_url("employer/remove_employer_program/" . $E['ID'] . "/" . $E['PROGRAM_ID']) ?>" class="btn btn-danger btn-xs">
													<i class="fa fa-trash"></i>
												</a>
											</td>
										</tr>
									<?php }
								} ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">LISTE DE TOUS LES EMPLOYEURS</h3>
			</div>
			<div class="box-body">
				<!-- SECTION POUR EMPLOYEURS ACTIFS -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-heading-with-add">
							<h3 class="panel-title"><?= "TOUS LES PROGRAMMES"; ?></h3>
							<?php if (is_teacher() || is_admin()) { ?>
								<a href="<?= site_url('employer/add') ?>" class="btn btn-success btn-xs pull-right">
									<span class="glyphicon glyphicon-plus"></span>
								</a>
							<?php } ?>
						</div>
					</div>
					<div class="panel-body cell-border table-responsive ">
						<table class="table table-hover employer-table">
							<thead>
							<tr>
								<th>EMPLOYEUR</th>
								<th>NOM UTILISATEUR</th>
								<th>NB STAGES</th>
								<th>VILLE</th>
								<th>ADRESSE</th>
								<th>ACTIONS</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($teacher_programs_not as $T) {
								foreach ($employers as $E) {
									if ($E["VISIBLE"] == 1 && $E['PROGRAM_ID'] == $T['ID']) { ?>
										<tr>
											<td><?= $E['EMPLOYER_NAME'] ?></td>
											<td><?= $E['EMAIL'] ?></td>
											<td><?php get_employer_internship_count($E['ID']); ?></td>
											<td><?= $E['CITY'] ?></td>
											<td><?= $E['ADDRESS'] ?></td>
											<td>
												<select name="EMPLOYER_ADD_PROGRAM"
												        data-employer-id="<?= $E['ID'] ?>"
												        class="form-control EMPLOYER_ADD_PROGRAM" style="width:100%"
												        title="Ajouter au programme"
												        data-header="Ajouter au programme"
												        placeholder="Ajouter au programme">
													<option value="" selected disabled>Ajouter au programme</option>
													<?php foreach ($teacher_programs as $program) {
														echo "<option data-employer-id='{$E['ID']}' value='{$program['ID']}'>{$program['NAME']}</option>";
													} ?>
												</select>
											</td>
										</tr>
									<?php }
								}
							} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } else { ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Liste des Employeurs</h3>
                <a href="<?= site_url("/employer/add") ?>" class="btn btn-success btn-xs pull-right">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
            <div class="box-body">
                <table class="table table-striped" data-sortable>
                    <thead>
                    <tr>
						<th>EMPLOYEUR</th>
						<th>PROGRAMME</th>
						<th>NB STAGES</th>
						<th>VILLE</th>
						<th>ADRESSE</th>
						<th>ACTIONS</th>
                    </tr>
                    </thead>
                    <?php foreach ($this->Employer_model->get_employers_simple_list() as $E) { ?>
					<tr>
						<td><?= $E['EMPLOYER_NAME'] ?></td>
						<td><?php $first = true;
						foreach ($this->Employer_model->get_employer_programs($E["ID"]) as $P) {
							if ($first) {
								$first = false;
							} else {
								echo ", ";
							}

							echo $P["NAME"];
						} ?></td>
						<td><?php get_employer_internship_count($E['ID']); ?></td>
						<td><?= $E['CITY'] ?></td>
						<td><?= $E['ADDRESS'] ?></td>
						<td>
							<a href="<?= site_url('employer/delete_employer/'.$E['ID']) ?>" class="btn btn-danger btn-xs"
                                onclick="return confirm('Êtes-vous sûr de voulloir faire cela?')">
                                <i class="fa fa-trash"></i>
                            </a>
							<a href="<?= site_url('employer/edit/' . $E['ID']) ?>" class="btn btn-info btn-xs">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a href="#" data-employerid="<?= $E['ID'] ?>" class="btn btn-warning btn-xs employer_send_info">
								<i class="far fa-envelope"></i>
							</a>
						</td>
					</tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php } ?>