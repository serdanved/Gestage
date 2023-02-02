<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">Ajouter un horaire pour le programme <?= $prog["NAME"] ?></h3>
            </div>
            <?= form_open('program/schedule_add/' . $prog["ID"]) ?>
          	<div class="panel-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?= $this->input->post('NAME') ?>" class="form-control" id="NAME" required />
						</div>
					</div>
				</div>
			</div>
          	<div class="panel-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Sauvegarder
            	</button>
          	</div>
            <?= form_close() ?>
      	</div>
    </div>
</div>