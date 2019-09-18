<?php
class Optionen {
    private $name;
    private $wert;
    
    function __construct($name, $wert) {
        $this->name = $name;
        $this->wert = $wert;
    }
    
    function getName() {
        return $this->name;
    }

    function getWert() {
        return $this->wert;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setWert($wert) {
        $this->wert = $wert;
    }

    //      !!!!   feld id in der Tabelle nicht vorhanden  !!!!
    public static function getById($name){
        $db = DB::connect();
        $sql = "SELECT * FROM optionen WHERE name='$name'";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);
        //echo $sql;
        $optionen = new Optionen( 
            $row['name'],
            $row['wert']
        );
        return $optionen;
    }


    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM optionen;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $optionen = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $optionen[$i] = new Optionen($row['name'], $row['wert']);
            $i++;
        }
        return $optionen;
    }

    public static function save($optionen)    {
        $db = DB::connect();
        $sql = "INSERT INTO optionen ( name, wert) VALUES ('$optionen->name', '$optionen->wert')";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $optionen;
    }


    public static function change($optionen)    {
        $db = DB::connect();
        $sql = "Update optionen SET  wert = '". $optionen->getWert()."' WHERE name = '".$optionen->getName()."' ";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        return $success;
    }

    public static function delete($id) {
        //echo $id;
        $db = DB::connect();
        $sql = "DELETE FROM optionen WHERE name ='$id'";
        //echo $sql;
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        return $success;
    }

    // fragt die einstellung ab bzw legt sie an wenn sie nicht in der DB ist
    public static function standard($typ,$default) {
        $existiert=0;
        foreach (Optionen::getAll() as $optionen){
            if ($optionen->getName()==$typ){
                $existiert=1;
                return $optionen->getWert();
            }
        }
        if ($existiert==0){
            $option= new Optionen($typ,$default);
            Optionen::save($option);
            return $default;
        }

    }

}
