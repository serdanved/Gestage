<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Document Type Add</h3>
            </div>
            <?php echo form_open('document_type/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<div class="form-group">
							<input type="checkbox" name="PRIVATE" value="1"  id="PRIVATE" />
							<label for="PRIVATE" class="control-label">PRIVATE</label>
							<span class="text-danger"><?php echo form_error('PRIVATE');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="checkbox" name="PUBLIC" value="1"  id="PUBLIC" />
							<label for="PUBLIC" class="control-label">PUBLIC</label>
							<span class="text-danger"><?php echo form_error('PUBLIC');?></span>
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