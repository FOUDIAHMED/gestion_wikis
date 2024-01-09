<?php
class tag{
    private $idtag;
    private $name;
    private $date_creation;

    public function __construct( $idtag, $name, $date_creation){
        $this->idtag = $idtag;
        $this->name = $name;
        $this->date_creation = $date_creation;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIdtag()
    {
        return $this->idtag;
    }
}