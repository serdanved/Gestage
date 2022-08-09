<!-- START SECTION OF "MESSAGERIE" -->    
    <div class="panel panel-primary">
        <div class="panel-heading with-border">

            <button class="btn_collapsed" style="background:unset !important;border:unset !important;position: inherit; top: unset; right:unset;"  data-toggle="collapse" aria-controls="collapse-messagerie" aria-expanded="true" href='#collapse-messagerie' style="position:relative !important;"><i class="fa fa-minus"></i> MESSAGERIE</button>

            <!--
            <select data-minimum-results-for-search="-1" id="message-filter-select" class="form-control" title="Choisir un statut" style="width:200px;display:inline-block;">
                <option value="0">REÇU</option>
                <option value="1">ENVOYÉ</option>
                <option value="2">SUPPRIMÉ</option>
            </select>
            -->
        </div>
        <!-- /.box-header -->
        <div class="panel-body ">
            <div id="collapse-messagerie" class="panel-collapse collapse in">
            <form id="message_list_form" accept-charset="utf-8">
            <div class="mailbox-controls">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-action-type="new" data-current-value="{'USER_ID':'<?php echo $this->session->userdata('userid');?>','USER_TYPE':'<?php echo $this->session->userdata('status_id');?>'}" data-from-name="<?php echo $this->session->userdata('name'); ?>" data-target="#MessageSendModal"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-action-type="reply" data-from-name="<?php echo $this->session->userdata('name'); ?>" data-target="#MessageSendModal"><i class="fas fa-reply"></i></button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-action-type="forward" data-from-name="<?php echo $this->session->userdata('name'); ?>" data-target="#MessageSendModal"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-
                
                
                group -->
                
                 <div class="btn-group" style="float:right;">
                    <button  type="button" id="inbox-refresh" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                    <button type="button" id="inbox-delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </div>
               
            <!-- /.pull-right -->
            </div>
            <div class="table-responsive mailbox-messages">
            
            <table id="messages-datatable" class="table table-hover table-striped messages-datatable">
                <thead>
                    <tr>
                        <td class="col-md-1"></td>
                        <td class="col-md-3">DE</td>
                        <td class="col-md-5">SUJET</td>
                        <td class="col-md-3">REÇU</td>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach($all_messages as $message): ?>

                    
                    <tr>
                        <td><input type="checkbox" data-message-id="<?php echo $message['ID']?>" data-from-date="<?php echo $message['DATE']?>" data-from-content='<?php echo $message['DESCRIPTION']?>' data-from-type="<?php echo $message['FROM_TYPE']?>" data-from-id="<?php echo $message['FROM_ID']?>" data-from-subject="<?php echo $message['TITLE']?>" data-from-name="<?php echo $message['FROM_NAME']; ?>"></td>
                        
                        <td class="mailbox-name"><a href=""   data-current-value="{'USER_ID':'<?php echo $this->session->userdata('userid');?>','USER_TYPE':'<?php echo $this->session->userdata('status_id');?>'}" data-current-name="<?php echo $this->session->userdata('name'); ?>" data-toggle="modal" data-action-type="read"  data-from-date="<?php echo $message['DATE']?>" data-from-message-td="mailbox-subject-<?php echo $message['ID']?>" data-from-message-id="<?php echo $message['ID']?>" data-from-content='<?php echo $message['DESCRIPTION']?>' data-from-subject="<?php echo $message['TITLE']?>" data-from-type="<?php echo $message['FROM_TYPE']?>" data-from-id="<?php echo $message['FROM_ID']?>" data-from-name="<?php echo $message['FROM_NAME']; ?>" data-target="#MessageSendModal"><?= $message['FROM_NAME'];?> 
                        <?php
                        if ($message['FROM_TYPE']==1) { echo "<b>[ÉLÈVE]</b>"; }
                        if ($message['FROM_TYPE']==2) { echo "<b>[ENSEIGNANT]</b>"; }
                        if ($message['FROM_TYPE']==3) { echo "<b>[EMPLOYEUR]</b>"; }
                        
                        ?></a></td>
                        <td id="mailbox-subject-<?php echo $message['ID'] ?>" class="mailbox-subject"><?php
                            if ($message['READ'] == 0) { echo "<b>".$message['TITLE']."</b>";}
                            if ($message['READ'] == 1) { echo $message['TITLE']; }
                        ?>- <?= substr(strip_tags($message['DESCRIPTION']),0,50);?>...</td>
                        <td class="mailbox-date"><?= $message['DATE'];?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!-- /.table -->
            </div>

        <!-- /.mail-box-messages -->
        </form>
        </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
            <div class="mailbox-controls"></div>
        </div>
    </div>
<!-- /. box -->

