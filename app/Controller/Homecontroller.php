<?php
class Homecontroller{
    private $wikidao;
    private $categoriedao;
    private $tagdao;
    public function __construct(){
        $this->wikidao=new wikidao();
        $this->categoriedao=new categorieDao();
        $this->tagdao=new tagsDao();
    }

    public function index(){
        $wikis=$this->wikidao->select();
        $categorie=$this->categoriedao->getAllCategories();
        $tags=$this->tagdao->select();
        include 'app/View/Homepage.php';
    }

    public function Search(){
        $search=$_GET['query'];
        $wikid=new wikidao();
        $searchwiki=$wikid->search_wikis($search);
        ob_start();
        include 'app/View/search.php';
       

    }
}