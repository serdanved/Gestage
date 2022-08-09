<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Document Types Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('document_type/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>PRIVATE</th>
						<th>PUBLIC</th>
						<th>DESCRIPTION</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($document_types as $D){ ?>
                    <tr>
						<td><?php echo $D['ID']; ?></td>
						<td><?php echo $D['PRIVATE']; ?></td>
						<td><?php echo $D['PUBLIC']; ?></td>
						<td><?php echo $D['DESCRIPTION']; ?></td>
						<td>
                            <a href="<?php echo site_url('document_type/edit/'.$D['ID']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('document_type/remove/'.$D['ID']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
