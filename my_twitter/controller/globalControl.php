<?php
require_once "action.php";
$action = new Action;
$user = new manageUser;
if (isset($_POST['email-inscription'])) {
    $action->RegisterAction();
}
if (isset($_POST['connexion'])) {
    $action->LoginAction();
}
if (isset($_POST['newpassw'])) {
    $action->UpdatePassw();
}
if (isset($_POST['newmail'])) {
    $action->UpdateMail();
}
if (isset($_POST['newnumber'])) {
    $action->UpdateNumber();
}
if (isset($_POST['username'])) {
    $action->UpdateUsername();
}
if (isset($_POST['desactiver'])) {
    $action->DesactivateAccount();
}
if (isset($_POST['tweet'])) {
    $action->Tweet();
}
if (isset($_POST['user-follow'])) {
    $action->Follow();
}
if (isset($_POST['user-unfollow'])) {
    $action->Unfollow();
}
if (isset($_POST["update-infos"])) {
    $action->UpdateInfo();
   
    }

