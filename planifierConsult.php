<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginClient.php', true, 301);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Planifier une consultation | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html') ?>
    <!--Barre de navigation-->
    <div class="navbar">
        <ul class="navbar">
            <li><a href="/" class="active">Accueil</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Informations</a>
                <div class="dropdown-content">
                    <a href="accueilClient.php">Mon espace</a>
                    <a href="profilClient.php">Profil</a>
                    <a href="deconnexion.php">Déconnexion</a>
                </div>
            </li>
            <li><a href="planifierConsult.php">Planifier une consultation</a></li>
            <li><a href="tarification.php">Tarification</a></li>
        </ul>
    </div>
    <!--Fin de la barre de navigation-->

    <main></main>

    <?php include_once('includes/footer.html') ?>
</body>

</html>