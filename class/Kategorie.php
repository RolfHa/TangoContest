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
        $sql = "SELECT * FROM kategorie";
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
        $katId = "SELECT id, kategorie.kategorie
                  FROM kategorie
                  WHERE kategorie LIKE '$kategorie->kategorie'";
        $result = mysqli_query($db, $katId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];
        $kategorie->setId($resultID);
        return $kategorie;
    }

    public static function delete() {
        //Wird nicht benötigt
    }

}
