<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Liste des obligations</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('obligation/add'); ?>" class="btn btn-success btn-sm">Ajouter</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
						<th>ID</th>
						<th>INTERNSHIP ID</th>
						<th>DOCUMENT ID</th>
						<th>DATE</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <?php foreach($obligations as $O){ ?>
                    <tr>
						<td><?php echo $O['ID']; ?></td>
						<td><?php echo $O['INTERNSHIP_ID']; ?></td>
						<td><?php echo $O['DOCUMENT_ID']; ?></td>
						<td><?php echo $O['DATE']; ?></td>
						<td>
                            <a href="<?php echo site_url('obligation/edit/'.$O['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modifier</a> 
                            <a href="<?php echo site_url('obligation/remove/'.$O['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Supprimer</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
