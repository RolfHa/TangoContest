<?php
class Bezahlart {
    private $id;
    private $bezahlart;
    
    function __construct($bezahlart, $id = null) {
        if(isset($id)){
            $this->id = $id;
        }
        $this->bezahlart = $bezahlart;
    }
    
    function getId() {
        return $this->id;
    }

    function getBezahlart() {
        return $this->bezahlart;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBezahlart($bezahlart) {
        $this->bezahlart = $bezahlart;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM bezahlart WHERE id=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);

        $bezahlart = new Bezahlart(
                $row['bezahlart'],
                $row['id']
        );
        return $bezahlart;
    }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM bezahlart";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $bezahlart = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $bezahlart[$i] = new Bezahlart($row['bezahlart'], $row['id']);
            $i++;
        }
        return $bezahlart;
    }

    function save ($bezahlart)    {
        $db = DB::connect();#
        $sql = "INSERT INTO bezahlart (bezahlart)
                VALUES ('$bezahlart->bezahlart')";
        Mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $bezahlartId = "SELECT id, bezahlart
                        FROM bezahlart
                        WHERE bezahlart LIKE '$bezahlart->bezahlart'";
        $result = mysqli_query($db, $bezahlartId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];
        $bezahlart->setId($resultID);
        return $bezahlart;
    }

    public static function change($bezahlart)    {
        $db = DB::connect();
        $sql = "Update bezahlart SET 
        bezahlart ='". $bezahlart->getBezahlart()."'
        WHERE id = '".$bezahlart->getId()."'
        ";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }

    public static function delete($id) {
        $db = DB::connect();
        $sql = "DELETE FROM bezahlart WHERE id = $id";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }


}
