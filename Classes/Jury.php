<?php
class Jury {
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
}
