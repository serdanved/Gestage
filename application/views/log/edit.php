<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Log Edit</h3>
            </div>
			<?php echo form_open('log/edit/'.$log['ID']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="INTERNSHIP_ID" class="control-label">Internship</label>
						<div class="form-group">
							<select name="INTERNSHIP_ID" class="form-control">
								<option value="">select internship</option>
								<?php 
								foreach($all_internships as $internship)
								{
									$selected = ($internship['ID'] == $log['INTERNSHIP_ID']) ? ' selected="selected"' : "";

									echo '<option value="'.$internship['ID'].'" '.$selected.'>'.$internship['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="DATE" class="control-label">DATE</label>
						<div class="form-group">
							<input type="text" name="DATE" value="<?php echo ($this->input->post('DATE') ? $this->input->post('DATE') : $log['DATE']); ?>" class="has-datetimepicker form-control" id="DATE" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="DESCRIPTION" class="control-label">DESCRIPTION</label>
						<div class="form-group">
							<textarea name="DESCRIPTION" class="form-control" id="DESCRIPTION"><?php echo ($this->input->post('DESCRIPTION') ? $this->input->post('DESCRIPTION') : $log['DESCRIPTION']); ?></textarea>
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