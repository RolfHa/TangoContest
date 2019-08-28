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
        return $this->bezahlt;
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
        $this->bezahlt = $bezahlt;
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

}