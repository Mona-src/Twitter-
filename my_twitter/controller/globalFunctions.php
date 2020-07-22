<?php

require_once("../model/manageUser.php");

class GlobalFunctions
{

    /*
    
        fonction getPostTime

        -Prend en paramètre une date
        -On converti cette date en type DateTime
        -En fait un switch pour traduire le nom des mois (EN -> FR)
        -On formatte ensuite la date pour l'afficher en dessous de chaque tweet
        -On renvoie la chaîne de caractère formattée
    
    */
    public function getPostTime($date)
    {
        $date = new DateTime($date);

        switch ($date->format("M")) {
            case "Jan":
                $month = "Janv.";
                break;
            case "Feb":
                $month = "Fév.";
                break;
            case "Mar":
                $month = "Mars";
                break;
            case "Apr":
                $month = "Avril";
                break;
            case "May":
                $month = "Mai";
                break;
            case "Jun":
                $month = "Juin";
                break;
            case "Jul":
                $month = "Juil.";
                break;
            case "Aug":
                $month = "Août";
                break;
            case "Sep":
                $month = "Sep.";
                break;
            case "Oct":
                $month = "Oct.";
                break;
            case "Nov":
                $month = "Nov.";
                break;
            case "Dec":
                $month = "Dec.";
                break;
        }

        $postTime = "Le " . $date->format("d") . " " . $month . " " . $date->format("Y") . " à " . $date->format("H") . ":" . $date->format("i") . ":" . $date->format("s");

        return $postTime;
    }

    /*
    
        fonction convertHashtag

        -Prend en paramètre un message (provenant d'un tweet)
        -On range dans le tableau $allTags toutes les chaînes de caracères
            qui sont comme ' #texte '
        -Pour tous les hashtag trouvés, on remplace chacuns d'eux
            par une balise <a> renvoyant vers la page de recherche 'search.php'
            dans la chaîne de caractère $message passé en paramètre
        -On renvoie $message
    
    */
    public function convertHashtag($message)
    {

        preg_match_all('/(#){1}(\S)+/', $message, $allTags);

        $allTags = $allTags[0];

        foreach ($allTags as $key => $tag) {
            $tagValue = str_replace("#", "", $tag);
            $message = str_replace($tag, "<a href='search.php?search=%23$tagValue'>$tag</a>", $message);
        }

        return $message;
    }

    public function convertUsernameTags($message)
    {

        $userManager = new ManageUser;

        preg_match_all('/(@){1}(\S)+/', $message, $allUserTags);

        $allUserTags = $allUserTags[0];

        foreach ($allUserTags as $key => $tag) {
            $username = str_replace("@", "", $tag);

            $message = str_replace($tag, "<a href='profile_view.php?id=$username'>$tag</a>", $message);
        }

        return $message;
    }
}
