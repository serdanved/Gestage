<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Messages Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('message/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>INTERNSHIP ID</th>
						<th>TO TYPE</th>
						<th>FROM TYPE</th>
						<th>TO ID</th>
						<th>FROM ID</th>
						<th>DESCRIPTION</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($messages as $M){ ?>
                    <tr>
						<td><?php echo $M['ID']; ?></td>
						<td><?php echo $M['INTERNSHIP_ID']; ?></td>
						<td><?php echo $M['TO_TYPE']; ?></td>
						<td><?php echo $M['FROM_TYPE']; ?></td>
						<td><?php echo $M['TO_ID']; ?></td>
						<td><?php echo $M['FROM_ID']; ?></td>
						<td><?php echo $M['DESCRIPTION']; ?></td>
						<td>
                            <a href="<?php echo site_url('message/edit/'.$M['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('message/remove/'.$M['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
