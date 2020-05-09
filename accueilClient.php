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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html');
    include_once('includes/menuClient.php');
    ?>
    <main>
    </main>
    <?php include_once('includes/footer.html') ?>
</body>


</html>