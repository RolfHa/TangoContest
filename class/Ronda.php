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

    public static function getKategorieIdById($id)
    {
        $db = DB::connect();
        $sql = "SELECT kategorie_id FROM ronda WHERE id = $id";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $katId = $row['kategorie_id'];
        }
        return $katId;
    }
    public static function getStufeIdById($id)
    {
        $db = DB::connect();
        $sql = "SELECT stufe_id FROM ronda WHERE id = $id";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $stufeId = $row['stufe_id'];
        }
        return $stufeId;
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


    // Löscht die ronda nur wenn noch kein Tanz in der betreffenden Kategorie und Stufe stattfand
    public static function delete($id)
    {
        $db = DB::connect();
        $resultKat = Ronda::getKategorieIdById($id); //Gibt Kategorie der ronda zurück
        $resultStufe = Ronda::getStufeIdById($id); //Gibt Stufe der ronda zurück
        $rondaIds = Ronda::getRondaIdByStufeIdAndKategorieId($resultKat, $resultStufe); //  Gibt alle ids züruck  die die gleiche Kategorie und Stufe haben
        $ids = array();
        $num = 0;
        for ($i=0; $i < count($rondaIds); $i++)
        {
            $ids = Tanzpaar2ronda::getIdByRondaId($rondaIds[$i]);
        }
        for ($i=0; $i < count($ids); $i++)
        {
            $num = Punkte::getAmountByTanzpaar2RondaId($ids[$i]);
            if($num !==0)
            {
                return false;
            }
            else
            {
                $success1 = Tanzpaar2ronda::delete($id);
                $sql = "DELETE FROM ronda WHERE id = $id";
                $success2 = mysqli_query($db, $sql);
                return $success1 && $success2;
            }
        }

    }
}
