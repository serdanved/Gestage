
<?php if (is_student()) {
    if($this->session->userdata("program_id") == 0){
        redirect("/student/set_program/". $this->session->userdata("userid"));
    }
} ?>

<div class="row clearfix">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div style="overflow:hidden;" class="panel-heading with-border">
              	<h3 class="pull-left panel-title">PROFIL DE L'UTILISATEUR</h3>
                <?php if($typeid == 2) { ?>
                <a data-toggle="modal" data-target="#ProgramModal" href="ProgramModal" class="pull-right btn btn-success btn-xs"><span class="fa fa-pencil"></span> Ajouter un programme</a>
                <?php } ?>
            </div>
			<div class="panel-body">
				<div class="row clearfix">
					<div class="col-md-12">
						<img class="center-block" src="<?php echo site_url('resources/img/logo_gestage.png');?>">
						<br>
						<h3 class="profile-username text-center"><?= $user["NAME"]; ?></h3>

						<h3 class="profile-username text-center"><?= $user["EMAIL_CS"]; ?></h3>

						<p class="text-muted text-center"><?= $type; ?></p>

						<ul class="list-group list-group-unbordered">
						<?php if ($typeid == 1) { ?>
						<li class="list-group-item">
						    <b>Superviseur de stage</b> <a class="pull-right"><?= get_user_fullname_by_id_and_type($user["TEACHER_ID"],"2"); ?></a>
						</li>
						<li class="list-group-item">
						    <b>Programme</b> <a href="/student/set_program" class="pull-right"><?= get_program_name_by_id($user["PROGRAM_ID"]); ?></a>
						</li>
						<?php } ?>

						<?php if ($typeid == 2) {
						    foreach($programs as $program) {
						      echo "<li class=\"list-group-item\"><b>Membre du programme</b> " . '<a href="/teacher/remove_program/' .$program["ID"] .'/'.$user["ID"].'" style="margin-right: 15px;" class="pull-right btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Supprimer le programme"><span class="fa fa-trash"></span></a>' . "<a style='margin-right: 15px;' class=\"pull-right\">".$program["NAME"]."</a></li>";
						    }
						    foreach($students as $student) {
						      echo "<li class=\"list-group-item\"><b>Élève: </b>".$student["NAME"]."<a style='margin-right: 52px;' class=\"pull-right\">".get_program_name_by_id($student["PROGRAM_ID"])."</a></li>";
						    }
				        } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </div>

    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div style="overflow:hidden;" class="panel-heading with-border">
                <h3 class="pull-left panel-title">GESTION DU MOT DE PASSE</h3>
            </div>
            <div class="panel-body">
                <?= form_open("/user/password") ?>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="PASS">Nouveau Mot de Passe</label>
                            <input type="password" class="form-control" id="PASS" name="PASS" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="CONFIRM">Confirmez Mot de Passe</label>
                            <input type="password" class="form-control" id="CONFIRM" name="CONFIRM" required>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top: 1.7em">
                        <button type="submit" class="btn btn-success btn-block">Enregister</button>
                    </div>

                    <?php if (isset($_GET["pass"]) && $_GET["pass"] == "error") { ?>
                        <div class="col-md-12">
                            <p style="font-weight: bold; text-align: center; color: red;">
                                Votre confirmation de mot de passe n'est pas le même que votre mot de passe!
                            </p>
                        </div>
                    <?php } ?>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SEND MESSAGE" -->
<form id="messagesendform" method="post" accept-charset="utf-8">
	<div id="MessageSendModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:615px;">
            <div class="modal-content">

                <!-- HEADER SECTION OF MODAL SEND MESSAGE" -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 id="TITLE_MESSAGE" class="modal-title">NOUVEAU MESSAGE</h4>
                </div>

                <!-- BODY SECTION OF MODAL SEND MESSAGE" -->
                <div class="modal-body">

                    <div class="">

                    <div class="form-group row">
                        <label for="FROM_MESSAGE" class="col-sm-2 col-form-label">DE</label>
                        <div class="col-sm-8">
                              <input disabled class="form-control" NAME="FROM_MESSAGE" id="FROM_MESSAGE">
                        </div>
                    </div>


                    <div class="form-group row TO_MESSAGE_ROW">
                        <label for="TO_MESSAGE" class="col-sm-2 col-form-label">À</label>
                        <div class="col-sm-8">
                            <select name="TO_MESSAGE" id="TO_MESSAGE" class="selectpicker form-control TO_MESSAGE_PROFILE" multiple data-actions-box="true" data-size="false" data-header="CHOISIR PROGRAMME" style="width:100%">
							</select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SUBJECT_MESSAGE" class="col-sm-2 col-form-label">SUJET</label>
                        <div class="col-sm-8">
                              <input class="form-control" id="SUBJECT_MESSAGE" name="SUBJECT_MESSAGE">
                        </div>
                    </div>


                    <div class="col-md-12">
						<div class="form-group">
        						<textarea  style="background-color:black;" rows="1" name="CONTENT_MESSAGE" id="CONTENT_MESSAGE" class="myTextEditor form-control"/></textarea>
						</div>
					</div>
</div>
                       <div class="row">
                        <?php echo form_hidden('CREATOR_ID', $this->session->userdata('userid'));?>
                        <?php echo form_hidden('CREATOR_TYPE', $this->session->userdata('status_id'));?>
                        <?php echo form_hidden('INTERNSHIP_ID', $this->uri->segment(3));?>
                        <?php echo form_hidden('PRIVATE', '1');?>
                    </div>

                    <div class="row">
                        <div class="col-md-12 message_validation_errors"> </div>
                    </div>

                </div>
                <!-- FOOTER SECTION OF MODAL SEND MESSAGE" -->
                <div class="modal-footer">
                    <button  style="background-color:Gainsboro;float:left" type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">FERMER</button>
                    <button  style="display:none;" class=" btn btn-primary" id="SUBMIT_MESSAGE" type="button"  class="btn btn-primary " value="<?php echo $this->uri->segment(3); ?>">ENVOYER</button>
                    <button  style="display:none;" class="btn btn-primary" id="REPLY_MESSAGE" type="button"  class="btn btn-primary " value="<?php echo $this->uri->segment(3); ?>">RÉPONDRE</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL ABSENCES -->
<form id="programform" method="post" accept-charset="utf-8">
	<div id="ProgramModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- HEADER SECTION OF MODAL PUBLIC NOTE" -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">AJOUT D'UN PROGRAMME</h4>
                </div>

                <!-- BODY SECTION OF MODAL PUBLIC NOTE" -->
                <div class="modal-body col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="PROGRAM_ID" class="control-label">PROGRAMME</label>
                            <div class="form-group">
                                <select style="width:100%:" name="PROGRAM_ID" class="form-control">
                                    <option value="">Sélectionner un programme</option>
                                    <?php foreach($all_programs as $program) {
                                        // $selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";
                                        echo '<option value="'.$program['ID'].'" >'.$program['NAME'].'</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div style="color:red !important;" class="col-md-12 absence_validation_errors"> </div>
                    </div>
                </div>
                <!-- FOOTER SECTION OF MODAL PUBLIC NOTE" -->
                <div class="modal-footer">
                    <button  class=" btn btn-primary"  type="submit"  class="btn btn-primary " value="<?php echo $this->uri->segment(3); ?>">OK</button>
                </div>
            </div>
        </div>
    </div>
</form>