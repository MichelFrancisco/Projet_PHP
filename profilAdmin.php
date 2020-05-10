<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginAdmin.php', true, 301);
}

include_once('connexion_local.php');
/* Requête pour les informations de l'admin... */
$query = $dbh->query("SELECT * FROM `LOGIN` WHERE utilisateur = '" . $_SESSION['utilisateur'] . "'");
$admin = $query->fetch();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/profilAdmin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html') ?>
    <?php include_once('includes/menuAdmin.php') ?>

    <main>
        <div class="infosAdmin">
            <h2>Informations</h2>
            <table>
                <tr>
                    <th colspan="1">Utilisateur admin</th>
                    <th colspan="3">Date et heure d'inscription</th>
                </tr>
                <tr>
                    <td colspan="1"><?php echo $admin['utilisateur']; ?></td>
                    <td colspan="3"><?php echo $admin['dateInscription']; ?></td>
                </tr>
            </table>
        </div>
        <form id="deconnexion" action="deconnexion.php" method="post">
          <input class='button warning' type='submit' value='Se déconnecter' />
        </form>
    </main>

    <?php include_once('includes/footer.html') ?>
</body>

</html>
