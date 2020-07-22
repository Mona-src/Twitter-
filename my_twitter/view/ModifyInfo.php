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
            <br>
            <br>

            <label for="newcity" class="city">Nouvelle ville:</label>
            <input type="text" name="newcity">
            </br>
            <label for="confirmcity">Confirmez votre ville:</label>
            <input type="text" name="confirmcity">
            </br>
            <input type="submit" name="city" class="btn btn-success" value="Modifiez ma ville" >
          

            <br>
            <br>
            <label for="newcountry" class="country">Nouveau pays:</label>
            <input type="text" name="newcountry">
            </br>
            <label for="confirmcountry">Confirmez votre pays:</label>
            <input type="text" name="confirmcountry">
            </br>
            <input type="submit" name="country" class="btn btn-success" value="Modifiez mon pays" >
            
            <br>
            <br>
            <label for="newname" class="name" >Nouveau nom:</label>
            <input type="text" name="newname">
            </br>
            <label for="confirmname">Confirmez votre nom:</label>
            <input type="text" name="confirmname">
            </br>
            <input type="submit" name="name" class="btn btn-success" value="Modifiez mon pays" >
       
        </form>
    </div>
    <div class="col-3"></div>
</div>
</main>
</body>

</html>