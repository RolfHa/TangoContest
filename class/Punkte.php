<?php
class Punkte {

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
        $sql = "SELECT * FROM punkte WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $jury = Jury.getById($row['jury_id']);
        $tanzpaar2ronda = Tanzpaar2ronda.getById($row['tanzpaar2ronda_id']);
        
        $punkte = new Punkte( 
            $row['jury_id'],
            $jury,
            $row['tanzpaar2ronda_id'],
            $tanzpaar2ronda,
            $row['punkte'],
            $row['id']
        );
        return $punkte;
    }

    function save ($punkte)
    {
        $db = DB::connect();#
        $sql = "INSERT INTO punkte (jury_id, tanzpaar2ronda_id, punkte)
                VALUES ('$punkte->jury_id', 
                        '$punkte->tanzpaar2ronda_id', 
                        '$punkte->punkte')";

        Mysqli_query($db,$sql);

        $punkteId = "SELECT id, jury_id, tanzpaar2ronda_id, punkte
                     FROM punkte
                     WHERE jury_id LIKE '$punkte->jury_id'
                     AND tanzpaar2ronda_id LIKE '$punkte->tanzpaar2ronda_id'";

        $result = mysqli_query($db, $punkteId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $punkte->setId($resultID);

        return $punkte;
    }

}
