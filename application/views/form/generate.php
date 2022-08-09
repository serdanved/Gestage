<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">GÉNÉRER UN FORMULAIRE</h3>
            </div>
            <?php echo form_open('form/generate/'.$form["ID"]); ?>
            
          	<div class="panel-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM DU FORMULAIRE</label>
						<div class="form-group">
	                        <input readonly type="text" name="NAME" value="<?php echo $form["NAME"] ?>" class="form-control" id="NAME" />
						</div>
					</div>
					
					<div class="col-md-6">
						<label for="STAGE" class="control-label">STAGE RELIÉ À LA LETTRE À GÉNÉRER</label>
						<div class="form-group">
	                        <select class="form-control" name="BLOCK_ID[]" multiple="multiple">
								<?php 
								foreach($stages as $stage)
								{
									echo '<option value="'.$stage['BLOCK_ID'].'">'. $stage['STUDENT_NAME'] .' - '. $stage['PROGRAM_NAME'] .' - '. $stage['BLOCK_NAME'] .' du '. date_in_french($stage['DATE_START']) .' au '. date_in_french($stage['DATE_END']) .'</option>';
									
									
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<label for="NAME">OPTIONS DE LA GÉNÉRATION DU FORMULAIRE</label>
						<div class="form-group">
	                        <input type=checkbox value='1' name=depot id=depot> Déposer une copie du document dans les documents du stage
						</div>

						
				        <div class="letter-generator-perms">
				        	<div style="">
				  	           <label  style="margin-right:2%;">PERMISSIONS:</label>
				  	           <div class="form-group">
					               <label class="checkbox-inline">
					                   <input name="ck_CANSEE_EMPLOYERS" type="checkbox">EMPLOYEURS
					               </label>
					               <label class="checkbox-inline">
					                   <input name="ck_CANSEE_STUDENTS" type="checkbox">ÉLÈVES
					               </label>
					           </div>
				           </div>
				        </div>
				        
				        
				        <div class="letter-generator-perms">
				        	<div style="">
				  	           <label  style="margin-right:2%;">OBLIGATIONS:</label>
				  	           <div class="form-group">
					               <label class="checkbox-inline">
					                   <input name="ck_OBLIGATION_EMPLOYERS" type="checkbox">EMPLOYEURS
					               </label>
					               <label class="checkbox-inline">
					                   <input name="ck_OBLIGATION_STUDENTS" type="checkbox">ÉLÈVES
					               </label>
					               <label class="checkbox-inline">
					                   <input name="ck_OBLIGATION_TEACHERS" type="checkbox" >ENSEIGNANTS
					               </label>
					           </div>
				           </div>
				        </div>				        
	
					</div>
				</div>
			</div>
          	<div class="panel-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> GÉNÉRER
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>