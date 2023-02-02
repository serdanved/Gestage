<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">AJOUTER UN STAGE</h3>
			</div>
			<?= form_open('internship/add') ?>
			<div class="box-body">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading with-border">
							<h3 class="panel-title">INFORMATION DU STAGE</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-6">
								<label for="PROGRAM_ID" class="control-label">PROGRAMME</label>
								<div class="form-group">
									<select id="PROGRAM_ID" name="PROGRAM_ID" class="form-control program_select_change">
										<option value="">Sélectionner un programme</option>
										<?php foreach ($all_programs as $program) {
											$selected = $program['ID'] == $this->input->post('PROGRAM_ID') ? 'selected="selected"' : "";
											echo '<option value="' . $program['ID'] . '" ' . $selected . '>' . $program['NAME'] . '</option>';
										} ?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<label for="schedule" class="control-label">HORAIRE</label>
								<div class="form-group">
									<select id="schedule" name="schedule" class="form-control" required>
										<option value="">Sélectionner un horaire</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<label for="STUDENT_ID" class="control-label">ÉLÈVE</label>
								<div class="form-group">
									<select name="STUDENT_ID[]" class="form-control" multiple>
										<option value="" disabled>Sélectionner un élève</option>
										<?php foreach ($all_students as $student) {
											$selected = in_array($student['ID'], $this->input->post('STUDENT_ID') ?? []) ? 'selected="selected"' : "";
											echo '<option value="' . $student['ID'] . '" ' . $selected . '>' . get_student_name_by_id($student['ID']) . '</option>';
										} ?>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<label for="EMPLOYER_ID" class="control-label">EMPLOYEUR</label>
								<div class="form-group">
									<select id="EMPLOYER_ID" name="EMPLOYER_ID" class="form-control employer_select_change">
										<option value="">Sélectionner un employeur</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<label for="EMPLOYER_CONTACT_ID" class="control-label">CONTACT</label>
								<div class="form-group">
									<select id="EMPLOYER_CONTACT_ID" name="EMPLOYER_CONTACT_ID" class="form-control">
										<option value="">Sélectionner un contact</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading with-border">
							<h3 class="panel-title">INFORMATION DU BLOC</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-12">
								<label for="TEACHER_ID" class="control-label">ENSEIGNANT</label>
								<div class="form-group">
									<select id="TEACHER_ID" name="TEACHER_ID" class="form-control">
										<option value="">Sélectionner un enseignant</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<label for='BLOCK_NAME' class="control-label">NOM BLOC</label>
								<div class="form-group input-group col-md-12">
									<input id="BLOCK_NAME" name="BLOCK_NAME" value="<?= $this->input->post('BLOCK_NAME') ?>" class="form-control">
								</div>
							</div>

							<div class="col-md-6">
								<label for='TOTAL_HOURS' class="control-label">HEURES TOTAL</label>
								<div class="form-group input-group col-md-12">
									<input type="number" min="0.00" step="0.01" id="TOTAL_HOURS" name="TOTAL_HOURS" value="<?= $this->input->post('TOTAL_HOURS') ?>" class="form-control">
								</div>
							</div>

							<div class="col-md-6">
								<label for="DATE_START" class="control-label">DÉBUT BLOC</label>
								<div class="form-group">
									<input type="text" name="DATE_START" value="<?= $this->input->post('DATE_START') ?>" class="has-datepicker form-control" data-date-format="YYYY-MM-DD" id="DATE_START" />
								</div>
							</div>

							<div class="col-md-6">
								<label for="DATE_END" class="control-label">FIN BLOC</label>
								<div class="form-group">
									<input type="text" name="DATE_END" value="<?= $this->input->post('DATE_END') ?>" class="has-datepicker form-control" data-date-format="YYYY-MM-DD" id="DATE_END" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 form_validation_errors">
				<?= validation_errors() ?>
			</div>

			<div class="box-footer">
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-check"></i> SAUVEGARDER
					</button>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", event => {
		const program = document.getElementById("PROGRAM_ID");
		const id = parseInt(program.value);
		if (id !== NaN) {
			set_select_program_teacher_data(id);
			set_select_program_employer_data(id);
		}

		$("#PROGRAM_ID").on("change.select2", async function(event) {
			const schedule = document.getElementById("schedule");
			const id = parseInt(event.target.value);
			if (id !== NaN) {
				const response = await fetch(`/internship/ajax_load_schedules/${id}`);
				schedule.innerHTML = await response.text();
			}
		});
	});
</script>