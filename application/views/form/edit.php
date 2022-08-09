<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-info">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">MODIFICATION FORMULAIRE <?php echo strtoupper($form['NAME']);?></h3>
            </div>
			<?php echo form_open('form/edit/'.$form['ID']); ?>
			<div class="panel-body">
				<div class="row clearfix">

					<div class="col-md-6">
						<label for="NAME" class="control-label">Nom</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?php echo ($this->input->post('NAME') ? $this->input->post('NAME') : $form['NAME']); ?>" class="form-control" id="NAME" />
						</div>
					</div>

                    <div class="col-md-6">
                            <label for="PROGRAM_ID" class="control-label">
                                PROGRAMME
                            </label>
                            <div class="form-group">
                                <select id="PROGRAM_ID" name="PROGRAM_ID" class="form-control select2">
                                    <option value="">Tous les programmes</option>
                                    <?php 
                                    foreach($all_programs as $program)
                                    {
                                       $selected = ($program['ID'] == $form['PROGRAM_ID']) ? ' selected="selected"' : "";         
                                       echo '<option value="'.$program['ID'].'" '.$selected.'>'.$program['NAME'].'</option>';
                                    } 
                                    ?>
                                </select>
                                <span class="text-danger">
                                    <?php echo form_error('PROGRAM_ID');?>
                                </span>
                            </div>
                        </div> 


                    <div class="col-md-12">
						<label for="FORM" class="control-label">CRÉATEUR</label>
						<div class="form-group">
							<div data-builder-json='<?php echo $form['DATA'];?>' id="build-wrap-edit"></div>	
                        </div>
					</div>
                    
                     <div class="col-md-12">
                        <p style="color:red;font-weight:bold;" class="validation-error">

                         </p> 
                    </div>

                    <input id="FORM_ID" name="FORM_ID" value="<?php echo $this->uri->segment(3); ?>" type="hidden"/> 

				</div>
			</div>
			<div class="panel-footer">
            	<button id="formbuilder-submit-edit" type="button" class="btn btn-success">
					<i class="fa fa-check"></i> SAUVEGARDER
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>