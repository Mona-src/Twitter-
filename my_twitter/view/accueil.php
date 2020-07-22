<?php

require_once("header.php");

require_once("../model/tweetManager.php");
require_once("../controller/globalFunctions.php");

$tweetManager = new TweetManager;
$functions = new GlobalFunctions;

$tweets = $tweetManager->getAllTweet($_SESSION["user-id"]);

?>

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <form action="../controller/globalControl.php" method="POST" id="tweet-area">
            <textarea name="tweet" id="write-tweet-container"></textarea>
            <input type="submit" id="submit-tweet" name="submit-tweet" value="Tweeter" class="btn btn-info" disabled />
            <small id="char-count">0/140</small>
        </form>
        <?php
        if (!empty($tweets)) {
            foreach ($tweets as $key => $tweet) {

                $postTime = $functions->getPostTime($tweet["date_sent"]);
                $message = $functions->convertHashtag($tweet["message"]);
                $message = $functions->convertUsernameTags($message);
        ?>
                <div class="card tweet-card">
                    <div class="card-body">
                        <?php if ($tweet["date_rt"] !== null) { ?>
                            <p>Vous avez retweeté</p>
                        <?php } ?>
                        <p class="card-title"><?php echo $tweet["fullname"]; ?></p>
                        <a class="card-subtitle mb-2 text-muted" href="<?php echo 'profile_view.php?id=' . $tweet["username"] ?>">@<?php echo $tweet["username"]; ?></a>
                        <p class="card-text tweet-message"><?php echo $message; ?></p>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn" id="button-like"><img src="../webroot/images/like.PNG" /><?php echo $tweet["fav_counter"]; ?></button>
                            <button type="button" class="btn" id="button-rt">
                                <?php if ($tweet["date_rt"] !== null) { ?>
                                    <img src="../webroot/images/rted.PNG" />
                                <?php } else { ?>
                                    <img src="../webroot/images/rt.PNG" />
                                <?php } ?>
                                <?php echo $tweet["rt_counter"]; ?></button>
                            <button type="button" class="btn" id="button-comm"><img src="../webroot/images/comm_tweet.png" /><?php echo $tweet["comm_counter"]; ?></button>
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
    <div class="col-md-3">
    </div>
</div>

</main>

<script src="../webroot/javaScript/jQuery.js"></script>
<script src="../webroot/javaScript/countCharTweet.js"></script>
<script src="../webroot/javaScript/rt.js"></script>

</body>

</html>