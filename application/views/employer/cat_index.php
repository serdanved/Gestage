<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">LISTE DES CATEGORIES D'EMPLOYEUR</h3>
                <?php if (is_teacher() || is_admin()) { ?>
                    <a href="<?= site_url('employer/catadd') ?>" class="btn btn-success btn-xs pull-right">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                <?php } ?>
			</div>

			<div class="box-body">
                <table class="table table-hover cat-table">
                    <thead>
                    <tr>
                        <th>CATÉGORIE</th>
                        <th>PROGRAMME</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cats as $C) { ?>
                        <tr>
                            <td><?= $C['NAME'] ?></td>
                            <td><?= $this->Program_model->get_program_name_by_id($C["PROGRAM_ID"])["NAME"] ?></td>
                            <td>
                                <a href="<?= site_url('employer/catedit/' . $C['ID']) ?>" class="btn btn-info btn-xs">
                                    <i class="fas fa-pencil-alt"></i>
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
