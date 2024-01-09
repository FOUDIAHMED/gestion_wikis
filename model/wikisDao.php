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

}
$wikidao=new wikidao();
print_r($wikidao->select());
$tagdao= new tagsDao();
$catdao=new categorieDao();
$userdao=new UserDao();

$wiki=new wiki(0,"djdjdj","hahahahahahaha",$catdao->getCategorieById(1),$userdao->getUserById(1),$tagdao->select(),0,0,"salamat abo lbanat");
$wikidao->insert($wiki);