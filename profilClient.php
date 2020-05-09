<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginClient.php', true, 301);
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
    <?php include_once('includes/menuClient.php') ?>


    <p><h2>Informations</h2></p>
        Je sais pas quoi mettre a part username et date inscription  ?

</body>
<?php include_once('includes/footer.html')?>
</html>
