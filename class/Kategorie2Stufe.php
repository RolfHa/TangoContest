<?php
// anzahlquali ist auch die zurordnung stufe2kategorie (wurde erst nachtäglich geändert)
class Kategorie2Stufe {
    private $id;
    private $kategorie_id;
    private $kategorie;
    private $stufe_id;
    private $stufe;
    private $anzahlquali;
    private $maxpaare;

    function __construct($kategorie_id, $kategorie, $stufe_id, $stufe, $anzahlquali,$maxpaare, $id = null) {
        if(isset($id)){
            $this->id = $id;
        }
        $this->kategorie_id = $kategorie_id;
        $this->kategorie = $kategorie;
        $this->stufe_id = $stufe_id;
        $this->stufe = $stufe;
        $this->anzahlquali = $anzahlquali;
        $this->maxpaare = $maxpaare;
    }

    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }

    function getKategorie_id() {
        return $this->kategorie_id;
    }
    function getKategorie() {
        return $this->kategorie;
    }
    function getStufe_id() {
        return $this->stufe_id;
    }
    function getStufe() {
        return $this->stufe;
    }
    function getAnzahlquali() {
        return $this->anzahlquali;
    }
    public function getMaxpaare()    {
        return $this->maxpaare;
    }


    function setKategorie_id($kategorie_id) {
        $this->kategorie_id = $kategorie_id;
    }
    function setKategorie($kategorie) {
        $this->kategorie = $kategorie;
    }
    function setStufe_id($stufe_id) {
        $this->stufe_id = $stufe_id;
    }
    function setStufe($stufe) {
        $this->stufe = $stufe;
    }
    function setAnzahlquali($anzahlquali) {
        $this->anzahlquali = $anzahlquali;
    }
    public function setMaxpaare($maxpaare)    {
        $this->maxpaare = $maxpaare;
    }




    public static function getByKategorieIdAndStufeId($kategorie_id,$stufe_id){
        $db = DB::connect();
        $sql = "SELECT * FROM kategorie2stufe WHERE kategorie_id=$kategorie_id and stufe_id=$stufe_id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);

        $kategorie = Kategorie::getById($row['kategorie_id']);
        $stufe = Stufe::getById($row['stufe_id']);

        $anzahlquali = new Kategorie2Stufe(
            $row['kategorie_id'],
            $kategorie,
            $row['stufe_id'],
            $stufe,
            $row['anzahlquali'],
            $row['maxpaare'],
            $row['id']
        );
        return $anzahlquali;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM kategorie2stufe WHERE id=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        $row = mysqli_fetch_assoc($result);

        $kategorie = Kategorie::getById($row['kategorie_id']);
        $stufe = Stufe::getById($row['stufe_id']);

        $anzahlquali = new Kategorie2Stufe(
            $row['kategorie_id'],
            $kategorie,
            $row['stufe_id'],
            $stufe,
            $row['anzahlquali'],
            $row['maxpaare'],
            $row['id']
        );
        return $anzahlquali;
    }


    public static function getByKategorieId($kategorie_id){
        $db = DB::connect();
        $sql = "SELECT kategorie2stufe.id as id, kategorie_id, stufe_id, anzahlquali, kategorie, stufe , maxpaare
                FROM kategorie2stufe
                join kategorie on kategorie2stufe.kategorie_id=kategorie.id
                join stufe on kategorie2stufe.stufe_id = stufe.id
                WHERE kategorie_id=$kategorie_id 
                order by kategorie_id, stufe_id;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        $anzahlquali = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $kategorie = new Kategorie($row['kategorie'], $row['kategorie_id']);
            $stufe =new Stufe( $row['stufe'], $row['stufe_id']);

            $anzahlquali[$i] = new Kategorie2Stufe(
                $row['kategorie_id'],
                $kategorie,
                $row['stufe_id'],
                $stufe,
                $row['anzahlquali'],
                $row['maxpaare'],
                $row['id']
            );
            $i++;
        }
        return $anzahlquali;
    }


    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT kategorie2stufe.id as id, kategorie_id, stufe_id, anzahlquali, kategorie, stufe , maxpaare
                FROM kategorie2stufe
                join kategorie on kategorie2stufe.kategorie_id=kategorie.id
                join stufe on kategorie2stufe.stufe_id = stufe.id
                order by kategorie_id, stufe_id;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $anzahlquali = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            //  *** Versuch Datenbankabfragen innerhalb einer Schleife zu vermeiden***
            //$kategorie = Kategorie.getById($row['kategorie_id']);
            $kategorie = new Kategorie($row['kategorie'], $row['kategorie_id']);
            //$stufe = Stufe.getById($row['stufe_id']);
            $stufe =new Stufe( $row['stufe'], $row['stufe_id']);

            $anzahlquali[$i] = new Kategorie2Stufe(
                $row['kategorie_id'],
                $kategorie,
                $row['stufe_id'],
                $stufe,
                $row['anzahlquali'],
                $row['maxpaare'],
                $row['id']
            );
            $i++;
        }
        return $anzahlquali;
    }

    public static function delete($id) {
        $db = DB::connect();
        $sql = "DELETE FROM kategorie2stufe WHERE id = $id";
        $success=mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        return $success;
    }

    public static function save ($anzahlquali)    {
        $db = DB::connect();
        $sql = "INSERT INTO kategorie2stufe (kategorie_id, stufe_id, anzahlquali,maxpaare)
                VALUES ('$anzahlquali->kategorie_id', '$anzahlquali->stufe_id', '$anzahlquali->anzahlquali', '$anzahlquali->maxpaare')";
        Mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $anzahlquali;
    }

    public static function change($anzahlquali)    {
        $db = DB::connect();
        $sql = "Update kategorie2stufe SET 
        anzahlquali = '". $anzahlquali->getAnzahlquali()."' , 
        maxpaare = '". $anzahlquali->getMaxpaare()."'
        WHERE id = '".$anzahlquali->getId()."' 
        ;";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }

}