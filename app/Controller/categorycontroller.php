<?php
class categorieController{
    private $categoriedao;
    public function __construct()
    {
        $this->categoriedao=new categorieDao();
        
    }

    public function CategoryPage($id){
        $catdao=new categorieDao();
        $categorie=$catdao->getCategorieById($id);
        $wikidao=new wikidao();
        $wikicat=$wikidao->getwikisbyCategorieId($id);
        include_once 'app/View/Categorie/Catgorypage.php';
    }
    public function index(){
        $categories=$this->categoriedao->getAllCategories();
        include_once 'app/View/Categorie/gestion_cat/index.php';
    }
    public function page_insert(){
        include_once 'app/View/Categorie/gestion_cat/insert.php';
    }
    public function insertCat(){
        $name=$_POST['name'];
        $cat=new categorie(0,$name,0);
        $this->categoriedao->insert($cat);
        header('location: index.php?action=category_list');
        exit();
    }
    public function modify(){
        $catid=$_GET['id'];
        $cat=$this->categoriedao->getCategorieById($catid);
        include_once 'app/View/Categorie/gestion_cat/update.php';
    }
    public function updateCat(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = $_POST['category_id'];
            $name = $_POST['name'];
            $cat=new categorie($categoryId,$name,0);
            $this->categoriedao->update($cat);
            header('Location: index.php?action=category_table');
            exit();
        
        }


    }
    public function delete($idcat){
        $cat=$this->categoriedao->getCategorieById($idcat);
        $this->categoriedao->delete($cat);
        header('Location: index.php?action=category_table');
        exit();
    }



}