<?php
class Teilnehmer implements Saveable{
   private $id;
   private $vorname;
   private $nachname;
   private $geschlecht;
   private $telefonnummer;
   private $wohnort;
   private $wohnland;
   private $kuenstlername;
   private $geburtsname;
   
   function __construct($vorname, $nachname, $geschlecht, $telefonnummer, $wohnort, $wohnland, $kuenstlername, $geburtsname, $id = null) {
       if(isset($id)){
           $this->id = $id;
       }
       $this->vorname = $vorname;
       $this->nachname = $nachname;
       $this->geschlecht = $geschlecht;
       $this->telefonnummer = $telefonnummer;
       $this->wohnort = $wohnort;
       $this->wohnland = $wohnland;
       $this->kuenstlername = $kuenstlername;
       $this->geburtsname = $geburtsname;
   }

   
   function getId() {
       return $this->id;
   }

   function getVorname() {
       return $this->vorname;
   }

   function getNachname() {
       return $this->nachname;
   }

   public function getName(){
       return $this->getVorname() . ' ' . $this->getNachname();
   }
   function getGeschlecht() {
       return $this->geschlecht;
   }

   function getTelefonnummer() {
       return $this->telefonnummer;
   }

   function getWohnort() {
       return $this->wohnort;
   }

   function getWohnland() {
       return $this->wohnland;
   }

   function getKuenstlername() {
       return $this->kuenstlername;
   }

   function getGeburtsname() {
       return $this->geburtsname;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setVorname($vorname) {
       $this->vorname = $vorname;
   }

   function setNachname($nachname) {
       $this->nachname = $nachname;
   }

   function setGeschlecht($geschlecht) {
       $this->geschlecht = $geschlecht;
   }

   function setTelefonnummer($telefonnummer) {
       $this->telefonnummer = $telefonnummer;
   }

   function setWohnort($wohnort) {
       $this->wohnort = $wohnort;
   }

   function setWohnland($wohnland) {
       $this->wohnland = $wohnland;
   }

   function setKuenstlername($kuenstlername) {
       $this->kuenstlername = $kuenstlername;
   }

   function setGeburtsname($geburtsname) {
       $this->geburtsname = $geburtsname;
   }

   public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM teilnehmer WHERE id=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);
        $teilnehmer = new Teilnehmer(
                $row['vorname'], 
                $row['nachname'], 
                $row['geschlecht'], 
                $row['telefonnummer'], 
                $row['wohnort'],
                $row['wohnland'],
                $row['kuenstlername'], 
                $row['geburtsname'],
                $row['id']
        );
        return $teilnehmer;
   }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM teilnehmer ORDER by nachname";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $teilnehmer = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $teilnehmer[$i] = new Teilnehmer(
                $row['vorname'],
                $row['nachname'],
                $row['geschlecht'],
                $row['telefonnummer'],
                $row['wohnort'],
                $row['wohnland'],
                $row['kuenstlername'],
                $row['geburtsname'],
                $row['id']
                );
            $i++;
        }
        return $teilnehmer;
    }

    public static function delete($id)
    {
        $db = DB::connect();
        $sql = "DELETE FROM teilnehmer WHERE id = $id";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }

    public static function save($member)    {
        $db = DB::connect();
        $sql = "INSERT INTO teilnehmer (vorname, nachname, geschlecht, telefonnummer, wohnort,wohnland,kuenstlername, geburtsname)
                VALUES ('$member->vorname',
                        '$member->nachname',
                        '$member->geschlecht',
                        '$member->telefonnummer',
                        '$member->wohnort',
                        '$member->wohnland',
                        '$member->kuenstlername',
                        '$member->geburtsname')";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $member->setId($id);
        return $member;
    }
    public static function change($teilnehmer){
        $db = DB::connect();
        $sql = "Update teilnehmer SET 
        vorname = '". $teilnehmer->getVorname()."' , 
        nachname = '". $teilnehmer->getNachname()."',
        geschlecht = '". $teilnehmer->getGeschlecht()."',
        telefonnummer = '". $teilnehmer->getTelefonnummer()."',
        wohnort = '". $teilnehmer->getWohnort()."',
        wohnland = '". $teilnehmer->getWohnland()."',
        kuenstlername = '". $teilnehmer->getKuenstlername()."',
        geburtsname = '". $teilnehmer->getGeburtsname()."'
        WHERE id = '".$teilnehmer->getId()."'
        ";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }
}