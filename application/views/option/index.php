<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Liste des options</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('option/add'); ?>" class="btn btn-success btn-sm">Ajouter</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" data-sortable>
                    <thead>
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>CONTENU</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <?php foreach($options as $O) { ?>
                    <tr>
						<td><?php echo $O['ID']; ?></td>
						<td><?php echo $O['NAME']; ?></td>
						<td><?php echo $O['VALUE']; ?></td>
						<td>
                            <a href="<?php echo site_url('option/edit/'.$O['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modifier</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
