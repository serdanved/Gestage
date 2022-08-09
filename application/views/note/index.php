<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Notes Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('note/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>INTERNSHIP ID</th>
						<th>CREATOR TYPE</th>
						<th>CREATOR ID</th>
						<th>DESCRIPTION</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($notes as $N){ ?>
                    <tr>
						<td><?php echo $N['ID']; ?></td>
						<td><?php echo $N['INTERNSHIP_ID']; ?></td>
						<td><?php echo $N['CREATOR_TYPE']; ?></td>
						<td><?php echo $N['CREATOR_ID']; ?></td>
						<td><?php echo $N['DESCRIPTION']; ?></td>
						<td>
                            <a href="<?php echo site_url('note/edit/'.$N['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('note/remove/'.$N['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
