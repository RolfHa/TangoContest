<?php
class Tanzpaar {
    private $id;
    private $startnummer;
    private $teilnehmer1_id;
    private $teilnehmer1;
    private $teilnehmer2_id;
    private $teilnehmer2;
    private $fuehrungsfolge;
    private $anmeldebetrag;
    private $bezahlt;
    private $bezahldatum;
    private $bezahlart_id;
    private $bezahlart;
    
    function __construct($startnummer, $teilnehmer1_id, $teilnehmer1, $teilnehmer2_id, $teilnehmer2, $fuehrungsfolge, $anmeldebetrag, $bezahlt, $bezahldatum, $bezahlart_id, $bezahlart, $id = null) {
        if(isset($id)){
            $this->id = $id;
        }
        $this->startnummer = $startnummer;
        $this->teilnehmer1_id = $teilnehmer1_id;
        $this->teilnehmer1 = $teilnehmer1;
        $this->teilnehmer2_id = $teilnehmer2_id;
        $this->teilnehmer2 = $teilnehmer2;
        $this->fuehrungsfolge = $fuehrungsfolge;
        $this->anmeldebetrag = $anmeldebetrag;
        $this->bezahlt = $bezahlt;
        $this->bezahldatum = $bezahldatum;
        $this->bezahlart_id = $bezahlart_id;
        $this->bezahlart = $bezahlart;
    }
    
    function getId() {
        return $this->id;
    }

    function getStartnummer() {
        return $this->startnummer;
    }

    function getTeilnehmer1_id() {
        return $this->teilnehmer1_id;
    }

    function getTeilnehmer1() {
        return $this->teilnehmer1;
    }

    function getTeilnehmer2_id() {
        return $this->teilnehmer2_id;
    }

    function getTeilnehmer2() {
        return $this->teilnehmer2;
    }

    function getFuehrungsfolge() {
        return $this->fuehrungsfolge;
    }

    function getAnmeldebetrag() {
        return $this->anmeldebetrag;
    }

    function getBezahlt() {
        if ($this->bezahlt == 1){
            return 'ja';
        } else {
            return 'nein';
        }
    }

    function getBezahldatum() {
        return $this->bezahldatum;
    }

    function getBezahlart_id() {
        return $this->bezahlart_id;
    }

    function getBezahlart() {
        return $this->bezahlart;
    }
    /*
     * wenn Tanzpartner aus verschiedenen Städten kommen, werden beide angezeigt
     * ansonsten wird die STadt nur einmal angezeigt
     */
    public function getWohnort(){
        $wohnort1 = $this->getTeilnehmer1()->getWohnort();
        $wohnort2 = $this->getTeilnehmer2()->getWohnort();
        if (trim($wohnort1) === trim($wohnort2)){
            return $wohnort1;
        } else {
            return $wohnort1 . '/' . $wohnort2;
        }
    }
    /*
     * siehe getWohnort()
     */
    public function getWohnland(){
        $wohnland1 = $this->getTeilnehmer1()->getWohnland();
        $wohnland2 = $this->getTeilnehmer2()->getWohnland();
        if (trim($wohnland1) === trim($wohnland2)){
            return $wohnland1;
        } else {
            return $wohnland1 . '/' . $wohnland2;
        }
    }
    function setId($id) {
        $this->id = $id;
    }

    function setStartnummer($startnummer) {
        $this->startnummer = $startnummer;
    }

    function setTeilnehmer1_id($teilnehmer1_id) {
        $this->teilnehmer1_id = $teilnehmer1_id;
    }

    function setTeilnehmer1($teilnehmer1) {
        $this->teilnehmer1 = $teilnehmer1;
    }

    function setTeilnehmer2_id($teilnehmer2_id) {
        $this->teilnehmer2_id = $teilnehmer2_id;
    }

    function setTeilnehmer2($teilnehmer2) {
        $this->teilnehmer2 = $teilnehmer2;
    }

