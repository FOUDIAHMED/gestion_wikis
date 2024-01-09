<?php
require_once('user.php');
require_once ('db_connection.php');
class UserDao{
    private $database;
    public function __construct(){
        $this->database = Database::getInstance()->getConnection(); 
    }
    public function getUserById($id){
        $query = $this->database->prepare("SELECT * FROM users where user_id='$id'");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $user = new user($row['user_id'],$row['nom'],$row['email'],$row['motpasse'],$row['roleuser']);
            return $user;
        }
        return null;
    }
    public static function authentificationAdmin($email,$password,$db){
        $query = $db->prepare("SELECT * FROM users WHERE email = '$email' AND motpasse = '$password' and roleuser='Admin'");
        $query->execute();
        if($row = $query->fetch(PDO::FETCH_ASSOC)){
            return true;
        }
        return 0;
    }
    public static function authentificationAuthor($email,$password,$db){
        $query = $db->prepare("SELECT * FROM users WHERE email = '$email' AND motpasse = '$password' and roleuser='author'");
        $query->execute();
        if($row = $query->fetch(PDO::FETCH_ASSOC)){
            return true;
        }
        return 0;
    }
    public function addUser($user){
        $query=$this->database->prepare("INSERT INTO users(nom,email,motpasse) Values(:nom,:email,:motpasse)");
        $nom = $user->getName();
        $email = $user->getEmail();
        $passwordadmin = $user->getPassword();
        $query->bindParam(':nomadmin', $nom);
        $query->bindParam(':email', $email);
        $query->bindParam(':motpasse', $passwordadmin);
        $query->execute();
    }
}