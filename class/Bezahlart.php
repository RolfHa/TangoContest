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

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM bezahlart WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $bezahlart = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $bezahlart[$1] = new Bezahlart(
                $row['bezahlart'],
                $row['id']
            );

        }
        return $bezahlart;
    }

}
