<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginAdmin.php', true, 301);
}

include_once('connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* Requête pour modifier les informations de l'utilisateur... */
    if (isset($_POST['id']) && isset($_POST['type']) && isset($_POST['lieu']) && isset($_POST['date']) && isset($_POST['heure'])) {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $lieu = $_POST['lieu'];
        $date = $_POST['date'] . " " . $_POST['heure'];
        $reponse = [];

        try {
            $reponse['type'] = 'success';
            $reponse['message'] = "Le rendez-vous a bien été modifié !";
            $modifRdv = $dbh->exec("UPDATE `RENDEZ_VOUS` SET type='$type', lieu='$lieu', date='$date' WHERE id = '$id'");
        } catch (Exception $e) {
            $reponse['type'] = 'error';
            $reponse['message'] = "Une erreur s'est produite lors de la modification...";
        }
    }
}
$query = $dbh->query("SELECT * FROM RENDEZ_VOUS");
$rdvs = $query->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Planning | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/planningAdmin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html') ?>
    <?php include_once('includes/menuAdmin.php') ?>
    <main>
        <div class="rdv">
            <h2>Liste des rendez-vous proposés</h2>
            <table>
                <tr>
                    <th colspan="1">ID du rendez-vous</th>
                    <th colspan="1">Type</th>
                    <th colspan="1">Lieu</th>
                    <th colspan="3">Date</th>
                </tr>
                <?php foreach ($rdvs as $rdv) { ?>
                    <tr>
                        <td colspan="1"><?php echo $rdv['id'] ?></td>
                        <td colspan="1"><?php echo $rdv['type'] ?></td>
                        <td colspan="1"><?php echo $rdv['lieu'] ?></td>
                        <td colspan="3"><?php echo $rdv['date'] ?></td>
                    </tr>
                <?php } ?>
            </table>
            <h2>Modifier un créneau...</h2>
            <form id="modifierRdv" action="planningAdmin.php" method="post">
                <label type="id">ID du rendez-vous à modifier :</label>
                <select name='id'>
                    <?php foreach ($rdvs as $rdv) { ?>
                        <option> <?php echo $rdv['id']; ?></option>
                    <?php } ?>
                </select>
                <label for="type">Type :</label>
                <select name="type">
                    <option>Osthéopathique</option>
                    <option>Homéopathique</option>
                </select>
                <label for="lieu">Lieu :</label>
                <select name="lieu">
                    <option>Cabinet</option>
                    <option>Chez le propriétaire</option>
                </select>
                <label for="date">Date :</label>
                <input type='date' name='date' />
                <label for="heure">Heure :</label>
                <input type='time' name='heure' />
                <input class='button success' type='submit' name='modifier' value='Modifier...' /></input>
            </form>
        </div>
        <?php if (isset($reponse)) { ?>
            <p class="<?php echo $reponse['type']; ?>"><?php echo $reponse['message']; ?></p>
        <?php } ?>
    </main>
    <?php include_once('includes/footer.html') ?>
</body>

</html>