<html>
    <head>
        <title>Rapport de Stage</title>
    </head>
    <body>
        <style>
            td { font-size:10px; }
            th { font-size:12px; font-weight:bold; text-align:left; }
            tr:nth-child(even) { background: #CCC }
            img { float:right; right:0; position:absolute; top:0; }
        </style>

        <?php if ($post["report_type"] == 1) { ?>
            <?php if ($post["date_debut"] != null && $post["date_fin"] != null) { ?>
                <h4>Liste des stages entre <?= $post["date_debut"] ?> et <?= $post["date_fin"] ?></h4>
            <?php } else { ?>
                <h4>Liste des stages en date du <?= date("Y-m-d") ?></h4>
            <?php } ?>
        <?php } else if ($post["report_type"] == 2) { ?>
            <?php if ($post["date_debut"] != null && $post["date_fin"] != null) { ?>
                <h4>Liste des employeurs de stages entre <?= $post["date_debut"] ?> et <?= $post["date_fin"] ?></h4>
            <?php } else { ?>
                <h4>Liste des employeurs de stages en date du <?= date("Y-m-d") ?></h4>
            <?php } ?>
        <?php } ?>
        <img src="<?= site_url("/resources/img/logo_gestage.png") ?>">
        <br><br>
        <table style="width:100%" cellspacing="2" cellpadding="2">
            <thead>
                <tr>
                    <?php if ($post["report_type"] == 1) { ?>
                        <th style="width:140px">Élève</th>
                        <th style="width:auto">Employeur</th>
                        <th style="width:150px">Programme</th>
                        <th style="width:60px">Date Début</th>
                        <th style="width:60px">Date Fin</th>
                    <?php } elseif ($post["report_type"] == 2) { ?>
                        <th style="width:250px">Employeur</th>
                        <th style="width:120px">Nom Contact</th>
                        <th style="width:auto">Email Contact</th>
                        <th style="width:60px">Date Début</th>
                        <th style="width:60px">Date Fin</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($internships[0] as $I) { ?>
                    <?php if ($post["report_type"] == 1) { ?>
                        <tr>
                            <td><?= $I["STUDENT_NAME"] ?></td>
                            <td><?= $I["EMPLOYER_NAME"] ?></td>
                            <td><?= $I["PROGRAM"] ?></td>
                            <td><?= $I["DATE_START"] ?></td>
                            <td><?= $I["DATE_END"] ?></td>
                        </tr>
                    <?php } elseif ($post["report_type"] == 2) { ?>
                        <tr>
                            <td><?= $I["EMPLOYER_NAME"] ?></td>
                            <td><?= $I["CONTACT_NAME"] ?></td>
                            <td><?= $I["CONTACT_EMAIL"] ?></td>
                            <td><?= $I["DATE_START"] ?></td>
                            <td><?= $I["DATE_END"] ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>