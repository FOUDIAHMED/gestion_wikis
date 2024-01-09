<?php
require_once('db_connection.php');
require_once('categorie.php');
class categorieDao{
    private $database;
    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection(); 
    }
    public function getCategorieById($id){
        $query=$this->database->prepare("SELECT * from categorie where idcategory='$id'");
        $query->execute();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $categorie=new categorie($row['idcategory'],$row['nom'],$row['date_creation']);
            return $categorie;
    }
    return null;
}
public function getAllCategories(){
    $query=$this->database->prepare("SELECT * FROM categorie");
    $query->execute();
    $categories=array();
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $categories[]=new categorie($row['idcategory'],$row['nom'],$row['date_creation']);
        
}
return $categories;
}
public function insert($categorie){
    $query=$this->database->prepare("INSERT INTO categorie (nom) values (:nom)");
    $nom=$categorie->getNomecategorie();
    $query->bindParam(':nom',$nom);
    $query->execute();
}
public function update($categorie){
    $query=$this->database->prepare("UPDATE categorie SET nom=:nom where icdategory=:idcat)");
    $nom=$categorie->getNomecategorie();
    $id=$categorie->getIdCategorie();
    $query->bindParam(':nom',$nom);
    $query->bindParam(':idcat',$id);
    $query->execute();
}
public function delete($categorie){
    $query=$this->database->prepare("DELETE FROM categorie WHERE idcategory=:idcat");
    $id=$categorie->getIdCategorie();
    $query->bindParam(':idcat',$id);
    $query->execute();
}

}