<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Ajout de catégorie</h3>
            </div>
            <?= form_open('employer/catadd') ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM DE LA CATÉGORIE</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?= $this->input->post('NAME') ?>" class="form-control" id="NAME" required />
						</div>
					</div>

					<div class="col-md-6">
						<label for="PROGRAM" class="control-label">PROGRAMME</label>
						<div class="form-group">
							<select class="form-control" name="PROGRAM" id="PROGRAM" required>
								<option value="">Sélectionner un Programme</option>
								<?php foreach ($this->Program_model->get_all_programs() as $P) { ?>
									<option value="<?= $P["ID"] ?>"><?= $P["NAME"] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Ajouter
            	</button>
          	</div>
            <?= form_close() ?>
      	</div>
    </div>
</div>