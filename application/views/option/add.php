<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Ajouter un option</h3>
            </div>
            <?= form_open('option/add') ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-12">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" id="NAME" class="form-control" maxlength="64" required />
						</div>

						<label for="VALUE" class="control-label">CONTENU</label>
						<div class="form-group">
							<input type="text" name="VALUE" id="VALUE" class="form-control" required />
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
</div>