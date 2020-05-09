<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require("connexion_local.php");

  if (!empty($_POST['login']) && !empty($_POST['mdp'])) {
    $inputLogin = $_POST['login'];
    $inputPassword = $_POST['mdp'];

    $results = $dbh->query("SELECT utilisateur, motDePasse FROM LOGIN WHERE utilisateur = '$inputLogin' AND motDePasse = '$inputPassword' AND role='admin'");

    $user = $results->fetch();
    $username = $user['utilisateur'];
    $password = $user['motDePasse'];

    if ($username == $inputLogin && $password == $inputPassword) {
      session_start();
      $_SESSION['utilisateur'] = $username;
      header('Location: accueilAdmin.php');
    } else {
      $error = 'Erreur : Identifiant ou mot de passe invalide.';
    }
  } else {
    $error = "Erreur : Vous n'avez rien rentré dans le formulaire de connexion.";
  }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="styles/global.css">
  <link rel="stylesheet" type="text/css" href="styles/loginClient.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion | Ostéopathe Animalier</title>
</head>

<body>
  <?php include_once('includes/header.html') ?>
  <main>
    <h1>Rentrez vos identifiants :</h1>
    <div class="formConnect">
      <form action="loginAdmin.php" method="post">

        <label for="login">Login</label>
        <input type="text" name="login">

        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp">

        <?php
        if (isset($error)) {
        ?>
          <p class="error"><?php echo ($error); ?></p>
        <?php
        }
        ?>
        <div class="actions">
          <input class="button warning" type="reset" value="Annuler" />
          <input class="button success" type="submit" value="Se connecter" />
        </div>
      </form>

      <a id="retourAccueil" class="button" href="/">Retour à l'accueil</a>
    </div>
  </main>
</body>
<?php include_once('includes/footer.html') ?>

</html>