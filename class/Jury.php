<?php
class Jury implements Saveable {

    private $id;
    private $vorname;
    private $nachname;


    public function __construct($vorname, $nachname, $id = null)    {
        if (isset($id)){
            $this->id = $id;
        }
        $this->vorname = $vorname;
        $this->nachname = $nachname;
    }

    public function getId()    {
        return $this->id;
    }
    public function setId($id)    {
        $this->id = $id;
    }

    public function getVorname()    {
        return $this->vorname;
    }
    public function setVorname($vorname)    {
        $this->vorname = $vorname;
    }

    public function getNachname()    {
        return $this->nachname;
    }
    public function setNachname($nachname)    {
        $this->nachname = $nachname;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM jury WHERE id=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);
        
        $jury = new Jury( 
            $row['vorname'],
            $row['nachname'],
            $row['id']
        );
        return $jury;
    }

    public static function getAll()    {
        $db = DB::connect();
        $sql = "SELECT * FROM jury";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $jury = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)){
            $jury[$i]= new Jury(
                $row['vorname'],
                $row['nachname'],
                $row['id']
            );
            $i++;
        }
        return $jury;
    }

    public static function save($jury)    {
        $db = DB::connect();
        $sql = "INSERT INTO jury (vorname, nachname)
                VALUES ('$jury->vorname', '$jury->nachname')";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $jury->setId($id);
        return $jury;
    }

    public static function change($jury)    {
        $db = DB::connect();
        $sql = "Update jury SET 
        vorname = '". $jury->getVorname()."' , 
        nachname = '". $jury->getNachname()."'
        WHERE id = '".$jury->getId()."'
        ";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }

    public static function delete($id)    {
        Jury2ronda::deleteByJuryId($id);
        $db = DB::connect();
        $sql = "DELETE FROM jury WHERE id = $id";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        if ($success!=1){
            echo "kann Jury nicht löschen, event. wurden schon Punkte vergeben";
        }
        return $success;
    }

}
