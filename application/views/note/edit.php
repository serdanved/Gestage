<div class="row">
<!-- SECTION OF "MODIFIER UNE NOTE" -->   
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">MODIFICATION NOTE #<?php echo $note['ID']; ?></h3>
            </div>
			<?php echo form_open('note/edit/'.$note['ID'] . '/' . $note['INTERNSHIP_ID']); ?>
			<div class="panel-body">
<!-- LEFT SECTION OF "MODIFIER UN EMPLOYEUR" -->
          		<div class="row clearfix col-md-12">

					<div class="col-md-3">
						<label for="DESCRIPTION" class="control-label">DESCRIPTION</label>
						<div class="form-group">
							<input type="text" name="DESCRIPTION" value="<?php echo ($this->input->post('DESCRIPTION') ? $this->input->post('DESCRIPTION') : $note['DESCRIPTION']); ?>" class="form-control" id="EMPLOYER_NAME" />
						</div>
					</div>
					
					<div class="col-md-3">
						<label for="PRIVÉE" class="control-label">PRIVATE</label>
						<div class="form-group">
							<input type="checkbox" <?php if($note['PRIVATE'] == "1"){echo "checked";} ?> name="PRIVATE" value="<?php echo ($this->input->post('PRIVATE') ? $this->input->post('PRIVATE') : $note['PRIVATE']); ?>" id="PRIVATE" />
						</div>
					</div>
					




					<div class="col-md-6 form_validation_errors">
						<?php echo validation_errors(); ?>
					</div>
					
				</div>


	<!-- RIGHT SECTION OF "MODIFIER UN EMPLOYEUR" -->				

					
			</div>
			<div class="panel-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> SAUVEGARDER
				</button>
	        </div>

	<!-- FOOTER SECTION OF "MODIFIER UN EMPLOYEUR" -->			
				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>