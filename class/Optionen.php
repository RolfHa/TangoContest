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

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM optionen WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $optionen = new Optionen( 
            $row['name'],
            $row['wert']
        );
        return $optionen;
    }

    function save($optionen)
    {
        $db = DB::connect();
        $sql = "INSERT INTO optionen ( name, wert)
                VALUES ('$optionen->name', '$optionen->wert')";

        mysqli_query($db, $sql);

        return $optionen;
    }

    public static function delete()
    {
        //Wird nicht benötigt
    }

}
