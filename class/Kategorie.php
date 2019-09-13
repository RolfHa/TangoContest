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
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $kategorie->setId($id);
        // anzalquali anlegen
        $stufeAll=Stufe::getAll();
        $anzahl=80;
        foreach ($stufeAll as $stufe){
            $anzahl=round($anzahl/2,0);
            $anzahlquali=new Anzahlquali($kategorie->getId(),$kategorie->getKategorie(),$stufe->getId(),$stufe->getStufe(),$anzahl,10);
            //bei der letzten stufe soll die qualianzahl immer 1 sein -> es kann nur einen geben!
            if ($stufe==end($stufeAll)){
                $anzahlquali=new Anzahlquali($kategorie->getId(),$kategorie->getKategorie(),$stufe->getId(),$stufe->getStufe(),1,10);
            }
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

    public static function delete($id) {
        $db = DB::connect();
        $sql = "DELETE FROM anzahlquali WHERE kategorie_id = $id";
        mysqli_query($db, $sql);
        $sql = "DELETE FROM kategorie WHERE id = $id";
        $success = mysqli_query($db, $sql);
        if ($success!=1){
            foreach (Stufe::getAll() as $stufe){
                $anzahlquali=new Anzahlquali($id,'dummy',$stufe->getId(),$stufe->getStufe(),50,10);
                Anzahlquali::save($anzahlquali);
            }
        }
        return $success;
    }

}
