<?php
class Anzahlquali {
    private $kategorie_id;
    private $kategorie;
    private $stufe_id;
    private $stufe;
    private $anzahlquali;
    private $maxpaare;

    function __construct($kategorie_id, $kategorie, $stufe_id, $stufe, $anzahlquali,$maxpaare) {
        $this->kategorie_id = $kategorie_id;
        $this->kategorie = $kategorie;
        $this->stufe_id = $stufe_id;
        $this->stufe = $stufe;
        $this->anzahlquali = $anzahlquali;
        $this->maxpaare = $maxpaare;

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


    public function getMaxpaare()
    {
        return $this->maxpaare;
    }

    public function setMaxpaare($maxpaare)
    {
        $this->maxpaare = $maxpaare;
    }




    //      !!!!   feld id in der Tabelle nicht vorhanden  !!!!
    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM anzahlquali WHERE id=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);

        $kategorie = Kategorie.getById($row['kategorie_id']);
        $stufe = Stufe.getById($row['stufe_id']);

        $anzahlquali = new Anzahlquali(
                $row['kategorie_id'],
                $kategorie,
                $row['stufe_id'],
                $stufe,
                $row['anzahlquali'],
                $row['maxpaare']
        );
        return $anzahlquali;
    }

    public static function gesAll(){
        $db = DB::connect();
        $sql = "SELECT kategorie_id, stufe_id, anzahlquali, kategorie, stufe , maxpaare
                FROM anzahlquali
                join kategorie on anzahlquali.kategorie_id=kategorie.id
                join stufe on anzahlquali.stufe_id = stufe.id
                order by kategorie_id, stufe_id;";
        $result = mysqli_query($db, $sql);
        $anzahlquali = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            //  *** Versuch Datenbankabfragen innerhalb einer Schleife zu vermeiden***

            //$kategorie = Kategorie.getById($row['kategorie_id']);
            $kategorie = new Kategorie($row['kategorie'], $row['kategorie_id']);

            //$stufe = Stufe.getById($row['stufe_id']);
            $stufe =new Stufe( $row['stufe'], $row['stufe_id']);

            $anzahlquali[$i] = new Anzahlquali(
                $row['kategorie_id'],
                $kategorie,
                $row['stufe_id'],
                $stufe,
                $row['anzahlquali'],
                $row['maxpaare']
            );
            $i++;
        }
        return $anzahlquali;
    }

    public static function delete()
    {
        //Wird nicht benötigt
    }

    function save ($anzahlquali)
    {
        $db = DB::connect();
        $sql = "INSERT INTO anzahlquali (kategorie_id, stufe_id, anzahlquali,maxpaare)
                VALUES ('$anzahlquali->kategorie_id', '$anzahlquali->stufe_id', '$anzahlquali->anzahlquali', '$anzahlquali->maxpaare')";
        Mysqli_query($db, $sql);
        return $anzahlquali;
    }

}
