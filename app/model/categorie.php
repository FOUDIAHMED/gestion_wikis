<?php
class categorie{
    private $idcat;
    private $nomecategorie;
    private $date_creation;
    public function __construct($id, $nomecategorie, $date_creation)
    {
        $this->idcat = $id;
        $this->nomecategorie = $nomecategorie;
        $this->date_creation = $date_creation;

    }
    public function getIdCategorie(){
        return $this->idcat;
    }
    public function getNomecategorie(){
        return $this->nomecategorie;
    }
    public function getDateCreation(){
        return $this->date_creation;
    }
}