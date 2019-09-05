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
        $db = db::connect();
        $sql = "SELECT * FROM kategorie WHERE id=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $kategorie = new Kategorie(
                $row['kategorie'], 
                $row['id']
        );
        return $kategorie;
    }




    public static function getAll(){
        $db = db::connect();
        $sql = "SELECT * FROM kategorie order by id";
        $result = mysqli_query($db, $sql);
        $kategorie = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $kategorie[$i] = new Kategorie($row['kategorie'], $row['id']);
            $i++;
        }
        return $kategorie;
    }



    function save ($kategorie)    {
        $db = DB::connect();
        $sql = "INSERT INTO kategorie (kategorie.kategorie)
                VALUES ('$kategorie->kategorie')";
        mysqli_query($db,$sql);
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $kategorie->setId($id);
        // anzalquali anlegen
        foreach (Stufe::getAll() as $stufe){
            $anzahlquali=new Anzahlquali($kategorie->getId(),$kategorie->getKategorie(),$stufe->getId(),$stufe->getStufe(),50,10);
            Anzahlquali::save($anzahlquali);
        }
        return $kategorie;
    }


    public static function change($kategorie)    {
        $db = DB::connect();
        $sql = "Update kategorie SET 
        kategorie = '". $kategorie->getKategorie()."' 
        WHERE id = '".$kategorie->getId()."'
        ";
        $success = mysqli_query($db, $sql);
        return $success;
    }

    public static function delete() {
        //Wird nicht benötigt
    }

}
