<?php 
class wikiController{
    private $wikidao;
    private $catdao;
    private $tagdao;
    private $userdao;
    public function __construct()
    {
        $this->wikidao = new wikidao();
        $this->catdao=new categorieDao();
        $this->tagdao=new tagsDao();
        $this->userdao=new UserDao();
    }

    public function wikipage($idwiki){
        $wiki=$this->wikidao->getwikibuId($idwiki);
        include_once 'app/View/wiki/wikipage.php'; 
    }
    public function adminPage(){
        $wikis=$this->wikidao->select();
        include 'app/View/wiki/gestion_wiki/adminIndex.php';
    }
    public function authorPage(){
        $id=$_SESSION['user_id'];
        $wikis=$this->wikidao->getwikisbusUserID($id);
        include 'app/View/wiki/gestion_wiki/authorIndex.php';
    }
    public function insertwiki(){
        $tags=$this->tagdao->select();
        $categories=$this->catdao->getAllCategories();
        include 'app/View/wiki/gestion_wiki/insert.php';

    }
    public function insert(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $tagIds =  $_POST['tags'];
            $image=$_POST['image'];
            $tags=array();
            foreach ($tagIds as $tagId) {
                $tags[]=$this->tagdao->getTagById($tagId);
            }
            $userid=$_SESSION['user_id'];
            $cat=$this->catdao->getCategorieById($categoryId);
            $user=$this->userdao->getUserById($userid);
            $wiki=new wiki(0,$title,$content,$cat,$user,$tags,0,0,$image);
            $this->wikidao->insert($wiki);
            header('Location: index.php?action=author_wikis');
            exit();

        }

    }
    public function modifywiki($wikiId){
        $wiki=$this->wikidao->getwikibuId($wikiId);
        $categories=$this->catdao->getAllCategories();
        $tags=$this->tagdao->select();
        include 'app/View/wiki/gestion_wiki/update.php';
    }
    public function updatewiki($wikiid){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $tagIds =  $_POST['tags'];
            $image=$_POST['image'];
            $tags=array();
            foreach ($tagIds as $tagId) {
                $tags[]=$this->tagdao->getTagById($tagId);
            }
            $userid=$_SESSION['user_id'];
            $cat=$this->catdao->getCategorieById($categoryId);
            $user=$this->userdao->getUserById($userid);
            $wiki=new wiki(0,$title,$content,$cat,$user,$tags,0,0,$image);
            $this->wikidao->update($wiki);
            header('Location: index.php?action=author_wikis');
            exit();

        }

    }

    public function archiverwiki($wikiid){
        $this->wikidao->archiverwiki($wikiid);
        header('Location: index.php?action=admin_wiki_table');
        exit();
    }
    public function disarchivewiki($wikiid){
        $this->wikidao->disarchivewiki($wikiid);
        header('Location: index.php?action=admin_wiki_table');
        exit();
    }
    public function deletewiki($wikiid){
        $wiki=$this->wikidao->getwikibuId($wikiid);
        $this->wikidao->delete($wiki);
        header('Location: index.php?action=author_wiki_table');
        exit();
    }

}