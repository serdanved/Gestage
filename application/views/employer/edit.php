<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Modifier un employeur</h3>
			</div>
			<?= form_open('employer/edit/' . $employer['ID']) ?>
			<div class="box-body">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">
							INFORMATIONS
						</h3>
					</div>
					<div class="panel-body">
						<div class="row clearfix col-md-12">
							<div class="col-md-3">
								<label for="EMPLOYER_NAME" class="control-label">NOM EMPLOYEUR</label>
								<div class="form-group">
									<input type="text" name="EMPLOYER_NAME"
									       value="<?= $this->input->post('EMPLOYER_NAME') ? $this->input->post('EMPLOYER_NAME') : $employer['EMPLOYER_NAME'] ?>"
									       class="form-control" id="EMPLOYER_NAME" />
								</div>
							</div>

							<div class="col-md-3">
								<label for="ADDRESS" class="control-label">ADRESSE</label>
								<div class="form-group">
									<input type="text" name="ADDRESS"
									       value="<?= $this->input->post('ADDRESS') ? $this->input->post('ADDRESS') : $employer['ADDRESS'] ?>"
									       class="form-control" id="ADDRESS" />
								</div>
							</div>

							<div class="col-md-3">
								<label for="CITY" class="control-label">VILLE</label>
								<div class="form-group">
									<input type="text" name="CITY"
									       value="<?= $this->input->post('CITY') ? $this->input->post('CITY') : $employer['CITY'] ?>"
									       class="form-control" id="CITY" />
								</div>
							</div>

							<div class="col-md-3">
								<label for="PROVINCE" class="control-label">PROVINCE</label>
								<div class="form-group">
									<input type="text" name="PROVINCE"
									       value="<?= $this->input->post('PROVINCE') ? $this->input->post('PROVINCE') : $employer['PROVINCE'] ?>"
									       class="form-control" id="PROVINCE" />
								</div>
							</div>

							<div class="col-md-3">
								<label for="POSTAL_CODE" class="control-label">CODE POSTAL</label>
								<div class="form-group">
									<input type="text" name="POSTAL_CODE"
									       value="<?= $this->input->post('POSTAL_CODE') ? $this->input->post('POSTAL_CODE') : $employer['POSTAL_CODE'] ?>"
									       class="form-control" id="POSTAL_CODE" />
								</div>
							</div>

							<div class="col-md-3">
								<label for="PHONEHASH" class="control-label">CODE UTILISATEUR (SUGGESTION TÉLÉPHONE)</label>
								<div class="form-group">
									<input type="text" name="PHONEHASH"
									       value="<?= $this->input->post('PHONEHASH') ? $this->input->post('PHONEHASH') : $employer['PHONEHASH'] ?>"
									       class="form-control" id="PHONEHASH" />
								</div>
							</div>
							<div class="col-md-12 form_validation_errors">
								<?= validation_errors() ?>
							</div>
						</div>
						<div class="col-md-12">
							<label for="NOTE" class="control-label">
								<span class="text-danger"></span>NOTE SUR L'EMPLOYEUR</label>
							<div class="form-group">
								<div class="form-group">
									<textarea name="NOTE" class="form-control mceNoEditor" id="NOTE"><?= $this->input->post('NOTE') ? $this->input->post('NOTE') : $employer['NOTE'] ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-check"></i> SAUVEGARDER
						</button>
					</div>
				</div>
                <?= form_close() ?>

                <?= form_open('employer/change_password/' . $employer['ID']) ?>
                <div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-heading-with-add">
							<h3 class="panel-title">
								CHANGER MOT DE PASSE
							</h3>
						</div>
					</div>
					<div class="panel-body">
						<div class="row clearfix">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NEW_PASSWORD">NOUVEAU MOT DE PASSE</label>
                                    <input type="password" minlength="4" class="form-control" name="NEW_PASSWORD" id="NEW_PASSWORD" placeholder="Mot de Passe" required>
                                </div>
                            </div>
                        </div>
					</div>
                    <div class="panel-footer">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-check"></i> SAUVEGARDER
						</button>
					</div>
				</div>
                <?= form_close() ?>

				<?= form_open("employer/batch_save_contacts/{$employer['ID']}") ?>
				<div class="panel-body">
					<table class="table table-hover ">
						<thead>
						<tr>
							<th>NOM</th>
							<th>TÉLÉPHONE</th>
							<th>COURRIEL</th>
							<th>ACTIONS</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($employer_contacts as $contact) { ?>
							<tr>
								<td>
									<input type="hidden" name="id[]" value="<?= $contact["ID"] ?>">
									<input type="text" name="name[]" class="form-control" value="<?= $contact["CONTACT_NAME"] ?>" required>
								</td>
								<td>
									<input type="text" name="phone[]" class="form-control" value="<?= $contact["CONTACT_PHONE"] ?>" required>
								</td>
								<td>
									<input type="text" name="email[]" class="form-control" value="<?= $contact["CONTACT_EMAIL"] ?>" required>
								</td>
								<td>
									<a href="https://gestage.cslsj.qc.ca/employer/remove_employer_contact/<?= $contact["ID"] ?>/<?= $contact["EMPLOYER_ID"] ?>"
										class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom"
										title="" data-original-title="Supprimé le contact">
										<span class="fa fa-trash"></span>
									</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-check"></i> SAUVEGARDER
					</button>
				</div>
				<?= form_close() ?>
			</div>
			<div class="box-footer">
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">LISTE DES CATEGORIES DE CET EMPLOYEUR POUR MES PROGRAMMES</h3>
			</div>
			<div class="box-body">
				<?php foreach ($teacher_programs as $T) {
					$categories = $this->Employer_model->get_categories($T["ID"]);
					$current = $this->Employer_model->get_employer_category_from_program($employer["ID"], $T["ID"]); ?>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-heading-with-add">
								<h3 class="panel-title"><?= $T['NAME']; ?></h3>
							</div>
						</div>
						<div class="panel-body cell-border table-responsive ">
							<?= form_open('employer/setcategory/' . $employer['ID'] . "/" . $T['ID']) ?>
							<table class="table table-hover">
								<thead>
								<tr>
									<th>CATÉGORIE</th>
									<th>ACTIONS</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										<select class='form-control' name='category_id' placeholder='Choisir une catégorie'>
											<option value="" selected disabled>Choisir une catégorie</option>
											<?php foreach ($categories as $C) {
												$selected = "";
												if ($current["ID"] == $C["ID"]) {
													$selected = "SELECTED";
												}
												echo "<option $selected value='{$C["ID"]}'>{$C["NAME"]}</option>";
											} ?>
										</select>
									</td>
									<td>
										<button type="submit" class="btn btn-success">
											<i class="fa fa-save"></i> ENREGISTRER
										</button>
									</td>
								</tr>
								</tbody>
							</table>
							<?= form_close() ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<!-- MODAL ABSENCES -->
<form id="employercontactform" method="post" accept-charset="utf-8">
	<div id="EmployerContactModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">AJOUT CONTACT</h4>
				</div>
				<div class="modal-body col-md-12">
					<div class="row">
						<div class="col-md-12">
							<label for='CONTACT_NAME' class="control-label">NOM</label>
							<div class="form-group input-group" style="width:100%;">
								<input type="text" name="CONTACT_NAME" value="<?= $this->input->post('CONTACT_NAME') ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<label for='CONTACT_PHONE' class="control-label">TÉLÉPHONE</label>
							<div class="form-group input-group" style="width:100%;">
								<input type="text" name="CONTACT_PHONE" value="<?= $this->input->post('CONTACT_PHONE') ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<label for='CONTACT_EMAIL' class="control-label">COURRIEL</label>
							<div class="form-group input-group" style="width:100%;">
								<input type="text" name="CONTACT_EMAIL" value="<?= $this->input->post('CONTACT_EMAIL') ?>" class="form-control">
							</div>
						</div>
						<input type="hidden" name="EMPLOYER_ID" value="<?= $this->uri->segment(3) ?>">
					</div>
					<div class="row">
						<div style="color:red !important;" class="col-md-12 employer_contact_errors"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button id="submit_employer_contact_form" class=" btn btn-primary" type="button"
					        class="btn btn-primary " value="<?= $this->uri->segment(3) ?>">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
</form>