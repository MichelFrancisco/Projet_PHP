<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginClient.php', true, 301);
}

include_once('connexion_local.php');

$queryParticulier = $dbh->query("SELECT id_particulier FROM `LOGIN` WHERE utilisateur = '" . $_SESSION['utilisateur'] . "'");
$user = $queryParticulier->fetch();
$userId = $user['id_particulier'];

$queryRdv = $dbh->query("SELECT id FROM `rendez_vous` WHERE `id_particulier` = '$userId'");
$rdv = $queryRdv->fetch();
$rdvId = $rdv['id'];

$queryConsult = $dbh->query("SELECT * FROM `consultation` WHERE `id_rendezvous` = '$rdvId'");
$consult = $queryConsult->fetch();
$consultId = $consult['id'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Suivi | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/suiviConsult.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html');
    include_once('includes/menuClient.php');
    ?>
    <main>
        <div class="suiviConsultation">
            <h2>Suivi de l'animal</h2>
            <table>
                <tr>
                    <th colspan="3">Anamnèse</th>
                    <th colspan="3">Diagnostic</th>
                    <th colspan="1">Manipulation(s) effectuée(s)</th>
                    <th colspan="3">Suivi quant au traitement</th>
                    <th colspan="2">prix</th>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $consult['anamnese'] ?></td>
                    <td colspan="3"><?php echo $consult['diagnostic'] ?></td>
                    <td colspan="1"><?php echo $consult['manipulation'] ?></td>
                    <td colspan="3"><?php echo $consult['suivi'] ?></td>
                    <td colspan="2"><?php echo $consult['prix'] ?></td>
                </tr>
            </table>
        </div>
    </main>
    <?php include_once('includes/footer.html') ?>
</body>


</html>