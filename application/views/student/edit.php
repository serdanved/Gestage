<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Modifier l'élève</h3>
			</div>
			<?= form_open("student/edit/{$student['ID']}") ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME"
							       value="<?= $this->input->post('NAME') ? $this->input->post('NAME') : $student['NAME'] ?>"
							       class="form-control" id="NAME" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="EMAIL_CS" class="control-label">COURRIEL DE LA COMMISSION SCOLAIRE</label>
						<div class="form-group">
							<input type="email" name="EMAIL_CS"
							       value="<?= $this->input->post('EMAIL_CS') ? $this->input->post('EMAIL_CS') : $student['EMAIL_CS'] ?>"
							       class="form-control" id="EMAIL_CS" />
							<span class="text-danger"><?= form_error('EMAIL_CS') ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="SCHOOL" class="control-label">ÉCOLE</label>
						<div class="form-group">
							<input type="text" name="SCHOOL"
							       value="<?= $this->input->post('SCHOOL') ? $this->input->post('SCHOOL') : $student['SCHOOL'] ?>"
							       class="form-control" id="SCHOOL" />
							<span class="text-danger"><?= form_error('SCHOOL') ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="PROGRAM_ID" class="control-label">PROGRAMME</label>
						<div class="form-group">
							<select name="PROGRAM_ID" class="form-control">
								<option value="">choisir un programme</option>
								<?php foreach ($all_programs as $program) {
									$selected = ($program['ID'] == $student['PROGRAM_ID']) ? ' selected="selected"' : "";

									echo "<option value='{$program['ID']}' {$selected}>{$program['NAME']}</option>";
								} ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Sauvegarder
				</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>

	<div class="col-md-12">
      	<div class="panel panel-primary">
            <div style="overflow:hidden;" class="panel-heading with-border">
                <h3 class="pull-left panel-title">MOT DE PASSE</h3>
            </div>
            <div class="panel-body">
                <?= form_open("/student/password/{$student['ID']}") ?>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="PASS">Nouveau Mot de Passe</label>
                            <input type="password" class="form-control" id="PASS" name="PASS" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="CONFIRM">Confirmez Mot de Passe</label>
                            <input type="password" class="form-control" id="CONFIRM" name="CONFIRM" required>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top: 1.7em">
                        <button type="submit" class="btn btn-success btn-block">Enregister</button>
                    </div>

                    <?php if (isset($_GET["pass"]) && $_GET["pass"] == "error") { ?>
                        <div class="col-md-12">
                            <p style="font-weight: bold; text-align: center; color: red;">
                                Votre confirmation de mot de passe n'est pas le même que votre mot de passe!
                            </p>
                        </div>
                    <?php } ?>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>