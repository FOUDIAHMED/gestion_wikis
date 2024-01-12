<?php 
require_once 'app/model/tagsDao.php';
class tagController{
    private $tagdao;
    public function __construct(){
        $this->tagdao = new tagsDao();
    }
    public function tagpage($tagId){
        $tag=$this->tagdao->getTagById($tagId);
        $wikidao=new wikidao();
        $wikis=$wikidao->getwikisbytag($tag);
        include_once 'app/View/Tags/TagPage.php';
    }
    public function index(){
        $tags=$this->tagdao->select();
        include_once 'app/View/Tags/gestion_tag/index.php';
    }
    public function inserttag(){
        include_once 'app/View/Tags/gestion_tag/insert.php';
    }
    public function insert(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $name=$_POST['name'];
            $tag=new tag(0,$name,0);
            $this->tagdao->insert($tag);
        }
    }
    public function modify(){
        $tagId=$_GET['id'];
        $tag=$this->tagdao->getTagById($tagId);
        include_once 'app/View/Tags/gestion_tag/update.php';
    }
    public function updateTag(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tagId = $_POST['tag_id'];
            $name = $_POST['name'];
            $tag=new tag($tagId,$name,0);
            $this->tagdao->update($tag);
            header('Location: index.php?action=tag_table');
            exit();
        }
    }

    public function deleteTag($tagId){
        $tag=$this->tagdao->getTagById($tagId);
        $this->tagdao->delete($tag);
        header('Location: index.php?action=tag_table');

    }
}