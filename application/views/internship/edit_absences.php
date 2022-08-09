      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
                <div class="panel-heading-with-add">
              	    <h3 class="panel-title">ABSENCES</h3>
            	</div>
            </div>

            <!-- BODY SECTION OF "INFORMATION DU STAGE" -->
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>RAISON</th>
                            <th>DATE REPORTÉ</th>
                            <th>INSCRIT PAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($all_block_schedules as $ABS){ ?>
                        <?php if((!isset($ABS["VALUE"]->PRESENT)) && (!isset($ABS["VALUE"]->CLOSED))) : ?>
                        <tr>
                            <td><?php echo date_in_french($ABS["VALUE"]->DATE); ?></td>
                            <td><?php echo $ABS["VALUE"]->REASON;?></td>
                            <td><?php echo date_in_french($ABS["VALUE"]->REASON_REPORT_DATE); ?></td>
                            <td><?php echo get_user_fullname_by_id_and_type($ABS["VALUE"]->REASON_BY_ID,$ABS["VALUE"]->REASON_BY_TYPE); ?></td>

                        </tr>
                        <?php endif; ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- FOOTER SECTION OF "INFORMATION DU STAGE" -->
			<div class="box-footer"></div>
		</div>