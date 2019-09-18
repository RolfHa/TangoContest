<?php
class Tanzpaar2kategorie {
    private $id;
    private $tanzpaar_id;
    private $tanzpaar;
    private $kategorie_id;
    private $kategorie;
    private $stufendurchschnitt;


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

    public function getStufendurchschnitt(){
        return $this->stufendurchschnitt;
    }

    public function setStufendurchschnitt($stufendurchschnitt)    {
        $this->stufendurchschnitt = $stufendurchschnitt;
    }






    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2kategorie WHERE id=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        //echo "<br>".$sql;
        $row = mysqli_fetch_assoc($result);
        $tanzpaar = Tanzpaar::getById($row['tanzpaar_id']);
        $kategorie = Kategorie::getById($row['kategorie_id']);
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
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $tanzpaar2kategorie = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tanzpaar = Tanzpaar::getById($row['tanzpaar_id']);
            $kategorie = Kategorie::getById($row['kategorie_id']);
            $tanzpaar2kategorie[] = new Tanzpaar2kategorie(
                $row['tanzpaar_id'],
                $tanzpaar,
                $row['kategorie_id'],
                $kategorie,
                $row['id']
            );
        }
        return $tanzpaar2kategorie;
    }

    public static function getByKategorieId($id){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2kategorie WHERE kategorie_id=$id order by tanzpaar_id;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $tanzpaar2kategorie = array();
        $kategorie = Kategorie::getById($id); //ist ja immer die selbe
        while ($row = mysqli_fetch_assoc($result)) {
            $tanzpaar = Tanzpaar::getById($row['tanzpaar_id']);
            $tanzpaar2kategorie[] = new Tanzpaar2kategorie(
                $row['tanzpaar_id'],
                $tanzpaar,
                $row['kategorie_id'],
                $kategorie,
                $row['id']
            );
        }
        return $tanzpaar2kategorie;
    }


    public static function getByTanzpaarId($id){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2kategorie WHERE tanzpaar_id=$id order by kategorie_id;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        $tanzpaar2kategorie = array();
        $tanzpaar = Tanzpaar::getById($id); //ist ja immer die selbe
        while ($row = mysqli_fetch_assoc($result)) {
            $kategorie = Kategorie::getById($row['kategorie_id']);
            $tanzpaar2kategorie[] = new Tanzpaar2kategorie(
                $row['tanzpaar_id'],
                $tanzpaar,
                $row['kategorie_id'],
                $kategorie,
                $row['id']
            );
        }
        return $tanzpaar2kategorie;
    }

    public static function delete($id) {
        $db = DB::connect();
        $sql = "DELETE FROM tanzpaar2kategorie WHERE id = $id";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }

    public static function save ($tanzpaar2kategorie){
        $db = DB::connect();
        $sql = "INSERT INTO tanzpaar2kategorie (tanzpaar_id, kategorie_id)
                VALUES ($tanzpaar2kategorie->tanzpaar_id, $tanzpaar2kategorie->kategorie_id)";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $tanzpaar2kategorie->setId($id);
        return $tanzpaar2kategorie;
    }


}
