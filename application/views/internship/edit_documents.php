<!-- SECTION OF "DOCUMENTS DU STAGE" -->
<div class="panel panel-primary">
    <div class="panel-heading with-border">
        <div class="panel-heading-with-add">
            <button class="btn_collapsed"
                    style="background:transparent !important;border:unset !important;position: inherit; top: unset; right:unset;"
                    data-toggle="collapse" aria-controls="collapse-documents" aria-expanded="true"
                    href='#collapse-documents' style="position:relative !important;"><i class="fa fa-minus"></i>
                DOCUMENTS DU STAGE
            </button>
            <button style="float:right;" data-toggle="modal" data-target="#DocumentUploadModal"
                    class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-plus"></span>
            </button>
        </div>
    </div>

    <div class="box-body">
        <!--<div id="elfinder"></div>-->
        <div id="collapse-documents" class="panel-collapse collapse in">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>CRÉÉ PAR</th>
                    <th>DATE</th>
                    <th>NOM DU DOCUMENT</th>
                    <th>ÉLÈVE</th>
                    <th>ENSEIGNANT</th>
                    <th>EMPLOYEUR</th>
                    <th class="text-right">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ($all_documents as $AD) { ?>
                    <tr>
                        <td><?php echo get_uploader_name($AD['UPLOADER_USERID'], $AD['UPLOADER_TYPEID']); ?></td>
                        <td><?php echo $AD['DATE']; ?></td>
                        <td><?php echo $AD['NAME']; ?></td>
						<?php
						$student = "";
						$teacher = "";
						$employer = "";
						if ($AD['CANSEE_STUDENT'] == 0) {
							$student = "onclick=\"javascript:blitz_js_db_update('DOCUMENTS','" . $AD['ID'] . "','ID','CANSEE_STUDENT','1');\" ";
						}
						if ($AD['CANSEE_STUDENT'] == 1) {
							$student = "onclick=\"javascript:blitz_js_db_update('DOCUMENTS','" . $AD['ID'] . "','ID','CANSEE_STUDENT','0');\" CHECKED";
						}
						if ($AD['CANSEE_TEACHER'] == 0) {
							$teacher = "onclick=\"javascript:blitz_js_db_update('DOCUMENTS','" . $AD['ID'] . "','ID','CANSEE_TEACHER','1');\" ";
						}
						if ($AD['CANSEE_TEACHER'] == 1) {
							$teacher = "onclick=\"javascript:blitz_js_db_update('DOCUMENTS','" . $AD['ID'] . "','ID','CANSEE_TEACHER','0');\" CHECKED";
						}
						if ($AD['CANSEE_EMPLOYER'] == 0) {
							$employer = "onclick=\"javascript:blitz_js_db_update('DOCUMENTS','" . $AD['ID'] . "','ID','CANSEE_EMPLOYER','1');\" ";
						}
						if ($AD['CANSEE_EMPLOYER'] == 1) {
							$employer = "onclick=\"javascript:blitz_js_db_update('DOCUMENTS','" . $AD['ID'] . "','ID','CANSEE_EMPLOYER','0');\" CHECKED";
						}

						if ($this->session->status == "student") {
							if ($AD['UPLOADER_TYPEID'] == "1") {
								$student .= " DISABLED ";
							} else {
								$student .= " DISABLED ";
								$teacher .= " DISABLED ";
								$employer .= " DISABLED ";
							}
						}
						if ($this->session->status == "teacher") {
							if ($AD['UPLOADER_TYPEID'] == "2") {
								$teacher .= " DISABLED ";
							} else {
								$student .= " DISABLED ";
								$teacher .= " DISABLED ";
								$employer .= " DISABLED ";
							}
						}
						if ($this->session->status == "employer") {
							if ($AD['UPLOADER_TYPEID'] == "3") {
								$employer .= " DISABLED ";
							} else {
								$student .= " DISABLED ";
								$teacher .= " DISABLED ";
								$employer .= " DISABLED ";
							}
						}
						?>
                        <td><input <?= $student; ?> type="checkbox"></td>
                        <td><input <?= $teacher; ?> type="checkbox"></td>
                        <td><input <?= $employer; ?> type="checkbox"></td>

						<?php if (get_document_filename($AD['FORM_ID']) == ""): ?>
                        <td align="right">
                            <a target="_Blank"
                               href="<?= site_url("resources/uploads/{$internship["ID"]}/{$AD['FILENAME']}") ?>"
                               title='Ouvrir le document' class="btn btn-info btn-xs">
                                <i class="fa fa-download"></i>
                            </a>
							<?php endif; ?>
							<?php if (get_document_filename($AD['FORM_ID']) != ""): ?>
                        <td align="right">
                            <a target="_Blank" href="<?= site_url("form/render/{$AD['FORM_ID']}") ?>"
                               title='Ouvrir le document' class="btn btn-info btn-xs">
                                <i class="fa fa-download"></i>
                            </a>
							<?php endif; ?>
							<?php if ($this->session->status == "teacher") { ?>
                                <a href="#" data-documentid="<?= $AD['ID'] ?>"
                                   class="btn btn-danger document-delete btn-xs">
                                    <i class="fa fa-trash"></i>
                                </a>
							<?php } ?>
                        </td>
                    </tr>
				<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- FOOTER SECTION OF "DOCUMENTS DU STAGE" -->
    <div class="box-footer"></div>
</div>
