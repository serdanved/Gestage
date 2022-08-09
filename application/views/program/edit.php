<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">Modifier le programme</h3>
            </div>
			<?php echo form_open('program/edit/'.$program['ID']); ?>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?= $this->input->post('NAME') ? $this->input->post('NAME') : $program['NAME'] ?>" class="form-control" id="NAME" />
						</div>
					</div>
                    <div class="col-md-6">
						<label for="PAVILION" class="control-label">PAVILION</label>
						<div class="form-group">
							<input type="text" name="PAVILION" maxlength="200" value="<?= $this->input->post('PAVILION') ? $this->input->post('PAVILION') : $program['PAVILION'] ?>" class="form-control" id="PAVILION" />
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> SAUVEGARDER
				</button>
	        </div>
			<?php echo form_close(); ?>
		</div>
    </div>
</div>