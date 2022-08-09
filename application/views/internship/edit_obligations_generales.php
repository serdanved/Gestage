
  	<div class="panel panel-primary">
        <div class="panel-heading with-border">
            <button class="btn_collapsed" style="background:transparent !important;border:unset !important;position: inherit; top: unset; right:unset;"  data-toggle="collapse" aria-controls="collapse-obligations-generales" aria-expanded="true" href='#collapse-obligations-generales' style="position:relative !important;"><i class="fa fa-minus"></i> OBLIGATIONS GÉNÉRALES</button>

        </div>

		<div class="panel-body">
            <div id="collapse-obligations-generales" class="panel-collapse collapse in">
            <table class="table table-striped">
                <thead>
                    <tr>
						<th>UTILISATEUR</th>
						<th>DATE</th>
						<th>NOM DU DOCUMENT</th>
						<th>STATUT</th>
						<th>OUVRIR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($all_obligations as $AO){ ?>
                    <tr>
						<td><?php echo get_user_fullname_by_id_and_type($AO['USER_ID'], $AO['USER_TYPE']); ?></td>
						<td><?php echo $AO['DATE']; ?></td>
						<td><?php echo get_document_name($AO['DOCUMENT_ID']); ?></td>
						<?php 
							if ($AO['STATUS']==0) { echo "<td>PAS ENCORE ACCEPTÉ</td>"; }
							if ($AO['STATUS']==1) { echo "<td>ACCEPTÉ MAIS NON REMPLI</td>"; }
							if ($AO['STATUS']==2) { echo "<td>OBLIGATION REMPLIE</td>"; }
						?>
						<td>
                            
                             <?php if(get_document_filename($AO['DOCUMENT_ID']) != ""):?>
						    <a target="_blank" href="/resources/uploads/<?php echo $AO['INTERNSHIP_ID']; echo "/" . get_document_filename($AO['DOCUMENT_ID']); ?>" class="btn btn-app"><i class="fa fa-bullhorn"></i>OUVRIR</a>
						    <?php endif;?>
                            <?php if(get_document_filename($AO['DOCUMENT_ID']) == ""):?>
						     <?php echo "<a target='_blank' href=\"/form/view/" . get_document_form_id($AO['DOCUMENT_ID']) . "/".$AO['ID']."\" class=\"btn btn-app\"><i class=\"fa fa-bullhorn\"></i>OUVRIR</a>"; ?>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        
        </div>                    
        </div> 

        <!-- FOOTER SECTION OF "DOCUMENTS DU STAGE" -->			
		<div class="box-footer"></div>
	</div>
