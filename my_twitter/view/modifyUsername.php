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
                Votre nom d'utilisateur ne doit pas contenir de caractère spécial.
            </div>
        <?php
            unset($_SESSION["error-passw"]);
        } else if (isset($_SESSION["confirm-error"])) { ?>
            <div class="alert alert-danger">
                Les nom d'utilisateurs ne sont pas identiques.
            </div>
        <?php
            unset($_SESSION["confirm-error"]);
        } else if (isset($_SESSION["length-error"])) { ?>
            <div class="alert alert-danger">
                Votre nom d'utilisateur doit faire au moins 5 caractères.
            </div>
        <?php
            unset($_SESSION["length-error"]);
        } ?>
        <form action="../controller/globalControl.php" method="POST" id="modify-form">
            <label for="passwconfirm">Saisissez votre ancien mot de passe:</label>
            <input type="password" name="passwconfirm" id="passwconfirm">
            <label for="newusername">Saisissez votre nouveau nom d'utilisateur:</label>
            <input type="text" name="newusername" id="newusername">
            <label for="confirmusername">Confirmez votre nouveau nom:</label>
            <input type="text" name="confirmusername" id="confirmusername">
            </br>
            <input type="submit" class="btn btn-success" value="Modifier mon nom d'utilisateur" name="envoyer">
        </form>
    </div>
    <div class="col-3"></div>
</div>
</main>
</body>

</html>