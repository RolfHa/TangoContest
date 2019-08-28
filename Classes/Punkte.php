<?php
class Punkte {
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
}
