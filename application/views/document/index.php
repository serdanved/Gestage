<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Documents Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('document/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>TYPE ID</th>
						<th>INTERNSHIP ID</th>
						<th>NAME</th>
						<th>FILENAME</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($documents as $D){ ?>
                    <tr>
						<td><?php echo $D['ID']; ?></td>
						<td><?php echo $D['TYPE_ID']; ?></td>
						<td><?php echo $D['INTERNSHIP_ID']; ?></td>
						<td><?php echo $D['NAME']; ?></td>
						<td><?php echo $D['FILENAME']; ?></td>
						<td>
                            <a href="<?php echo site_url('document/edit/'.$D['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('document/remove/'.$D['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
