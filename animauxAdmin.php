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
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html') ?>
    <?php include_once('includes/menuAdmin.php') ?>
    <h1>Liste</h1>
      <table>
        <thead>
          <tr>
            <th>id</th>
            <th>nom</th>
            <th>espece</th>
            <th>race</th>
            <th>taille</th>
            <th>genre</th>
            <th>castre</th>
            <th>poids</th>
            <th>id_particulier</th>
            <th>id_organisme</th>
          </tr>
        </thead>
        <?php

        require("connexion_local.php");

        $results = $dbh->query("SELECT * FROM animaux_traites"); // C'est moche mais dans l'idée c'est sa je crois ? :(
        while($ligne = $results->fetch()){
          echo'<tr>
                 <td>' . $ligne['id'] . '<td>
                 <td>' . $ligne['nom'] . '<td>
                 <td>' . $ligne['espece'] . '<td>
                 <td>' . $ligne['race'] . '<td>
                 <td>' . $ligne['taille'] . '<td>
                 <td>' . $ligne['genre'] . '<td>
                 <td>' . $ligne['castre'] . '<td>
                 <td>' . $ligne['poids'] . '<td>
                 <td>' . $ligne['id_particulier'] . '<td>
                 <td>' . $ligne['id_organisme'] . '<td>
               </tr>';
        }
        ?>
    </table>
</body>
<?php include_once('includes/footer.html')?>
</html>
