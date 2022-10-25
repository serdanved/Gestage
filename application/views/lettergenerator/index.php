<div class="row">
    <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">LISTE DES LETTRES PAR PROGRAMME</h3>
        </div>
         <div class="box-body">


        <?php foreach($all_programs as $P){ ?>
        <div class="panel panel-primary">
            <div style="overflow:hidden;" class="panel-heading">
                <h3 class="panel-title pull-left"><?php echo $P['NAME']; ?></h3>
                <?php if (is_teacher()): ?>
                    <a href="<?php echo site_url('lettergenerator/add'); ?>" style="float:right;" class="btn btn-success btn-xs">
          		        <span class="glyphicon glyphicon-plus"></span>
        	        </a>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-striped" data-sortable>
                    <thead class="cf">
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>DESCRIPTION</th>
						<th>FAVORIS</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($letters as $L){ ?>
                    <?php if($P['ID'] == $L["PROGRAM_ID"]) { ?>
                    <tr>
						<td><?php echo $L['ID']; ?></td>
						<td><?php echo $L['NAME']; ?></td>
						<td><?php echo $L['DESC']; ?></td>
						<?php
						    if ($L['FAVORITE'] == "0") {
						        echo "<td><a class=\"btn btn-app\" href=\"javascript:blitz_js_db_update('LETTERS','".$L['ID']."','ID','FAVORITE','1',false,true);\"><i style='font-size:x-large' class='fas fa-heart'></i></a></td>";
                            }
		                    if ($L['FAVORITE'] == "1") {
						        echo "<td><a class=\"btn btn-app\" style='color:red' href=\"javascript:blitz_js_db_update('LETTERS','".$L['ID']."','ID','FAVORITE','0',false,true);\"><i class=\"fa fa-star\"></i></a></td>";
                            }
                        ?>
						<td>
                            <?php if ($this->session->userdata("mail")=="manon.larouche@cslsj.qc.ca") { ?>
                            <a href="<?php echo site_url('lettergenerator/edit/'.$L['ID']); ?>" class="btn btn-info btn-xs"><span class="fas fa-pencil-alt"></span> Éditer</a>
                            <?php } ?>
                            <a href="<?php echo site_url('lettergenerator/generate/'.$L['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-eye"></span> Générer</a>
                            <?php if ($this->session->userdata("mail")=="manon.larouche@cslsj.qc.ca") { ?>
                            <a href="<?php echo site_url('lettergenerator/remove/'.$L['ID']); ?>" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="top" data-title="Supprimer définitivement du système?" data-original-title="" title=""><span class="fa fa-trash"></span> Supprimer</a>
                            <?php } ?>
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
            <div style="overflow:hidden;" class="panel-heading">
                <h3 class="pull-left panel-title"><?php echo "Général"; ?></h3>
                <?php if (is_teacher()): ?>
                    <a href="<?php echo site_url('lettergenerator/add'); ?>" style="float:right;" class="btn btn-success btn-xs">
          		        <span class="glyphicon glyphicon-plus"></span>
        	        </a>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-striped" data-sortable>
                    <thead class="cf">
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>DESCRIPTION</th>
						<th>FAVORIS</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($letters as $L){ ?>
                    <?php if($L["PROGRAM_ID"] == 0) { ?>
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
                            <?php if ($this->session->userdata("mail")=="manon.larouche@cslsj.qc.ca") { ?>
                            <a href="<?php echo site_url('lettergenerator/edit/'.$L['ID']); ?>" class="btn btn-info btn-xs"><span class="fas fa-pencil-alt"></span> Éditer</a>
                            <?php } ?>
                            <a href="<?php echo site_url('lettergenerator/generate/'.$L['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-eye"></span> Générer</a>
                            <?php if ($this->session->userdata("mail")=="manon.larouche@cslsj.qc.ca") { ?>
                            <a href="<?php echo site_url('lettergenerator/remove/'.$L['ID']); ?>" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="top" data-title="Supprimé définitivement du système?" data-original-title="" title=""><span class="fa fa-trash"></span> Supprimer</a>
                            <?php } ?>
                        </td>
                    </tr>
                        <?php } ?>
                    <?php } ?>
                        </tbody>
                </table>
                    </div>
            </div>
        </div>




