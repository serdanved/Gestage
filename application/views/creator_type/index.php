<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Liste des types de créateurs</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('creator_type/add'); ?>" class="btn btn-success btn-sm">Ajouter</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" data-sortable>
                    <thead>
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <?php foreach($creator_types as $C){ ?>
                    <tr>
						<td><?php echo $C['ID']; ?></td>
						<td><?php echo $C['NAME']; ?></td>
						<td>
                            <a href="<?php echo site_url('creator_type/edit/'.$C['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modifier</a> 
                            <a href="<?php echo site_url('creator_type/remove/'.$C['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Supprimer</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
