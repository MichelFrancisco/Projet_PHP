<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginAdmin.php', true, 301);
}

include_once('connexion.php');
$query = $dbh->query("SELECT * FROM RENDEZ_VOUS");
$rdvs = $query->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* Requête pour ajouter une consultation à partir d'un rendez-vous */
    if (isset($_POST['id']) && isset($_POST['anamnese']) && isset($_POST['diagnostic']) && isset($_POST['manipulation']) && isset($_POST['suivi']) && isset($_POST['prix'])) {

        $id = $_POST['id'];
        $duree = $_POST['duree'];
        $anamnese = $_POST['anamnese'];
        $diagnostic = $_POST['diagnostic'];
        $manipulation = $_POST['manipulation'];
        $suivi = $_POST['suivi'];
        $prix = $_POST['prix'];

        $reponse = [];

        try {
            $reponse['type'] = 'success';
            $reponse['message'] = "La consultation a bien été ajoutée !";
            $ajouterConsultation = $dbh->exec("INSERT INTO CONSULTATION (`duree`,`anamnese`,`diagnostic`,`manipulation`,`suivi`,`prix`,`id_rendezvous`) VALUES ('$duree','$anamnese','$diagnostic','$manipulation','$suivi','$prix','$id')");
        } catch (Exception $e) {
            $reponse['type'] = 'error';
            $reponse['message'] = "Une erreur s'est produite lors de l'ajout...";
        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Créer une consultation | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/consultAdmin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html');
    include_once('includes/menuAdmin.php'); ?>
    <main>
        <div class="consult">
            <h2>Ajouter une consultation pour un rendez-vous effectué...</h2>
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
            <h2>Renseigner le déroulement...</h2>
            <form id="ajouterConsult" action="consultAdmin.php" method="post">
                <label type="id">ID du rendez-vous à compléter :</label>
                <select name='id'>
                    <?php foreach ($rdvs as $rdv) { ?>
                        <option> <?php echo $rdv['id']; ?></option>
                    <?php } ?>
                </select>
                <label for="duree">Durée :</label>
                <input type="text" name="duree" />
                <label for="anamnese">Anamnese :</label>
                <input type="text" name="anamnese" />
                <label for="diagnostic">Diagnostic :</label>
                <input type="text" name="diagnostic" />
                <label for="manipulation">Manipulations effectuées (Laisser le champs vide si il n'y en a pas eu) :</label>
                <input type="text" name="manipulation" />
                <label for="suivi">Suivi :</label>
                <input type="text" name="suivi" />
                <label for="prix">Prix (en euros) :</label>
                <select name="prix">
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="40">40</option>
                    <option value="70">70</option>
                </select>
                <input class='button success' type='submit' name='zjouter' value='Ajouter...' /></input>
            </form>
        </div>
        <?php if (isset($reponse)) { ?>
            <p class="<?php echo $reponse['type']; ?>"><?php echo $reponse['message']; ?></p>
        <?php } ?>
    </main>
    <?php include_once('includes/footer.html'); ?>
</body>

</html>