<?php
class Ronda {
    private $id;
    private $kategorie_id;
    private $kategorie;
    private $stufe_id;
    private $stufe;
    private $ronda;
    
    function __construct($kategorie_id, $kategorie, $stufe_id, $stufe, $ronda, $id = null) {
        if(isset($id)){
            $this->id = $id;
        }
        $this->kategorie_id = $kategorie_id;
        $this->kategorie = $kategorie;
        $this->stufe_id = $stufe_id;
        $this->stufe = $stufe;
        $this->ronda = $ronda;
    }
    
    function getId() {
        return $this->id;
    }

    function getKategorie_id() {
        return $this->kategorie_id;
    }

    function getKategorie() {
        return $this->kategorie;
    }

    function getStufe_id() {
        return $this->stufe_id;
    }

    function getStufe() {
        return $this->stufe;
    }

    function getRonda() {
        return $this->ronda;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setKategorie_id($kategorie_id) {
        $this->kategorie_id = $kategorie_id;
    }

    function setKategorie($kategorie) {
        $this->kategorie = $kategorie;
    }

    function setStufe_id($stufe_id) {
        $this->stufe_id = $stufe_id;
    }

    function setStufe($stufe) {
        $this->stufe = $stufe;
    }

    function setRonda($ronda) {
        $this->ronda = $ronda;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM ronda WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $kategorie = Kategorie.getById($row['kategorie_id']);
        $stufe = Stufe.getById($row['stufe_id']);
        $ronda = new Ronda(
            $row['kategorie_id'],
            $kategorie,
            $row['stufe_id'],
            $stufe,
            $row['ronda'],
            $row['id']
        );
        return $ronda;
    }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT  ronda.id, ronda.ronda, kategorie_id, kategorie, stufe_id, stufe
                FROM ronda 
                join kategorie on ronda.kategorie_id=kategorie.id
                join stufe on ronda.stufe_id=stufe.id
                order by kategorie_id, stufe_id, ronda
                ;";
        $result = mysqli_query($db, $sql);
        $ronda = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            //  *** Versuch Datenbankabfragen innerhalb einer Schleife zu vermeiden***
            //$kategorie = Kategorie.getById($row['kategorie_id']);
            $kategorie = new Kategorie($row['kategorie'], $row['kategorie_id']);
            //$stufe = Stufe.getById($row['stufe_id']);
            $stufe =new Stufe( $row['stufe'], $row['stufe_id']);
            //$ronda = Ronda.getById($row['ronda_id']);
            $ronda[$i] = new Ronda($row['kategorie_id'], $kategorie, $row['stufe_id'], $stufe, $row['ronda'], $row['id']);
            $i++;
        }
        return $ronda;
    }


    public static function  getRondaIdByStufeIdAndKategorieId($kategorie_id, $stufe_id)
    {
        $db = DB::connect();
        $sql = "SELECT id FROM ronda WHERE kategorie_id=$kategorie_id AND stufe_id = $stufe_id";
        $result = mysqli_query($db, $sql);
        $rondaId = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $rondaId[] = $row['id'];
        }
        return $rondaId;
    }


    // Löscht die ronda nur wenn noch keine Punkte in der betreffenden Kategorie und Stufe stattfand
    public static function delete($id)    {
        $db = DB::connect();
        $ronda=self::getById($id)
        $rondaId = Ronda::getRondaIdByStufeIdAndKategorieId($ronda->getKategorie_id(), $ronda->getStufe_id()); //  Gibt alle rondas züruck  die die gleiche Kategorie und Stufe haben
        $tanzpaar2rondaId = array();
        for ($i=0; $i < count($rondaId); $i++)        {
            $tanzpaar2rondaId = Tanzpaar2ronda::getIdByRondaId($rondaId[$i]);
        }
        $num=0;
        for ($i=0; $i < count($tanzpaar2rondaId); $i++)        {
            $num = $num+Punkte::getAmountByTanzpaar2RondaId($tanzpaar2rondaId[$i]);
        }
        if($num !=0)  {
           return false;
        }
        else {
            for ($i=0; $i < count($tanzpaar2rondaId;$i++){
                Tanzpaar2ronda::delete($tanzpaar2rondaId[$i]);
            }
            $jury2rondaId=Jury2ronda::getByRondaId($id);
            for ($i=0; $i < count($jury2rondaId;$i++){
                Jury2ronda::delete($jury2rondaId[$i]->getId());
            }

            $sql = "DELETE FROM ronda WHERE id = $id";
            $success = mysqli_query($db, $sql);
            return $success;
            }
        }
    }

    function save($ronda){
        $db = DB::connect();
        $sql = "INSERT INTO ronda (kategorie_id, stufe_id, ronda)
                VALUES ('$ronda->kategorie_id', 
                        '$ronda->stufe_id', 
                        '$ronda->ronda')";
        mysqli_query($db, $sql);
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $ronda->setId($id);
        return $ronda;
    }

}
