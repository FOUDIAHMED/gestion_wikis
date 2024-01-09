<?php
require_once('db_connection.php');
require_once('tags.php');
class tagsDao{
    private $database;
    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection(); 
    }

    public function getTagById($id){
        $query=$this->database->prepare("SELECT * FROM tags WHERE idtag=:id");
        $query->bindParam(':id',$id);
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $tag=new tag($row['idtag'],$row['nom'],$row['date_creation']);
            return $tag;
        }
        return null;
    }
    public function select(){
        $query=$this->database->prepare("SELECT * FROM tag");
        $query->execute();
        $tags=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $tags[]=new tag($row['idtag'],$row['nom'],$row['date_creation']);
            
    }
    return $tags;
    }
    public function insert($tag){
        $query=$this->database->prepare("INSERT INTO tag (nom) values (:nom)");
        $nom=$tag->getName();
        $query->bindParam(':nom',$nom);
        $query->execute();
    }
    public function update($tag){
        $query=$this->database->prepare("UPDATE tag SET nom=:nom where idtag=:idtag)");
        $nom=$tag->getName();
        $id=$tag->getIdtag();
        $query->bindParam(':nom',$nom);
        $query->bindParam(':idtag',$id);
        $query->execute();
    }
    public function delete($tag){
        $query=$this->database->prepare("DELETE FROM tag WHERE idtag=:idtag");
        $id=$tag->getIdtag();
        $query->bindParam(':idtag',$id);
        $query->execute();
    }
    public function getTagbyWiki($wiki){
        $query=$this->database->prepare("SELECT * FROM tag inner join wiki_tag on idtag=wiki_tag.id_tag and wiki_tag.wiki_id=:wiki_id");
        $id=$wiki;
        $query->bindParam(':wiki_id',$id);
        $query->execute();
        $tags=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $tags[]=new tag($row['idtag'],$row['nom'],$row['date_creation']);
            
    }
    return $tags;
    }

}

