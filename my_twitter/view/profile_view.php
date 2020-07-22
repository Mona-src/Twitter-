<?php
require_once("header.php");
require_once("../model/manageUser.php");
require_once("../model/tweetManager.php");
require_once("../controller/globalFunctions.php");

$infoManager = new manageUser;
$tweetManager = new TweetManager;
$functions = new GlobalFunctions;

if (!isset(($_GET['id']))) {
    $info = $infoManager->getUserInfo($_SESSION["user-id"]);
    $tweets = $tweetManager->getUserTweet($_SESSION["user-id"]);
    $userId = $_SESSION["user-id"];
} else {
    $userId = $infoManager->getUserId($_GET["id"], "username");
    $info = $infoManager->getUserInfo($userId);
    $tweets = $tweetManager->getUserTweet($userId);

    if (empty($info)) { ?>
        <div class="alert alert-danger">
            Cet utilisateur ne possède pas de compte.
        </div>
<?php
        return;
    }
}

$dateRegister = new DateTime($info[0]["date_inscription"]);
$dateRegister = $dateRegister->format("d/m/Y");
$dateNaissance = new DateTime($info[0]["date_naissance"]);
$dateNaissance = $dateNaissance->format("d/m/Y");

$biography = $functions->convertUsernameTags($info[0]["biography"]);

?>

<div class="row">
    <div class="col-2"></div>
    <div class="col-8">

        <?php if (isset($_SESSION["follow"])) { ?>
            <div class="alert alert-success">
                Vous suivez maintenant <?php echo $_GET["id"]; ?>.
            </div>
        <?php
            unset($_SESSION["follow"]);
        } else if (isset($_SESSION["unfollow"])) { ?>
            <div class="alert alert-success">
                Vous ne suivez plus <?php echo $_GET["id"]; ?>.
            </div>
        <?php
            unset($_SESSION["unfollow"]);
        } else if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger">
                Une erreur s'est produite.
            </div>
        <?php
            unset($_SESSION["error"]);
        } ?>

        <div class="modal-custom hidden" id="followers-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Abonné(s)</h5>
                        <button type="button" class="close" id="close-followers-modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="followers-display">

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-custom hidden" id="following-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Abonnement(s)</h5>
                        <button type="button" class="close" id="close-following-modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="following-display">

                    </div>
                </div>
            </div>
        </div>

        <div class="jumbotron" id="profil-container">

            <?php
            if ($info[0]["avatar"] !== '') {
                $avatar = $info[0]["avatar"];
            } else {
                $avatar = "../webroot/images/user.png";
            }
            ?>

            <div id="avatar-display" style="background-image: url('<?php echo $avatar; ?>')"></div>

            <div id="imgid" style="background-image: url('<?php echo $info[0]["banner"] ?>');"> </div>

            <ul class="nav flex-column" id="user-infos">
                <li class="nav-item">
                    <h3><?php echo  $info[0]['fullname']; ?></h3>
                </li>
                <li class="nav-item" id="username-display">
                    <?php echo  "@" . $info[0]['username']; ?>
                </li>
                <li class="nav-item" id="biography-display">
                    Biographie: </br>
                    <?php echo $biography; ?>
                </li>
                <li class="nav-item">
                    Inscrit depuis le <?php echo $dateRegister; ?>
                </li>
                <li class="nav-item">
                    Né le <?php echo $dateNaissance; ?>
                </li>
                <li class="nav-item">
                    Localisation: <?php
                                    echo $info[0]["pays"] . " ";
                                    if ($info[0]["ville"] !== "") {
                                        echo "(" . $info[0]["ville"] . ")";
                                    }; ?>
                </li>
                <li class="nav-item">
                    <button class="btn btn-info" id="followerId">
                        <?php echo $infoManager->getNumberFollower($userId); ?> Abonné(s)
                    </button> /
                    <button class="btn btn-info" id="followingId">
                        <?php echo $infoManager->getNumberFollowing($userId); ?> Abonnement(s)
                    </button>
                </li>
            </ul>

            <?php if ($_SESSION["user-id"] !== $info[0]['id']) {
                if ($userManager->isFollowing($_SESSION["user-id"], $userId)) {
            ?>
                    <form action='../controller/globalControl.php' method='POST'>
                        <input type="hidden" name="username" value="<?php echo $_GET["id"]; ?>" />
                        <input name="user-unfollow" id='button-unfollow' class="follow-button" type='submit' value='Abonné'>
                    </form>
                <?php } else { ?>
                    <form action='../controller/globalControl.php' method='POST'>
                        <input type="hidden" name="username" value="<?php echo $_GET["id"]; ?>" />
                        <input name="user-follow" id='button-follow' class="follow-button" type='submit' value='Suivre'>
                    </form>
                <?php }
            } else { ?>
                <a href="settings.php"><button class="btn btn-outline-primary" id="go-to-settings">Modifier mon profil</button></a>
            <?php } ?>
        </div>

        <div id="profil-nav">
            <ul id="id_nav" class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Tweets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tweets/ Answers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Medias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Likes</a>
                </li>

            </ul>
        </div>

        <form action="../controller/globalControl.php" method="POST" id="tweet-area">
            <textarea name="tweet" id="write-tweet-container"></textarea>
            <input type="submit" id="submit-tweet" name="submit-tweet" value="Tweeter" class="btn btn-info" disabled />
            <small id="char-count">0/140</small>
        </form>

        <div contenteditable="true"></div>

        <?php
        if (!empty($tweets)) {
            foreach ($tweets as $key => $tweet) {

                $postTime = $functions->getPostTime($tweet["date_sent"]);
                $message = $functions->convertHashtag($tweet["message"]);
                $message = $functions->convertUsernameTags($message);
        ?>
                <div class="card tweet-card">
                    <div class="card-body">
                        <p class="card-title"><?php echo $tweet["fullname"]; ?></p>
                        <a class="card-subtitle mb-2 text-muted" href="<?php echo 'profile_view.php?id=' . $tweet["username"] ?>">@<?php echo $tweet["username"]; ?></a>
                        <p class="card-text tweet-message"><?php echo $message; ?></p>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn"><img src="../webroot/images/like.PNG" /><?php echo $tweet["fav_counter"]; ?></button>
                            <button type="button" class="btn"><img src="../webroot/images/rt.PNG" /><?php echo $tweet["rt_counter"]; ?></button>
                            <button type="button" class="btn"><img src="../webroot/images/comm_tweet.png" /><?php echo $tweet["comm_counter"]; ?></button>
                        </div>
                        <p class="card-text post-time"><?php echo $postTime; ?></p>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>

            <div class="alert alert-info" id="no-tweet">Aucuns tweets à afficher.</div>

        <?php
        }
        ?>
    </div>
</div>

<div class="col-2"></div>


</main>
<script src="../webroot/javaScript/jQuery.js"></script>
<script src="../webroot/javaScript/countCharTweet.js"></script>
<script src="../webroot/javaScript/profil.js"></script>
</body>

</html>