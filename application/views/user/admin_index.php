<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Liste des Administrateurs</h3>
                <a href="<?= site_url("/user/admin_add") ?>" class="btn btn-success btn-xs pull-right">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
            <div class="box-body">
                <table class="table table-striped" data-sortable>
                    <thead>
                    <tr>
						<th>ID</th>
						<th>NOM</th>
						<th>COURRIEL</th>
						<th>ACTIONS</th>
                    </tr>
                    </thead>
                    <?php foreach($users as $U) { ?>
                    <tr>
						<td><?= $U['ID'] ?></td>
						<td><?= $U['NAME'] ?></td>
						<td><?= $U['EMAIL'] ?></td>
						<td>
                            <?php if ($U["ID"] != $this->session->userid) { ?>
                            <a href="<?= site_url('user/admin_delete/'.$U['ID']) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Êtes-vous sûr de voulloir faire cela?')">
                                <span class="fa fa-trash"></span> Supprimer
                            </a>
                            <?php } ?>
                            <a href="<?= site_url('user/admin_edit/'.$U['ID']) ?>" class="btn btn-info btn-xs">
                                <span class="fa fa-edit"></span> Modifier
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
