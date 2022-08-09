<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modifier un obligation</h3>
            </div>
			<?php echo form_open('obligation/edit/'.$obligation['ID']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="INTERNSHIP_ID" class="control-label">Stage</label>
						<div class="form-group">
							<select name="INTERNSHIP_ID" class="form-control">
								<option value="">Sélectionner le stage</option>
								<?php 
								foreach($all_internships as $internship)
								{
									$selected = ($internship['ID'] == $obligation['INTERNSHIP_ID']) ? ' selected="selected"' : "";

									echo '<option value="'.$internship['ID'].'" '.$selected.'>'.$internship['NAME'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="DOCUMENT_ID" class="control-label">Document</label>
						<div class="form-group">
							<select name="DOCUMENT_ID" class="form-control">
								<option value="">Sélectionner le document</option>
								<?php 
								foreach($all_documents as $document)
								{
									$selected = ($document['ID'] == $obligation['DOCUMENT_ID']) ? ' selected="selected"' : "";

									echo '<option value="'.$document['ID'].'" '.$selected.'>'.$document['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="DATE" class="control-label">DATE</label>
						<div class="form-group">
							<input type="text" name="DATE" value="<?php echo ($this->input->post('DATE') ? $this->input->post('DATE') : $obligation['DATE']); ?>" class="has-datetimepicker form-control" id="DATE" />
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