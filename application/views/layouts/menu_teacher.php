<li>
    <a href="<?= site_url("/user/profile"); ?>"><i class="fa fa-list-ul"></i> MON PROFIL</a>
</li>
<li>
    <a href="<?= site_url("/teacher/list_students"); ?>"><i class="fa fa-list-ul"></i> ÉLÈVES</a>
</li>
<li>
    <a href="<?= site_url("/internship/index"); ?>"><i class="fa fa-list-ul"></i> STAGES</a>
</li>
<li>
    <a href="<?= site_url("/report/index"); ?>"><i class="fa fa-list-ul"></i> RAPPORT</a>
</li>
<li>
    <a href="<?= site_url("/employer/index"); ?>"><i class="fa fa-list-ul"></i> EMPLOYEURS</a>
</li>
<li>
    <a href="<?= site_url("/lettergenerator/index"); ?>"><i class="fa fa-list-ul"></i> GÉNÉRATEUR DE LETTRES</a>
</li>
<!--<li>
    <a href="<?= site_url("/form/index"); ?>"><i class="fa fa-list-ul"></i> FORMULAIRES</a>
</li>//-->
<!--<li class="">
    <a href="<?= site_url("/absence/index"); ?>"><i class="fa fa-list-ul"></i> ABSENCES</a>
</li>//-->
<?php
$letters = get_letters_favorite();
$this->load->model('Teacher_model');

$teacher_programs = $this->Teacher_model->get_teacher_programs($this->session->userdata("userid"));
foreach($letters as $letter) {
    if($letter['PROGRAM_ID'] == 0) {
        echo "
            <li style='white-space: normal;'>
                <a href='".site_url("lettergenerator/generate/".$letter['ID']."/")."'><i style='color:#328fad' class='fa fa-star'></i> ".$letter["NAME"]."</a>
            </li>";
    }
    foreach($teacher_programs as $program){
        if($letter['PROGRAM_ID'] == $program['ID']){
            echo "
                <li style='white-space: normal;'>
                    <a href='".site_url("lettergenerator/generate/".$letter['ID']."/")."'><i class='fa fa-star'></i> ".$letter["NAME"]."</a>
                </li>";
        }
    }
}