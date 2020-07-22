<?php

if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../webroot/CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="../webroot/CSS/main.css" />
    <link rel="stylesheet" href="../webroot/CSS/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../webroot/javaScript/login.js"></script>
        <script src="../webroot/javaScript/login_check.js"></script>
    <title> Connexion </title>
</head>

<body>

    <main class="container-fluid">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <?php if (isset($_SESSION["wrong-login"])) { ?>
                    <div class="alert alert-danger">
                        Identifiant incorrect.
                    </div>
                <?php
                    session_destroy();
                } else if (isset($_SESSION["wrong-passw"])) { ?>
                <div class="alert alert-danger">
                        Mot de passe incorrect.
                    </div>
                <?php
                    session_destroy();
                } ?>
                <form action="../controller/globalControl.php" method="POST" id="connexion-form">
                    <h1> Connexion </h1>
                    <br>
                    <div class="email">
                    <p id="error-email" class="hidden error-message">Votre email n'est pas au bon format.</p>
                        <label for="email" id="labelid">Adresse mail </label>
                        <input type="email" placeholder="Email" name="connexion" id="identifiant" class="form-control" aria-describedby="emailHelp">
                        <small id="emailHelp">Nous ne partagerons jamais vos informations.</small>
                        <br>
                        <input type="button" id="switch" value="Phone number" />
                    </div>
                    <div class="mdp">
                    <p id="error-passw" class="hidden error-message">Il y a un problème avec votre email ou votre mot de passe, veuillez ré-essayer.</p>
                        <label for="password" id="passw">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <small id="emailHelp" for="exampleCheck1">Se souvenir de mon mot de passe</small>
                    </div>
                    <button id="connect" type="submit" class="btn btn-primary"> Se connecter </button>
                    </br>
                    <a href="inscription.php">S'inscire!</a>
                    <a href="forgotpassw.php">Mot de passe oublié?</a>
            </div>
            <div class="col-3"></div>
        </div>
    </main>

    <script src="../webroot/javaScript/jQuery.js"></script>
    <script src="../webroot/javaScript/login.js"></script>
</body>

</html>