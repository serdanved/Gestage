<div class="row">
    
    
    
    <div class="col-md-12">
        
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">LISTE DES CATEGORIES DE MES PROGRAMMES</h3>
            </div>
            
            <div class="box-body">
        <?php foreach ($teacher_programs as $T) {
$categories = $this->Employer_model->get_categories($T["ID"]);
 ?>
        
        <!-- SECTION POUR EMPLOYEURS ACTIFS -->
        <div class="panel panel-primary">
            
            <div class="panel-heading">
                <div class="panel-heading-with-add"> 
                <h3 class="panel-title"><?= $T['NAME']; ?></h3>

                    <a href="<?php echo site_url('employer/catadd/'.$T["ID"]); ?>"  class="btn btn-success btn-xs">
          		        <span class="glyphicon glyphicon-plus"></span>
        	        </a>

            </div>
           </div>
            <!-- /.box-header -->
            <div class="panel-body cell-border table-responsive ">
              <table class="table table-hover cat-table">
                <thead>
                    <tr>
                        <th>CATÉGORIE</th>
					    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as &$C ): ?>
                            <tr>
                  	            <td><?php echo $C['NAME'];?></td>
        						<td>
                                    <a href="<?php echo site_url('employer/catedit/'.$C['ID']); ?>" class="btn btn-info btn-xs"><i class="fas fa-pencil-alt"></i></a> 
                                </td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.box-body -->
        </div>


       
        <?php } ?>
    </div>
    
    </div>
</div>
</div>


