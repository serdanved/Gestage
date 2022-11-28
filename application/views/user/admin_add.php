<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Ajouter un Administrateur</h3>
            </div>
            <?= form_open('user/admin_add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-4">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?= $this->input->post('NAME') ?>" class="form-control" id="NAME" required />
							<span class="text-danger"><?= form_error('NAME') ?></span>
						</div>
					</div>
					<div class="col-md-4">
						<label for="EMAIL" class="control-label">COURRIEL</label>
						<div class="form-group">
							<input type="text" name="EMAIL" value="<?= $this->input->post('EMAIL') ?>" class="form-control" id="EMAIL" required />
							<span class="text-danger"><?= form_error('EMAIL') ?></span>
						</div>
					</div>
					<div class="col-md-4">
						<label for="PASSWORD" class="control-label">Mot de Passe</label>
						<div class="form-group">
							<input type="password" name="PASSWORD" value="<?= $this->input->post('PASSWORD') ?>" class="form-control" id="PASSWORD" required />
							<span class="text-danger"><?= form_error('PASSWORD') ?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Sauvegarder
            	</button>
          	</div>
            <?= form_close(); ?>
      	</div>
    </div>
</div>