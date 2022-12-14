<div class="panel panel-primary">
	<div class="panel-heading with-border">
		<div class="panel-heading-with-add">
			<button class="btn_collapsed"
			        style="background:transparent !important;border:unset !important;position: inherit; top: unset; right:unset;"
			        data-toggle="collapse"
			        aria-controls="collapse-notes"
			        aria-expanded="true"
			        href='#collapse-notes'
			        style="position:relative !important;">
				<i class="fa fa-minus"></i> NOTES
			</button>

			<button style="float:right;" data-toggle="modal" data-target="#NoteModal" class="btn btn-success btn-xs">
				<span class="glyphicon glyphicon-plus"></span>
			</button>
		</div>
	</div>

	<div class="panel-body">
		<div id="collapse-notes" class="panel-collapse collapse in">
			<table class="table table-striped">
				<thead>
				<tr>
					<th>PAR</th>
					<th>DATE</th>
					<th>NOTE</th>
                    <?php if (!is_student() && !is_employer()) { ?>
						<th style="text-align:center;"
						    data-toggle="popover"
						    data-trigger="hover"
						    data-placement="top"
						    title="INFORMATION"
						    data-html="true"
						    data-content="<p style='text-align:center;'>SEULEMENT VOUS ÊTES EN MESURE DE VISUALISER CETTE NOTE</p>"
						    class="popover-general">
							PRIVÉE <span class="fas fa-question-circle"></span>
						</th>
						<th>ACTIONS</th>
                    <?php } ?>
				</tr>
				</thead>
				<tbody>
                <?php foreach ($all_notes as $NP) { ?>
                    <?php if ($NP['PRIVATE'] == 0) { ?>
						<tr>
							<td><?= get_notes_user_name($NP['CREATOR_ID'], $NP['CREATOR_TYPE']) ?></td>
							<td><?= $NP['DATE'] ?></td>
							<td><?= $NP['DESCRIPTION'] ?></td>
                            <?php if (!is_student() && !is_employer()) { ?>
								<td></td>
								<td>
									<a href="<?= site_url("note/edit/{$NP['ID']}/{$NP['INTERNSHIP_ID']}") ?>" class="btn btn-primary btn-xs">
										<i class="fa fa-edit"></i> MODIFIER
									</a>
									<a href="<?= site_url("note/remove/{$NP['ID']}/{$NP['INTERNSHIP_ID']}") ?>" class="btn btn-danger btn-xs">
										<i class="fa fa-trash"></i> SUPRIMMER
									</a>
								</td>
                            <?php } ?>
						</tr>
                    <?php } ?>

                    <?php if (($NP['PRIVATE'] == 1) && (is_teacher())) { ?>
						<tr>
							<td><?= get_notes_user_name($NP['CREATOR_ID'], $NP['CREATOR_TYPE']) ?></td>
							<td><?= $NP['DATE'] ?></td>
							<td><?= $NP['DESCRIPTION'] ?></td>
							<td style="text-align: center"><i class="fa fa-check" aria-hidden="true"></i></td>
							<td>
								<a href="<?= site_url("note/edit/{$NP['ID']}/{$NP['INTERNSHIP_ID']}") ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-edit"></i> MODIFIER
								</a>
								<a href="<?= site_url("note/remove/{$NP['ID']}/{$NP['INTERNSHIP_ID']}") ?>" class="btn btn-danger btn-xs">
									<i class="fa fa-trash"></i> SUPRIMMER
								</a>
							</td>
						</tr>
                    <?php } ?>
                <?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box-footer"></div>
</div>
