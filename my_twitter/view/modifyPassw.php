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
        } else if (isset($_SESSION["error-passw"])) { ?>
            <div class="alert alert-danger">
                Votre nouveau mot de passe ne correspond pas au bon format (Lettre majuscule, minuscule, caractère spécial, entre et 15 caractères).
            </div>
        <?php
            unset($_SESSION["error-passw"]);
        } else if (isset($_SESSION["confirm-error"])) { ?>
            <div class="alert alert-danger">
                Les mots de passes ne sont pas identiques.
            </div>
        <?php
            unset($_SESSION["confirm-error"]);
        } ?>
        <form action="../controller/globalControl.php" method="POST" id="modify-form">
            <label for="oldpassw">Saisissez votre ancien mot de passe:</label>
            <input type="password" name="passwconfirm" />
            </br>
            <label for="">Saisissez votre nouveau mot de passe:</label>
            <input type="password" name="newpassw" />
            </br>
            <label for="">Confirmez votre nouveau mot de passe:</label>
            <input type="password" name="confirmpassw" />
            </br>
            <input type="submit" class="btn btn-success" value="Modifier mon mot de passe" name="envoyer" />
        </form>
    </div>
    <div class="col-3"></div>
</div>
</main>
</body>

</html>