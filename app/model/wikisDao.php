<?php
require_once('wikis.php');
require_once('tagsDao.php');
require_once('userDao.php');
require_once('categorieDao.php');
class wikidao{
    private $database;
    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection(); 
    }
    public function select(){
        $query=$this->database->prepare("SELECT * FROM wiki");
        $query->execute();
        $wikis=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $catdao=new categorieDao();
            $cat=$catdao->getCategorieById($row['idcat']);
            $tagdao=new tagsDao();
            $tags=$tagdao->getTagbyWiki($row['id_wiki']);
            $userdao=new UserDao();
            $user=$userdao->getUserById($row['iduser']);

            $wikis[]=new wiki($row['id_wiki'],$row['nom'],$row['contenu'],$cat,$user,$tags,$row['date_creation'],$row['isdisable'],$row['img']) ;
    }
    return $wikis;
}

public function insert($wiki){
    $query=$this->database->prepare("INSERT INTO WIKI (nom,contenu,idcat,iduser,img) values (:nom,:contenu,:idcat,:iduser,:img)");
    $name=$wiki->getName();
    $content=$wiki->getContent();
    $idcat=$wiki->getCategory()->getIdCategorie();
    $iduser=$wiki->getUser()->getID();
    $img=$wiki->getImage();
    $query->bindParam(':nom',$name);
    $query->bindParam(':contenu',$content);
    $query->bindParam(':idcat',$idcat);
    $query->bindParam(':iduser',$iduser);
    $query->bindParam(':img',$img);
    $query->execute();
    $idwiki=$this->database->lastInsertId();
    foreach($wiki->getTags() as $tag){
        $query=$this->database->prepare("INSERT INTO wiki_tag (wiki_id,id_tag) VALUES (:wiki_id,:id_tag)");
        $id_tag=$tag->getIdtag();
        $query->bindParam(':wiki_id',$idwiki);
        $query->bindParam(':id_tag',$id_tag);
        $query->execute();
        
    }

}
public function update($wiki){
    $query=$this->database->prepare("UPDATE WIKI SET nom=:nom,contenu=:contenu,idcat=:idcat,iduser=:iduser,img=:img) where id_wiki=:idwiki");
    $name=$wiki->getName();
    $idwiki=$wiki->getId();
    $content=$wiki->getContent();
    $idcat=$wiki->getCategory()->getIdCategorie();
    $iduser=$wiki->getUser()->getID();
    $img=$wiki->getImage();
    $query->bindParam(':nom',$name);
    $query->bindParam(':idwiki',$idwiki);
    $query->bindParam(':contenu',$content);
    $query->bindParam(':idcat',$idcat);
    $query->bindParam(':iduser',$iduser);
    $query->bindParam(':img',$img);
    $query->execute();
    $query=$this->database->prepare("DELETE from wiki_tag where wiki_id=:idwiki");
    $query->bindParam(':idwiki',$wiki->getId());
    $query->execute();
    // $idwiki=$this->database->lastInsertId();

    foreach($wiki->getTags() as $tag){
        $query=$this->database->prepare("INSERT INTO wiki_tag (wiki_id,id_tag) VALUES (:wiki_id,:id_tag)");
        $id_tag=$tag->getIdtag();
        $query->bindParam(':wiki_id',$idwiki);
        $query->bindParam(':id_tag',$id_tag);
        $query->execute();
        
    }

}
public function delete($idwiki){
    $query=$this->database->prepare("DELETE from wiki_tag where wiki_id=:idwiki");
    $query->bindParam(':idwiki',$idwiki);
    $query->execute();
    $query=$this->database->prepare("DELETE FROM wiki where id_wiki=:idwiki");
    $query->bindParam(':idwiki',$idwiki);
    $query->execute();
}
public function getwikibuId($idwiki){
    $query=$this->database->prepare("SELECT * FROM wiki where id_wiki=:ID_wiki");
    $query->bindParam(':ID_wiki',$idwiki);
        $query->execute();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $catdao=new categorieDao();
            $cat=$catdao->getCategorieById($row['idcat']);
            $tagdao=new tagsDao();
            $tags=$tagdao->getTagbyWiki($row['id_wiki']);
            $userdao=new UserDao();
            $user=$userdao->getUserById($row['iduser']);

            $wikis=new wiki($row['id_wiki'],$row['nom'],$row['contenu'],$cat,$user,$tags,$row['date_creation'],$row['isdisable'],$row['img']) ;
    }
    return $wikis;

}
public function getwikisbusUserID($id){
    $query=$this->database->prepare("SELECT * FROM wiki where iduser=:ID_user");
    $query->bindParam(':ID_user',$id);
        $query->execute();
        $wikis=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $catdao=new categorieDao();
            $cat=$catdao->getCategorieById($row['idcat']);
            $tagdao=new tagsDao();
            $tags=$tagdao->getTagbyWiki($row['id_wiki']);
            $userdao=new UserDao();
            $user=$userdao->getUserById($row['iduser']);

            $wikis[]=new wiki($row['id_wiki'],$row['nom'],$row['contenu'],$cat,$user,$tags,$row['date_creation'],$row['isdisable'],$row['img']) ;
    }
    return $wikis;

}
public function getwikisbyCategorieId($id){
    $query=$this->database->prepare("SELECT * FROM wiki where idcat=:id_cat");
    $query->bindParam(':id_cat',$id);
        $query->execute();
        $wikis=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $catdao=new categorieDao();
            $cat=$catdao->getCategorieById($row['idcat']);
            $tagdao=new tagsDao();
            $tags=$tagdao->getTagbyWiki($row['id_wiki']);
            $userdao=new UserDao();
            $user=$userdao->getUserById($row['iduser']);

            $wikis[]=new wiki($row['id_wiki'],$row['nom'],$row['contenu'],$cat,$user,$tags,$row['date_creation'],$row['isdisable'],$row['img']) ;
    }
    return $wikis;

}
public function getwikisbytag($tag){
    $query=$this->database->prepare("SELECT * FROM wiki inner join wiki_tag on wiki_tag.wiki_id=id_wiki and wiki_tag.id_tag=id_tag");
    $query->bindParam(':id_tag',$tag->getIdtag());
        $query->execute();
        $wikis=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $catdao=new categorieDao();
            $cat=$catdao->getCategorieById($row['idcat']);
            $tagdao=new tagsDao();
            $tags=$tagdao->getTagbyWiki($row['id_wiki']);
            $userdao=new UserDao();
            $user=$userdao->getUserById($row['iduser']);

            $wikis[]=new wiki($row['id_wiki'],$row['nom'],$row['contenu'],$cat,$user,$tags,$row['date_creation'],$row['isdisable'],$row['img']) ;
    }
    return $wikis;

}
public function search_wikis($text){

}
public function archiverwiki($id){

}
public function disarchivewiki($id){
    
}
}