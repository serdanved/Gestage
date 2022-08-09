
<style>
table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,th {
    border: 1px solid #ddd;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}
th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #328fad;
    color: white;
}
</style>



<div class="row" style="text-align:center">
    <img  style="max-width:200px" src="http://gestage.cslsj.qc.ca/resources/img/logo_cfp.png">
    
    
    <?php //var_dump($internships) ;?>
    <div class="col-md-12">
        
        <div class="box box-info">
            <div class="box-header">
                <hr>
                <h3 class="box-title">ABSENCES  
                <?php 
                if($studentid != "null"){ echo " POUR " . strtoupper(get_student_name_by_id($studentid));  } 
                
                if($start_date != "null"){ echo " <br> DU " . strtoupper(date_in_french($start_date));  }
                if($end_date != "null"){ echo " <br> AU " . strtoupper(date_in_french($end_date));  }?>
                
                </h3>
                
            </div>
            
            <div class="box-body">
                
          
                      
                  
                     
                     
                   
   
        <!-- SECTION POUR EMPLOYEURS ACTIFS -->
        <?php foreach($unique_student as $student): ?>
        <div style="margin-bottom:50px;" class="panel panel-primary">
            
            <div class="panel-heading">
            <h2 style="text-align:left;"><?php echo get_student_name_by_id($student); ?></h2>
           </div>
            <!-- /.box-header -->
            <div class="panel-body cell-border table-responsive ">
              <table class="table table-hover absences-datatable">
                <thead>
                    <tr>
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
                     <?php if($A["STUDENT_ID"] == $student) : ?>
                            <tr>
                  	            <td><?php $date1 = new DateTime($A["REPORTDATE"]); echo $date1->format('Y-m-d');?></td>
        						<td><?php if($A["BY_TYPE"]== 3){echo get_employer_contact_name_by_id($A["BY_ID"]) . ' [EMPLOYEUR]';}
        						          if($A["BY_TYPE"]== 2){echo get_teacher_name_by_id($A["BY_ID"]) . ' [PROFESSEUR]';}?>
        						</td>
        						<td><?php echo $A["FORDATE"]; ?></td>
        						<td><?php echo ($A["FULLDAY"] == 1 ? "OUI" : 'NON'); ?></td>
        						<td><?php echo $A["HOURS"]; ?></td>
        						<td><?php echo $A["NOTE"]; ?></td>
                            </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.box-body -->
            
            
        </div>
        <?php endforeach; ?>


    </div>
    
    </div>
</div>
</div>










