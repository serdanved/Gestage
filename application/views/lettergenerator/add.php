<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">AJOUTER UNE LETTRE</h3>
            </div>
            <?php echo form_open('lettergenerator/add'); ?>
          	<div class="panel-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">Nom</label>
						<div class="form-group">
	                        <input type="text" name="NAME" value="<?php echo $this->input->post('NAME'); ?>" class="form-control" id="NAME" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="DESC" class="control-label">Description</label>
						<div class="form-group">
	                        <input type="text" name="DESC" value="<?php echo $this->input->post('DESC'); ?>" class="form-control" id="DESC" />
						</div>
					</div>

                    <div class="col-md-6">
						<label for="PROGRAM_ID" class="control-label">Programme</label>
						<div class="form-group">
							<select name="PROGRAM_ID" class="form-control">
								<option value="0">Tous les programmes</option>
								<?php foreach($all_programs as $program) {
									$selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";
									echo '<option value="'.$program['ID'].'" '.$selected.'>'.$program['NAME'].'</option>';
								} ?>
							</select>
						</div>
					</div>

                    <div class="col-md-6">
						<label for="LETTER_ID" class="control-label">Copier une lettre</label>
						<div class="form-group">
							<select name="LETTER_ID" class="form-control">
								<option value="0">Copie vierge</option>
								<?php foreach($all_letters as $letter) {
									$selected = ($letter['ID'] == $this->input->post('LETTER_ID')) ? ' selected="selected"' : "";

                                    if ($letter["PROGRAM_NAME"]=="") { $letter["PROGRAM_NAME"] = "Général"; }
									echo '<option value="'.$letter['ID'].'" '.$selected.'>'.$letter['NAME']." (".$letter['PROGRAM_NAME'].")".'</option>';
								} ?>
							</select>
						</div>
					</div>
				</div>
			</div>
          	<div class="panel-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Sauvegarder
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>