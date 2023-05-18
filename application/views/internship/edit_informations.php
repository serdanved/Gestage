<div class="panel panel-primary">
    <div class="panel-heading with-border">
        <button class="btn_collapsed"
                style="background:transparent !important;border:unset !important;position:relative !important; top: unset; right:unset;"
                data-toggle="collapse" aria-controls="collapse-informations" aria-expanded="true"
                href='#collapse-informations'>
            <i class="fa fa-minus"></i>
            INFORMATION DU STAGE
        </button>
    </div>

    <!-- BODY SECTION OF "INFORMATION DU STAGE" -->
    <div class="panel-body">
        <div id="collapse-informations" class="panel-collapse collapse in">
            <div class="row clearfix">
                <div class="col-md-2">
                    <label for="STUDENT_NAME" class="control-label">ÉLÈVE</label>
                    <div class="form-group">
                        <input readonly type="text" name="STUDENT_NAME"
                               value="<?= $this->input->post('STUDENT_NAME') ? $this->input->post('STUDENT_NAME') : $internship['STUDENT_NAME'] ?>"
                               class="form-control" id="STUDENT_NAME"/>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="PROGRAM_NAME" class="control-label">PROGRAMME</label>
                    <div class="form-group">
                        <input readonly type="text" name="PROGRAM_NAME"
                               value="<?= $this->input->post('PROGRAM_NAME') ? $this->input->post('PROGRAM_NAME') : $internship['PROGRAM_NAME'] ?>"
                               class="form-control" id="PROGRAM_NAME"/>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="EMPLOYER_NAME" class="control-label">EMPLOYEUR</label>
                    <div class="form-group">
                        <input readonly type="text" name="EMPLOYER_NAME"
                               value="<?= $this->input->post('EMPLOYER_NAME') ? $this->input->post('EMPLOYER_NAME') : $internship['EMPLOYER_NAME'] ?>"
                               class="form-control" id="EMPLOYER_NAME"/>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="EMPLOYER_CONTACT" class="control-label">EMPLOYEUR CONTACT</label>
                    <div class="form-group">
                        <input readonly type="text" name="EMPLOYER_CONTACT"
                               value="<?= $this->input->post('EMPLOYER_CONTACT') ? $this->input->post('EMPLOYER_CONTACT') : @$employer_contact['CONTACT_NAME'] ?>"
                               class="form-control" id="EMPLOYER_CONTACT"/>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="EMPLOYER_PHONE" class="control-label">EMPLOYEUR TÉLÉPHONE</label>
                    <div class="form-group">
                        <a href="tel:<?= @$employer_contact['CONTACT_PHONE']; ?>">
                            <input style='cursor:pointer' disabled type="text" name="EMPLOYER_PHONE" value="<?= @$employer_contact['CONTACT_PHONE']; ?>" class="form-control" id="EMPLOYER_PHONE"/>
                        </a>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="EMPLOYER_EMAIL" class="control-label">EMPLOYEUR COURRIEL</label>
                    <div class="form-group">
                        <a href="mailto:<?= @$employer_contact['CONTACT_EMAIL']; ?>">
                            <input style='cursor:pointer' disabled type="text" name="EMPLOYER_EMAIL" value="<?= @$employer_contact['CONTACT_EMAIL']; ?>" class="form-control" id="EMPLOYER_EMAIL"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer"></div>
</div>
