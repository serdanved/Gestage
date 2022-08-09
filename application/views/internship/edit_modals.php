<!-- START OF MODAL SECTION" -->

<!-- MODAL ABSENCES -->
<form id="absenceform" method="post" accept-charset="utf-8">
	<div id="AbsenceModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- HEADER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">ABSENCE</h4>
				</div>

				<!-- BODY SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-body col-md-12">
					<div class="row">
						<div class="col-md-12">
							<label for='REASON' class="control-label">RAISON</label>
							<div class="form-group input-group" style="width:100%;">
								<input id="REASON" name="REASON" value="<?= $this->input->post('REASON') ?>"
								       class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div style="" class="col-md-12"><p>*Ne pas oublier d'enregistrer vos changements.</p></div>
					</div>
					<div class="row">
						<div style="color:red !important;" class="col-md-12 absence_validation_errors"></div>
					</div>
				</div>
				<!-- FOOTER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-footer">
					<button class="btn btn-primary" id="submit_absence" type="button" value="<?= $this->uri->segment(3) ?>">
						OK
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- MODAL SIGNATURE" -->
<form id="signatureform" method="post" accept-charset="utf-8">
	<div id="signatureModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- HEADER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">SIGNATURE REQUISE</h4>
				</div>

				<!-- BODY SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-body col-md-12">
					<div class="row">
						<div class="col-md-12">
							<label for='SIGNATURE' class="control-label">SIGNATURE</label>
							<div id="SIGNATURE" style="height:100px;width:500px;background-color:white;"></div>
						</div>

						<input type="hidden" class="SIGNATURE_VALUE" name="SIGNATURE_VALUE" value="">
						<input type="hidden" name="INTERNSHIP_ID" value="<?= $this->uri->segment(3) ?>">
						<input type="hidden" name="OBLIGATION_ID" value="">
						<input type="hidden" name="DOCUMENT_ID" value="">
						<input type="hidden" name="BLOCK_ID" value="">
						<input type="hidden" name="FORM_ID" value="">
					</div>

					<div class="row">
						<div class="col-md-12 signature_validation_errors"></div>
					</div>
				</div>
				<!-- FOOTER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button class="btn btn-primary" id="reset_signature" type="button" value="<?= $this->uri->segment(3) ?>">
						EFFACER
					</button>
					<button class="btn btn-primary" id="submit_signature" type="button" value="<?= $this->uri->segment(3) ?>">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- MODAL SIGNATURE" -->
<form id="signatureFormform" method="post" accept-charset="utf-8">
	<div id="signatureFormModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- HEADER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">SIGNATURE REQUISE</h4>
				</div>

				<!-- BODY SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-body col-md-12">
					<div class="row">
						<div class="col-md-12">
							<label for='SIGNATUREFORM' class="control-label">SIGNATURE</label>
							<div id="SIGNATUREFORM" style="height:100px;width:500px;background-color:white;"></div>
						</div>

						<input type="hidden" class="SIGNATURE_VALUE" name="SIGNATURE_VALUE" value="">
						<input type="hidden" name="INTERNSHIP_ID" value="<?= $this->uri->segment(3) ?>">
						<input type="hidden" name="OBLIGATION_ID" value="">
						<input type="hidden" name="DOCUMENT_ID" value="">
						<input type="hidden" name="BLOCK_ID" value="">
						<input type="hidden" name="FORM_ID" value="">
					</div>

					<div class="row">
						<div class="col-md-12 signature_validation_errors"></div>
					</div>
				</div>
				<!-- FOOTER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button class="btn btn-primary" id="reset_signature" type="button" value="<?= $this->uri->segment(3) ?>">
						EFFACER
					</button>
					<button class="btn btn-primary" id="submit_signature_form" type="button" value="<?= $this->uri->segment(3) ?>">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- MODAL PUBLIC NOTE" -->
