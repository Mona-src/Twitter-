<?php

require_once("database.php");
require_once("manageUser.php");

class TweetManager extends ConnectionBDD
{
    /*
    
        fonction getUserTweet

        -Prend en paramètre un id utilisateur
        -Requête SQL : On SELECT tous les tweets de la table tweets
            ou l'id utilisateur est celui que l'on a passé en paramètre
            de la fonction
        -On retourne le tableau contenant les lignes résultant
            de la requête (dans $tweets)
    
    */
    public function getUserTweet($id_user)
    {
        $request = "SELECT * FROM tweets INNER JOIN members ON tweets.id_user = members.id WHERE id_user = :id ORDER BY date_sent DESC;";

        try {
            $connexion = $this->conn();
            $getUserTweet = $connexion->prepare($request);
            $getUserTweet->bindParam(':id', $id_user, PDO::PARAM_INT);
            $getUserTweet->execute();
            $tweets = $getUserTweet->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return $tweets;
    }

    /*
    
        fonction addTweet

        -Prend en paramètre un id utilisateur et le message
        -Requête SQL : On INSERT INTO la table tweets les valeurs dynamiques:
            id_user et message, le reste est statique à chaque insertions
    
    */
    public function addTweet($id_user, $message)
    {
        $request = "INSERT INTO `tweets`(`id_user`, `message`, `date_sent`, `fav_counter`, `rt_counter`, `comm_counter`) 
                    VALUES (:id_user, :msg, now(), 0, 0, 0)";

        try {
            $connexion = $this->conn();
            $getUserTweet = $connexion->prepare($request);
            $getUserTweet->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $getUserTweet->bindParam(':msg', $message, PDO::PARAM_STR);
            $getUserTweet->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*
    
        fonction getAllTweet

        -Prend en paramètre un id utilisateur
        -Requête SQL : On SELECT tous les utilisateurs que l'utilsateur connecté
            (identifié par le paramètre de la fonction) suit
        -On stock ces utilisateurs dans le tableau $following
    
    */
    public function getAllTweet($id_user)
    {
        $request = "SELECT * FROM follow WHERE id_follower = :id_user";

        try {
            $connexion = $this->conn();
            $getFollowing = $connexion->prepare($request);
            $getFollowing->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $getFollowing->execute();
            $following = $getFollowing->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        if (empty($following)) {
            return;
        }

        $request = 'SELECT *, rt.date_fav AS "date_rt" FROM tweets 
                    left join rt on tweets.id_tweet = rt.id_tweet 
                    inner join members on tweets.id_user = members.id 
                    where rt.id_user = 17 OR ';

        // Constructeur de requête

        $count = 1; // Compteur pour savoir lorsu'on arrive au dernier index du tableau $following

        // Boucle sur les utilisateurs que la personne suit, pour chaque personne, on ajoute
        // une condition sur l'id utilisateur. On trie par date d'envoie décroissant (plus récent au plus vieux)
        foreach ($following as $key => $value) {
            if (sizeof($following) === $count) {
                $request .= "tweets.id_user = ? ORDER BY date_sent DESC;";
            } else {
                $request .= "tweets.id_user = ? OR ";
            }

            $count++;
        }

        // La requête finale ressemble à (pour 2 utilisateurs suivis) : 
        // SELECT * FROM tweets INNER JOIN members ON tweets.id_user = members.id WHERE id_user = ? AND id_user ? ORDER BY date_sent DESC;

        $count = 1; // Compteur pour savoir lorsu'on arrive au dernier index du tableau $following

        try {
            $connexion = $this->conn();
            $getAllTweet = $connexion->prepare($request);
            // Boucle sur les utilisateurs que la personne suit, pour chaque personne, on bind
            // le paramètre qui lui correspond dans la requête
            foreach ($following as $key => $value) {
                $getAllTweet->bindParam($count, $value["id_following"], PDO::PARAM_STR);
                $count++;
            }
            $getAllTweet->execute();
            $tweets = $getAllTweet->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return $tweets;
    }

    public function searchTweets($search)
    {
        $manageUser = new ManageUser;

        preg_match_all('/(@){1}(\S)+/', $search, $allUserTags);
        preg_match_all('/(#){1}(\S)+/', $search, $allTags);

        $allUserTags = $allUserTags[0];
        $allTags = $allTags[0];

        if (empty($allTags) && empty($allUserTags)) {

            $request = "SELECT * FROM tweets INNER JOIN members on tweets.id_user = members.id WHERE `message` LIKE :search;";

            try {
                $connexion = $this->conn();
                $getTweets = $connexion->prepare($request);
                $search = "%$search%";
                $getTweets->bindParam(':search', $search, PDO::PARAM_STR);
                $getTweets->execute();
                $result = $getTweets->fetchAll();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        } else {

            $request = "SELECT * FROM tweets INNER JOIN members on tweets.id_user = members.id WHERE ";

            foreach ($allTags as $key => $value) {
                $request .= "message LIKE ? OR ";
            }

            foreach ($allUserTags as $key => $value) {
                $request .= "message LIKE ? OR id_user = ? OR ";
            }

            $request = rtrim($request, " OR ");

            $userIds = [];
            foreach ($allUserTags as $key => $value) {
                $value = substr($value, 1);
                array_push($userIds, $manageUser->getUserId($value, "username"));
            }

            try {
                $connexion = $this->conn();
                $getTweets = $connexion->prepare($request);
                $count = 1;
                foreach ($allTags as $key => $value) {
                    $value = "%$value%";
                    $getTweets->bindValue($count, $value, PDO::PARAM_STR);
                    $count++;
                }
                $countId = 0;
                foreach ($allUserTags as $key => $value) {
                    $value = "%$value%";
                    $getTweets->bindValue($count, $value, PDO::PARAM_STR);
                    $count++;
                    $getTweets->bindValue($count, $userIds[$countId], PDO::PARAM_INT);
                    $count++;
                    $countId++;
                }
                $getTweets->execute();
                $result = $getTweets->fetchAll();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }
    }
}
