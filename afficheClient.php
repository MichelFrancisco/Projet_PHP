<?php
require("connexion.php");
session_start();
if (isset($_POST['login']) && isset($_POST['mdp']))
{
    $loginc = $_POST['login'];
    $mdpc = $_POST['mdp'];

    $results=$dbh->query("SELECT id,pwd FROM LOGIN WHERE id = '$loginc' AND pwd = '$mdpc'");

    $ligne = $results->fetch();
    $loginvalide = $ligne['id'];
    $mdpvalide = $ligne['pwd'];

    if ($loginvalide == $loginc && $mdpvalide == $mdpc){
        $_SESSION['login'] = $loginvalide;
        $_SESSION['mdp'] = $mdpvalide;
        header('Location : accueilClient.php');
    }
    else {
        echo 'Erreur : mauvais identifiants.';
        header('Location : afficheClient.php');
    }
}
else {
    echo "Vous n'avez rien rentré dans le formulaire de connexion.";
    header('Location : loginClient.php');
}
?>

    