<?php
class Kategorie {
    private $id;
    private $kategorie;
    
    function __construct($kategorie, $id = null) {
        if(isset($id)){
            $this->id = $id;
        }
        $this->kategorie = $kategorie;
    }
    
    function getId() {
        return $this->id;
    }

    function getKategorie() {
        return $this->kategorie;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setKategorie($kategorie) {
        $this->kategorie = $kategorie;
    }
    
    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM kategorie WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $kategorie = new Kategorie( 
                $row['kategorie'], 
                $row['id']
        );
        return $kategorie;
    }


}
