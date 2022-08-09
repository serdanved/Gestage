<div class="row">
	<?php //var_dump($internships) ;?>
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">GESTION PDF</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<?= form_open_multipart("/pdf/add") ?>
						<fieldset class="form-horizontal">
							<legend>Ajouter des Documents PDF</legend>
							<div class="form-group">
								<label for="programme" class="col-sm-2 control-label">Programme:</label>
								<div class="col-sm-10">
									<select class="form-control" id="programme" name="programme">
                                        <?php foreach ($progs as $P) { ?>
                                        <option value="<?= $P["ID"] ?>"><?= $P["NAME"] ?></option>
                                        <?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="fileTeacher" class="col-sm-2 control-label">Enseignant:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                Ouvrir&hellip; <input type="file" style="display:none" id="fileTeacher" name="fileTeacher" accept="application/pdf" />
                                            </span>
                                        </label>
                                        <input type="text" class="form-control filename" readonly>
                                        <span class="input-group-addon">Nom:</span>
                                        <input type="text" class="form-control" name="nameTeacher" maxlength="255" />
                                    </div>
                                </div>
							</div>

                            <div class="form-group">
								<label for="fileEmployer" class="col-sm-2 control-label">Employeur:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                Ouvrir&hellip; <input type="file" style="display:none" id="fileEmployer" name="fileEmployer" accept="application/pdf" />
                                            </span>
                                        </label>
                                        <input type="text" class="form-control filename" readonly>
                                        <span class="input-group-addon">Nom:</span>
                                        <input type="text" class="form-control" name="nameEmployer" maxlength="255" />
                                    </div>
                                </div>
							</div>

                            <div class="form-group">
								<label for="fileStudent" class="col-sm-2 control-label">Élève:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                Ouvrir&hellip; <input type="file" style="display:none" id="fileStudent" name="fileStudent" accept="application/pdf" />
                                            </span>
                                        </label>
                                        <input type="text" class="form-control filename" readonly />
                                        <span class="input-group-addon">Nom:</span>
                                        <input type="text" class="form-control" name="nameStudent" maxlength="255" />
                                    </div>
                                </div>
							</div>

                            <div class="form-group">
                                <div class="col-sm-2">&nbsp;</div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Envoyer
                                    </button>
                                </div>
                            </div>
						</fieldset>
						<?= form_close(); ?>

                        <?php if (isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php foreach ($progs as $P) { ?>
    <div class="col-md-12">
        <div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?= $P["NAME"] ?></h3>
			</div>
			<div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Enseignant</th>
                            <th>Employeur</th>
                            <th>Élève</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php foreach ($this->Pdf_model->get_prog_pdf_type($P["ID"], "fileTeacher") as $D) { ?>
                                <div class="input-group" style="margin-top: 5px">
                                    <input type="text" class="form-control" readonly value="<?= $D["NAME"] ?>" />
                                    <div class="input-group-btn">
                                        <a href="<?= site_url("/resources/documents/" . $D["ID"] . ".pdf") ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="<?= site_url("/pdf/delete/" . $D["ID"]) ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de voulloir supprimer ce document?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php foreach ($this->Pdf_model->get_prog_pdf_type($P["ID"], "fileEmployer") as $D) { ?>
                                <div class="input-group" style="margin-top: 5px">
                                    <input type="text" class="form-control" readonly value="<?= $D["NAME"] ?>" />
                                    <div class="input-group-btn">
                                        <a href="<?= site_url("/resources/documents/" . $D["ID"] . ".pdf") ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="<?= site_url("/pdf/delete/" . $D["ID"]) ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de voulloir supprimer ce document?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php foreach ($this->Pdf_model->get_prog_pdf_type($P["ID"], "fileStudent") as $D) { ?>
                                <div class="input-group" style="margin-top: 5px">
                                    <input type="text" class="form-control" readonly value="<?= $D["NAME"] ?>" />
                                    <div class="input-group-btn">
                                        <a href="<?= site_url("/resources/documents/" . $D["ID"] . ".pdf") ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="<?= site_url("/pdf/delete/" . $D["ID"]) ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de voulloir supprimer ce document?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>
</div>