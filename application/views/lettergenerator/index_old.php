<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            
            
             <div class="panel-heading">
                <div class="panel-heading-with-add"> 
                <h3 class="panel-title">LISTE DES GÉNÉRATEURS DE LETTRES</h3>
                <?php if (is_teacher()): ?>
                    <a href="<?php echo site_url('lettergenerator/add'); ?>" style="float:right;" class="btn btn-success btn-xs">
          		        <span class="glyphicon glyphicon-plus"></span>
        	        </a>
                <?php endif; ?> 
            </div>
           </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>DESCRIPTION</th>
						<th>FAVORIS</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($letters as $L){ ?>
                    <tr>
						<td><?php echo $L['ID']; ?></td>
						<td><?php echo $L['NAME']; ?></td>
						<td><?php echo $L['DESC']; ?></td>
						<?php
						    if ($L['FAVORITE'] == "0") {
						        echo "<td><a class=\"btn btn-app\" href=\"javascript:blitz_js_db_update('LETTERS','".$L['ID']."','ID','FAVORITE','1',false,true);\"><i class=\"fa fa-heart-o\"></i></a></td>";
                            }
		                    if ($L['FAVORITE'] == "1") {
						        echo "<td><a class=\"btn btn-app\" style='color:red' href=\"javascript:blitz_js_db_update('LETTERS','".$L['ID']."','ID','FAVORITE','0',false,true);\"><i class=\"fa fa-star\"></i></a></td>";
                            }                            
                        ?>
						<td>
                            <a href="<?php echo site_url('lettergenerator/edit/'.$L['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Éditer</a> 
                            <a href="<?php echo site_url('lettergenerator/generate/'.$L['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-eye"></span> Générer</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
