<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Followup Add</h3>
            </div>
            <?php echo form_open('followup/add'); ?>
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
									$selected = ($internship['ID'] == $this->input->post('INTERNSHIP_ID')) ? ' selected="selected"' : "";

									echo '<option value="'.$internship['ID'].'" '.$selected.'>'.$internship['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="CREATOR_ID" class="control-label">CREATOR ID</label>
						<div class="form-group">
							<select name="CREATOR_ID" class="form-control">
								<option value="">select</option>
								<?php 
								$CREATOR_ID_values = array(
								);

								foreach($CREATOR_ID_values as $value => $display_text)
								{
									$selected = ($value == $this->input->post('CREATOR_ID')) ? ' selected="selected"' : "";

									echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('CREATOR_ID');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="CREATOR_TYPE" class="control-label">Creator Type</label>
						<div class="form-group">
							<select name="CREATOR_TYPE" class="form-control">
								<option value="">select creator_type</option>
								<?php 
								foreach($all_creator_types as $creator_type)
								{
									$selected = ($creator_type['ID'] == $this->input->post('CREATOR_TYPE')) ? ' selected="selected"' : "";

									echo '<option value="'.$creator_type['ID'].'" '.$selected.'>'.$creator_type['ID'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="DESCRIPTION" class="control-label">DESCRIPTION</label>
						<div class="form-group">
							<textarea name="DESCRIPTION" class="form-control" id="DESCRIPTION"><?php echo $this->input->post('DESCRIPTION'); ?></textarea>
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