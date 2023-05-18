<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading with-border">
				<h3 class="panel-title">ÉDITER UNE LETTRE</h3>
			</div>
			<?= form_open('lettergenerator/edit/' . $lettergenerator['ID']) ?>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="NAME" class="control-label">Nom</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?= $lettergenerator['NAME'] ?>" class="form-control" id="NAME" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="DESC" class="control-label">Description</label>
						<div class="form-group">
							<input type="text" name="DESC" value="<?= $lettergenerator['DESC'] ?>" class="form-control" id="DESC" />
						</div>
					</div>

					<div class="col-md-4">
						<label for="PROGRAM_ID" class="control-label">Programme</label>
						<div class="form-group">
							<select name="PROGRAM_ID" class="form-control select2">
								<option value="">Tous les programmes</option>
								<?php foreach ($all_programs as $program) {
									$selected = ($program['ID'] == $lettergenerator['PROGRAM_ID']) ? ' selected="selected"' : "";
									echo '<option value="' . $program['ID'] . '" ' . $selected . '>' . $program['NAME'] . '</option>';
								} ?>
							</select>
							<span class="text-danger"><?= form_error('PROGRAM_ID') ?></span>
						</div>
					</div>

					<div class='col-md-12'>
						<label for="CONTENT" class="control-label">Contenu</label>
						<div class="form-group">
							<textarea name="CONTENT" class="form-control" id="CONTENT"><?= $lettergenerator['CONTENT'] ?></textarea>
						</div>
					</div>

					<div class='col-md-12'>
						<div class="box box-info">
							<div class="box-header"><h3 class="box-title">CHAMPS</h3></div>
							<div class="box-body">
								<ul style="list-style-type:none;" id="draggable">
									<?php foreach ($eleve_fields as $fields) {
										echo "<li>{ETUDIANT." . $fields . "}</li> ";
									}
									echo "<br><br>";
									foreach ($stage_fields as $fields) {
										echo "<li>{STAGE." . $fields . "}</li> ";
									}
									echo "<br><br>";
									foreach ($employeur_fields as $fields) {
										echo "<li>{EMPLOYEUR." . $fields . "}</li> ";
									}
									echo "<br><br>";
									foreach ($teacher_fields as $fields) {
										echo "<li>{ENSEIGNANT." . $fields . "}</li> ";
									}
									echo "<br><br>";
									foreach ($program_fields as $fields) {
										echo "<li>{PROGRAMME." . $fields . "}</li> ";
									}

									/*foreach($block_fields as $fields) {
										echo "<li>{".$fields."}</li> ";
									}*/
									echo "<br><br>";
									echo "<li>{PAVILION_ADDRESS}</li> ";
									echo "<li>{PAVILION_POSTAL_CODE}</li> ";
									echo "<li>{LOGO}</li> ";

									echo "<br><br>";
									echo "<li>{DATE}</li> ";
									echo "<li>{SIGNATURE_ENSEIGNANT}</li> ";
									echo "<li>{SIGNATURE_EMPLOYEUR}</li> ";
									echo "<li>{SIGNATURE_ELEVE}</li> ";
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> SAUVEGARDER
				</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
