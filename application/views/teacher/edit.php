<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading with-border">
				<h3 class="panel-title">Modification Programme</h3>
			</div>
			<?= form_open('teacher/edit/' . $teacher['ID']) ?>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-5">
						<label for="PROGRAMS_IDS" class="control-label">
							<span class="text-danger">*</span>PROGRAMME(S)
						</label>
						<div class="form-group">
							<select id="PROGRAM_IDS" name="PROGRAM_IDS[]" class="selectpicker form-control" multiple
							        data-actions-box="false" data-header="CHOISIR PROGRAMME" title="AUCUNE">
								<option value="none" id="unselector">AUCUN</option>
								<?php $selected = "";
								foreach ($all_programs as $program) {
									//show_error(var_dump($program));
									foreach ($teacher_programs as $no) {
										$selected = ($program["ID"] == $no["ID"]) ? ' selected="selected"' : "";
										if ($selected != "") {
											break;
										}
									}

									echo "<option value={$program["ID"]} {$selected}>{$program["NAME"]}</option>";
								} ?>
							</select>
							<span class="text-danger"><?= form_error('PROGRAM_IDS[]') ?></span>
						</div>
					</div>
					<div class="col-md-5">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME"
							       value="<?= $this->input->post('NAME') ? $this->input->post('NAME') : $teacher['NAME'] ?>"
							       class="form-control" id="NAME" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="FLAG_ATE" class="control-label">ATE</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="FLAG_ATE" name="FLAG_ATE">
								<option value="0" <?= $teacher["FLAG_ATE"] == 0 ? "selected": "" ?>>Non</option>
								<option value="1" <?= $teacher["FLAG_ATE"] == 1 ? "selected": "" ?>>Oui</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> SAUVEGARDER
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
                <?= form_open("/teacher/password/{$teacher['ID']}") ?>
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