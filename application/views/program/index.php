<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-with-add">
                    <h3 class="panel-title">Liste des programmes</h3>
                    <a href="<?= site_url("/program/add") ?>" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" data-sortable>
                    <thead>
                    <tr>
						<th>ID</th>
						<th>NOMS</th>
                        <th>PAVILION</th>
						<th>ACTIONS</th>
                    </tr>
                    </thead>
                    <?php foreach($programs as $P){ ?>
                    <tr>
						<td><?php echo $P['ID']; ?></td>
						<td><?php echo $P['NAME']; ?></td>
                        <td><?php echo $P['PAVILION']; ?></td>
						<td>
                            <a href="<?php echo site_url('program/edit/'.$P['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modifier</a>
                            <!-- <a href="<?php echo site_url('program/remove/'.$P['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Supprimer</a> -->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
