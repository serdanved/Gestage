<!-- HORAIRE STAGE -->
<div class="panel panel-primary panel-horaire">
	<div class="panel-heading with-border">
		<div style="display: flex; justify-content: space-between; align-items: center;" class="panel-heading-with-add">
			<button class="btn_collapsed btn_horaire_stage_collapse"
			        style="background:transparent !important;border:unset !important;position: relative !important; top: unset; right:unset;"
			        data-toggle="collapse"
			        aria-expanded="false"
			        aria-controls="collapse-horaires"
			        href='#collapse-horaires'>
				<i class="fa fa-plus"></i> HORAIRE TYPE DES HEURES DE L'ENTREPRISE
			</button>

			<div style="display: flex; justify-content: center;">
				<input <?= ($internship_schedule_ev == 1 ? 'checked' : '') ?>
						style="margin-top: 3px; width: 15px; height: 20px; margin-right: 5px;"
				        type="checkbox"
				        name="CK_HORAIRE_EVENING"
				        value="1"
				        class="checkbox"
				        id="CK_HORAIRE_EVENING">
				<label style="margin-bottom: 0;" for="CK_HORAIRE_EVENING" class="control-label">PÉRIODES DE SOIR</label>
				<div style="margin-bottom: 0;" class="form-group"></div>
			</div>
		</div>
	</div>
	<div class="panel-body table-responsive">
		<div id="collapse-horaires" class="panel-collapse collapse">
			<form id="horaireform">
				<table class="table table-striped table-responsive">
					<thead>
					<th></th>
					<th style="text-align:center;">DE</th>
					<th style="text-align:center;">À</th>
					<th style="text-align:center;">DE</th>
					<th style="text-align:center;">À</th>
					<th class="th-evening" style="display:<?= ($internship_schedule_ev == 1 ? 'table-cell' : 'none') ?>;text-align:center;">
						DE
					</th>
					<th class="th-evening" style="display:<?= ($internship_schedule_ev == 1 ? 'table-cell' : 'none') ?>;text-align:center;">
						À
					</th>
					<th style="text-align:center;">FERMÉ</th>
					<th style="text-align:center;">TOTAL</th>
					</thead>
					<tbody>
					<tr>
						<?php $z = 0; ?>
						<?php foreach ($internship_schedule as $schedule) { ?>
						<td>
							<p><?= $schedule->DAY ?></p>
							<input type="hidden"
							       name="DAY"
							       value="<?= $schedule->DAY ?>"
							       class="form-control horaireform_<?= $z ?>" />
						</td>
						<td>
							<div class="input-group">
								<input type="text"
								       name="FROM_AM"
								       value="<?= $schedule->FROM_AM ?>"
								       class="form-control timepicker horaireform_<?= $z ?>" />
								<div class="input-group-addon"><i class="far fa-clock"></i></div>
							</div>
						</td>
						<td>
							<div class="input-group">
								<input type="text"
								       name="TO_AM"
								       value="<?= $schedule->TO_AM ?>"
								       class=" form-control timepicker horaireform_<?= $z ?>" />
								<div class="input-group-addon"><i class="far fa-clock"></i></div>
							</div>
						</td>
						<td>
							<div class="input-group">
								<input type="text"
								       name="FROM_PM"
								       value="<?= $schedule->FROM_PM ?>"
								       class=" form-control timepicker horaireform_<?= $z ?>" />
								<div class="input-group-addon"><i class="far fa-clock"></i></div>
							</div>
						</td>
						<td>
							<div class="input-group">
								<input type="text"
								       name="TO_PM"
								       value="<?= $schedule->TO_PM ?>"
								       class=" form-control timepicker horaireform_<?= $z ?>" />
								<div class="input-group-addon"><i class="far fa-clock"></i></div>
							</div>
						</td>
						<td style="display:<?= ($internship_schedule_ev == 1 ? '' : 'none') ?>;"
						    class="td-evening">
							<div class="input-group">
								<input type="text"
								       name="FROM_EV"
								       value="<?= (isset($schedule->FROM_EV) ? $schedule->FROM_EV : '17:00') ?>"
								       class=" form-control timepicker horaireform_<?= $z ?>" />
								<div class="input-group-addon"><i class="far fa-clock"></i></div>
							</div>
						</td>
						<td style="display:<?= ($internship_schedule_ev == 1 ? '' : 'none') ?>;"
						    class="td-evening">
							<div class="input-group">
								<input type="text"
								       name="TO_EV"
								       value="<?= (isset($schedule->TO_EV) ? $schedule->TO_EV : '21:00') ?>"
								       class=" form-control timepicker horaireform_<?= $z ?>" />
								<div class="input-group-addon"><i class="far fa-clock"></i></div>
							</div>
						</td>
						<td>
							<div class="form-group" style="text-align:center;">
								<?php if (isset($schedule->CLOSED)) { ?>
									<input type="checkbox"
									       checked
									       name="CLOSED"
									       class="horaireform_<?= $z ?>" />
								<?php } if (!isset($schedule->CLOSED)) { ?>
									<input type="checkbox" name="CLOSED" class="horaireform_<?= $z ?>" />
								<?php } ?>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input readonly
								       type="text"
								       name="TOTAL"
								       value="<?= $schedule->TOTAL ?>"
								       class="form-control horaireform_<?= $z ?>" />
							</div>
						</td>
					</tr>
					<?php $z++; } ?>
					</tbody>
				</table>
			</form>
			<div style="color:red;" class="horaire_stage_validation_error"></div>
			<button type="button"
			        id="submit_horaire_stage"
			        value="<?= $this->uri->segment(3) ?>"
			        class="btn btn-success">
				<i class="fa fa-check"></i> SAUVEGARDER
			</button>
		</div>
	</div>
</div>
<!-- HORAIRE STAGE -->
