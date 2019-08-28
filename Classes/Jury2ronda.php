<?php
class Jury2ronda {
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
}
