<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('Location: loginClient.php', true, 301);
}

include_once('connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* Requête pour modifier les informations de l'utilisateur... */
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse']) && isset($_POST['codep']) && isset($_POST['ville']) && isset($_POST['telephone']) && isset($_POST['email'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $codep = $_POST['codep'];
        $ville = $_POST['ville'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];

        $query = $dbh->query("SELECT id_particulier FROM `LOGIN` WHERE utilisateur = '" . $_SESSION['utilisateur'] . "'");
        $user = $query->fetch();
        $userId = $user['id_particulier'];

        $maj = $dbh->exec("UPDATE PARTICULIERS SET nom='$nom', prenom='$prenom', adresse='$adresse', codePostal = '$codep', ville = '$ville', telephone = '$telephone', email = '$email' WHERE id = '$userId'");
    }
}

/* Requête pour les informations de l'utilisateur... */
$infos = $dbh->query("SELECT * FROM `PARTICULIERS` LEFT JOIN `LOGIN` ON `PARTICULIERS`.id = `LOGIN`.id_particulier WHERE `LOGIN`.`utilisateur` = '" . $_SESSION['utilisateur'] . "'");
$infoUser = $infos->fetch();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/profilClient.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <?php include_once('includes/header.html') ?>
    <?php include_once('includes/menuClient.php') ?>

    <main>
        <div class="infosClient">
            <h2>Informations</h2>
            <table>
                <tr>
                    <th colspan="1">Nom</th>
                    <th colspan="1">Prénom</th>
                    <th colspan="3">Adresse</th>
                    <th colspan="1">Code Postal</th>
                    <th colspan="2">Ville</th>
                    <th colspan="1">Téléphone</th>
                    <th colspan="2">Adresse e-mail</th>
                </tr>
                <tr>
                    <td colspan="1"><?php echo $infoUser['nom'] ?></td>
                    <td colspan="1"><?php echo $infoUser['prenom'] ?></td>
                    <td colspan="3"><?php echo $infoUser['adresse'] ?></td>
                    <td colspan="1"><?php echo $infoUser['codePostal'] ?></td>
                    <td colspan="2"><?php echo $infoUser['ville'] ?></td>
                    <td colspan="1"><?php echo $infoUser['telephone'] ?></td>
                    <td colspan="2"><?php echo $infoUser['email'] ?></td>
                </tr>
            </table>
            <h2>Modifier mon profil</h2>
            <form id="modifierProfil" action="profilClient.php" method="post">
                <label for='nom'>Nom :</label>
                <input type='text' name='nom' value="<?php echo $infoUser['nom']; ?>" />
                <label for='prenom'>Prenom :</label>
                <input type='text' name='prenom' value="<?php echo $infoUser['prenom']; ?>" />
                <label for='adresse'>Adresse :</label>
                <input type='text' name='adresse' value="<?php echo $infoUser['adresse']; ?>" />
                <label for='codep'>Code postal :</label>
                <input type='text' name='codep' value="<?php echo $infoUser['codePostal']; ?>" />
                <label for='ville'>Ville :</label>
                <input type='text' name='ville' value="<?php echo $infoUser['ville']; ?>" />
                <label for='telephone'>Téléphone :</label>
                <input type='text' name='telephone' value="<?php echo $infoUser['telephone']; ?>" />
                <label for='email'>Adresse e-mail :</label>
                <input type='text' name='email' value="<?php echo $infoUser['email']; ?>" />
                <input class='button success' type='submit' name='sauvegarder' value='Sauvegarder' />
            </form>
            <form id="deconnexion" action="deconnexion.php" method="post">
                <input class='button warning' type='submit' value='Se déconnecter' />
            </form>
        </div>
    </main>

    <?php include_once('includes/footer.html') ?>
</body>

</html>