<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">Modification Programme</h3>
            </div>
			<?php echo form_open('employer/edit_programs/'.$employer['ID']); ?>
			<div class="panel-body">
				<div class="row clearfix">
					
					<div class="col-md-6">
        						<label for="PROGRAMS_IDS" class="control-label"><span class="text-danger">*</span>PROGRAMME(S)</label>
        						<div class="form-group">
        							<select id="PROGRAM_IDS" name="PROGRAM_IDS[]"  class="selectpicker form-control" multiple data-actions-box="false" data-header="CHOISIR PROGRAMME" title="AUCUNE">
        								<option value="none" id="unselector">AUCUN</option>
        								
        								<?php
        								
										
										$selected = "";			
        								foreach($all_programs as $program)
        								{											
											
											//show_error(var_dump($program));
											
											foreach($employer_programs as $no)
											{
												$selected = ($program["ID"] == $no["ID"]) ? ' selected="selected"' : "";
												if ($selected != "")
												{
													break;
												}
												
											}

											echo '<option value='.$program["ID"].' '.$selected.'>'.$program["NAME"].'</option>';

        									
        								}
        								?>
        							</select>
        							<span class="text-danger"><?php echo form_error('PROGRAM_IDS');?></span>
        						</div>
        					</div>
					
					<!--<div class="col-md-6">-->
					<!--	<label for="GUID" class="control-label">GUID</label>-->
					<!--	<div class="form-group">-->
					<!--		<input type="text" name="GUID" value="<?php echo ($this->input->post('GUID') ? $this->input->post('GUID') : $teacher['GUID']); ?>" class="form-control" id="GUID" />-->
					<!--	</div>-->
					<!--</div>-->
					<div class="col-md-6">
						<label for="EMPLOYER_NAME" class="control-label">NOM EMPLOYEUR</label>
						<div class="form-group">
							<input type="text" name="EMPLOYER_NAME" value="<?php echo ($this->input->post('EMPLOYER_NAME') ? $this->input->post('EMPLOYER_NAME') : $employer['EMPLOYER_NAME']); ?>" class="form-control" id="EMPLOYER_NAME" />
						</div>
					</div>
					<!--<div class="col-md-6">-->
					<!--	<label for="EMAIL_CS" class="control-label">COURRIEL DE LA COMMISSION SCOLAIRE</label>-->
					<!--	<div class="form-group">-->
					<!--		<input type="text" name="EMAIL_CS" value="<?php echo ($this->input->post('EMAIL_CS') ? $this->input->post('EMAIL_CS') : $teacher['EMAIL_CS']); ?>" class="form-control" id="EMAIL_CS" />-->
					<!--		<span class="text-danger"><?php echo form_error('EMAIL_CS');?></span>-->
					<!--	</div>-->
					<!--</div>-->
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