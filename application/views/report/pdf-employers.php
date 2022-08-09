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
        <h4>Liste de tous les Employeurs avec leurs Contact(s)</h4>
        <img src="<?= site_url("/resources/img/logo.png") ?>">
        <br><br><br>
        <?php foreach ($employers as $e) { ?>
            <div style="page-break-inside: avoid; margin-bottom: 1em; line-height:1.2em; height:15em; width: 100%;">
                <p style="float: left">
                    <strong><?= $e["EMPLOYER_NAME"] ?></strong><br>
                    Adresse: <?= $e["ADDRESS"] ?><br>
                    Ville: <?= $e["CITY"] ?><br>
                    Province: <?= $e["PROVINCE"] ?><br>
                    Pays: <?= $e["COUNTRY"] ?><br>
                    Code Postal: <?= $e["POSTAL_CODE"] ?><br><br>
                    Courriel: <?= $e["EMAIL"] ?>
                </p>
                <p style="float: right">
                    <span style="text-decoration: underline;">Contact(s)</span><br>
                    <?php foreach ($e["CONTACTS"] as $c) { ?>
                        <strong><?= $c["CONTACT_NAME"] ?></strong><br>
                        Téléphone: <?= $c["CONTACT_PHONE"] ?><br>
                        Courriel: <?= $c["CONTACT_EMAIL"] ?><br><br>
                    <?php } ?>
                </p>
            </div>
        <?php } ?>
    </body>
</html>