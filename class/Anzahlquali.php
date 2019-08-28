<?php
class Anzahlquali {
    private $kategorie_id;
    private $kategorie;
    private $stufe_id;
    private $stufe;
    private $anzahlquali;
    private $id;
    
    function __construct($kategorie_id, $kategorie, $stufe_id, $stufe, $anzahlquali) {
        $this->kategorie_id = $kategorie_id;
        $this->kategorie = $kategorie;
        $this->stufe_id = $stufe_id;
        $this->stufe = $stufe;
        $this->anzahlquali = $anzahlquali;
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

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM anzahlquali WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $kategorie = Kategorie.getById($row['kategorie_id']);
        $stufe = Stufe.getById($row['stufe_id']);
        
        $anzahlquali = new Anzahlquali( 
                $row['kategorie_id'],
                $kategorie,
                $row['stufe_id'],
                $stufe,
                $row['anzahlquali']
        );
        return $anzahlquali;
    }
    public static function delete()
    {
        //Wird nicht benötigt
    }

    function save ($anzahlquali)
    {
        $db = DB::connect();
        $sql = "INSERT INTO anzahlquali (kategorie_id, stufe_id, anzahlquali)
                VALUES ('$anzahlquali->kategorie_id', '$anzahlquali->stufe_id', '$anzahlquali->anzahlquali')";

        Mysqli_query($db, $sql);

        return $anzahlquali;
    }

}
