<?php
require_once('../model/manageUser.php');
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["count_notif"])) {
    $_SESSION["count_notif"] = 0;
}

if (!isset($_SESSION["user-id"])) {
    header("Location: ../index.php");
} else {
    $userManager = new ManageUser;
    $userInfos = $userManager->getUserInfo($_SESSION["user-id"]);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tweetech</title>
    <link rel="stylesheet" href="../webroot/CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="../webroot/CSS/header.css" />
    <link rel="stylesheet" href="../webroot/CSS/main.css" />
    <?php if (strpos($_SERVER["REQUEST_URI"], "accueil")) { ?>
        <link rel="stylesheet" href="../webroot/CSS/accueil.css" />
    <?php } else if (strpos($_SERVER["REQUEST_URI"], "search")) { ?>
        <link rel="stylesheet" href="../webroot/CSS/search.css" />
    <?php } else if (strpos($_SERVER["REQUEST_URI"], "settings")) { ?>
        <link rel="stylesheet" href="../webroot/CSS/settings.css" />
    <?php } else if (strpos($_SERVER["REQUEST_URI"], "search")) { ?>
        <link rel="stylesheet" href="../webroot/CSS/search.css" />
    <?php } else if (strpos($_SERVER["REQUEST_URI"], "profil")) { ?>
        <link rel="stylesheet" href="../webroot/CSS/profil.css" />
    <?php } else if (strpos($_SERVER["REQUEST_URI"], "modify")) { ?>
        <link rel="stylesheet" href="../webroot/CSS/settings_modify.css" />
    <?php }
    if ($userInfos[0]["light_mode"] === "on") { ?>
        <link rel="stylesheet" href="../webroot/CSS/light.css" />
    <?php } else { ?>
        <link rel="stylesheet" href="../webroot/CSS/dark.css" />
    <?php } ?>
</head>

<body>
    <main class="container-fluid">
        <div class="row" id="header">
            <div class="btn-group btn-group-lg col-12" id="header-link-container">
                <button type="button" class="btn header-button"><a href="accueil.php">Accueil</a></button>
                <button type="button" class="btn header-button"><a href="search.php">Rechercher</a></button>
                <button type="button" class="btn header-button"><a href="profile_view.php">Profil</a></button>
                <button type="button" class="btn header-button"><a href="messages.php">Messages</a></button>

                <button type="button" class="btn header-button"><a href="notifs.php">Notification(s) <span class="badge badge-light"><?php echo $_SESSION["count_notif"]; ?></span></a></button>
                <button type="button" class="btn header-button"><a href="settings.php">Paramètres</a></button>
            </div>
        </div>