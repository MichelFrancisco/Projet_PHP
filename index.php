<!DOCTYPE html>
<html>

<head>
    <title>Bienvenue | Ostéopathe Animalier</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>

<body>
    <!--Haut de la page-->
    <header>
        <h1>Bienvenue</h1>
    </header>
    <!--Fin du haut de la page-->
    <!-- Corps de la page -->
    <main>
        <div class="choixUtilisateur">
            <h2>Vous êtes :</h2>
            <div class="buttons">
                <a class="button" href="loginClient.php">Client</a>
                <a class="button" href="loginAdmin.php">Ostéopathe</a>
                <a class="button" href="accueilVisiteur.php">Visiteur</a>
            </div>
        </div>

    </main>
    <!-- Fin du corps de la page -->
    <?php include_once('includes/footer.html') ?>
</body>

</html>