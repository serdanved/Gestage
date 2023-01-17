<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">CHOISIR VOS FILTRES DE RAPPORT</h3>
            </div>
            <?= form_open('report/generatePdf', array('target' => '_blank')) ?>
          	<div class="box-body">
          		<div class="row clearfix">
                    <div class="col-md-12">
                        <label for="REPORT_TYPE" class="control-label">CHOISIR TYPE DE RAPPORT</label>
                        <div class="form-group">
                            <select id="REPORT_TYPE" name="REPORT_TYPE" style="width:100%">
                                <option value="1" selected>Liste des stages entre 2 dates</option>
                                <option value="2">Liste des Employeurs</option>
                                <option value="3">Publipostage Employeur</option>
                                <option value="4">Liste des Protocoles entre 2 dates</option>
                                <option value="5">Publipostage Employeur simplifié</option>
                            </select>
                        </div>
                    </div>
					<div class="col-md-4">
                        <label for="STUDENTS" class="control-label">CHOISIR LES ÉLÈVES</label>
						<div class="form-group">
                            <?= form_multiselect("STUDENTS[]", $students, array(0), array(
                                "class" => "form-control",
                                "id" => "STUDENTS",
                                "style" => "width:100%",
                            )) ?>
						</div>
					</div>

                    <div class="col-md-4">
                        <label for="EMPLOYERS" class="control-label">CHOISIR LES EMPLOYEURS</label>
						<div class="form-group">
                            <?= form_multiselect("EMPLOYERS[]", $employers, array(0), array(
                                "class" => "form-control",
                                "id" => "EMPLOYERS",
                                "style" => "width:100%",
                            )) ?>
						</div>
					</div>

					<div class="col-md-4">
                        <label for="PROGRAMS" class="control-label">CHOISIR LES PROGRAMMES</label>
						<div class="form-group">
                            <?= form_multiselect("PROGRAMS[]", $programs, array(0), array(
                                "class" => "form-control",
                                "id" => "PROGRAMS",
                                "style" => "width:100%",
                            )) ?>
						</div>
					</div>
                </div>
                <div class="row clearfix">
  					<div class="col-md-6">
                        <label for="DATE_DEBUT" class="control-label">DATE DÉBUT DE STAGE</label>
						<div class="form-group">
                            <input type="date" class="form-control" name="DATE_DEBUT" id="DATE_DEBUT" value="2000-01-01">
						</div>
					</div>

  					<div class="col-md-6">
                        <label for="DATE_FIN" class="control-label">DATE FIN DE STAGE</label>
						<div class="form-group">
                            <input type="date" class="form-control" name="DATE_FIN" id="DATE_FIN" value="<?= date("Y-m-d") ?>">
						</div>
					</div>
				</div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="CITIES" class="control-label">CHOISIR LES VILLES (pour employeurs)</label>
                        <div class="form-group">
                            <?= form_multiselect("CITIES[]", $cities, array(-1), array(
                                "class" => "form-control",
                                "id" => "CITIES",
                                "style" => "width:100%",
                            )) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="CATS" class="control-label">CHOISIR LES CATÉGORIES (pour employeurs)</label>
                        <div class="form-group">
		                    <?= form_multiselect("CATS[]", $cats, array(0), array(
			                    "class" => "form-control",
			                    "id" => "CATS",
			                    "style" => "width:100%",
		                    )) ?>
                        </div>
                    </div>
                </div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> GÉNÉRER PDF
            	</button>
                <button type="submit" class="btn btn-success" formaction="<?= site_url("report/generateXls") ?>">
            		<i class="fa fa-check"></i> GÉNÉRER EXCEL
            	</button>
          	</div>
            <?= form_close() ?>
      	</div>
    </div>
</div>