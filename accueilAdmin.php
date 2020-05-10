<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginAdmin.php', true, 301); // jsp si il faut changer ou pas j'ai juste repris celui d'avant :/
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Accueil | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/accueil.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html');
    include_once('includes/menuClient.php');
    ?>
    <main>
      <h2> Mr Daktari - Ostéopathe/homéopathe pour animaux</h2>
      <img src="images/dog.png" width="50%" height="70%">

      <h2>Diplômes obtenus</h2>
      <ul class='liste'>
       <li>Master II en ostéopathie et homéopathie animal</li>
       <li>Diplôme national d'internat des écoles vétérinaires</li>
      </ul>
      <p class="citation">
        <span class="quote1"> ‘‘</span>
        Chez Monsieur Daktari, nous vous garantissons amour et bien-être quant au traitement de vos animaux.
        <span class="quote2"> ’’</span>
      </p>
      <?php include_once('includes/footer.html')?>
    </main>
</body>


</html>
