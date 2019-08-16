<!--creer un deuxième template-->
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Connectez-vous</title>
  <link rel="icon" type="image/x-icon" href="public/images/favicon_2.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="public/images/favicon_2.ico" />
        <link rel="apple-touch-icon" href="public/images/favicon_2.ico" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
        <link href="public/css/style_admin.css" rel="stylesheet" /> 
</head>
<body>
    <h2>Connectez-vous</h2>
  <form method="post" action="index.php?action=admin&amp;status=verification" id="connexion">
    <p>
        <label for="pseudo">Votre pseudo :</label>
        <input type="text" name="pseudo" id="pseudo" />
         
        <br />
        <label for="pass">Votre mot de passe :</label>
        <input type="password" name="pass" id="pass" />

        <br />
        <input type="submit" value="Envoyer" />       
     </p>
  </form>
  <p>
  <?php
    if (isset($_GET['return'])) {
      echo 'veuillez vérifier vos identifiants';
    } 
  ?>      
  </p>
</body>
</html>
