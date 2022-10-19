
<style>
table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,th {
    border: 1px solid #ddd;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}
th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #328fad;
    color: white;
}
</style>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">




<div class="row" style="text-align:center">
    <img  style="max-width:200px" src="<?= site_url("/resources/img/logo_gestage.png") ?>">


    <?php //var_dump($internships) ;?>
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header">
                <hr>
                <h3 class="box-title">PRÉSENCES
                <?php
                $hour_left =  intval($block["TOTAL_HOURS"]) - intval($block["SCHEDULE_TOTAL_HOURS"]);
                echo " POUR " . mb_strtoupper(get_student_name_by_id($internship["STUDENT_ID"]));
                echo " <br>" . mb_strtoupper(date_in_french($block["DATE_START"]));
                echo " - " . mb_strtoupper(date_in_french($block["DATE_END"]));
                echo "<br><br> NOMBRE D'HEURES À FAIRE : " . $block["SCHEDULE_TOTAL_HOURS"];
                echo "<br> NOMBRE D'HEURES ATTRIBUÉES AU STAGE : " . $block["TOTAL_HOURS"];
                //echo " <br><br> STAGE #" . $internship["ID"] . " | ". strtoupper($block["NAME"]) . " | " . $block["TOTAL_HOURS"] . " | " . $block["SCHEDULE_TOTAL_HOURS"];
                echo " <br><br> STAGE #" . $internship["ID"] . " | ". mb_strtoupper($block["NAME"]);?>


                </h3>

            </div>

            <div class="box-body">








        <!-- SECTION POUR EMPLOYEURS ACTIFS -->
        <div style="margin-bottom:50px;" class="panel panel-primary">


            <!-- /.box-header -->
            <div class="panel-body cell-border table-responsive ">
              <table class="table table-hover absences-datatable">
                <thead>
                    <tr>
                        <th class="col-md-2 text-center">DATE</th>
                        <th class="col-md-1">PRÉSENT</th>
                        <th class="col-md-1">RAISON</th>
                        <th class="col-md-1">DE</th>
                        <th class="col-md-1">À</th>
					    <th class="col-md-1">DE</th>
					    <th class="col-md-1">À</th>
                        <th class="th-evening" style="display:<?php echo ($evening == 1 ? 'table-cell' : 'none'); ?>;text-align:center;">DE</th>
                        <th class="th-evening" style="display:<?php echo ($evening == 1 ? 'table-cell' : 'none'); ?>;text-align:center;">À</th>
					     <!--<th class="col-md-1">NON APPLICABLE</th>-->
                        <th class="col-md-2">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($block_schedules as $schedule): ?>
                        <?php if (!isset($schedule["VALUE"]->CLOSED)): ?>
                            <tr>
                  	            <td><?php echo $schedule["VALUE"]->DATE;?></td>
                                <td style="text-align:center;"><?php if(isset($schedule["VALUE"]->PRESENT)){echo '<i class="fas fa-check"></i>' ;}  ?></td>
                                <td><?php echo $schedule["VALUE"]->REASON;?></td>
                                <td><?php echo $schedule["VALUE"]->FROM_AM;?></td>
                                <td><?php echo $schedule["VALUE"]->TO_AM;?></td>
                                <td><?php echo $schedule["VALUE"]->FROM_PM;?></td>
                                <td><?php echo $schedule["VALUE"]->TO_PM;?></td>
                                <?php if($evening == 1 ): ?>
                                <td><?php echo (isset($schedule["VALUE"]->FROM_EV) ? $schedule["VALUE"]->FROM_EV : '')?></td>
                                <td><?php echo (isset($schedule["VALUE"]->TO_EV) ? $schedule["VALUE"]->TO_EV : '')?></td>
                                <?php endif; ?>

                                <!-- <td style="text-align:center;"><?php if(isset($schedule["VALUE"]->CLOSED)){echo '<i class="fas fa-check"></i>' ;}  ?></td> -->
                                <td><?php echo $schedule["VALUE"]->TOTAL;?></td>

                            </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.box-body -->


        </div>


    </div>

    </div>
</div>
</div>










