<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
  </head>
  <body>
    <h1>Rentrez vos identifiants :</h1>
    <br>
    <form action="afficheClient.php" method="post">
      <table>
        <tr>
          <td>Login </td>
          <td><input type="text" name="login"></td>
        </tr>
        <tr>
          <td>Mot de passe </td>
          <td><input type="password" name="mdp"></td>
        </tr>
        <tr>
          <td><input type="reset" value="Annulez" /> <input type="submit" value="Se connecter" /></td>
        </tr>
      </table>
    </form>
  </body>
</html>
