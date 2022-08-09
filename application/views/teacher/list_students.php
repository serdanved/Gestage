<div class="row">
    <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">liste d'Élèves</h3>
        </div>
         <div class="box-body">
             
             
        <?php foreach($teachers as $T){ ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $T['NAME']; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive"> 
                <table class="table table-striped" data-sortable>
                    <thead class="cf">
                    <tr>
						<th class="col-md-2">NOM</th>
						<th class="col-md-2">COURRIEL</th>
						<th class="col-md-2">PROGRAMME</th>
						<th class="col-md-2">ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($students as $S){ 
                        if ($S['TEACHER_ID'] == $T['ID']) {?>

                    
                    <tr>
						<td><?php echo $S['NAME']; ?></td>
						<td><?php echo $S['EMAIL_CS']; ?></td>
						<td><?php echo get_program_name_by_id($S['PROGRAM_ID']); ?></td>

						<td>
                            <a href="<?php echo site_url('teacher/unassign_student/'.$S['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span> Désassigner cet élève</a> 
                            <a style="margin-left:15px;" href="<?php echo site_url('teacher/archive_student/'.$S['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-pencil"></span> Archiver cet élève</a>

                        </td>
                    </tr>
                    <?php } ?>
                  <?php } ?>  
                        </tbody>
                </table>
                    </div>
            </div>
        </div>
        <?php } ?>
        
        
        
        
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"> ÉLÈVES NON ASSIGNÉS À UN ENSEIGNANT (<?= count($unassigned_students); ?>)<button style="margin-left:15px;font-weight:bold" class="btn btn-danger btn-xs pull-right" id="mass_archive_button"><span class="fa fa-pencil"></span> Archivation massive</button><button style="font-weight:bold;" class="btn btn-success btn-xs pull-right" id="mass_assign_button"><span class="fa fa-pencil"></span> Assignation massive</button> </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped" id="unassigned_students_table" data-sortable>
                    <thead>
                    <tr>
                        <th class="col-md-1"></th>
						<th class="col-md-2">NOM</th>
						<th class="col-md-2">COURRIEL</th>
						<th class="col-md-2">PROGRAMME</th>
						<th class="col-md-2">ACTIONS</th>
                    </tr>
                    </thead>
                    
                    <?php foreach($unassigned_students as $S){ ?>
                        <?php if($S["ARCHIVE"] == 0){ ?>
                        <tr>
    						<td><input type="checkbox" name="students_assignment[]" value="<?php echo $S['ID']; ?>"/></td>
    						<td><?php echo $S['NAME']; ?></td>
    						<td><?php echo $S['EMAIL_CS']; ?></td>
    						<td><?php echo get_program_name_by_id($S['PROGRAM_ID']); ?></td>
    						<td>
                                <a href="<?php echo site_url('teacher/assign_student/'.$S['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span> M'assigner cet élève</a> 
                                 <a style="margin-left:15px;" href="<?php echo site_url('teacher/archive_student/'.$S['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-pencil"></span> Archiver cet élève</a>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
        </div>        

        
        
         <div class="panel panel-primary">
            <div class="panel-heading">
                   <button class="btn_collapsed" style="background:unset !important;border:unset !important;" data-toggle="collapse" aria-expanded="false" href='#collapse' style="position:relative !important;" class="panel-title collapsed"><i class="fa fa-plus"></i> ÉLÈVES ARCHIVÉS</button>


            </div>
            <div class="panel-body">
                <div id="collapse" class="panel-collapse collapse">
                <table class="table table-striped" id="unassigned_students_table" data-sortable>
                    <thead>
                    <tr>
						<th class="col-md-2">NOM</th>
						<th class="col-md-2">COURRIEL</th>
						<th class="col-md-2">PROGRAMME</th>
						<th class="col-md-2">ACTIONS</th>
                    </tr>
                    </thead>
                    
                    <?php foreach($unassigned_students as $S){ ?>
                        <?php if($S["ARCHIVE"] == 1){ ?>
                        <tr>
    						<td><?php echo $S['NAME']; ?></td>
    						<td><?php echo $S['EMAIL_CS']; ?></td>
    						<td><?php echo get_program_name_by_id($S['PROGRAM_ID']); ?></td>
    						<td>
                                <a href="<?php echo site_url('teacher/assign_student/'.$S['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span> M'assigner cet élève</a> 
                                <a style="margin-left:15px;" href="<?php echo site_url('teacher/unarchive_student/'.$S['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-pencil"></span> Désarchiver cet élève</a>

                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
                </div>
            </div>
        </div>        
    </div>
</div>
</div>
</div>


