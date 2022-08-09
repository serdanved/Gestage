<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Document Edit</h3>
            </div>
			<?php echo form_open('document/edit/'.$document['ID']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="TYPE_ID" class="control-label">Document Type</label>
						<div class="form-group">
							<select name="TYPE_ID" class="form-control">
								<option value="">select document_type</option>
								<?php 
								foreach($all_document_types as $document_type)
								{
									$selected = ($document_type['ID'] == $document['TYPE_ID']) ? ' selected="selected"' : "";

									echo '<option value="'.$document_type['ID'].'" '.$selected.'>'.$document_type['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="INTERNSHIP_ID" class="control-label">Internship</label>
						<div class="form-group">
							<select name="INTERNSHIP_ID" class="form-control">
								<option value="">select internship</option>
								<?php 
								foreach($all_internships as $internship)
								{
									$selected = ($internship['ID'] == $document['INTERNSHIP_ID']) ? ' selected="selected"' : "";

									echo '<option value="'.$internship['ID'].'" '.$selected.'>'.$internship['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="NAME" class="control-label">NAME</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?php echo ($this->input->post('NAME') ? $this->input->post('NAME') : $document['NAME']); ?>" class="form-control" id="NAME" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="FILENAME" class="control-label">FILENAME</label>
						<div class="form-group">
							<input type="text" name="FILENAME" value="<?php echo ($this->input->post('FILENAME') ? $this->input->post('FILENAME') : $document['FILENAME']); ?>" class="form-control" id="FILENAME" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>