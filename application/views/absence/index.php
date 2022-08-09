<div class="row">
    <?php //var_dump($internships) ;?>
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">ABSENCES</h3>
            </div class="box-header">

            <div class="box-body">

                  <div class="row">


                      <div class="col-md-3">
                          <label for="STUDENT_ID" class="control-label">ÉLÈVE</label>
                          <div class="form-group input-group col-md-12 ">
                              <select id="STUDENT_ID_SELECT" name="STUDENT_ID" class="form-control" style="width:100%">
                                  <option value="">Sélectionner un élève</option>
                                  <?php  
                                  foreach($students as $student)
                                  {
                                      // $selected = ($program['ID'] == $this->input->post('PROGRAM_ID')) ? ' selected="selected"' : "";

                                      echo '<option value="'.$student['ID'].'" >'.$student['NAME'].'</option>';
                                  } 
                                  ?>
                              </select>

                          </div>

                      </div>
                        
                        <div class="col-md-2">
                            <label for='FORDATE' class="control-label">DÉBUT DES ABSENCES</label>
                            <div class="form-group input-group col-md-12" >
                                <input  id="START_DATE_SELECT"  name="FORDATE" value="<?php echo $this->input->post('FORDATE'); ?>" class="form-control has-datetimepicker" data-date-format="YYYY-MM-DD">
                            </div> 
                        </div>
                        
                        <div class="col-md-2">
                            <label for='FORDATE' class="control-label">FIN DES ABSENCES</label>
                            <div class="form-group input-group col-md-12" >
                                <input  id="END_DATE_SELECT"  name="FORDATE" value="<?php echo $this->input->post('FORDATE'); ?>" class="form-control has-datetimepicker" data-date-format="YYYY-MM-DD">
                            </div> 
                        </div>
                        
                        
                        <div class="col-md-2">
                            <label for='FORBUTTON' class="control-label"></label>
                            <div class="form-group input-group col-md-12" style="margin-top:3px;" >
                          <button id="btn-absence-filter" class="btn btn-success ">FILTRÉ <span class="fas fa-angle-double-right"></span></button>
                           </div> 
                        </div>
                        
                    </div>
   
        <!-- SECTION POUR EMPLOYEURS ACTIFS -->
        <div class="panel panel-primary">
            
            <div class="panel-heading">
                <div class="panel-heading-with-add"> 
                <h3 class="panel-title">LISTE DES ABSENCES</h3>
               
            </div>
           </div>
            <!-- /.box-header -->
            <div class="panel-body cell-border table-responsive ">
              <table class="table table-hover absences-datatable">
                <thead>
                    <tr>
                        <th class="">STUDENT</th>
                        <th class="col-md-2">ÉLÈVE</th>
                        <th class="col-md-1">DATE REPORTÉ</th>
                        <th class="col-md-2">INSCRIT PAR</th>
                        <th class="col-md-1">POUR DATE</th>
                        <th class="col-md-1">JOURNÉE COMPLÈTE</th>
					    <th class="col-md-1">NOMBRE D'HEURES</th>
					    <th class="col-md-4">NOTES</th>
					    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absences as $A): ?>
                            <tr>
                                <td><?php echo get_student_id_by_internship_id($A["INTERNSHIP_ID"]); ?></td>
                                <td><?php echo get_student_name_by_internship_id($A["INTERNSHIP_ID"]); ?></td>
                  	            <td><?php $date1 = new DateTime($A["REPORTDATE"]); echo $date1->format('Y-m-d');?></td>
        						<td><?php if($A["BY_TYPE"]== 3){echo get_employer_contact_name_by_id($A["BY_ID"]) . ' [EMPLOYEUR]';}
        						          if($A["BY_TYPE"]== 2){echo get_teacher_name_by_id($A["BY_ID"]) . ' [ENSEIGNANT]';}?>
        						</td>
        						<td><?php echo $A["FORDATE"]; ?></td>
        						<td><?php echo ($A["FULLDAY"] == 1 ? "OUI" : 'NON'); ?></td>
        						<td><?php echo $A["HOURS"]; ?></td>
        						<td><?php echo $A["NOTE"]; ?></td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.box-body -->
            
            
        </div>
         <button id="btn-absence-print" class="btn btn-primary ">IMPRIMER <span class="fas fa-print"></span></button>


    </div>
    
    </div>
</div>
</div>










