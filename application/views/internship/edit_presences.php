<!-- HORAIRE STAGE -->
<div class="panel panel-primary">
	<div class="panel-heading with-border">
		<div class="panel-heading-with-add">
			<button class="btn_collapsed"
			        style="background:transparent !important;border:unset !important;position: inherit; top: unset; right:unset;"
			        data-toggle="collapse" aria-expanded="false" href='#collapse-presences'
			        aria-controls="collapse-presences" style="position:relative !important;"><i class="fa fa-plus"></i>
				PRÉSENCES
			</button>
			<!--
						<button style="float:right;" data-toggle="modal" data-target="#PrivateNoteModal" class="btn btn-success btn-xs">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
			-->
		</div>
	</div>
	<div class="panel-body table-responsive">
		<div id="collapse-presences" class="panel-collapse collapse">
			<div class="row">
				<div class="col-md-3">
					<label for="STUDENT_ID" class="control-label">BLOC</label>
					<div class="form-group input-group col-md-12 ">
						<select id="BLOCK_SCHEDULE_ID_SELECT" name="BLOCK_SCHEDULE_ID_SELECT" class="form-control" style="width:100%">
							<?php foreach ($all_blocks as $block) {
								$selected = ($block['CURRENT'] == 1) ? ' selected="selected"' : "";

								echo '<option value="' . $block['ID'] . '" "' . $selected . '"   >' . $block['NAME'] . '</option>';
							} ?>
						</select>
					</div>
				</div>
			</div>

			<form id="presenceform">
				<table class="table presence-table table-striped" style="width:100% !important;">
					<thead>
					<tr>
						<th style="text-align:center;">BLOCK ID</th>
						<th style="text-align:center;">DATE</th>
						<th style="text-align:center;">PRÉSENT</th>
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
						<th style="text-align:center;">NON APPLICABLE</th>
						<th style="text-align:center;">TOTAL</th>
					</tr>
					</thead>

					<tbody>
					<?php foreach ($all_block_schedules as $schedule) { ?>
						<tr data-schedule-id="<?= $schedule["ID"] ?>"
						    data-schedule-day="<?= $schedule["VALUE"]->DAY ?>"
						    data-schedule-date="<?= $schedule["VALUE"]->DATE ?>"
						    data-schedule-reason="<?= $schedule["VALUE"]->REASON ?>"
						    class="schedule-row-<?= $schedule['ID'] ?>">
							<td><?= $schedule["BLOCK_ID"] ?></td>
							<td><?= $schedule["VALUE"]->DATE ?></td>
							<td style="text-align:center;">
								<div class="form-group">
									<?php if (isset($schedule["VALUE"]->PRESENT)) { ?>
										<input type="checkbox" checked name="PRESENT" data-toggle="tooltip"
										       data-html="true" data-placement="right" title="<p></p>"
										       class="checkbox-present" />
									<?php } ?>
									<?php if (!isset($schedule["VALUE"]->PRESENT)) { ?>
										<input type="checkbox" name="PRESENT" data-toggle="tooltip" data-html="true"
										       data-placement="right"
										       title="<p><?= $schedule["VALUE"]->REASON ?></p>"
										       class="checkbox-present" />
									<?php } ?>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="FROM_AM" value="<?= $schedule["VALUE"]->FROM_AM ?>"
									       class="form-control timepicker" />
									<div class="input-group-addon"><i class="far fa-clock"></i></div>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="TO_AM" value="<?= $schedule["VALUE"]->TO_AM ?>"
									       class=" form-control timepicker" />
									<div class="input-group-addon"><i class="far fa-clock"></i></div>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="FROM_PM" value="<?= $schedule["VALUE"]->FROM_PM ?>"
									       class=" form-control timepicker" />
									<div class="input-group-addon"><i class="far fa-clock"></i></div>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="TO_PM" value="<?= $schedule["VALUE"]->TO_PM ?>"
									       class=" form-control timepicker" />
									<div class="input-group-addon"><i class="far fa-clock"></i></div>
								</div>
							</td>
							<td style="display:<?= ($internship_schedule_ev == 1 ? '' : 'none') ?>;"
							    class="td-evening">
								<div class="input-group">
									<input type="text" name="FROM_EV"
									       value="<?= (isset($schedule["VALUE"]->FROM_EV) ? $schedule["VALUE"]->FROM_EV : '17:00') ?>"
									       class=" form-control timepicker" />
									<div class="input-group-addon"><i class="far fa-clock"></i></div>
								</div>
							</td>
							<td style="display:<?= ($internship_schedule_ev == 1 ? '' : 'none') ?>;"
							    class="td-evening">
								<div class="input-group">
									<input type="text" name="TO_EV"
									       value="<?= (isset($schedule["VALUE"]->TO_EV) ? $schedule["VALUE"]->TO_EV : '17:00') ?>"
									       class=" form-control timepicker" />
									<div class="input-group-addon"><i class="far fa-clock"></i></div>
								</div>
							</td>
							<td style="text-align:center;">
								<div class="form-group">
									<?php if (isset($schedule["VALUE"]->CLOSED)) { ?>
										<input type="checkbox" checked name="CLOSED" />
									<?php } ?>
									<?php if (!isset($schedule["VALUE"]->CLOSED)) { ?>
										<input type="checkbox" name="CLOSED" />
									<?php } ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<input readonly type="text" name="TOTAL" value="<?= $schedule["VALUE"]->TOTAL ?>" class=" form-control" />
								</div>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</form>

			<button type="button" id="submit_presences" value="<?= $this->uri->segment(3) ?>"
			        class="btn btn-success">
				<i class="fa fa-check"></i> SAUVEGARDER LE BLOC
			</button>
			<div style="color:red;" class="presence_validation_error"></div>
		</div>
	</div>
</div> <!-- HORAIRE STAGE -->
