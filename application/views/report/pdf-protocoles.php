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

        <h4>Liste des stages entre <?= $post["date_debut"] ?> et <?= $post["date_fin"] ?></h4>
        <img src="<?= site_url("/resources/img/logo_gestage.png") ?>">
        <br><br>

        <table style="width:100%" cellspacing="2" cellpadding="2">
            <thead>
                <tr>
                    <th style="width:180px">Nom Document</th>
                    <th style="width:50px">Date</th>
                    <th style="width:auto">Employeur</th>
                    <th style="width:150px">Élève</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($documents[0] as $d) { ?>
                    <tr>
                        <td><?= $d["NAME"] ?></td>
                        <td><?= $d["DATE"] ?></td>
                        <td><?= $d["EMPLOYER_NAME"] ?></td>
                        <td><?= $d["STUDENT_NAME"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>