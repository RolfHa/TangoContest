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
        $sql = "SELECT * FROM ronda WHERE id=$id;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);
        $kategorie = Kategorie::getById($row['kategorie_id']);
        $stufe = Stufe::getById($row['stufe_id']);
        $ronda = new Ronda(
            $row['kategorie_id'],
            $kategorie,
            $row['stufe_id'],
            $stufe,
            $row['ronda'],
            $row['id']
        );
        //print_r($ronda);
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
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $ronda = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            //  *** Versuch Datenbankabfragen innerhalb einer Schleife zu vermeiden***
            //$kategorie = Kategorie.getById($row['kategorie_id']);
            //$stufe = Stufe.getById($row['stufe_id']);
            $kategorie = new Kategorie($row['kategorie'], $row['kategorie_id']);
            $stufe =new Stufe( $row['stufe'], $row['stufe_id']);
            $ronda[$i] = new Ronda($row['kategorie_id'], $kategorie, $row['stufe_id'], $stufe, $row['ronda'], $row['id']);
            $i++;
        }
        return $ronda;
    }


    public static function  getRondaIdByStufeIdAndKategorieId($kategorie_id, $stufe_id)
    {
        $db = DB::connect();
        $sql = "SELECT id FROM ronda WHERE kategorie_id=$kategorie_id AND stufe_id = $stufe_id order by id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $rondaId = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $rondaId[] = $row['id'];
        }
        return $rondaId;
    }

    public static function  getRondaKategorieId($kategorie_id)
    {
        $db = DB::connect();
        $sql = "SELECT * FROM ronda WHERE kategorie_id=$kategorie_id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $ronda = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            //$kategorie = Kategorie.getById($row['kategorie_id']);
            //$stufe = Stufe.getById($row['stufe_id']);
            //$ronda[$i] = new Ronda($row['kategorie_id'], $kategorie, $row['stufe_id'], $stufe, $row['ronda'], $row['id']);
            $ronda[$i] = new Ronda($row['kategorie_id'], 'dummykategorie', $row['stufe_id'], 'dummystufe', $row['ronda'], $row['id']);
            $i++;
        }
        return $ronda;
    }


    // Löscht die ronda nur wenn noch keine Punkte in der betreffenden Kategorie und Stufe stattfand
    public static function delete($id)    {
        $db = DB::connect();
        $ronda=self::getById($id);
        //  Gibt alle rondas züruck  die die gleiche Kategorie und Stufe haben
        $rondaId = Ronda::getRondaIdByStufeIdAndKategorieId($ronda->getKategorie_id(), $ronda->getStufe_id());
        $tanzpaar2ronda = array();
        for ($i=0; $i < count($rondaId); $i++)        {
            $tanzpaar2ronda = Tanzpaar2ronda::getByRondaId($rondaId[$i]);
        }
        $num=0;
        for ($i=0; $i < count($tanzpaar2ronda); $i++)        {
            $num = $num+Punkte::getAmountByTanzpaar2RondaId($tanzpaar2ronda[$i]->getId());
        }
        if($num !=0)  {
            echo 'kann Ronda nicht löschen da schon punkte vergeben wurden';
            return false;
        }
        else {
            for ($i=0; $i < count($tanzpaar2ronda); $i++){
                Tanzpaar2ronda::delete($tanzpaar2ronda[$i]->getId());
            }
            $jury2ronda=Jury2ronda::getByRondaId($id);
            for ($i=0; $i < count($jury2ronda); $i++){
                Jury2ronda::delete($jury2ronda[$i]->getId());
            }
            $sql = "DELETE FROM ronda WHERE id = $id";
            $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
            return $success;
        }
    }

    public static function change($ronda){
        $db = DB::connect();
        $sql = "Update ronda SET 
        kategorie_id = '". $ronda->getKategorie_id()."' , 
        stufe_id = '". $ronda->getStufe_id()."' ,
        ronda = '". $ronda->getRonda()."'
        WHERE id = '".$ronda->getId()."'
        ";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        //echo "<br>".$sql;
    }

    public static function save($ronda){
        $db = DB::connect();
        $sql = "INSERT INTO ronda (kategorie_id, stufe_id, ronda)
                VALUES ('$ronda->kategorie_id', 
                        '$ronda->stufe_id', 
                        '$ronda->ronda');";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        //echo "<br>".$sql;
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $ronda->setId($id);
        return $ronda;
    }

    //prüft ob es Rondas in der nächsten Stufe gibt (wenn ja soll diese nicht änderbar sein)
    public static function rondaInNextStufe($ronda){
        $stufeCount=0;
        $stufeAll=Stufe::getAll();
        foreach ($stufeAll as $stufe){
            $stufeCount++;
            if ($stufeCount<=Count($stufeAll)){
                if ($stufe->getId()>$ronda->getStufe_id()){
                    // prüf ob es in der nächsten stufe schon rondas gibt
                    foreach (Ronda::getRondaKategorieId($ronda->getKategorie_id()) as $rondaAll){
                        if ($rondaAll->getStufe_id()==$stufe->getId()){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public static function neuanlegen($kategorie_id,$stufe_id){
        //nächste ronda nr ermitteln
        $ronda=Ronda::getRondaIdByStufeIdAndKategorieId($kategorie_id,$stufe_id); // id list aller rondas in dem bereich
        $ronda=end($ronda); // letzte id
        echo "ronda:".$ronda;
        if($ronda!=null){
            $ronda=Ronda::getById($ronda); // ronda objekt
            $ronda=$ronda->getRonda(); // ronda nummer
            $ronda++; // +1
        }
        else {$ronda=1;}
        $ronda=new Ronda($kategorie_id,'dummykat',$stufe_id,'dummystufe',$ronda,'');
        Ronda::save($ronda);
    }




}
