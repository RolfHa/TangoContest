<?php
class Tanzpaar2ronda {
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
}
