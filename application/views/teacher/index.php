<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Liste des enseignants</h3>
                <a href="<?= site_url("/teacher/add") ?>" class="btn btn-success btn-xs pull-right">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
            <div class="box-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">ENSEIGNANTS ACTIFS</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped teachers-datatable" data-sortable data-state-save="true" id="activeTeachers">
                            <thead>
                            <tr>
                                <th>NOM</th>
                                <th>PROGRAMME(S)</th>
                                <th>COURRIEL</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($activeTeachers as $T) { ?>
                                <tr>
                                    <td><?= $T['NAME'] ?></td>
                                    <td><?= $T['PROGRAM_NAMES'] ?></td>
                                    <td><?= $T['EMAIL_CS'] ?></td>
                                    <td>
                                        <a href="<?= site_url("teacher/login_as/{$T["ID"]}") ?>" class="btn btn-warning btn-xs">
                                            <i class="fa fa-door-open"></i>
                                        </a>
                                        <a href="<?= site_url('teacher/archive_teacher/'.$T['ID']) ?>" class="btn btn-danger btn-xs"
                                            onclick="return confirm('Êtes-vous sûr de voulloir faire cela?')">
                                            <span class="fa fa-trash"></span> Désactiver
                                        </a>
                                        <a href="<?= site_url('teacher/edit/'.$T['ID']) ?>" class="btn btn-info btn-xs">
                                            <span class="fa fa-edit"></span> Modifier
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">ENSEIGNANTS INACTIFS</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped teachers-datatable" data-sortable data-state-save="true" id="inactiveTeachers">
                            <thead>
                            <tr>
                                <th>NOM</th>
                                <th>COURRIEL</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($inactiveTeachers as $T) { ?>
                                <tr>
                                    <td><?= $T['NAME'] ?></td>
                                    <td><?= $T['EMAIL_CS'] ?></td>
                                    <td>
                                        <a href="<?= site_url('teacher/unarchive_teacher/'.$T['ID']) ?>" class="btn btn-success btn-xs"
                                            onclick="if (!confirm('Êtes-vous sûr de voulloir faire cela?')) event.preventDefault()">
                                            <span class="fa fa-arrow-up"></span> Réactiver
                                        </a>
                                        <a href="<?= site_url('teacher/edit/'.$T['ID']) ?>" class="btn btn-info btn-xs">
                                            <span class="fa fa-edit"></span> Modifier
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>