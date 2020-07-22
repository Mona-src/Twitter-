<?php
require_once("header.php");
?>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <?php if (isset($_SESSION["wrong-passw"])) { ?>
            <div class="alert alert-danger">
                Mot de passe incorrect.
            </div>
        <?php
            unset($_SESSION["wrong-passw"]);
        } else if (isset($_SESSION["change-error"])) { ?>
            <div class="alert alert-danger">
                Une erreur s'est produite, veuillez rééssayer ultérieurement.
            </div>
        <?php
            unset($_SESSION["change-error"]);
        } else if (isset($_SESSION["error-tel"])) { ?>
            <div class="alert alert-danger">
                Votre nouveau numéro n'est pas au bon format.
            </div>
        <?php
            unset($_SESSION["error-tel"]);
        } else if (isset($_SESSION["error-confirm"])) { ?>
            <div class="alert alert-danger">
                Les numéros ne sont pas identiques.
            </div>
        <?php
            unset($_SESSION["error-confirm"]);
        } ?>
        <form action="../controller/globalControl.php" method="POST" id="modify-form">
            <label for=passwconfirm>Saisissez votre mot de passe:</label>
            <input type="password" name="passwconfirm" />
            </br>
            <label for="changenumber">Changez votre numéro de téléphone:</label>
            <input type="text" name="newnumber" />
            </br>
            <label for="confirmnumber">Confirmez votre nouveau numéro:</label>
            <input type="text" name="confirmnumber" id="confirmnumber" />
            </br>
            <input type="submit" class="btn btn-success" value="Envoyer" name="envoyer" />
    </div>
    <div class="col-3"></div>
</div>
</main>
</body>

</html>