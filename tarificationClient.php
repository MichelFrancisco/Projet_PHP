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

    <table>
      <tr>
        <td>Type de consultation</td>
        <td>Cabinet</td>
        <td>Hors Cabinet</td>
      </tr>
      <tr>
        <td>Consultation de base</td>
        <td>15€</td>
        <td>25€</td>
      </tr>
      <tr>
        <td>Consulation avec manipultaion</td>
        <td>40€</td>
        <td>70€</td>
      </tr>
    </table>

</body>
<?php include_once('includes/footer.html')?>
</html>