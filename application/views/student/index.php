<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Liste des élèves</h3>
                <a href="<?= site_url("/student/add") ?>" class="btn btn-success btn-xs pull-right">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
            <div class="box-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">ÉLÈVES ACTIFS</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped teachers-datatable" data-sortable data-state-save="true" id="activeStudents">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOM</th>
                                <th>COURRIEL</th>
                                <th>ÉCOLE</th>
                                <th>PROGRAMME</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($students as $S){ ?>
                            <tr>
                                <td><?php echo $S['ID']; ?></td>
                                <td><?php echo $S['NAME']; ?></td>
                                <td><?php echo $S['EMAIL_CS']; ?></td>
                                <td><?php echo $S['SCHOOL']; ?></td>
                                <td><?php echo $S['PROGRAM_NAME']; ?></td>
                                <td>
                                    <a href="<?= site_url('student/archive_student/'.$S['ID']) ?>" class="btn btn-danger btn-xs"
                                        onclick="return confirm('Êtes-vous sûr de voulloir faire cela?')">
                                        <span class="fa fa-trash"></span> Désactiver
                                    </a>
                                    <a href="<?= site_url('student/edit/' . $S['ID']) ?>" class="btn btn-info btn-xs">
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
                        <h3 class="panel-title">ÉLÈVES INACTIFS</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped teachers-datatable" data-sortable data-state-save="true" id="inactiveStudents">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOM</th>
                                <th>COURRIEL</th>
                                <th>ÉCOLE</th>
                                <th>PROGRAMME</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($archived_students as $S){ ?>
                            <tr>
                                <td><?php echo $S['ID']; ?></td>
                                <td><?php echo $S['NAME']; ?></td>
                                <td><?php echo $S['EMAIL_CS']; ?></td>
                                <td><?php echo $S['SCHOOL']; ?></td>
                                <td><?php echo $S['PROGRAM_NAME']; ?></td>
                                <td>
                                    <a href="<?= site_url('student/unarchive_student/'.$S['ID']) ?>" class="btn btn-success btn-xs"
                                        onclick="return confirm('Êtes-vous sûr de voulloir faire cela?')">
                                        <span class="fa fa-arrow-up"></span> Réactiver
                                    </a>
                                    <a href="<?= site_url('student/edit/' . $S['ID']) ?>" class="btn btn-info btn-xs">
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
