<?php

class Jury {

    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM jury WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $jury = new Jury( 
            $row['vorname'],
            $row['nachname'],
            $row['id']
        );
        return $jury;
    }

    function save($jury)
    {
        $db = DB::connect();
        $sql = "INSERT INTO jury (vorname, nachname)
                VALUES ('$jury->vorname', '$jury->nachname')";
        mysqli_query($db, $sql);

        $memberId = "SELECT  id, vorname, nachname
                     FROM    jury
                     WHERE vorname LIKE '$jury->vorname'
                     AND nachname LIKE '$jury->nachname'";
        $result = mysqli_query($db, $memberId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $jury->setId($resultID);

        return $jury;
    }

}
