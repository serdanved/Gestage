<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Création d'un formulaire</h3>
            </div>
            <?php echo form_open('form/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?php echo $this->input->post('NAME'); ?>" class="form-control" id="NAME" />
                        </div>
					</div>	
                    
                     <div class="col-md-6">
						<label for="PROGRAM_ID" class="control-label">PROGRAMME</label>
						<div class="form-group">
							<select id="PROGRAM_ID" name="PROGRAM_ID" class="form-control">
								<option value="0">Tous les programmes</option>
								<?php 
								foreach($all_programs as $program)
								{
									$selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";

									echo '<option value="'.$program['ID'].'" '.$selected.'>'.$program['NAME'].'</option>';
								} 
								?>
							</select>
						</div>

					</div>


                    <div class="col-md-12">
						<label for="FORM" class="control-label">CRÉATEUR</label>
						<div class="form-group">
							<div id="build-wrap"></div>	
                        </div>
					</div>	

                     <div class="col-md-12">
                        <p style="color:red;font-weight:bold;" class="validation-error">

                         </p> 
                    </div>
                    

				</div>
			</div>
          	<div class="box-footer">
            	<button id="formbuilder-submit" type="button" class="btn btn-success">
            		<i class="fa fa-check"></i> Sauvegarder
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>