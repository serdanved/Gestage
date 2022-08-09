<div class="row">
    <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">LISTE DES FORMULAIRES PAR PROGRAMME</h3>
            <?php if (is_teacher()): ?>
                    <a href="<?php echo site_url('form/add'); ?>" style="float:right;" class="btn btn-success btn-xs">
          		        <span class="glyphicon glyphicon-plus"></span>
        	        </a>
            <?php endif; ?> 
        </div>
         <div class="box-body">
             

        <?php foreach($all_programs as $P){ ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $P['NAME']; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive"> 
                <table class="table table-striped" data-sortable>
                    <thead class="cf">
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($forms as $L){ ?>
                    <?php if($P['ID'] == $L["PROGRAM_ID"]) { ?>
                    <tr>
						<td><?php echo $L['ID']; ?></td>
						<td><?php echo $L['NAME']; ?></td>

						<td>
                            <a href="<?php echo site_url('form/edit/'.$L['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modifier</a> 
                            <a href="<?php echo site_url('form/generate/'.$L['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-eye"></span> Générer</a>

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
                <h3 class="panel-title"><?php echo "Général"; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive"> 
                <table class="table table-striped" data-sortable>
                    <thead class="cf">
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($forms as $L){ ?>
                    <?php if($L["PROGRAM_ID"] == 0) { ?>
                    <tr>
						<td><?php echo $L['ID']; ?></td>
						<td><?php echo $L['NAME']; ?></td>

						<td>
                            <a href="<?php echo site_url('form/edit/'.$L['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Éditer</a> 
                            <a href="<?php echo site_url('form/generate/'.$L['ID']); ?>" class="btn btn-success btn-xs"><span class="fa fa-eye"></span> Générer</a>

                        </td>
                    </tr>
                        <?php } ?>
                    <?php } ?>
                        </tbody>
                </table>
                    </div>
            </div>
        </div>

        
        
        