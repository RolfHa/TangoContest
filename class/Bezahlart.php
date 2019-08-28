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
        $sql = "SELECT * FROM bezahlart WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $bezahlart = new Bezahlart( 
                $row['bezahlart'], 
                $row['id']
        );
        return $bezahlart;
    }

    function save ($bezahlart)
    {
        $db = DB::connect();#
        $sql = "INSERT INTO bezahlart (bezahlart)
                VALUES ('$bezahlart->bezahlart')";

        Mysqli_query($db, $sql);

        $bezahlartId = "SELECT id, bezahlart
                        FROM bezahlart
                        WHERE bezahlart LIKE '$bezahlart->bezahlart'";

        $result = mysqli_query($db, $bezahlartId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $bezahlart->setId($resultID);

        return $bezahlart;

    }
}