    function setFuehrungsfolge($fuehrungsfolge) {
        $this->fuehrungsfolge = $fuehrungsfolge;
    }

    function setAnmeldebetrag($anmeldebetrag) {
        $this->anmeldebetrag = $anmeldebetrag;
    }

    function setBezahlt($bezahlt) {
        if ($bezahlt === 'ja' || $bezahlt == 1){
            $this->bezahlt = 1;
        } else if ($bezahlt === 'nein' || $bezahlt == 0){
            $this->bezahlt = 0;
        } else {
            $this->bezahlt = 0;
        }
    }

    function setBezahldatum($bezahldatum) {
        $this->bezahldatum = $bezahldatum;
    }

    function setBezahlart_id($bezahlart_id) {
        $this->bezahlart_id = $bezahlart_id;
    }

    function setBezahlart($bezahlart) {
        $this->bezahlart = $bezahlart;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $teilnehmer1 = Teilnehmer.getById($row['teilnehmer1_id']);
        $teilnehmer2 = Teilnehmer.getById($row['teilnehmer2_id']);
        $bezahlart = Bezahlart.getById($row['bezahlart_id']);
        
        $tanzpaar = new Tanzpaar( 
                $row['startnummer'], 
                $row['teilnehmer1_id'], 
                $teilnehmer1,
                $row['teilnehmer2_id'], 
                $teilnehmer2,
                $row['fuehrungsreinfolge'], 
                $row['anmeldebetrag'], 
                $row['bezahlt'],
                $row['bezahldatum'],
                $row['bezahlart_id'], 
                $bezahlart,
                $row['id']
        );
        return $tanzpaar;
   }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar;";
        $result = mysqli_query($db, $sql);
        $tanzpaar = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $teilnehmer1 = Teilnehmer::getById($row['teilnehmer1_id']);
            $teilnehmer2 = Teilnehmer::getById($row['teilnehmer2_id']);
            $bezahlart = Bezahlart::getById($row['bezahlart_id']);

            $tanzpaar[$i] = new Tanzpaar(
                $row['startnummer'],
                $row['teilnehmer1_id'],
                $teilnehmer1,
                $row['teilnehmer2_id'],
                $teilnehmer2,
                $row['fuehrungsfolge'],
                $row['anmeldebetrag'],
                $row['bezahlt'],
                $row['bezahldatum'],
                $row['bezahlart_id'],
                $bezahlart,
                $row['id']
            );
            $i++;
        }
        return $tanzpaar;
    }

    public static function delete($id)
    {
        $db = DB::connect();
        $sql = "DELETE FROM tanzpaar WHERE id = $id";
        $success = mysqli_query($db, $sql);
        return $success;
    }

    public static function getByTeilnehmerId($id)
    {
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar WHERE teilnehmer1_id = $id or teilnehmer2_id = $id";
        $result = mysqli_query($db, $sql);
        $resultNo = mysqli_num_rows($result);
        return $resultNo;
    }

    function save ($tanzpaar)
    {
        $db = DB::connect();
        $sql = "INSERT INTO tanzpaar (startnummer, teilnehmer1_id, teilnehmer2_id, fuehrungsfolge, anmeldebetrag, bezahlt, bezahldatum, bezahlart_id)
                VALUES ($tanzpaar->startnummer, 
                        $tanzpaar->teilnehmer1_id, 
                        $tanzpaar->teilnehmer2_id, 
                        $tanzpaar->fuehrungsfolge, 
                        $tanzpaar->anmeldebetrag, 
                        $tanzpaar->bezahlt, 
                        '$tanzpaar->bezahldatum', 
                        $tanzpaar->bezahlart_id)";

        mysqli_query($db, $sql);

        $tanzpaarId = "SELECT id, startnummer
                       FROM tanzpaar
                       WHERE startnummer LIKE '$tanzpaar->startnummer';";

        $result = mysqli_query($db, $tanzpaarId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $tanzpaar->setId($resultID);

        return $tanzpaar;
    }

}
