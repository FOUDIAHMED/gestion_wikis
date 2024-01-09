<?php 
class wiki{
    private $id;
    private $name;
    private $content;
    private $category;
    private $user;
    private $image;
    private $tags;
    private $date_creation;
    private $state;
    public function __construct($id,$name,$content,$category,$user,$tags,$date_creation,$state,$image){
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->category = $category;
        $this->user = $user;
        $this->tags = $tags;
        $this->image=$image;
        $this->date_creation = $date_creation;
        $this->state = $state;

    }
  
    public function getState()
    {
        return $this->state;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getUser()
    {
        return $this->user;
    }

    
    public function getCategory()
    {
        return $this->category;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }
}