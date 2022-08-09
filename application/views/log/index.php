<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Logs Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('log/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>INTERNSHIP ID</th>
						<th>DATE</th>
						<th>DESCRIPTION</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($logs as $L){ ?>
                    <tr>
						<td><?php echo $L['ID']; ?></td>
						<td><?php echo $L['INTERNSHIP_ID']; ?></td>
						<td><?php echo $L['DATE']; ?></td>
						<td><?php echo $L['DESCRIPTION']; ?></td>
						<td>
                            <a href="<?php echo site_url('log/edit/'.$L['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('log/remove/'.$L['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
