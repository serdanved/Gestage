<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTE DE TOUS LES EMPLOYEURS</h3>
            </div>
            <div class="box-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">EMPLOYEURS ASSIGNÉS</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped teachers-datatable" data-sortable>
                    <thead>
                    <tr>
                        <th>EMPLOYEUR</th>
                        <th>CONTACT</th>
						<th>PROGRAMME(S)</th>
						<th>COURRIEL</th>
						<th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($assigned_employers as $T): ?>
                        <tr>
    						<td><?php echo $T['EMPLOYER_NAME']; ?></td>
    						<td><?php echo $T['CONTACT_NAME']; ?></td>
    						<td><?php echo $T['PROGRAM_NAMES']; ?></td>
    						<td><?php echo $T['EMAIL']; ?></td>
    						<td>
                                <a href="<?php echo site_url('employer/edit_programs/'.$T['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modifier</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">EMPLOYEURS NON-ASSIGNÉS</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped teachers-datatable" data-sortable>
                    <thead>
                    <tr>
						<th>EMPLOYEUR</th>
						<th>CONTACT</th>
						<th>COURRIEL</th>
						<th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($unassigned_employers as $T): ?>
                        <tr>
    						<td><?php echo $T['EMPLOYER_NAME']; ?></td>
    						<td><?php echo $T['CONTACT_NAME']; ?></td>
    						<td><?php echo $T['EMAIL']; ?></td>
    						<td>
                                <a href="<?php echo site_url('employer/edit_programs/'.$T['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Modifier</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>