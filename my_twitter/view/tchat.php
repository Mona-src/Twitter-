<?php
require_once("header.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
</head>
<body>
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
    <div id="messages"></div>
<form method="POST" action="message.php">
Pseudo : <input type="text" name="pseudo" id="pseudo"/>
Message : <textarea name="message" id="message"></textarea>
<input type="submit" name="submit" value="Envoyez votre message !" id="envoi"/>
</form>
<div class="col-3"></div>
        </div>
    </main>

    <script src="../webroot/javaScript/jQuery.js"></script>
    <script src="../webroot/javaScript/login.js"></script>

</body>
</html>