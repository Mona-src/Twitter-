<?php
require_once "../model/manageUser.php";
require_once "../model/tweetManager.php";
require_once "globalFunctions.php";

class Action
{
    public function RegisterAction()
    {

        $userManager = new Manageuser();
        $mail = $_POST['email-inscription'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $passw = hash('ripemd160', $_POST['password'] . 'vive le projet tweet_academy');
        $date_naissance = $_POST['date-naissance'];
        $pays = $_POST['pays'];
        $ville = $_POST['ville'];
        $genre = $_POST['genre'];
        $tel = $_POST['tel'];
        $site_web = $_POST['web'];

        session_start();

        if ($userManager->isMailTaken($mail)) {
            $_SESSION["error-mail-taken"] = true;
            header("Location: ../view/inscription.php");
            return false;
        }

        if ($userManager->isUsernameTaken($username)) {
            $_SESSION["error-username-taken"] = true;
            header("Location: ../view/inscription.php");
            return false;
        }

        if (!empty($tel)) {
            if ($userManager->isPhoneTaken($tel)) {
                $_SESSION["error-phone-taken"] = true;
                header("Location: ../view/inscription.php");
                return false;
            }
        }


        $userManager->adduser($mail, $fullname, $username, $passw, $date_naissance, $pays, $ville, $genre, $tel, $site_web);

        $user_id = $userManager->getUserId($mail, "mail");

        $_SESSION["user-id"] = $user_id;

        header("Location: ../view/accueil.php");

        return true;
    }

    public function LoginAction()
    {
        $userManager = new Manageuser();
        $info = $_POST["connexion"];
        $password = $_POST["password"];

        session_start();

        if (preg_match("/(.)+(@){1}(.)+(\.){1}(.){2,}/", $info) === 1) {
            if ($userManager->verifyUser($info, "mail", $password) === "wrong-login") {
                $_SESSION["wrong-login"] = true;
                header("Location: ../view/connexion.php");
                return false;
            } else if ($userManager->verifyUser($info, "mail", $password) === "wrong-passw") {
                $_SESSION["wrong-passw"] = true;
                header("Location: ../view/connexion.php");
                return false;
            }

            $user_id = $userManager->getUserId($info, "mail");
        } else if (preg_match("/(0){1}(\d){9}/", $info) === 1) {
            if ($userManager->verifyUser($info, "tel", $password) === "wrong-login") {
                $_SESSION["wrong-login"] = true;
                header("Location: ../view/connexion.php");
                return false;
            } else if ($userManager->verifyUser($info, "tel", $password) === "wrong-passw") {
                $_SESSION["wrong-passw"] = true;
                header("Location: ../view/connexion.php");
                return false;
            }

            $user_id = $userManager->getUserId($info, "tel");
        }

        $_SESSION["user-id"] = $user_id;


        header("Location: ../view/accueil.php");

        return true;
    }

    public function UpdatePassw()
    {
        session_start();
        $updatePassw = new ManageUser;

        if (preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]){8,15}$/", $_POST['newpassw'])) {

            if ($updatePassw->verifyUser($_SESSION['user-id'], 'id', $_POST["passwconfirm"]) === "wrong-passw") {
                $_SESSION['wrong-passw'] = true;
                header('Location: ../view/modifyPassw.php');
                return false;
            }
            $password = hash('ripemd160', $_POST["newpassw"] . 'vive le projet tweet_academy');
            $confirmPassword = hash('ripemd160', $_POST["confirmpassw"] . 'vive le projet tweet_academy');
            if ($password !== $confirmPassword) {
                $_SESSION['confirm-error'] = true;
                header('Location: ../view/modifyPassw.php');
                return false;
            }
            if ($updatePassw->UpdateInfo($_SESSION['user-id'], $password, 'passw')) {
                $_SESSION['change-done'] = true;

                header('Location: ../view/settings.php');
                return true;
            }
            $_SESSION['change-error'] = true;
            header('Location: ../view/modifyPassw.php');
            return false;
        }
        $_SESSION['error-passw'] = true;
        header('Location: ../view/modifyPassw.php');
        return false;
    }

    public function UpdateMail()
    {
        session_start();
        $updateMail = new ManageUser;
        if (preg_match("/(.)+(@){1}(.)+(\.){1}(.){2,}/", $_POST['newmail'])) {
            if ($updateMail->verifyUser($_SESSION['user-id'], 'id', $_POST["passwconfirm"]) === "wrong-passw") {
                $_SESSION['wrong-passw'] = true;
                header('Location: ../view/modifyMail.php');
                return false;
            }
            $mail = $_POST['newmail'];
            $confirmMail = $_POST["confirmmail"];
            if ($mail !== $confirmMail) {
                $_SESSION['confirm-error'] = true;
                header('Location: ../view/modifyMail.php');
                return false;
            }
            if ($updateMail->UpdateInfo($_SESSION['user-id'], $mail, 'mail')) {
                $_SESSION['change-done'] = true;

                header('Location: ../view/settings.php');
                return true;
            }
            $_SESSION['change-error'] = true;
            header('Location: ../view/modifyMail.php');
            return false;
        }
        $_SESSION['error-mail'] = true;
        header('Location: ../view/modifyMail.php');
        return false;
    }

    public function UpdateNumber()
    {
        session_start();
        $updateNumber = new ManageUser;
        if (preg_match("/(0){1}(\d){9}/", $_POST['newnumber'])) {
            if ($updateNumber->verifyUser($_SESSION['user-id'], 'id', $_POST["passwconfirm"]) === "wrong-passw") {
                $_SESSION['wrong-passw'] = true;
                header('Location: ../view/modifyNumber.php');
                return false;
            }
            $number = $_POST['newnumber'];
            $confirmNumber = $_POST["confirmnumber"];
            if ($number !== $confirmNumber) {
                $_SESSION['error-confirm'] = true;
                header('Location: ../view/modifyNumber.php');
                return false;
            }
            if ($updateNumber->UpdateInfo($_SESSION['user-id'], $number, 'tel')) {
                $_SESSION['change-done'] = true;
                header('Location: ../view/settings.php');
                return true;
            }
            $_SESSION['change-error'] = true;
            header('Location: ../view/modifyNumber.php');
            return false;
        }
        $_SESSION['error-tel'] = true;
        header('Location: ../view/modifyNumber.php');
        return false;
    }
    public function UpdateUsername()
    {
        session_start();
        $updateUsername = new ManageUser;
        if (!preg_match("/[!@#$%^&*()+\=\[\]{};':\|,.<>\/?\"]/", $_POST['newusername'])) {
            if ($updateUsername->verifyUser($_SESSION['user-id'], 'id', $_POST["passwconfirm"]) === "wrong-passw") {
                $_SESSION['wrong-passw'] = true;
                header('Location: ../view/modifyUsername.php');

                return false;
            }
            $username = $_POST['newusername'];
            $confirmUsername = $_POST["confirmusername"];
            if ($username !== $confirmUsername) {
                $_SESSION['confirm-error'] = true;
                header('Location: ../view/modifyUsername.php');
                return false;
            }
            if (strlen($username) < 5) {
                $_SESSION['length-error'] = true;
                header('Location: ../view/modifyUsername.php');
                return false;
            }
            if ($updateUsername->UpdateInfo($_SESSION['user-id'], $username, 'username')) {
                $_SESSION['change-done'] = true;
                header('Location: ../view/settings.php');
                return true;
            }
            $_SESSION['change-error'] = true;
            header('Location: ../view/modifyUsername.php');
            return false;
        }
        $_SESSION['error-passw'] = true;
        header('Location: ../view/modifyUsername.php');
        return false;
    }
    public function DesactivateAccount()
    {
        session_start();

        $desactivateAccount = new ManageUser;
        if ($desactivateAccount->verifyUser($_SESSION['user-id'], 'id', $_POST["mdp"]) === "wrong-passw") {
            $_SESSION['wrong-passw'] = true;
            header('Location: ../view/desactivateAccount.php');

            return false;
        }
        if ($desactivateAccount->UpdateInfo($_SESSION['user-id'], 0, 'etat_compte')) {
            $_SESSION['change-done'] = true;
            header('Location: ../controller/logout.php');
            return true;
        }
        $_SESSION['change-error'] = true;
        header('Location: ../view/desactivateAccount.php');
        return false;
    }

    public function Tweet()
    {
        session_start();

        $tweetManager = new TweetManager;

        $tweetManager->addTweet($_SESSION['user-id'], $_POST['tweet']);

        header("Location: ../view/profile_view.php");
    }

    public function Follow()
    {
        session_start();
        $userManager = new ManageUser;

        $id_following = $userManager->getUserId($_POST["username"], "username");

        if ($userManager->followUser($_SESSION["user-id"], $id_following)) {
            $_SESSION["follow"] = true;
            header("Location: ../view/profile_view.php?id=" . $_POST["username"] . "");
            return true;
        }

        $_SESSION["error"] = true;
        header("Location: ../view/profile_view.php?id=" . $_POST["username"] . "");
        return false;
    }

    public function Unfollow()
    {
        session_start();
        $userManager = new ManageUser;

        $id_following = $userManager->getUserId($_POST["username"], "username");

        if ($userManager->unfollowUser($_SESSION["user-id"], $id_following)) {
            $_SESSION["unfollow"] = true;
            header("Location: ../view/profile_view.php?id=" . $_POST["username"] . "");
            return true;
        }

        $_SESSION["error"] = true;
        header("Location: ../view/profile_view.php?id=" . $_POST["username"] . "");
        return false;
    }

    public function UpdateInfo()
    {
        session_start();

        $update = new ManageUser;
        $functions = new GlobalFunctions;

        $errors = 0;

        if (preg_match("/[!@#%^&*+\=\[\]{};':\|,.<>\/?\"]/", $_POST['fullname'])) {
            $_SESSION["fullname-error"] = true;
            $errors++;
        } else {
            $update->updateInfo($_SESSION['user-id'], $_POST['fullname'], 'fullname');
        }

        if (preg_match("/[!@#$%^&*()+\=\[\]{};':\|,.<>\/?\"]/", $_POST['city'])) {
            $_SESSION["city-error"] = true;
            $errors++;
        } else {
            $update->updateInfo($_SESSION['user-id'], $_POST['city'], 'ville');
        }

        $update->updateInfo($_SESSION['user-id'], $_POST['pays'], 'pays');

        if (strlen($_POST["biography"]) <= 140) {
            $update->updateInfo($_SESSION['user-id'], $_POST["biography"], 'biography');
        } else {
            $_SESSION["biography-error"] = true;
            $errors++;
        }

        if (isset($_POST["mode"])) {
            $update->updateInfo($_SESSION['user-id'], "off", 'light_mode');
        } else {
            $update->updateInfo($_SESSION['user-id'], "on", 'light_mode');
        }
        if ($_POST["website"] !== "") {
            if (!preg_match("/^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/", $_POST['website'])) {
                $_SESSION["website-error"] = true;
                $errors++;
            } else {
                $update->updateInfo($_SESSION['user-id'], $_POST['website'], 'site_web');
            }
        }

        if ($errors === 0) {
            $_SESSION['change-done'] = true;
        } else {
            $_SESSION['done-with-errors'] = true;
        }
        header('Location: ../view/settings.php');
        return true;
    }
}
