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
        } else if (isset($_SESSION["error-mail"])) { ?>
            <div class="alert alert-danger">
                Votre nouvelle adresse mail n'est pas au bon format.
            </div>
        <?php
            unset($_SESSION["error-mail"]);
        } else if (isset($_SESSION["confirm-error"])) { ?>
            <div class="alert alert-danger">
                Les adresses mails ne sont pas identiques.
            </div>
        <?php
            unset($_SESSION["confirm-error"]);
        } ?>
        <form action="../controller/globalControl.php" method="POST" id="modify-form">
            <label for="passwconfirm">Saisissez votre mot de passe:</label>
            <input type="password" name="passwconfirm">
            </br>
            <label for="newmail" class="chmail">Nouvelle adresse mail:</label>
            <input type="text" name="newmail">
            </br>
            <label for="confirmmail">Confirmez votre e-mail:</label>
            <input type="text" name="confirmmail">
            </br>
            <input type="submit" class="btn btn-success" value="Modifiez mon e-mail" name="envoyer">
        </form>
    </div>
    <div class="col-3"></div>
</div>
</main>
</body>

</html>