<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Message Edit</h3>
            </div>
			<?php echo form_open('message/edit/'.$message['ID']); ?>
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
									$selected = ($internship['ID'] == $message['INTERNSHIP_ID']) ? ' selected="selected"' : "";

									echo '<option value="'.$internship['ID'].'" '.$selected.'>'.$internship['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="TO_TYPE" class="control-label">Creator Type</label>
						<div class="form-group">
							<select name="TO_TYPE" class="form-control">
								<option value="">select creator_type</option>
								<?php 
								foreach($all_creator_types as $creator_type)
								{
									$selected = ($creator_type['ID'] == $message['TO_TYPE']) ? ' selected="selected"' : "";

									echo '<option value="'.$creator_type['ID'].'" '.$selected.'>'.$creator_type['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="FROM_TYPE" class="control-label">Creator Type</label>
						<div class="form-group">
							<select name="FROM_TYPE" class="form-control">
								<option value="">select creator_type</option>
								<?php 
								foreach($all_creator_types as $creator_type)
								{
									$selected = ($creator_type['ID'] == $message['FROM_TYPE']) ? ' selected="selected"' : "";

									echo '<option value="'.$creator_type['ID'].'" '.$selected.'>'.$creator_type['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="TO_ID" class="control-label">TO ID</label>
						<div class="form-group">
							<input type="text" name="TO_ID" value="<?php echo ($this->input->post('TO_ID') ? $this->input->post('TO_ID') : $message['TO_ID']); ?>" class="form-control" id="TO_ID" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="FROM_ID" class="control-label">FROM ID</label>
						<div class="form-group">
							<input type="text" name="FROM_ID" value="<?php echo ($this->input->post('FROM_ID') ? $this->input->post('FROM_ID') : $message['FROM_ID']); ?>" class="form-control" id="FROM_ID" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="DESCRIPTION" class="control-label">DESCRIPTION</label>
						<div class="form-group">
							<textarea name="DESCRIPTION" class="form-control" id="DESCRIPTION"><?php echo ($this->input->post('DESCRIPTION') ? $this->input->post('DESCRIPTION') : $message['DESCRIPTION']); ?></textarea>
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