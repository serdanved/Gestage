<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">Modifier le programme</h3>
            </div>
			<?php echo form_open('program/edit/'.$program['ID']); ?>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?= $this->input->post('NAME') ? $this->input->post('NAME') : $program['NAME'] ?>" class="form-control" id="NAME" />
						</div>
					</div>
                    <div class="col-md-6">
						<label for="PAVILION" class="control-label">PAVILION</label>
						<div class="form-group">
							<input type="text" name="PAVILION" maxlength="200" value="<?= $this->input->post('PAVILION') ? $this->input->post('PAVILION') : $program['PAVILION'] ?>" class="form-control" id="PAVILION" />
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> SAUVEGARDER
				</button>
	        </div>
			<?php echo form_close(); ?>
		</div>
    </div>

	<div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
				<div class="panel-heading-with-add">
					<h3 class="panel-title">Gestion des horaires</h3>
					<a href="<?= site_url("/program/schedule_add/{$program['ID']}") ?>" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span>
					</a>
				</div>
            </div>
			<div class="panel-body">
				<table class="table table-striped" data-sortable>
                    <thead>
                    <tr>
						<th style="width:8rem">ID</th>
						<th>NOM</th>
						<th style="width:20rem">ACTIONS</th>
                    </tr>
                    </thead>
                    <?php foreach($schedules as $S){ ?>
                    <tr>
						<td><?= $S['ID'] ?></td>
						<td><?= $S['NAME'] ?></td>
						<td>
                            <a href="<?= site_url('program/schedule_edit/' . $S['ID']) ?>" class="btn btn-info btn-xs">
								<span class="fa fa-edit"></span> Modifier
							</a>
                            <a href="<?= site_url('program/schedule_delete/' . $S['ID']) ?>" class="btn btn-danger btn-xs"
								onclick="return confirm('Ètes-vous sûr de vouloir faire cela?');">
								<span class="fa fa-trash"></span> Supprimer
							</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
			</div>
		</div>
	</div>
</div>