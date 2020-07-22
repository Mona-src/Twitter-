<?php

require_once("../model/manageUser.php");

header("content-type: application/json");

if (isset($_GET["follower-username"])) {
    $username = trim($_GET["follower-username"]);
    $username = substr($username, 1);

    $userManager = new ManageUser;

    $userId = $userManager->getUserId($username, "username");

    $followers = $userManager->getFollowers($userId);

    $followers = json_encode($followers);

    echo $followers;
}


if (isset($_GET["following-username"])) {
    $username = trim($_GET["following-username"]);
    $username = substr($username, 1);

    $userManager = new ManageUser;

    $userId = $userManager->getUserId($username, "username");

    $following = $userManager->getFollowing($userId);

    $following = json_encode($following);

    echo $following;
}