<section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Nouveau message</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Dossiers</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Boîte de réception
                  <span class="label label-primary pull-right">12</span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Envoyés
                <span class="label label-primary pull-right">12</span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Brouillons
                <span class="label label-primary pull-right">12</span></a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Spams <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Poubelle
                <span class="label label-primary pull-right">12</span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <!--<div class="box box-solid">-->
          <!--  <div class="box-header with-border">-->
          <!--    <h3 class="box-title">Étiquettes</h3>-->

          <!--    <div class="box-tools">-->
          <!--      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
          <!--      </button>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--  <div class="box-body no-padding">-->
          <!--    <ul class="nav nav-pills nav-stacked">-->
          <!--      <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>-->
          <!--      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>-->
          <!--      <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>-->
          <!--    </ul>-->
          <!--  </div>-->
            <!-- /.box-body -->
          <!--</div>-->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Boîte de réception</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Rechercher">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <thead>
                        <td></td>
                        <td><strong>De</strong></td>
                        <td><strong>Message</strong></td>
                        <td><strong>Date</strong></td>
                    </thead>
                  <tbody>
                    <?php foreach($messages as $message): ?>
                  <tr>
                    <td>
                        <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="checkbox" style="position: absolute; opacity: 0;">
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                    </td>
                    
                    <td class="mailbox-name"><a href="read-mail.html"><?= get_sender_name($message['FROM_ID'], $message['FROM_TYPE']); ?></a></td>
                    <td class="mailbox-subject"><b><?= $message['TITLE']; ?></b> - <?= $message['DESCRIPTION']; ?></td>
                    <td class="mailbox-date"><?= time_elapsed_string($message['DATE']); ?></td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>