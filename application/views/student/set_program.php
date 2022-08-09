<div class="row">
   <div class="col-md-12">
      <div class="panel panel-primary">
      <div class="panel-heading with-border">
            <h3 class="panel-title">Assignation d'un programme</h3>
      </div>
          
      <?php echo form_open('student/set_program/'.$student['ID'],array("class"=>"form-horizontal")); ?>    
      <div class="panel-body">



          <div class="form-group">
  <label style="text-align:left;" for="PROGRAM_ID" class="control-label col-md-2">Programme</label>
  <div class="col-md-3">
   <select class="recherche" NAME="PROGRAM_ID" style="height:30px;padding:5px;width:400px;">
        <option value="">SÉLECTIONNEZ UN PROGRAMME</option>
        <?php foreach($all_programs as $program){ 

          echo '<option value="' . $program["ID"] . '"' . $sel . '>' . $program["NAME"] . '</option>';
        }?>
      </select>
  </div>

  <div class="col-md-12">
  <span class="text-danger">
    <?php echo form_error('PROGRAM_ID');?>
  </span>
  </div>

</div>



       </div>

          
          
      <div class="panel-footer">
          <div class="row">
              <div class="col-sm-5 col-md-5">
                  <button type="submit" class="btn btn-success">Enregistrer</button>
              </div>
          </div>
      </div>
  </div>
 <?php echo form_close(); ?>
  </div>           
    <style>




        

        </style>
