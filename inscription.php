
<?php
if (isset($_POST['inscrire'])){
  $reponse = []; /* Réponse adaptée à la situation sous forme d'un tableau. */

  /* on test si les champ sont bien remplis */
  if(!empty($_POST['pseudo']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']) and !empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['adresse']) and !empty($_POST['codep']) and !empty($_POST['ville']) and !empty($_POST['email'])){
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $codep = $_POST['codep'];
    $ville = $_POST['ville'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date = date('Y-m-d H:i:s');
    /* on test si le mdp contient bien au moins 5 caractère */
    if (strlen($_POST['mdp'])>=5){
         /* on test si les deux mdp sont bien identique */
      if ($_POST['mdp']==$_POST['mdp2']){
        include_once('connexion_local.php');
        try {
            $inscription = $dbh->exec("INSERT INTO particuliers (`nom`, `prenom`, `adresse`, `codePostal`, `ville`, `telephone`, `email`) VALUES ('$nom','$prenom','$adresse', '$codep', '$ville','$telephone' ,'$email')");
            $inscription2 = $dbh->exec("INSERT INTO login (`utilisateur`, `motDePasse`, `dateInscription`, `role`, `id_particulier`) VALUES ('$pseudo','$mdp','$date', 'user',(SELECT COUNT(id) from particuliers))");
            $reponse['type'] = 'success';
            $reponse['message'] = "Inscription reussite";
            header('Location: index.php');
        } catch (Exception $e) {
            $reponse['type'] = 'error';
            $reponse['message'] = "Une erreur s'est produite lors de l'inscription";
        }
      }
      else {
        $reponse['type'] = 'error';
        $reponse['message'] = "Les mots de passe ne sont pas identiques";
      }
    }
    else {
      $reponse['type'] = 'error';
      $reponse['message'] = "Veuillez saisir un mot de passe d'au moins 5 caractères !";
    }
  }
  else {
    $reponse['type'] = 'error';
    $reponse['message'] = "Veuillez remplir tout les champs !";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tarification | Ostéopathe Animalier</title>
  <link rel="stylesheet" type="text/css" href="styles/global.css">
  <link rel="stylesheet" type="text/css" href="styles/inscription.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
</head>

<body>
  <?php include_once('includes/menuVisiteur.php') ?>
  <main>
    <form id="inscription" action="inscription.php" method="post">
        <label for='pseudo'>Pseudonyme :</label>
        <input type='text' name='pseudo' value="" />
        <label for='password'>Mot de passe :</label>
        <input type='password' name='mdp' value="" />
        <label for='password2'>Repetez le mot de passe :</label>
        <input type='password' name='mdp2' value="" />
        <label for='nom'>Nom :</label>
        <input type='text' name='nom' value="" />
        <label for='prenom'>Prenom :</label>
        <input type='text' name='prenom' value="" />
        <label for='adresse'>Adresse :</label>
        <input type='text' name='adresse' value="" />
        <label for='codep'>Code postal :</label>
        <input type='text' name='codep' value="" />
        <label for='ville'>Ville :</label>
        <input type='text' name='ville' value="" />
        <label for='telephone'>Téléphone (optionnel):</label>
        <input type='text' name='telephone' value="" />
        <label for='email'>Adresse e-mail :</label>
        <input type='text' name='email' value="" />
        <input class='button success' type='submit' name='inscrire' value='Inscription' />
        <div class="connect">
          <h3><a href="loginClient.php">Déja inscris ? Connectez vous !</a><h3>
        </div>

        <?php
        if (isset($reponse)) {
        ?>
            <p class="<?php echo $reponse['type']; ?>"><?php echo $reponse['message']; ?></p>
        <?php
        }
        ?>
    </form>
  </main>
  <?php include_once('includes/footer.html'); ?>
</body>

</html>
