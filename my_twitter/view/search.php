<?php
require_once("header.php");
require_once("../model/tweetManager.php");
require_once("../controller/globalFunctions.php");

$tweetManager = new TweetManager;
$functions = new GlobalFunctions;
?>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="GET" id="search-form">
            <h1> Les réseaux sociaux, c'est savoir s'aimer, et se faire aimer. </h1>

            <input type="text" id="name" name="search" />
            <input type="submit" value="send" />

            <?php
            if (isset($_GET["search"]) && $_GET["search"] !== "") {
                $tweets = $tweetManager->searchTweets($_GET["search"]);

                foreach ($tweets as $key => $tweet) {

                    $postTime = $functions->getPostTime($tweet["date_sent"]);
                    $message = $functions->convertHashtag($tweet["message"]);
                    $message = $functions->convertUsernameTags($message);
            ?>
                    <div class="card tweet-card">
                        <div class="card-body">
                            <p class="card-title"><?php echo $tweet["fullname"]; ?></p>
                            <a class="card-subtitle mb-2 text-muted" href="<?php echo 'profile_view.php?id=' . $tweet["id_user"] ?>">@<?php echo $tweet["username"]; ?></a>
                            <p class="card-text tweet-message"><?php echo $message; ?></p>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn"><img src="../webroot/images/like.PNG" /><?php echo $tweet["fav_counter"]; ?></button>
                                <button type="button" class="btn"><img src="../webroot/images/rt.PNG" /><?php echo $tweet["rt_counter"]; ?></button>
                                <button type="button" class="btn"><img src="../webroot/images/comm_tweet.png" /><?php echo $tweet["comm_counter"]; ?></button>
                            </div>
                        </div>
                        <p class="card-text post-time"><?php echo $postTime; ?></p>
                    </div>
            <?php
                }
            }

            ?>
    </div>
    <div class="col-3"></div>
</div>
</main>
</body>

</html>