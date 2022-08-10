<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading with-border">
				<h3 class="panel-title">Veuillez sélectionner le ou les programmes dont vous faites partie</h3>
			</div>
			<?= form_open('teacher/noProgram') ?>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-8">
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
					<div class="col-md-4" style="padding-top: 3rem;">
						<button type="submit" class="btn btn-success btn-block">
							<i class="fa fa-check"></i> SAUVEGARDER
						</button>
					</div>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>