<form id="noteform" method="post" accept-charset="utf-8">
	<div id="NoteModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- HEADER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">AJOUT D'UNE NOTE</h4>
				</div>

				<!-- BODY SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-body col-md-12">
					<div class="row">
						<div class="col-md-12">
							<label for='DESCRIPTION' class="control-label">DESCRIPTION</label>
							<div class="form-group input-group" style="width:100%;">
								<input id="DESCRIPTION" name="DESCRIPTION"
								       value="<?= $this->input->post('DESCRIPTION') ?>" class="form-control">
							</div>
						</div>

						<div class="col-md-12">
							<label for='PRIVATE' class="control-label">PRIVÉE</label>
							<span style="text-align:center;" data-toggle="popover" data-trigger="hover"
							      data-placement="top" title="INFORMATION" data-html="true"
							      data-content="<p style='text-align:center;'>SEULEMENT VOUS ÊTES EN MESURE DE VISUALISER CETTE NOTE</p>"
							      class="popover-general">
								<span class="fas fa-question-circle"></span>
							</span>

							<div class="form-group input-group" style="width:100%;">
								<input checked type="checkbox" id="PRIVATE" name="PRIVATE" value="1" class="">
							</div>
						</div>

						<?= form_hidden('CREATOR_ID', $this->session->userdata('userid')) ?>
						<?= form_hidden('CREATOR_TYPE', $this->session->userdata('status_id')) ?>
						<?= form_hidden('INTERNSHIP_ID', $this->uri->segment(3)) ?>
					</div>
					<div class="row">
						<div class="col-md-12 note_validation_errors"></div>
					</div>
				</div>
				<!-- FOOTER SECTION OF MODAL PUBLIC NOTE" -->
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button class="btn btn-primary" id="submit_note" type="button" value="<?= $this->uri->segment(3) ?>">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- MODAL BLOCKS INTERNSHIP" -->
<form id="blocksform" method="post" accept-charset="utf-8" action="/internship/add_block">
	<div id="BlocksModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- HEADER SECTION OF MODAL BLOCK" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">AJOUT D'UN BLOC DE STAGE</h4>
				</div>

				<!-- BODY SECTION OF MODAL BLOCK" -->
				<div class="modal-body col-md-12">
					<div class="row">
						<div class="col-md-6">
							<label for='NAME' class="control-label">NOM</label>
							<div class="form-group input-group col-md-12">
								<input id="NAME" name="NAME" value="<?= $this->input->post('NAME') ?>"
								       class="form-control">
							</div>
						</div>

						<div class="col-md-6">
							<label for="TEACHER_ID" class="control-label">ENSEIGNANT</label>
							<div class="form-group input-group col-md-12 ">
								<select name="TEACHER_ID" class="form-control" style="width:100%">
									<option value="">Sélectionner un enseignant</option>
									<?php foreach ($program_teachers as $teacher) {
										// $selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";
										echo '<option value="' . $teacher['ID'] . '">' . $teacher['NAME'] . '</option>';
									} ?>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<label for='DATE_START' class="control-label">DATE DE DÉBUT</label>
							<div class="form-group input-group col-md-12">
								<input id="DATE_START" name="DATE_START" value="<?= $this->input->post('DATE_START') ?>"
								       class="form-control has-datetimepicker" data-date-format="YYYY-MM-DD">
							</div>
						</div>

						<div class="col-md-6">
							<label for='DATE_END' class="control-label">DATE DE FIN</label>
							<div class="form-group input-group col-md-12">
								<input id="DATE_END" name="DATE_END" value="<?= $this->input->post('DATE_END') ?>"
								       class="form-control has-datetimepicker" data-date-format="YYYY-MM-DD">
							</div>
						</div>

						<div class="col-md-6">
							<label for='TOTAL_HOURS' class="control-label">HEURES TOTAL</label>
							<div class="form-group input-group col-md-12">
								<input id="TOTAL_HOURS" name="TOTAL_HOURS"
								       value="<?= $this->input->post('TOTAL_HOURS') ?>" class="form-control">
							</div>
						</div>

						<?= form_hidden('CREATOR_ID', $this->session->userdata('userid')) ?>
						<?= form_hidden('CREATOR_TYPE', $this->session->userdata('status_id')) ?>
						<?= form_hidden('INTERNSHIP_ID', $this->uri->segment(3)) ?>
					</div>

					<div class="row">
						<div class="col-md-12 block_validation_errors"></div>
					</div>
				</div>

				<!-- FOOTER SECTION OF MODAL PRIVATE NOTE" -->
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button class="btn btn-primary" id="submit_block" type="button" value="<?= $this->uri->segment(3) ?>">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- MODAL PRIVATE NOTE" -->
<form id="privatenoteform" method="post" accept-charset="utf-8">
	<div id="PrivateNoteModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- HEADER SECTION OF MODAL PRIVATE NOTE" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">AJOUT D'UNE NOTE PRIVÉE</h4>
				</div>

				<!-- BODY SECTION OF MODAL PRIVATE NOTE" -->
				<div class="modal-body col-md-12">

					<div class="row">
						<div class="col-md-12">
							<label for='DESCRIPTION' class="control-label">DESCRIPTION</label>
							<div class="form-group input-group" style="width:100%;">
								<input id="DESCRIPTION" name="DESCRIPTION"
								       value="<?= $this->input->post('DESCRIPTION') ?>" class="form-control">
							</div>
						</div>

						<?= form_hidden('CREATOR_ID', $this->session->userdata('userid')) ?>
						<?= form_hidden('CREATOR_TYPE', $this->session->userdata('status_id')) ?>
						<?= form_hidden('INTERNSHIP_ID', $this->uri->segment(3)) ?>
						<?= form_hidden('PRIVATE', '1') ?>
					</div>

					<div class="row">
						<div class="col-md-12 private_note_validation_errors"></div>
					</div>
				</div>
				<!-- FOOTER SECTION OF MODAL PRIVATE NOTE" -->
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button class="btn btn-primary" id="submit_private_note" type="button" value="<?= $this->uri->segment(3) ?>">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- MODAL SEND MESSAGE" -->
<form id="messagesendform" method="post" accept-charset="utf-8">
	<div id="MessageSendModal" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog" style="width:615px;">
			<div class="modal-content">
				<!-- HEADER SECTION OF MODAL SEND MESSAGE" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 id="TITLE_MESSAGE" class="modal-title">NOUVEAU MESSAGE</h4>
				</div>

				<!-- BODY SECTION OF MODAL SEND MESSAGE" -->
				<div class="modal-body">
					<div>
						<div class="form-group row">
							<label for="FROM_MESSAGE" class="col-sm-2 col-form-label">DE</label>
							<div class="col-sm-8">
								<input disabled class="form-control" NAME="FROM_MESSAGE" id="FROM_MESSAGE">
							</div>
						</div>

						<div class="form-group row TO_MESSAGE_ROW">
							<label for="TO_MESSAGE" class="col-sm-2 col-form-label">À</label>
							<div class="col-sm-8">
								<select name="TO_MESSAGE" id="TO_MESSAGE" class="selectpicker form-control" multiple
								        data-actions-box="true" data-size="false" data-header="CHOISIR PROGRAMME"
								        style="width:100%">
									<optgroup label="EMPLOYEUR">
										<option value="{'USER_ID':'<?= $internship['EMPLOYER_ID'] ?>','USER_TYPE':'3'}"><?= $internship['EMPLOYER_NAME'] ?></option>
									</optgroup>
									<optgroup label="ÉLÈVE">
										<option value="{'USER_ID':'<?= $internship['STUDENT_ID'] ?>','USER_TYPE':'1'}"><?= $internship['STUDENT_NAME'] ?></option>
									</optgroup>
									<optgroup label="ENSEIGNANT(S)">
										<?php foreach ($program_teachers as $teacher) {
											// $selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";

											$value = "{'USER_ID':'" . $teacher['ID'] . "','USER_TYPE':'2'} >";
											echo "<option value='$value'" . $teacher['NAME'] . '</option>';
										} ?>
									</optgroup>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="SUBJECT_MESSAGE" class="col-sm-2 col-form-label">SUJET</label>
							<div class="col-sm-8">
								<input class="form-control" id="SUBJECT_MESSAGE" name="SUBJECT_MESSAGE">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<textarea style="background-color:black;" rows="1" name="CONTENT_MESSAGE"
								          id="CONTENT_MESSAGE" class="myTextEditor form-control"></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<?= form_hidden('CREATOR_ID', $this->session->userdata('userid')) ?>
						<?= form_hidden('CREATOR_TYPE', $this->session->userdata('status_id')) ?>
						<?= form_hidden('INTERNSHIP_ID', $this->uri->segment(3)) ?>
						<?= form_hidden('PRIVATE', '1') ?>
					</div>

					<div class="row">
						<div class="col-md-12 message_validation_errors"></div>
					</div>
				</div>
				<!-- FOOTER SECTION OF MODAL SEND MESSAGE" -->
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button style="display:none;" class="btn btn-primary btn btn-primary" id="SUBMIT_MESSAGE" type="button"
					        value="<?= $this->uri->segment(3) ?>">
						ENVOYER
					</button>
					<button style="display:none;" class="btn btn-primary" id="REPLY_MESSAGE" type="button"
					        value="<?= $this->uri->segment(3) ?>">
						RÉPONDRE
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- MODAL DOCUMENT UPLOAD" -->
<form id="documentuploadform" action="/upload/file_upload">
	<div id="DocumentUploadModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- HEADER SECTION DOCUMENT UPLOAD MODAL" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">AJOUT D'UN DOCUMENT POUR LE STAGE</h4>
				</div>

				<!-- BODY SECTION DOCUMENT UPLOAD MODAL" -->
				<div class="modal-body">
					<?= print_upload($this->uri->segment(3)) ?>
				</div>

				<!-- FOOTER SECTION DOCUMENT UPLOAD MODAL" -->
				<div class="modal-footer">
					<button style="background-color:Gainsboro;float:left" type="button"
					        class="btn btn-secondary bg-secondary" data-dismiss="modal">
						FERMER
					</button>
					<button onClick="$(this).SelectFiles();" class="btn btn-primary" id="button_select_files"
					        type="button" value="<?= $this->uri->segment(3) ?>">
						CHOISIR FICHIERS
					</button>
					<button onClick="$(this).UploadFiles();" class="btn btn-primary" id="button_upload_files"
					        type="button" value="<?= $this->uri->segment(3) ?>">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<?= form_open_multipart("/pdf/add_pdf_stage/" . $this->uri->segment(3)) ?>
    <div id="AddPdfModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">AJOUT D'UN PDF POUR LE STAGE</h4>
				</div>
				<div class="modal-body">
                    <div class="form-group">
                        <label for="TYPE" class="col-sm-2 control-label">Type:</label>
                        <div class="col-sm-10">
                            <select class="form-control force-normal" name="TYPE" id="TYPE">
                                <option value="fileTeacher">Enseignant</option>
                                <option value="fileEmployer">Employeur</option>
                                <option value="fileStudent">Élève</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="FILE" class="col-sm-2 control-label">Fichier:</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Ouvrir&hellip; <input type="file" style="display:none" id="FILE" name="FILE" accept="application/pdf" required />
                                    </span>
                                </label>
                                <input type="text" class="form-control filename" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="NAME" class="col-sm-2 control-label">Nom:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="NAME" id="NAME" maxlength="255" required />
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button style="background-color:Gainsboro" type="reset" class="btn btn-secondary pull-left" data-dismiss="modal">
						FERMER
					</button>
					<button class="btn btn-primary" type="submit">
						ENREGISTRER
					</button>
				</div>
			</div>
		</div>
	</div>
