<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">MODIFICATION DU BLOC</h3>
            </div>
			<?php echo form_open('block/edit/'.$block['ID'] . '/'.$block['INTERNSHIP_ID']); ?>
			<div class="box-body">
				<div class="row clearfix">
                    <div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?php echo ($this->input->post('NAME') ? $this->input->post('NAME') : $block['NAME']); ?>" class="form-control" id="NAME" />
						</div>
					</div>

					<div class="col-md-6">
						<label for="TEACHER_ID" class="control-label">ENSEIGNANT</label>
						<div class="form-group">
							<select name="TEACHER_ID" class="form-control">
								<option value="">Sélectionner un enseignant</option>
								<?php foreach($program_teachers as $teacher) {
									$selected = ($teacher['ID'] == $block['TEACHER_ID']) ? ' selected="selected"' : "";

									echo '<option value="'.$teacher['ID'].'" '.$selected.'>'.$teacher['NAME'].'</option>';
								} ?>
							</select>
						</div>
					</div>

                     <div class="col-md-6">
						<label for="DATE_START" class="control-label">DATE DE DÉBUT</label>
						<div class="form-group">
							<input type="text" name="DATE_START" value="<?php echo ($this->input->post('DATE_START') ? $this->input->post('DATE_START') : $block['DATE_START']); ?>" class="has-datetimepicker form-control" id="DATE_START" data-date-format="YYYY-MM-DD"/>
						</div>
					</div>

                    <div class="col-md-6">
						<label for="DATE_END" class="control-label">DATE DE FIN</label>
						<div class="form-group">
							<input type="text" name="DATE_END" value="<?php echo ($this->input->post('DATE_END') ? $this->input->post('DATE_END') : $block['DATE_END']); ?>" class="has-datetimepicker form-control" id="DATE_END" data-date-format="YYYY-MM-DD"/>
						</div>
					</div>

                    <div class="col-md-6">
                            <label for='TOTAL_HOURS' class="control-label">HEURES TOTAL</label>
                            <div class="form-group input-group col-md-12" >
                                <input type="number" min="0.00" step="0.01" id="TOTAL_HOURS"  name="TOTAL_HOURS" value="<?php echo ($this->input->post('TOTAL_HOURS') ? $this->input->post('TOTAL_HOURS') : $block['TOTAL_HOURS']); ?>" class="form-control">
                            </div>
                        </div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success" onclick="return confirm('Attention, si votre nouvelle date de début est ultérieure à la nouvelle date de debut actuelle, les jours précédent cette nouvelle date seront supprimés')">
					<i class="fa fa-check"></i> ENREGISTRER
				</button>
	        </div>
			<?php echo form_close(); ?>
		</div>
    </div>
</div>