<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Ajouter un enseignant</h3>
            </div>
            <?php echo form_open('teacher/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="PROGRAM_ID" class="control-label">Programme</label>
						<div class="form-group">
							<select name="PROGRAM_ID" class="form-control">
								<option value="">Sélectionner un programme</option>
								<?php foreach($all_programs as $program) {
									$selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";

									echo '<option value="'.$program['ID'].'" '.$selected.'>'.$program['NAME'].'</option>';
								} ?>
							</select>
							<span class="text-danger"><?php echo form_error('PROGRAM_ID');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?php echo $this->input->post('NAME'); ?>" class="form-control" id="NAME" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="EMAIL_CS" class="control-label">COURRIEL DE LA COMMISSION SCOLAIRE</label>
						<div class="form-group">
							<input type="text" name="EMAIL_CS" value="<?php echo $this->input->post('EMAIL_CS'); ?>" class="form-control" id="EMAIL_CS" />
							<span class="text-danger"><?php echo form_error('EMAIL_CS');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="PASSWORD" class="control-label">MOT DE PASSE</label>
						<div class="form-group">
							<input type="text" name="PASSWORD" value="<?php echo $this->input->post('PASSWORD'); ?>" class="form-control" id="PASSWORD" />
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