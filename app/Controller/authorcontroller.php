<?php
class authorController{
    private $categoriedao;
    private $tagsdao;
    private $wikisdao;
    public function __construct(){
        $this->categoriedao=new categorieDao(); 
        $this->tagsdao=new tagsDao();
        $this->wikisdao=new wikidao();
    }
    public function index(){
        $numcat=count($this->categoriedao->getAllCategories());
        $numtags=count($this->tagsdao->select());
        $numwiki=count($this->wikisdao->select());
        include_once 'app/View/author/AuthorHomepage.php';
    }
}