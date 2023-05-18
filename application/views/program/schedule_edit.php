<div class="row">
    <div class="col-md-12">
        <?= form_open('program/schedule_edit/' . $edit["ID"]) ?>
      	<div class="panel panel-primary panel-horaire">
            <div class="panel-heading with-border">
                <div style="display: flex; justify-content: space-between; align-items: center;" class="panel-heading-with-add">
                    <h3 class="panel-title">Modifier un horaire pour le programme <?= $prog["NAME"] ?></h3>
                    <div style="display: flex; justify-content: center;">
                        <input <?= $schedule_ev == 1 ? 'checked' : '' ?> style="margin-top: 3px; width: 15px; height: 20px; margin-right: 5px;" type="checkbox" name="CK_HORAIRE_EVENING" value="1" class="checkbox" id="CK_HORAIRE_EVENING">
                        <label style="margin-bottom: 0;" for="CK_HORAIRE_EVENING" class="control-label">PÉRIODES DE SOIR</label>
                        <div style="margin-bottom: 0;" class="form-group"></div>
                    </div>
                </div>
            </div>
          	<div class="panel-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="NAME" class="control-label">NOM</label>
						<div class="form-group">
							<input type="text" name="NAME" value="<?= $this->input->post('NAME') == null ? $edit["NAME"] : $this->input->post('NAME') ?>" class="form-control" id="NAME" required />
						</div>
					</div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th></th>
                                <th style="text-align:center;">DE</th>
                                <th style="text-align:center;">À</th>
                                <th style="text-align:center;">DE</th>
                                <th style="text-align:center;">À</th>
                                <th class="th-evening" style="display:<?= ($schedule_ev == 1 ? 'table-cell' : 'none') ?>;text-align:center;">DE</th>
                                <th class="th-evening" style="display:<?= ($schedule_ev == 1 ? 'table-cell' : 'none') ?>;text-align:center;">À</th>
                                <th style="text-align:center;">FERMÉ</th>
                                <th style="text-align:center;">TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
						        <?php foreach ($schedule as $z => $s) { ?>
                                <td>
                                    <p><?= $s->DAY ?></p>
                                    <input type="hidden" name="DAY[<?= $z ?>]" value="<?= $s->DAY ?>" class="form-control horaireform_<?= $z ?>"/>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="FROM_AM[<?= $z ?>]" value="<?= $s->FROM_AM ?>" class="form-control timepicker horaireform_<?= $z ?>"/>
                                        <div class="input-group-addon"><i class="far fa-clock"></i></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="TO_AM[<?= $z ?>]" value="<?= $s->TO_AM ?>" class="form-control timepicker horaireform_<?= $z ?>"/>
                                        <div class="input-group-addon"><i class="far fa-clock"></i></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="FROM_PM[<?= $z ?>]" value="<?= $s->FROM_PM ?>" class="form-control timepicker horaireform_<?= $z ?>"/>
                                        <div class="input-group-addon"><i class="far fa-clock"></i></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="TO_PM[<?= $z ?>]" value="<?= $s->TO_PM ?>" class="form-control timepicker horaireform_<?= $z ?>"/>
                                        <div class="input-group-addon"><i class="far fa-clock"></i></div>
                                    </div>
                                </td>

                                <td style="display:<?= ($schedule_ev == 1 ? '' : 'none') ?>;" class="td-evening">
                                    <div class="input-group">
                                        <input type="text" name="FROM_EV[<?= $z ?>]" value="<?= isset($s->FROM_EV) ? $s->FROM_EV : '17:00' ?>" class="form-control timepicker horaireform_<?= $z ?>"/>
                                        <div class="input-group-addon"><i class="far fa-clock"></i></div>
                                    </div>
                                </td>
                                <td style="display:<?= ($schedule_ev == 1 ? '' : 'none') ?>;" class="td-evening">
                                    <div class="input-group">
                                        <input type="text" name="TO_EV[<?= $z ?>]" value="<?= isset($s->TO_EV) ? $s->TO_EV : '21:00' ?>" class="form-control timepicker horaireform_<?= $z ?>"/>
                                        <div class="input-group-addon"><i class="far fa-clock"></i></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group" style="text-align:center;">
								        <?php if (isset($s->CLOSED)) { ?>
                                            <input type="checkbox" checked name="CLOSED[<?= $z ?>]" class="horaireform_<?= $z ?>"/>
								        <?php } ?>
								        <?php if (!isset($s->CLOSED)) { ?>
                                            <input type="checkbox" name="CLOSED[<?= $z ?>]" class="horaireform_<?= $z ?>"/>
								        <?php } ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input readonly type="text" value="<?= $s->TOTAL ?>" class="form-control horaireform_<?= $z ?>"/>
                                    </div>
                                </td>
                            </tr>
					        <?php } ?>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
          	<div class="panel-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Sauvegarder
            	</button>
          	</div>
      	</div>
        <?= form_close() ?>
    </div>
</div>