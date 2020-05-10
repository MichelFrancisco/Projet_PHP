<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
  header('Location: loginAdmin.php', true, 301);
}

include_once('connexion_local.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  /* Requête pour ajouter un animal */
  if ((isset($_POST['id_particulier']) || isset($_POST['id_organisme'])) && isset($_POST['nom']) && isset($_POST['espece']) && isset($_POST['race']) && isset($_POST['taille']) && isset($_POST['genre']) && isset($_POST['castre']) && isset($_POST['poids'])) {
    $typeProprietaire = $_POST['typeProprietaire'];
    if ($typeProprietaire == 'particulier') {
      $id = $_POST['id_particulier'];
    } else {
      $id = $_POST['id_organisme'];
    }
    $nom = $_POST['nom'];
    $espece = $_POST['espece'];
    $race = $_POST['race'];
    $taille = $_POST['taille'];
    $genre = $_POST['genre'];
    $castre = $_POST['castre'];
    $poids = $_POST['poids'];

    $reponse = [];
    try {
      if ($typeProprietaire == 'particulier') {
        $ajoutAnimal = $dbh->exec("INSERT INTO ANIMAUX_TRAITES (`nom`,`espece`,`race`,`taille`,`genre`,`castre`,`poids`,`id_particulier`,`id_organisme`) VALUES ('$nom','$espece','$race','$taille','$genre','$castre','$poids','$id', null)");
      } else {
        $ajoutAnimal = $dbh->exec("INSERT INTO ANIMAUX_TRAITES (`nom`,`espece`,`race`,`taille`,`genre`,`castre`,`poids`,`id_particulier`,`id_organisme`) VALUES ('$nom','$espece','$race','$taille','$genre','$castre','$poids',null, '$id')");
      }
      $reponse['type'] = 'success';
      $reponse['message'] = "L'animal rentré a bien été ajouté !";
    } catch (Exception $e) {
      $reponse['type'] = 'error';
      $reponse['message'] = "Une erreur s'est produite lors de l'ajout...";
    }
  }
}

$query = $dbh->query("SELECT a.nom, a.espece, a.race, a.taille, a.genre, a.castre, a.poids, p.nom AS nom_proprietaire, p.prenom AS prenom_proprietaire, o.raisonSociale
                      FROM ANIMAUX_TRAITES AS a
                      LEFT JOIN PARTICULIERS AS p ON a.id_particulier = p.id
                      LEFT JOIN ORGANISME AS o ON a.id_organisme = o.id
                      ORDER BY p.nom, p.prenom, a.nom");
$animaux = $query->fetchAll();

$query = $dbh->query("SELECT id, nom, prenom FROM PARTICULIERS");
$particuliers = $query->fetchAll();

$query = $dbh->query("SELECT id, raisonSociale FROM ORGANISME");
$organismes = $query->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Animaux à traiter | Ostéopathe Animalier</title>
  <link rel="stylesheet" type="text/css" href="styles/global.css">
  <link rel="stylesheet" type="text/css" href="styles/animauxAdmin.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
</head>

<body>
  <?php include_once('includes/header.html') ?>
  <?php include_once('includes/menuAdmin.php') ?>
  <main>
    <div class="listeAnimaux">
      <h2>Animaux traités</h2>
      <table>
        <tr>
          <th colspan="1">Nom</th>
          <th colspan="1">Espece</th>
          <th colspan="1">Propriétaire</th>
          <th colspan="1">Race</th>
          <th colspan="1">Taille</th>
          <th colspan="1">Genre</th>
          <th colspan="2">Castré ?</th>
          <th colspan="1">Poids</th>
        </tr>
        <?php foreach ($animaux as $animal) { ?>
          <tr>
            <td colspan="1"><?php echo $animal['nom'] ?></td>
            <td colspan="1"><?php echo $animal['espece'] ?></td>
            <td colspan="1">
              <?php if (isset($animal['raisonSociale'])) {
                echo ($animal['raisonSociale']);
              } else {
                echo ($animal['nom_proprietaire'] . " " .  $animal['prenom_proprietaire']);
              } ?>
            </td>
            <td colspan="1"><?php echo $animal['race'] ?></td>
            <td colspan="1"><?php echo $animal['taille'] ?> cm</td>
            <td colspan="1"><?php echo $animal['genre'] ?></td>
            <td colspan="2">
              <?php if ($animal['castre'] == '1') {
                echo 'oui';
              } else {
                echo 'non';
              } ?>
            </td>
            <td colspan="1"><?php echo $animal['poids'] ?> kg</td>
          </tr>
        <?php } ?>
      </table>
      <h2>Ajouter un animal</h2>
      <form id="addAnimal" name="addAnimal" action="animauxAdmin.php" method="post">
        <label for="typeProprietaire">Type de propriétaire</label>
        <input type="radio" name="typeProprietaire" value="particulier" checked /> <label for="particulier">Particulier</label>
        <input type="radio" name="typeProprietaire" value="organisme" /> <label for="organisme">Organisme</label>
        <label for="id">Propriétaire de l'animal :</label>
        <select name='id_particulier'>
          <?php foreach ($particuliers as $particulier) { ?>
            <option value="<?php echo $particulier['id']; ?>"> <?php echo $particulier['nom'] . " " . $particulier['prenom']; ?></option>
          <?php } ?>
        </select>
        <select name='id_organisme'>
          <?php foreach ($organismes as $organisme) { ?>
            <option value="<?php echo $organisme['id']; ?>"> <?php echo $organisme['raisonSociale']; ?></option>
          <?php } ?>
        </select>
        <label for="nom">Nom :</label>
        <input type='text' name='nom' /></input>
        <label for="espece">Espèce :</label>
        <input type='text' name='espece' /></input>
        <label for="race">Race :</label>
        <input type='text' name='race' /></input>
        <label for="taille">Taille :</label>
        <input type='text' name='taille' /></input>
        <label for="genre">Genre :</label>
        <select name="genre">
          <option value="Mâle">Mâle</option>
          <option value="Femelle">Femelle</option>
        </select>
        <label for="castre">Castre :</label>
        <select name="castre">
          <option value="1">Oui</option>
          <option value="0">Non</option>
        </select>
        <label for="poids">Poids :</label>
        <input type='text' name='poids' /></input>
        <input class='button success' type='submit' name='ajouter' value='Ajouter...' /></input>
      </form>
    </div>
    <?php if (isset($reponse)) { ?>
      <p class="<?php echo $reponse['type']; ?>"><?php echo $reponse['message']; ?></p>
    <?php
    }
    ?>
  </main>
  <?php include_once('includes/footer.html') ?>

  <script>
    function toggleSelect(selectedOwnerType) {
      var particulierSelect = document.forms['addAnimal'].elements["id_particulier"];
      var organismeSelect = document.forms['addAnimal'].elements["id_organisme"];
      if (selectedOwnerType === 'particulier') {
        particulierSelect.style.display = "block";
        organismeSelect.style.display = "none";
      } else {
        particulierSelect.style.display = "none";
        organismeSelect.style.display = "block";
      }
    }

    var ownerTypeRadios = document.forms['addAnimal'].elements["typeProprietaire"];
    for (var i = 0; i < ownerTypeRadios.length; i++) {
      ownerTypeRadios[i].onclick = function() {
        toggleSelect(this.value);
      };
    }

    toggleSelect('particulier');
  </script>
</body>

</html>