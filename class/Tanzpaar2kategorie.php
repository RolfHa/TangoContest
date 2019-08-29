<?php
class Tanzpaar2kategorie {
    private $id;
    private $tanzpaar_id;
    private $tanzpaar;
    private $kategorie_id;
    private $kategorie;
    
    function __construct($tanzpaar_id, $tanzpaar, $kategorie_id, $kategorie, $id = null) {
        if(isset($id)){
          $this->id = $id;  
        }
        $this->tanzpaar_id = $tanzpaar_id;
        $this->tanzpaar = $tanzpaar;
        $this->kategorie_id = $kategorie_id;
        $this->kategorie = $kategorie;
    }
    
    function getId() {
        return $this->id;
    }

    function getTanzpaar_id() {
        return $this->tanzpaar_id;
    }

    function getTanzpaar() {
        return $this->tanzpaar;
    }

    function getKategorie_id() {
        return $this->kategorie_id;
    }

    function getKategorie() {
        return $this->kategorie;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTanzpaar_id($tanzpaar_id) {
        $this->tanzpaar_id = $tanzpaar_id;
    }

    function setTanzpaar($tanzpaar) {
        $this->tanzpaar = $tanzpaar;
    }

    function setKategorie_id($kategorie_id) {
        $this->kategorie_id = $kategorie_id;
    }

    function setKategorie($kategorie) {
        $this->kategorie = $kategorie;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2kategorie WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $tanzpaar = Tanzpaar.getById($row['tanzpaar_id']);
        $kategorie = Kategorie.getById($row['kategorie_id']);
        $tanzpaar2kategorie = new Tanzpaar2kategorie( 
            $row['tanzpaar_id'],
            $tanzpaar,
            $row['kategorie_id'],
            $kategorie,
            $row['id']
        );
        return $tanzpaar2kategorie;
    }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2kategorie;";
        $result = mysqli_query($db, $sql);
        $tanzpaar = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $tanzpaar = Tanzpaar.getById($row['tanzpaar_id']);
            $kategorie = Kategorie.getById($row['kategorie_id']);
            $tanzpaar2kategorie[$i] = new Tanzpaar2kategorie(
                $row['tanzpaar_id'],
                $tanzpaar,
                $row['kategorie_id'],
                $kategorie,
                $row['id']
            );
            $i++;
        }


        return $tanzpaar2kategorie;
    }

    public static function delete()
    {
        //Wird nicht benötigt
    }

    function save ($tanzpaar2kategorie)
    {
        $db = DB::connect();
        $sql = "INSERT INTO tanzpaar2kategorie (tanzpaar_id, kategorie_id)
                VALUES ($tanzpaar2kategorie->tanzpaar_id, $tanzpaar2kategorie->kategorie_id)";
        mysqli_query($db, $sql);

        $tanzpaar2kategorieId = "SELECT id, tanzpaar_id, kategorie_id
                                 FROM tanzpaar2kategorie 
                                 WHERE tanzpaar_id LIKE '$tanzpaar2kategorie->tanzpaar_id'
                                 AND kategorie_id LIKE '$tanzpaar2kategorie->kategorie_id'";

        $result = mysqli_query($db, $tanzpaar2kategorieId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $tanzpaar2kategorie->setId($resultID);

        return $tanzpaar2kategorie;
    }


}
