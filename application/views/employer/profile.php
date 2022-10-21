<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading with-border">
				<h3 class="panel-title">PROFIL DE L'UTILISATEUR</h3>
			</div>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-12">
						<img class="center-block" src="<?= site_url('resources/img/logo_gestage.png') ?>">
						<br>
						<h3 class="profile-username text-center"><?= $user["EMPLOYER_NAME"] ?></h3>
						<h3 class="profile-username text-center"><?= $user["CONTACT_NAME"] ?></h3>
						<p class="text-muted text-center"><?= $type ?></p>
						<p class="text-muted text-center"><?= $user["USERNAME"] ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading with-border">
				<h3 class="panel-title">MODIFIER VOS INFORMATIONS</h3>
			</div>
			<?= form_open('employer/profile') ?>
			<div class="panel-body">
				<div class="row clearfix col-md-12">
					<div class="col-md-3">
						<label for="EMPLOYER_NAME" class="control-label">NOM EMPLOYEUR</label>
						<div class="form-group">
							<input type="text" name="EMPLOYER_NAME"
							       value="<?= $this->input->post('EMPLOYER_NAME') ? $this->input->post('EMPLOYER_NAME') : $user['EMPLOYER_NAME'] ?>"
							       class="form-control" id="EMPLOYER_NAME" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="CONTACT_NAME" class="control-label">CONTACT</label>
						<div class="form-group">
							<input type="text" name="CONTACT_NAME"
							       value="<?= $this->input->post('CONTACT_NAME') ? $this->input->post('CONTACT_NAME') : $user['CONTACT_NAME'] ?>"
							       class="form-control" id="CONTACT_NAME" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="PHONE" class="control-label">TÉLÉPHONE</label>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" name="PHONE" class="form-control bfh-phone"
								       value="<?= $this->input->post('PHONE') ? $this->input->post('PHONE') : $user['PHONE'] ?>"
								       data-format="(ddd) ddd-dddd" id="PHONE">
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<label for="EMAIL" class="control-label">COURRIEL</label>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fas fa-envelope"></i>
								</div>
								<input type="text" name="EMAIL" class="form-control"
								       value="<?= $this->input->post('EMAIL') ? $this->input->post('EMAIL') : $user['EMAIL'] ?>"
								       id="EMAIL">
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<label for="PROVINCE" class="control-label">PROVINCE</label>
						<div class="form-group">
							<input type="text" name="PROVINCE"
							       value="<?= $this->input->post('PROVINCE') ? $this->input->post('PROVINCE') : $user['PROVINCE'] ?>"
							       class="form-control" id="PROVINCE" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="CITY" class="control-label">VILLE</label>
						<div class="form-group">
							<input type="text" name="CITY"
							       value="<?= $this->input->post('CITY') ? $this->input->post('CITY') : $user['CITY'] ?>"
							       class="form-control" id="CITY" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="ADDRESS" class="control-label">ADRESSE</label>
						<div class="form-group">
							<input type="text" name="ADDRESS"
							       value="<?= $this->input->post('ADDRESS') ? $this->input->post('ADDRESS') : $user['ADDRESS'] ?>"
							       class="form-control" id="ADDRESS" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="POSTAL_CODE" class="control-label">CODE POSTAL</label>
						<div class="form-group">
							<input type="text" name="POSTAL_CODE"
							       value="<?= $this->input->post('POSTAL_CODE') ? $this->input->post('POSTAL_CODE') : $user['POSTAL_CODE'] ?>"
							       class="form-control" id="POSTAL_CODE" />
						</div>
					</div>

					<div class="col-md-3">
						<label for="PHONEHASH" class="control-label">ID CONNEXION</label>
						<div class="form-group">
							<input type="text" name="PHONEHASH"
							       value="<?= $this->input->post('PHONEHASH') ? $this->input->post('PHONEHASH') : $user['PHONEHASH'] ?>"
							       class="form-control" id="PHONEHASH" />
						</div>
					</div>

					<div class="col-md-12 form_validation_errors">
						<?= validation_errors() ?>
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

    <?= form_open('employer/profile_password') ?>
    <div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading with-border">
				<h3 class="panel-title">PROFIL DE L'UTILISATEUR</h3>
			</div>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-6">
                        <div class="form-group">
                            <label for="NEW_PASSWORD">NOUVEAU MOT DE PASSE</label>
                            <input type="password" minlength="4" class="form-control" name="NEW_PASSWORD" id="NEW_PASSWORD" placeholder="Mot de Passe" required>
                        </div>
                    </div>
				</div>
			</div>
            <div class="panel-footer">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> SAUVEGARDER
				</button>
			</div>
		</div>
	</div>
    <?= form_close() ?>
</div>