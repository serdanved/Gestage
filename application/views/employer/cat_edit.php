<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modifier une catégorie d'employeur</h3>
            </div>
			<?php echo form_open('employer/catedit/'.$category['ID']); ?>
			<div class="box-body">
				<div class="row clearfix">

					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM DE LA CATÉGORIE</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?php echo ($this->input->post('NAME') ? $this->input->post('NAME') : $category['NAME']); ?>" class="form-control" id="NAME" />
						</div>
					</div>

				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Enregistrer
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>