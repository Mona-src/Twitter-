<?php
class ConnectionBDD{

    protected function conn(){
        
        $host = "localhost";
        $username = "root";
        $password = "root";

        try{
            $connexion = new PDO("mysql:host=$host;dbname=common-database",$username,$password);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           /* echo "Connexion réussie";*/
        }

        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
        return $connexion;
    } 
}

?>