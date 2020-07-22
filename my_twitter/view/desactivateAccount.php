<?php
require_once("header.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desactivation du compte</title>
</head>

<body>
    <form action="../controller/globalControl.php" method="POST">
    <label for="motdepasse">Saisissez votre mot de passe pour désactivez votre comtpe:</label>
    <input type="password" name="mdp">
    <input type="submit" name="desactiver" value="Désactiver le compte">
    
    </form>

</body>

</html>