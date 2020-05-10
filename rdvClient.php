<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginClient.php', true, 301);
}
include_once('connexion.php');

$queryParticulier = $dbh->query("SELECT id_particulier FROM `LOGIN` WHERE utilisateur = '" . $_SESSION['utilisateur'] . "'");
$user = $queryParticulier->fetch();
$userId = $user['id_particulier'];

$queryRdv = $dbh->query("SELECT type, lieu, date FROM `RENDEZ_VOUS` WHERE `id_particulier` = '$userId'");
$rdv = $queryRdv->fetch();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Suivi | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/rdv.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html');
    include_once('includes/menuClient.php');
    ?>
    <main>
        <div class="rdv">
            <h2>Mes rendez-vous</h2>
            <table>
                <tr>
                    <th colspan="3">Type de rendez-vous</th>
                    <th colspan="3">Lieu</th>
                    <th colspan="1">date</th>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $rdv['type'] ?></td>
                    <td colspan="3"><?php echo $rdv['lieu'] ?></td>
                    <td colspan="1"><?php echo $rdv['date'] ?></td>
                </tr>
            </table>
        </div>
    </main>
    <?php include_once('includes/footer.html') ?>
</body>