<?php
class Jury2ronda {

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
        $sql = "SELECT * FROM jury2ronda WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $jury = Jury.getById($row['jury_id']);
        $ronda = Ronda.getById($row['ronda_id']);
        
        $jury2ronda = new Jury2ronda( 
            $row['jury_id'],
            $jury,
            $row['ronda_id'],
            $ronda,
            $row['sitzplatz'],
            $row['id']
        );
        return $jury2ronda;
    }

    function save ($jury2ronda)
    {
        $db = DB::connect();#
        $sql = "INSERT INTO jury2ronda (jury_id, ronda_id, sitzplatz)
                VALUES ('$jury2ronda->jury_id', 
                        '$jury2ronda->ronda_id', 
                        '$jury2ronda->sitzplatz')";

        Mysqli_query($db, $sql);

        $jury2rondaId = "SELECT id, jury_id, ronda_id, sitzplatz
                         FROM jury2ronda
                         WHERE jury_id LIKE '$jury2ronda->jury_id'
                         AND ronda_id LIKE '$jury2ronda->ronda_id'";

        $result = mysqli_query($db, $jury2rondaId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $jury2ronda->setId($resultID);

        return $jury2ronda;
    }

}
