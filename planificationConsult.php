<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginClient.php', true, 301);
}

include_once('connexion_local.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* Requête pour modifier les informations de l'utilisateur... */
    if (isset($_POST['type']) && isset($_POST['lieu']) && isset($_POST['date']) && isset($_POST['heure'])) {
        $type = $_POST['type'];
        $lieu = $_POST['lieu'];
        $date = $_POST['date'] . " " . $_POST['heure'];

        // die($type . " " . $lieu . " " . $date);

        $queryParticulier = $dbh->query("SELECT id_particulier FROM `LOGIN` WHERE utilisateur = '" . $_SESSION['utilisateur'] . "'");
        $user = $queryParticulier->fetch();
        $userId = $user['id_particulier'];

        $queryAnimal = $dbh->query("SELECT id FROM `ANIMAUX_TRAITES` WHERE `id_particulier` = '$userId'");
        $animal = $queryAnimal->fetch();
        $animalId = $animal['id'];

        $reponse = [];
        try {
            $addConsult = $dbh->exec("INSERT INTO rendez_vous (`type`, `lieu`, `date`, `id_particulier`, `id_animal`) VALUES ('$type','$lieu','$date', '$userId', '$animalId')");
            $reponse['type'] = 'success';
            $reponse['message'] = "Votre rendez-vous a bien été pris en compte !";
        } catch (Exception $e) {
            die($e);
            $reponse['type'] = 'error';
            $reponse['message'] = "Une erreur s'est produite lors de la prise de rendez-vous";
        }
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Planifier une consultation | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/planificationConsult.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html'); ?>
    <?php include_once('includes/menuClient.php'); ?>

    <main>
        <div class="planificationConsult">
            <h2>Indiquez vos disponibilités...</h2>
            <form id="planifConsult" action="planificationConsult.php" method="post">
                <label for="type">Type de la consultation :</label>
                <select name='type'>
                    <option>Ostéopathique</option>
                    <option>Homéopathique</option>
                </select>
                <label for="lieu">Lieu :</label>
                <select name='lieu'>
                    <option>Cabinet</option>
                    <option>Chez le propriétaire</option>
                </select>
                <label for="date">Date :</label>
                <input type='date' name='date' />
                <label for="heure">Heure :</label>
                <input type='time' name='heure' />
                <input class='button success' type='submit' name='envoyer' value='Prendre RDV' />
                <?php
                if (isset($reponse)) {
                ?>
                    <p class="<?php echo $reponse['type']; ?>"><?php echo $reponse['message']; ?></p>
                <?php
                }
                ?>
            </form>
        </div>
    </main>

    <?php include_once('includes/footer.html') ?>
</body>

</html>