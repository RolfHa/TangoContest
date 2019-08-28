<?php
class Tanzpaar2ronda {

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
        $sql = "SELECT * FROM tanzpaar2ronda WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $tanzpaar2kategorie = Tanzpaar2kategorie.getById($row['tanzpaar2kategorie_id']);
        $ronda = Ronda.getById($row['ronda_id']);
        
        $tanzpaar2ronda = new Tanzpaar2ronda( 
            $row['tanzpaar2kategorie_id'],
            $tanzpaar2kategorie,
            $row['ronda_id'],
            $ronda,
            $row['reihenfolge'],
            $row['id']
        );
        return $tanzpaar2ronda;
    }

    function save ($tanzpaar2ronda)
    {
        $db = DB::connect();#
        $sql = "INSERT INTO tanzpaar2ronda (tanzpaar2kategorie_id, ronda_id, reihenfolge)
                VALUES ('$tanzpaar2ronda->tanzpaar2kategorie_id', 
                        '$tanzpaar2ronda->ronda_id', 
                        '$tanzpaar2ronda->reihenfolge')";

        Mysqli_query($db, $sql);

        $tanzpaar2rondaId = "SELECT id, tanzpaar2kategorie_id, ronda_id
                             FROM tanzpaar2ronda
                             WHERE tanzpaar2kategorie_id LIKE '$tanzpaar2ronda->tanzpaar2kategorie_id'
                             AND ronda_id LIKE '$tanzpaar2ronda->ronda_id'";

        $result = mysqli_query($db, $tanzpaar2rondaId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $tanzpaar2ronda->setId($resultID);

        return $tanzpaar2ronda;
    }

}
