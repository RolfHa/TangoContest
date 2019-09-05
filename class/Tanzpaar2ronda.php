<?php
class Tanzpaar2ronda {

    private $id;
    private $tanzpaar2kategorie_id;
    private $tanzpaar2kategorie;
    private $ronda_id;
    private $ronda;
    private $reihenfolge;


    public function __construct( $tanzpaar2kategorie_id, $ronda_id, $reihenfolge, $id = null)
    {
        if (isset($id)){
            $this->id = $id;
        }
        $this->tanzpaar2kategorie_id = $tanzpaar2kategorie_id;
        $this->tanzpaar2kategorie = Tanzpaar2kategorie::GetById($tanzpaar2kategorie_id);
        $this->ronda_id = $ronda_id;
        $this->ronda = Ronda::GetById($ronda_id);
        $this->reihenfolge = $reihenfolge;
    }

    public function getId()    {
        return $this->id;
    }
    public function setId($id)    {
        $this->id = $id;
    }

    public function getTanzpaar2kategorieId(){
        return $this->tanzpaar2kategorie_id;
    }
    public function setTanzpaar2kategorieId($tanzpaar2kategorie_id)    {
        $this->tanzpaar2kategorie_id = $tanzpaar2kategorie_id;
    }

    public function getRondaId(){
        return $this->ronda_id;
    }
    public function setRondaId($ronda_id)    {
        $this->ronda_id = $ronda_id;
    }

    public function getReihenfolge(){
        return $this->reihenfolge;
    }
    public function setReihenfolge($reihenfolge){
        $this->reihenfolge = $reihenfolge;
    }

    public function getTanzpaar2kategorie()    {
        return $this->tanzpaar2kategorie;
    }
    public function setTanzpaar2kategorie($tanzpaar2kategorie)    {
        $this->tanzpaar2kategorie = $tanzpaar2kategorie;
    }

    public function getRonda()    {
        return $this->ronda;
    }
    public function setRonda($ronda)    {
        $this->ronda = $ronda;
    }



    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2ronda WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
//        $tanzpaar2kategorie = Tanzpaar2kategorie::getById($row['tanzpaar2kategorie_id']);
//        $ronda = Ronda::getById($row['ronda_id']);
        $tanzpaar2ronda = new Tanzpaar2ronda(
            $row['tanzpaar2kategorie_id'],
//            $tanzpaar2kategorie,
            $row['ronda_id'],
//            $ronda,
            $row['reihenfolge'],
            $row['id']
        );
        return $tanzpaar2ronda;
    }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2ronda order by reihenfolge;";
        $result = mysqli_query($db, $sql);
        $tanzpaar2ronda= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
//            $tanzpaar2kategorie = Tanzpaar2kategorie::getById($row['tanzpaar2kategorie_id']);
//            $ronda = Ronda::getById($row['ronda_id']);
            $tanzpaar2ronda[$i] = new Tanzpaar2ronda(
                $row['tanzpaar2kategorie_id'],
//                $tanzpaar2kategorie,
                $row['ronda_id'],
//                $ronda,
                $row['reihenfolge'],
                $row['id']
            );
            $i++;
        }
        return $tanzpaar2ronda;
    }

    public static function getByRondaId($id)    {
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2ronda WHERE ronda_id = $id order by reihenfolge;" ;
        $result = mysqli_query($db, $sql);
        $tanzpaar2ronda= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $tanzpaar2kategorie = "";//Tanzpaar2kategorie::getById($row['tanzpaar2kategorie_id']);
            $ronda = "";//Ronda::getById($row['ronda_id']);
            $tanzpaar2ronda[$i] = new Tanzpaar2ronda(
                $row['tanzpaar2kategorie_id'],
                $row['ronda_id'],
                $row['reihenfolge'],
                $row['id']
            );
            $i++;
        }
        return $tanzpaar2ronda;
    }

    function save ($tanzpaar2ronda)    {
        $db = DB::connect();#
        $sql = "INSERT INTO tanzpaar2ronda (tanzpaar2kategorie_id, ronda_id, reihenfolge)
                VALUES ('$tanzpaar2ronda->tanzpaar2kategorie_id', 
                        '$tanzpaar2ronda->ronda_id', 
                        '$tanzpaar2ronda->reihenfolge');";
        Mysqli_query($db, $sql);
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $tanzpaar2ronda->setId($id);
        return $tanzpaar2ronda;
    }

    public static function delete($id)
    {
        $db = DB::connect();
        $sql = "DELETE FROM tanzpaar2ronda WHERE id = $id";
        $success = mysqli_query($db, $sql);
        return $success;
    }


}
