<?php
class Jury2ronda {

    private $id;
    private $jury_id;
    private $jury;
    private $ronda_id;
    private $ronda;
    private $sitzplatz;


    public function __construct($jury_id, $jury, $ronda_id, $ronda, $sitzplatz, $id = null)
    {
        if (isset($id)){            $this->id = $id;        }
        $this->jury_id = $jury_id;
        if ($jury==""){            $this->jury = Jury::GetById($jury_id);        }
        else {            $this->jury = $jury;            }
        $this->ronda_id = $ronda_id;
        if ($ronda==""){            $this->ronda = Ronda::GetById($ronda_id);        }
        else {            $this->ronda = $ronda;        }
        $this->sitzplatz = $sitzplatz;
    }


    public function getId(){
        return $this->id;
    }
    public function setId($id)    {
        $this->id = $id;
    }

    public function getJuryId()    {
        return $this->jury_id;
    }
    public function setJuryId($jury_id)    {
        $this->jury_id = $jury_id;
    }

    public function getRondaId(){
        return $this->ronda_id;
    }
    public function setRondaId($ronda_id){
        $this->ronda_id = $ronda_id;
    }

    public function getSitzplatz(){
        return $this->sitzplatz;
    }
    public function setSitzplatz($sitzplatz){
        $this->sitzplatz = $sitzplatz;
    }

    public function getJury(){
        return $this->jury;
    }
    public function setJury($jury)    {
        $this->jury = $jury;
    }

    public function getRonda()    {
        return $this->ronda;
    }
    public function setRonda($ronda)    {
        $this->ronda = $ronda;
    }

    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM jury2ronda WHERE id=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);
        $jury = Jury::getById($row['jury_id']);
        $ronda = Ronda::getById($row['ronda_id']);
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

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM jury2ronda order by sitzplatz;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $jury2ronda = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $jury = Jury::getById($row['jury_id']);
            $ronda = Ronda::getById($row['ronda_id']);
            $jury2ronda[$i] = new Jury2ronda(
                $row['jury_id'],
                $jury,
                $row['ronda_id'],
                $ronda,
                $row['sitzplatz'],
                $row['id']
            );
            $i++;
        }
        return $jury2ronda;
    }


    public static function getByRondaId($rondaId){
        $db = DB::connect();
        $sql = "SELECT * FROM jury2ronda where ronda_id= $rondaId order by sitzplatz;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $jury2ronda = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $ronda = Ronda::getById($row['ronda_id']);
            $jury = Jury::getById($row['jury_id']);
            $jury2ronda[$i] = new Jury2ronda($row['jury_id'],$jury,$row['ronda_id'],$ronda,$row['sitzplatz'],$row['id']);
            $i++;
        }
        return $jury2ronda;
    }

    public static function deleteByJuryId($id){
        $db = DB::connect();
        $sql = "DELETE FROM jury2Ronda WHERE jury_id = $id";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;

    }

    function save ($jury2ronda){
        $db = DB::connect();#
        $sql = "INSERT INTO jury2ronda (jury_id, ronda_id, sitzplatz)
                VALUES ('$jury2ronda->jury_id', 
                        '$jury2ronda->ronda_id', 
                        '$jury2ronda->sitzplatz')";
        Mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $jury2ronda->setId($id);
        return $jury2ronda;
    }

    public static function delete($id)    {
        $db = DB::connect();
        $sql = "DELETE FROM jury2ronda WHERE id = $id";
        //echo "test".$sql;
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }


    public static function vorigeJury($id)    {
        $dieseRonda=Ronda::getById($id);
        $rondaId=Ronda::getRondaIdByStufeIdAndKategorieId($dieseRonda->getKategorie_id(),$dieseRonda->getStufe_id());
        for($i=0; $i<count($rondaId);$i++){
            if($rondaId[$i]==$id){
                if ($i>0){
                    $jury2rondaAll=Jury2ronda::getByRondaId($rondaId[$i-1]);
                }
                else{
                    //wenn es die erste Ronda ist wird die Jury aus der letzten stufe genommen
                    $kategorie2Stufe=Kategorie2Stufe::getByKategorieId($dieseRonda->getKategorie_id());
                    for ($j=0;$j<count($kategorie2Stufe);$j++){
                        if ($kategorie2Stufe[$j]->getStufe_id()==$dieseRonda->getStufe_id() and $j>0){
                            $lezteStufeRondaIdAll=Ronda::getRondaIdByStufeIdAndKategorieId($dieseRonda->getKategorie_id(),$kategorie2Stufe[$j-1]->getStufe_id());
                            foreach ($lezteStufeRondaIdAll as $lezteStufeRondaId){
                                $jury2rondaAll=Jury2ronda::getByRondaId($lezteStufeRondaId);
                            }
                        }
                    }
                }
                $success=1;
                //alte jury löschen
                foreach (Jury2ronda::getByRondaId($id) as $jury2ronda){
                    $success=Jury2ronda::delete($jury2ronda->getId());
                }
                if ($success==1){
                    // jury aus vorheriger Runde übernehmen
                    foreach ($jury2rondaAll as $jury2ronda){
                        $jury2ronda->setRondaId($id);
                        $success = Jury2ronda::save($jury2ronda);
                    }
                }
                else { echo "alte Jury kann nicht gelöscht werden, wahrscheinlich sind schon Punkte vorhanden"; }
            }
        }
    }

}
