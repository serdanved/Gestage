
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
                <button class="btn_collapsed" style="background:transparent !important;border:unset !important;position: inherit; top: unset; right:unset;" data-toggle="collapse" aria-controls="collapse-obligations" aria-expanded="true" href='#collapse-obligations' style="position:relative !important;"><i class="fa fa-minus"></i> VOS OBLIGATIONS</button>
            </div>

            <div class="panel-body">
                <div id="collapse-obligations" class="panel-collapse collapse in">
                <table class="table table-striped">
                    <thead>
                        <tr>
    						<th>DATE</th>
    						<th>NOM DU DOCUMENT</th>
    						<th>ACTIONS</th>
    						<th>OUVRIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($all_your_obligations as $AO){ ?>
                        <tr>
                        	<td><?php echo $AO["ID"]." - ".$AO['DATE']; ?></td>
    						<td><?php echo get_document_name($AO['DOCUMENT_ID']); ?></td>

    						<?php 
                                if(get_document_filename($AO['DOCUMENT_ID']) != ""){
                                    if ($AO['STATUS'] == '0') { echo "<td><a href=\"javascript:blitz_js_db_update('OBLIGATIONS','".$AO['ID']."','ID','STATUS','1',false,true,false)\"   class=\"btn btn-app\"><i class=\"fa fa-check-square\"></i>ACCEPTER</a></td>"; }
    							    if (($AO['STATUS'] == '1')&& ($AO['SIGNATURE'] == '0')) { echo "<td><a href=\"javascript:blitz_js_db_update('OBLIGATIONS','".$AO['ID']."','ID','STATUS','2',false,true,false)\"   class=\"btn btn-app\"><i class=\"fa fa-share-square\"></i>TERMINER</a></td>"; }
                                    if (($AO['STATUS'] == '1') && ($AO['SIGNATURE'] == '1')) { echo "<td><button  data-obligation-id=\"" . $AO['ID']. "\"  data-document-id=\"" . $AO['DOCUMENT_ID']. "\" data-toggle=\"modal\" data-target=\"#signatureModal\"  class=\"btn btn-app\"><i class=\"fa fa-share-square\"></i>SIGNATURE</button></td>"; }

                                    if ($AO['STATUS'] == '2') { echo "<td></td>"; }


    							    if ($AO['STATUS'] !== '0') { echo "<td><a target=\"_blank\"  class=\"btn btn-app\" href=\"/resources/uploads/" . $AO['INTERNSHIP_ID'] . "/" . get_document_filename($AO['DOCUMENT_ID'])."?key=" . generateRandomString() ."\" ><i class=\"fa fa-bullhorn\"></i>OUVRIR</a></td>"; }
    						        if ($AO['STATUS'] == '0') { echo "<td></td>"; }

                                }
                                else{
                                    if ($AO['STATUS'] == '0') { echo "<td><a href=\"javascript:blitz_js_db_update('OBLIGATIONS','".$AO['ID']."','ID','STATUS','1',false,true,false)\"   class=\"btn btn-app\"><i class=\"fa fa-check-square\"></i>ACCEPTER</a></td>"; }
    							    if (($AO['STATUS'] == '1')&& ($AO['SIGNATURE'] == '0')) { echo "<td><a href=\"/form/render/" . get_document_form_id($AO['DOCUMENT_ID']) . "/".$AO['ID']."\" class=\"btn btn-app\"><i class=\"fa fa-share-square\"></i>FORMULAIRE</a></td>"; }

                                    if (($AO['STATUS'] == '1') && ($AO['SIGNATURE'] == '1')) { echo "<td><a href=\"/form/render/" . get_document_form_id($AO['DOCUMENT_ID']) . "/".$AO['ID']."\" class=\"btn btn-app\"><i class=\"fa fa-share-square\"></i>FORMULAIRE</a><button data-obligation-id=\"" . $AO['ID']. "\"  data-document-id=\"" . $AO['DOCUMENT_ID']. "\" data-toggle=\"modal\" data-target=\"#signatureFormModal\"  class=\"btn btn-app\"><i class=\"fa fa-share-square\"></i>SIGNATURE</button></td>"; }

                                    if ($AO['STATUS'] == '2') { echo "<td></td>"; }


    							    if ($AO['STATUS'] !== '0') { echo "<td><a target='_blank' href=\"/form/view/" . get_document_form_id($AO['DOCUMENT_ID']) . "/".$AO['ID']."\" class=\"btn btn-app\"><i class=\"fa fa-bullhorn\"></i>OUVRIR</a></td>"; }
    						        if ($AO['STATUS'] == '0') { echo "<td></td>"; }
                                }

    						?>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>                     
            </div>         
            
            
            <!-- FOOTER SECTION OF "DOCUMENTS DU STAGE" -->			
			<div class="box-footer"></div>
		</div>
