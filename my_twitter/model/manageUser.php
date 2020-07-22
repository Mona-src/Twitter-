<?php
require_once "database.php";
class ManageUser extends ConnectionBDD
{
    public function addUser($mail, $fullname, $username, $passw, $date_naissance, $pays, $ville, $genre, $tel, $site_web)
    {
        try {
            $connexion = $this->conn();
            $request_members = "INSERT INTO members(
                                                mail, 
                                                fullname, 
                                                username, 
                                                passw, 
                                                date_inscription,
                                                date_naissance, 
                                                etat_compte, 
                                                avatar, 
                                                banner, 
                                                pays, 
                                                ville, 
                                                biography, 
                                                genre, 
                                                tel, 
                                                site_web, 
                                                light_mode
                                            )
                                VALUES (
                                    :email,
                                    :fullname,
                                    :username,
                                    :mdp,
                                    NOW(),
                                    :date_naissance,
                                    '1',
                                    '',
                                    '',
                                    :pays,
                                    :ville,
                                    '',
                                    :genre,
                                    :telephone,
                                    :web, 
                                    'on'
                                );";

            $result_members = $connexion->prepare($request_members);
            $result_members->bindParam(':email', $mail, PDO::PARAM_STR);
            $result_members->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $result_members->bindParam(':username', $username, PDO::PARAM_STR);
            $result_members->bindParam(':mdp', $passw, PDO::PARAM_STR);
            $result_members->bindParam(':date_naissance', $date_naissance);
            $result_members->bindParam(':pays', $pays, PDO::PARAM_STR);
            $result_members->bindParam(':ville', $ville, PDO::PARAM_STR);
            $result_members->bindParam(':genre', $genre, PDO::PARAM_STR);
            $result_members->bindParam(':telephone', $tel, PDO::PARAM_STR);
            $result_members->bindParam(':web', $site_web, PDO::PARAM_STR);
            $result_members->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUserId($info, $champ)
    {
        $request = "SELECT id FROM members WHERE $champ = :info;";

        try {
            $connexion = $this->conn();
            $getUserId = $connexion->prepare($request);
            $getUserId->bindParam(':info', $info);
            $getUserId->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        $userId = $getUserId->fetchAll();
        if (!empty($userId)) {
            return $userId[0]["id"];
        }
    }

    public function isMailTaken($mail)
    {
        $request = "SELECT * FROM members WHERE mail = :mail;";

        try {
            $connexion = $this->conn();
            $verifMail = $connexion->prepare($request);
            $verifMail->bindParam(':mail', $mail, PDO::PARAM_STR);
            $verifMail->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        if ($verifMail->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isUsernameTaken($username)
    {
        $request = "SELECT * FROM members WHERE username = :username;";

        try {
            $connexion = $this->conn();
            $verifUsername = $connexion->prepare($request);
            $verifUsername->bindParam(':username', $username, PDO::PARAM_STR);
            $verifUsername->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        if ($verifUsername->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isPhoneTaken($phone)
    {
        $request = "SELECT * FROM members WHERE tel = :phone;";

        try {
            $connexion = $this->conn();
            $verifPhone = $connexion->prepare($request);
            $verifPhone->bindParam(':phone', $phone, PDO::PARAM_STR);
            $verifPhone->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        if ($verifPhone->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyUser($info, $champ, $password)
    {
        $request = "SELECT * FROM members WHERE $champ = :info;";

        try {
            $connexion = $this->conn();
            $verifyUser = $connexion->prepare($request);
            $verifyUser->bindParam(':info', $info, PDO::PARAM_STR);
            $verifyUser->execute();
            $results = $verifyUser->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        if (empty($results)) {
            return "wrong-login";
        }

        $password = hash('ripemd160', $password . 'vive le projet tweet_academy');

        if ($results[0]["passw"] !== $password) {
            return "wrong-passw";
        }
        if ($results[0]["etat_compte"] === "0") {
            return "account-desactivate";
        }

        return true;
    }

    public function updateInfo($id, $newvalue, $champ)
    {
        $request = "UPDATE members SET $champ = :new_value WHERE id = :id;";

        try {
            $connexion = $this->conn();
            $updateInfo = $connexion->prepare($request);
            $updateInfo->bindParam(':new_value', $newvalue);
            $updateInfo->bindParam(':id', $id, PDO::PARAM_INT);
            $updateInfo->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function followUser($id_follower, $id_following)
    {
        $request = "INSERT INTO follow(`id_follower`, `id_following`, `date_follow`) VALUES (:id_follower, :id_following, now());";

        try {
            $connexion = $this->conn();
            $followUser = $connexion->prepare($request);
            $followUser->bindParam(':id_follower', $id_follower, PDO::PARAM_INT);
            $followUser->bindParam(':id_following', $id_following, PDO::PARAM_INT);
            $followUser->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
            return false;
        }
    }

    public function unfollowUser($id_follower, $id_following)
    {
        $request = "DELETE FROM `follow` WHERE id_follower = :id_follower AND id_following = :id_following;";

        try {
            $connexion = $this->conn();
            $followUser = $connexion->prepare($request);
            $followUser->bindParam(':id_follower', $id_follower, PDO::PARAM_INT);
            $followUser->bindParam(':id_following', $id_following, PDO::PARAM_INT);
            $followUser->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUserInfo($id)
    {
        $request = "SELECT * FROM members WHERE id = :id;";

        try {
            $connexion = $this->conn();
            $getUserInfo = $connexion->prepare($request);
            $getUserInfo->bindParam(':id', $id, PDO::PARAM_INT);
            $getUserInfo->execute();
            $userInfos = $getUserInfo->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return $userInfos;
    }

    public function getFollowers($id)
    {
        $request = "SELECT * FROM follow INNER JOIN members ON follow.id_follower = members.id WHERE id_following = :id";
        try {
            $connexion = $this->conn();
            $getFollowers = $connexion->prepare($request);
            $getFollowers->bindParam(':id', $id, PDO::PARAM_INT);
            $getFollowers->execute();
            $followers = $getFollowers->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $followers;
    }

    public function getFollowing($id)
    {
        $request = "SELECT * FROM follow INNER JOIN members ON follow.id_following = members.id WHERE id_follower = :id;";
        try {
            $connexion = $this->conn();
            $getFollowing = $connexion->prepare($request);
            $getFollowing->bindParam(':id', $id, PDO::PARAM_INT);
            $getFollowing->execute();
            $followings = $getFollowing->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $followings;
    }

    public function getNumberFollower($id)
    {
        $request = "SELECT count(id_follower) FROM follow WHERE id_following = :id";
        try {
            $connexion = $this->conn();
            $getFollowers = $connexion->prepare($request);
            $getFollowers->bindParam(':id', $id, PDO::PARAM_INT);
            $getFollowers->execute();
            $numberFollowers = $getFollowers->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $numberFollowers[0][0];
    }

    public function getNumberFollowing($id)
    {
        $request = "SELECT count(id_following) FROM follow WHERE id_follower = :id;";
        try {
            $connexion = $this->conn();
            $getFollowing = $connexion->prepare($request);
            $getFollowing->bindParam(':id', $id, PDO::PARAM_INT);
            $getFollowing->execute();
            $numberFollowing = $getFollowing->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $numberFollowing[0][0];
    }

    public function desactivateUser($id)
    {
        $request = "UPDATE members SET etat_compte = 0 WHERE id = :id";
        try {
            $connexion = $this->conn();
            $desactivateUser = $connexion->prepare($request);
            $desactivateUser->bindParam(':id', $id, PDO::PARAM_INT);
            $desactivateUser->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function isFollowing($id_user, $id_to_check)
    {
        $request = "SELECT * FROM follow WHERE id_follower = :id_user AND id_following = :id_following";
        try {
            $connexion = $this->conn();
            $checkUser = $connexion->prepare($request);
            $checkUser->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $checkUser->bindParam(':id_following', $id_to_check, PDO::PARAM_INT);
            $checkUser->execute();
            $result = $checkUser->fetchAll();
            if (empty($result)) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function isFollowed($id_user, $id_to_check)
    {
        $request = "SELECT * FROM follow WHERE id_following = :id_user AND id_follower = :id_follower";
        try {
            $connexion = $this->conn();
            $checkUser = $connexion->prepare($request);
            $checkUser->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $checkUser->bindParam(':id_follower', $id_to_check, PDO::PARAM_INT);
            $checkUser->execute();
            $result = $checkUser->fetchAll();
            if (empty($result)) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
