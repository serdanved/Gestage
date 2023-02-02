<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading with-border">
				<h3 class="panel-title">Ajouter un employeur</h3>
			</div>
			<?= form_open('employer/add') ?>
			<div class="panel-body">
				<div class="row clearfix col-md-12">
					<div class="col-md-3">
						<label for="EMPLOYER_NAME" class="control-label">NOM EMPLOYEUR</label>
						<div class="form-group">
							<input type="text" name="EMPLOYER_NAME"
							       value="<?= $this->input->post('EMPLOYER_NAME') ?>" class="form-control"
							       id="EMPLOYER_NAME" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="ADDRESS" class="control-label">ADRESSE</label>
						<div class="form-group">
							<input type="text" name="ADDRESS" value="<?= $this->input->post('ADDRESS') ?>"
							       class="form-control" id="ADDRESS" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="CITY" class="control-label">VILLE</label>
						<div class="form-group">
							<input type="text" name="CITY" value="<?= $this->input->post('CITY') ?>"
							       class="form-control" id="CITY" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="PROVINCE" class="control-label">PROVINCE</label>
						<div class="form-group">
							<input type="text" name="PROVINCE" value="<?= $this->input->post('PROVINCE') ?>"
							       class="form-control" id="PROVINCE" />
						</div>
					</div>

					<div class="col-md-4">
						<label for="POSTAL_CODE" class="control-label">CODE POSTAL</label>
						<div class="form-group">
							<input type="text" name="POSTAL_CODE"
							       value="<?= $this->input->post('POSTAL_CODE') ?>" class="form-control"
							       id="POSTAL_CODE" />
						</div>
					</div>

					<div class="col-md-4">
						<label for="PHONEHASH" class="control-label">CODE UTILISATEUR (SUGGESTION TÉLÉPHONE)</label>
						<div class="form-group">
							<input type="text" name="PHONEHASH" value="<?= $this->input->post('PHONEHASH') ?>"
							       class="form-control" id="PHONEHASH" />
						</div>
					</div>

					<div class="col-md-4">
						<label for="PROGRAM_ID" class="control-label">PROGRAMME</label>
						<div class="form-group">
							<select name="PROGRAM_ID" class="form-control">
								<option value="">Sélectionner un programme</option>
								<?php foreach ($all_programs as $program) {
									$selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";
									echo "<option value='{$program['ID']}' $selected>{$program['NAME']}</option>";
								} ?>
							</select>
						</div>
					</div>

					<div class="col-md-4">
						<label for="CONTACT_NAME" class="control-label">NOM DU CONTACT</label>
						<div class="form-group">
							<input type="text" name="CONTACT_NAME"
							       value="<?= $this->input->post('CONTACT_NAME') ?>" class="form-control"
							       id="CONTACT_NAME" />
						</div>
					</div>

					<div class="col-md-4">
						<label for="CONTACT_EMAIL" class="control-label">COURRIEL DU CONTACT</label>
						<div class="form-group">
							<input type="text" name="CONTACT_EMAIL"
							       value="<?= $this->input->post('CONTACT_EMAIL') ?>" class="form-control"
							       id="CONTACT_EMAIL" />
						</div>
					</div>

					<div class="col-md-4">
						<label for="CONTACT_PHONE" class="control-label">TÉLÉPHONE DU CONTACT</label>
						<div class="form-group">
							<input type="text" name="CONTACT_PHONE"
							       value="<?= $this->input->post('CONTACT_PHONE') ?>" class="form-control"
							       id="CONTACT_PHONE" />
						</div>
					</div>

					<div class="col-md-12 form_validation_errors">
						<?= validation_errors() ?>
					</div>
				</div>

				<div class="col-md-12">
					<label for="NOTE" class="control-label">
						<span class="text-danger"></span>NOTE SUR L'EMPLOYEUR
					</label>
					<div class="form-group">
						<div class="form-group">
							<textarea rows="4" name="NOTE" class="form-control mceNoEditor" id="NOTE"><?= $this->input->post('NOTE') ?></textarea>
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
</div>
