<?php ini_set('memory_limit', '512M'); ?>
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
        <h4>Liste simplifié des Employeurs</h4>
        <img height="80" src="<?= site_url("/resources/img/logo_gestage.png") ?>">
        <br><br><br>
        <table style="width:100%" cellspacing="2" cellpadding="2">
            <thead>
                <tr>
                    <th style="width:auto">Employeur</th>
                    <th style="width:120px">Nom Contact</th>
                    <th style="width:200px">Email Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($employers as $e) { ?>
                <tr>
                    <td><?= $e["EMPLOYER_NAME"] ?></td>
                    <td><?= $e["CONTACT_NAME"] ?></td>
                    <td><?= $e["EMAIL"] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>