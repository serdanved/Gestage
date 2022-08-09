<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modifier l'option</h3>
            </div>
			<?php echo form_open('option/edit/'.$option['ID']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-12">
						<!--<h4><strong>NOM:</strong> <?= $option["NAME"] ?></h4>-->
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" id="NAME" class="form-control" value="<?= $this->input->post('NAME') ? $this->input->post('NAME') : $option['NAME'] ?>" required />
						</div>
						<label for="VALUE" class="control-label">CONTENU</label>
						<div class="form-group">
							<input type="text" name="VALUE" id="VALUE" class="form-control" value="<?= $this->input->post('VALUE') ? $this->input->post('VALUE') : $option['VALUE'] ?>" required />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Sauvegarder
				</button>
	        </div>
			<?php echo form_close(); ?>
		</div>
    </div>
</div>