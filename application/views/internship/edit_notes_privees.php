<!-- NOTES PRIVÉES -->    
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
                <div class="panel-heading-with-add">
                	<h3 class="panel-title">NOTES PRIVÉES</h3>
                  	<button style="float:right;" data-toggle="modal" data-target="#PrivateNoteModal" class="btn btn-success btn-xs">
                  		<span class="glyphicon glyphicon-plus"></span>
                	</button>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
    						<th>PAR</th>
    						<th>DATE</th>
    						<th>NOTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($all_private_notes as $NP){ ?>
                        <tr>
    						<td><?php echo get_notes_user_name($NP['CREATOR_ID'], $NP['CREATOR_TYPE']); ?></td>
    						<td><?php echo $NP['DATE']; ?></td>
    						<td><?php echo $NP['DESCRIPTION']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div> 
        
			<div class="box-footer"></div>
		</div>
 <!-- FIN NOTES PRIVÉES -->   