<?= form_close() ?>

<script type="text/template" id="qq-template-manual-trigger">
	<div class="qq-uploader qq-uploader-selector " qq-drop-area-text="DÉPOSEZ LES FICHIERS ICI">
		<div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
			<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
			     class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar">
			</div>
		</div>
		<div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
			<span class="qq-upload-drop-area-text-selector"></span>
		</div>
		<span class="qq-drop-processing-selector qq-drop-processing">
			<span>Processing dropped files...</span>
			<span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
		<ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
			<li>
				<div class="qq-progress-bar-container-selector">
					<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
					     class="qq-progress-bar-selector qq-progress-bar">
					</div>
				</div>
				<span class="qq-upload-spinner-selector qq-upload-spinner"></span>
				<img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
				<span class="qq-upload-file-selector qq-upload-file"></span>
				<span class="qq-edit-filename-icon-selector qq-edit-filename-icon"
				      aria-label="MODIFIER LE NOM DU FICHIER"></span>
				<input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
				<span class="qq-upload-size-selector qq-upload-size"></span>
				<button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">ANNULER</button>
				<button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">RECOMMENCER</button>
				<button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">SUPPRIMER</button>
				<span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
			</li>
		</ul>
		<div class="buttons" style="display:none !important;">
			<div class="qq-upload-button-selector qq-upload-button" id="qq-file-select-button">
				<div>CHOISIR UN FICHIER</div>
			</div>
			<button type="button" id="trigger-upload" class="btn btn-primary">
				<i class="icon-upload icon-white"></i> Upload
			</button>
		</div>
		<dialog class="qq-alert-dialog-selector">
			<div class="qq-dialog-message-selector"></div>
			<div class="qq-dialog-buttons">
				<button type="button" class="qq-cancel-button-selector">FERMER</button>
			</div>
		</dialog>
		<dialog class="qq-confirm-dialog-selector">
			<div class="qq-dialog-message-selector"></div>
			<div class="qq-dialog-buttons">
				<button type="button" class="qq-cancel-button-selector">NON</button>
				<button type="button" class="qq-ok-button-selector">OUI</button>
			</div>
		</dialog>
		<dialog class="qq-prompt-dialog-selector">
			<div class="qq-dialog-message-selector"></div>
			<input type="text">
			<div class="qq-dialog-buttons">
				<button type="button" class="qq-cancel-button-selector">ANNULER</button>
				<button type="button" class="qq-ok-button-selector">OK</button>
			</div>
		</dialog>
	</div>
</script>