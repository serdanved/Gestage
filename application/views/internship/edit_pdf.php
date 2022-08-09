<div class="panel panel-primary">
	<div class="panel-heading with-border">
		<div class="panel-heading-with-add">
			<button class="btn_collapsed"
			        style="background:transparent !important;border:unset !important;position: relative !important; top: unset; right:unset;"
			        data-toggle="collapse" aria-controls="collapse-pdf" aria-expanded="true" href='#collapse-pdf'>
				<i class="fa fa-minus"></i> DOCUMENTS PDF
			</button>

			<?php if (is_teacher()): ?>
				<button data-toggle="modal" data-target="#AddPdfModal" class="btn btn-success btn-xs">
					<span class="glyphicon glyphicon-plus"></span>
				</button>
			<?php endif; ?>
		</div>
	</div>

	<div class="panel-body">
		<div id="collapse-pdf" class="panel-collapse collapse in">
			<table class="table table-striped">
				<thead>
                    <tr>
                        <th>NOM</th>
                        <th>TYPE</th>
                        <th class="text-right">ACTIONS</th>
                    </tr>
				</thead>
				<tbody>
                    <?php foreach ($docs as $D) {
                        if (!is_teacher()) {
                            if ($D["TYPE"] == "fileTeacher") { continue; }
                            if ($D["TYPE"] == "fileEmployer" && !is_employer()) { continue; }
                            if ($D["TYPE"] == "fileStudent" && !is_student()) { continue; }
                        }
                    ?>
                    <tr>
                        <td><?= $D["NAME"] ?></td>
                        <td><?php
                            if ($D["TYPE"] == "fileTeacher") {
                                echo "Enseignant";
                            }
                            if ($D["TYPE"] == "fileEmployer") {
                                echo "Employeur";
                            }
                            if ($D["TYPE"] == "fileStudent") {
                                echo "Élève";
                            }
                        ?></td>
                        <td>
                            <div class="btn-group pull-right" role="group" aria-label="Actions Documents">
                                <a href="<?= site_url("/pdf/viewer/{$internship["ID"]}/{$D["ID"]}") ?>" target="_blank" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <?php if (is_teacher()) { ?>
                                <a href="<?= site_url("/pdf/delete_stage_pdf/{$internship["ID"]}/{$D["ID"]}") ?>"
                                   onclick="return confirm('Êtes-vous sûr de voulloir supprimer ce document?')"
                                   class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box-footer"></div>
</div>