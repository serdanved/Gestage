<div class="panel panel-primary">
	<div class="panel-heading with-border">
		<div class="panel-heading-with-add">
			<button class="btn_collapsed"
			        style="background:transparent !important;border:unset !important;position: inherit; top: unset; right:unset;"
			        data-toggle="collapse" aria-controls="collapse-blocs" aria-expanded="true" href='#collapse-blocs'
			        style="position:relative !important;">
				<i class="fa fa-minus"></i> BLOCS DE STAGE (<?= count($block_count); ?>)
			</button>

			<?php if (is_teacher()): ?>
				<button data-toggle="modal" data-target="#BlocksModal" class="btn btn-success btn-xs ">
					<span class="glyphicon glyphicon-plus"></span>
				</button>
			<?php endif; ?>
		</div>
	</div>

	<!-- BODY SECTION OF "INFORMATION DU STAGE" -->
	<div class="panel-body">
		<div id="collapse-blocs" class="panel-collapse collapse in">
			<table class="table table-striped">
				<thead>
				<tr>
					<th class="text-center">EN COURS</th>
					<th>NOM</th>
					<th>ENSEIGNANT</th>
					<th>DÉBUT</th>
					<th>FIN</th>
					<th>HEURES TOTAL</th>
					<th>HEURES TRAVAILLÉES</th>
					<th>ABSENCES</th>
					<th class="text-right">ACTIONS</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($all_blocks as $AB) { ?>
					<tr>
						<td align="center"><?php
							if ($AB['CURRENT'] == 0) {
								if (is_teacher()) {
									echo "<a href='/block/set_current/" . $AB['ID'] . "/" . $AB['INTERNSHIP_ID'] . "' <i class='far fa-star'></i></a>";
								} else {
									echo "<i class='fa fa-star-r'></i>";
								}
							}
							if ($AB['CURRENT'] == 1) {
								echo "<i class='fa fa-star'></i>";
							}
							?></td>
						<td><?php echo $AB['NAME']; ?></td>
						<td><?php echo $AB['TEACHER_NAME']; ?></td>
						<td><?php echo date_in_french($AB['DATE_START']); ?></td>
						<td><?php echo date_in_french($AB['DATE_END']); ?></td>
						<td><?php echo $AB['TOTAL_HOURS']; ?></td>
						<td><?php echo $AB['SCHEDULE_TOTAL_HOURS']; ?></td>
						<td><?php echo $AB['SCHEDULE_TOTAL_ABSENCES']; ?></td>
						<td align="right">
							<?php if ($AB['CURRENT'] == 0 && is_teacher() && (!has_block_schedule($AB['ID']))) { ?>
								<a href="<?php echo site_url('internship/removeblock/' . $AB['ID']); ?>"
								   class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> SUPPRIMER</a>
							<?php }
							if (is_teacher()) { ?>
								<a
										href="<?php echo site_url('block/edit/' . $AB['ID'] . '/' . $AB['INTERNSHIP_ID']); ?>"
										class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> MODIFIER</a>
							<?php } ?>
							<?php if ((is_teacher()) && (!has_block_schedule($AB['ID']))) { ?>
								<button data-block-id="<?php echo $AB['ID']; ?>"
								        data-internship-id="<?php echo $this->uri->segment(3); ?>"
								        class="btn btn-success btn-xs submit_generate_schedule"><i
											class="far fa-calendar-plus"></i> GÉNÉRER
								</button>
							<?php } ?>

							<?php if (has_block_schedule($AB['ID'])) { ?>
								<a target="_blank"
								   href="/block/printschedules/<?php echo $AB['ID']; ?>/<?php echo $AB['INTERNSHIP_ID']; ?>"
								   class="btn btn-success btn-xs"><i class="fas fa-sticky-note"></i> RAPPORT</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- FOOTER SECTION OF "INFORMATION DU STAGE" -->
	<div class="box-footer"></div>
</div>