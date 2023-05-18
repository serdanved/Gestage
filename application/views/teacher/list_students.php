<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Liste d'Élèves</h3>
			</div>
			<div class="box-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">MES ÉLÈVES</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped assign-student-list" id="my_students_table" data-sortable>
                            <thead>
                            <tr>
                                <th>NOM</th>
                                <th>COURRIEL</th>
                                <th>PROGRAMME</th>
                                <th data-searchable="false" style="width:260px">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($students as $S) {
                                if ($this->session->is_ate == 1 || $S['TEACHER_ID'] == $this->session->userid) { ?>
                                    <tr>
                                        <td><?= $S['NAME'] ?></td>
                                        <td><?= $S['EMAIL_CS'] ?></td>
                                        <td><?= get_program_name_by_id($S['PROGRAM_ID']) ?></td>
                                        <td>
											<?php if ($S['TEACHER_ID'] == $this->session->userid) { ?>
                                            <a href="<?= site_url('teacher/unassign_student/' . $S['ID']) ?>" class="btn btn-success btn-xs">
                                                <span class="fa fa-pencil"></span> Désassigner cet élève
                                            </a>
                                            <a style="margin-left:15px;" href="<?= site_url('teacher/archive_student/' . $S['ID']) ?>" class="btn btn-danger btn-xs">
                                                <span class="fa fa-pencil"></span> Archiver cet élève
                                            </a>
											<?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">ÉLÈVES NON ASSIGNÉS À UN ENSEIGNANT (<?= count($unassigned_students) ?>)
							<button style="margin-left:15px;font-weight:bold" class="btn btn-danger btn-xs pull-right" id="mass_archive_button">
								<span class="fa fa-pencil"></span> Archivage massif
							</button>
                            <select class="form-control pull-right input-sm force-normal" style="width:300px;height:22px;padding-top:2px;padding-bottom:2px" id="mass_assign_select">
                                <option value="" disabled selected>Choisissez le programme pour assignation massive</option>
                                <?php foreach ($this->Teacher_model->get_teacher_programs($this->session->userid) as $p) { ?>
                                    <option value="<?= $p["ID"] ?>"><?= $p["NAME"] ?></option>
                                <?php } ?>
                            </select>
						</h3>
					</div>
					<div class="panel-body">
						<table class="table table-striped" id="unassigned_students_table" data-sortable>
							<thead>
							<tr>
								<th data-searchable="false" data-width="5rem"></th>
								<th>NOM</th>
								<th>COURRIEL</th>
								<th>PROGRAMME</th>
							</tr>
							</thead>
							<?php foreach ($unassigned_students as $S) {
								if ($S["ARCHIVE"] == 0) { ?>
									<tr>
										<td><input type="checkbox" name="students_assignment[]" value="<?= $S['ID'] ?>" /></td>
										<td><?= $S['NAME'] ?></td>
										<td><?= $S['EMAIL_CS'] ?></td>
										<td><?= get_program_name_by_id($S['PROGRAM_ID']) ?></td>
									</tr>
								<?php }
							} ?>
						</table>
					</div>
				</div>

				<div class="panel panel-primary">
					<div class="panel-heading">
						<button class="btn_collapsed"
						        style="background:unset !important;border:unset !important;"
						        data-toggle="collapse"
						        aria-expanded="false"
						        href='#collapse'
						        style="position:relative !important;"
						        class="panel-title collapsed">
							<i class="fa fa-plus"></i> ÉLÈVES ARCHIVÉS
						</button>
					</div>
					<div class="panel-body">
						<div id="collapse" class="panel-collapse collapse">
							<table class="table table-striped assign-student-list" id="archived_students_table" data-sortable>
								<thead>
								<tr>
									<th>NOM</th>
									<th>COURRIEL</th>
									<th>PROGRAMME</th>
									<th data-searchable="false" style="width:275px">ACTIONS</th>
								</tr>
								</thead>
								<?php foreach ($unassigned_students as $S) {
									if ($S["ARCHIVE"] == 1) { ?>
										<tr>
											<td><?= $S['NAME'] ?></td>
											<td><?= $S['EMAIL_CS'] ?></td>
											<td><?= get_program_name_by_id($S['PROGRAM_ID']) ?></td>
											<td>
												<a href="<?= site_url('teacher/assign_student/' . $S['ID']) ?>" class="btn btn-success btn-xs">
													<span class="fa fa-pencil"></span> M'assigner cet élève
												</a>
												<a style="margin-left:15px;" href="<?= site_url('teacher/unarchive_student/' . $S['ID']) ?>" class="btn btn-danger btn-xs">
													<span class="fa fa-pencil"></span> Désarchiver cet élève
												</a>
											</td>
										</tr>
									<?php }
								} ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", () => {
		const table = $("#unassigned_students_table").DataTable({
			paging: true,

			"language": {
				"decimal": "",
				"emptyTable": "Aucun élève",
				"info": "_TOTAL_ élèves",
				"infoEmpty": "",
				"infoFiltered": "(filtré de _MAX_ total élève)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "&nbsp;&nbsp;&nbsp;&nbsp;Afficher _MENU_ élèves",
				"loadingRecords": "Chargement...",
				"processing": "En traitement...",
				"search": "Rechercher:",
				"zeroRecords": "Aucun enregistrements correspondants trouvés",
				"paginate": {
					"first": "Première",
					"last": "Dernière",
					"next": "Suivant",
					"previous": "Précédent"
				}
			}
		});

		const assign = document.getElementById("mass_assign_select");
		assign.addEventListener("change", async event => {
			const select = assign.selectedOptions.item(0);
			const students = [];

			const nodes = table.column(0).nodes();
			for (let i = 0; i < nodes.length; ++i) {
				const checkbox = nodes[i].querySelector("input[type='checkbox']");
				if (checkbox.checked) {
					students.push(parseInt(checkbox.value));
				}
			}

			if (students.length === 0) {
				alert("Veuillez choisir un ou plusieurs élèves");
			} else {
				if (select !== null) {
					if (confirm(`Ètes-vous sûr de voulloir assigner le programme "${select.text}" à ${students.length} élève(s)?`)) {
						const body = new FormData();
						body.append("prog", select.value.toString());
						body.append("students", JSON.stringify(students));

						const response = await fetch("/teacher/mass_assign_students", {
							method: "POST",
							body,
						});
						const text = await response.text();
						if (text !== "DONE") {
							alert(`Une erreur(#${response.status}) s'est produite :\n${text}`);
						}

						document.location.reload();
					}
				}
			}
		});
	});
</script>