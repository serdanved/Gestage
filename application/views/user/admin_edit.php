<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Modifier l'Administrateur</h3>
			</div>
			<?= form_open("user/admin_edit/{$user['ID']}") ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME"
							       value="<?= $this->input->post('NAME') ? $this->input->post('NAME') : $user['NAME'] ?>"
							       class="form-control" id="NAME" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="EMAIL" class="control-label">COURRIEL</label>
						<div class="form-group">
							<input type="email" name="EMAIL"
							       value="<?= $this->input->post('EMAIL') ? $this->input->post('EMAIL') : $user['EMAIL'] ?>"
							       class="form-control" id="EMAIL" />
							<span class="text-danger"><?= form_error('EMAIL') ?></span>
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
                <?= form_open("/user/admin_password/{$user['ID']}") ?>
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