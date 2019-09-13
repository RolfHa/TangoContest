<?php
class Punkte {
    private $id;
    private $jury_id;
    private $jury;
    private $tanzpaar2ronda_id;
    private $tanzpaar2ronda;
    private $punkte;

    public function __construct($jury_id, $jury, $tanzpaar2ronda_id, $tanzpaar2ronda, $punkte, $id = null)
    {
        if (isset($id)){
            $this->id = $id;
        }
        $this->jury_id = $jury_id;
        $this->jury = $jury;
        if ($jury==""){$this->jury = Jury::GetById($jury_id);}
        $this->tanzpaar2ronda_id = $tanzpaar2ronda_id;
        $this->tanzpaar2ronda=$tanzpaar2ronda;
        if ($tanzpaar2ronda==""){$this->tanzpaar2ronda = Tanzpaar2ronda::GetById($tanzpaar2ronda);}
        $this->punkte = $punkte;
    }


    public function getId()    {
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

    public function getTanzpaar2rondaId()   {
        return $this->tanzpaar2ronda_id;
    }
    public function setTanzpaar2rondaId($tanzpaar2ronda_id)    {
        $this->tanzpaar2ronda_id = $tanzpaar2ronda_id;
    }

    public function getJury()    {
        return $this->jury;
    }
    public function setJury($jury)    {
        $this->jury = $jury;
    }

    public function getTanzpaar2ronda()    {
        return $this->tanzpaar2ronda;
    }
    public function setTanzpaar2ronda($tanzpaar2ronda)    {
        $this->tanzpaar2ronda = $tanzpaar2ronda;
    }

    public function getPunkte() {
        return $this->punkte;
    }
    public function setPunkte($punkte)    {
        $this->punkte = $punkte;
    }


   public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM punkte WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        $row = mysqli_fetch_assoc($result);
        $jury = Jury::getById($row['jury_id']);
        $tanzpaar2ronda = Tanzpaar2ronda::getById($row['tanzpaar2ronda_id']);
        
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

    public static function getALL(){
        $db = DB::connect();
        $sql = "SELECT * from punkte;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        $punkte = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $jury = Jury::getById($row['jury_id']);
            $tanzpaar2ronda = Tanzpaar2ronda::getById($row['tanzpaar2ronda_id']);

            $punkte[$i] = new Punkte(
                $row['jury_id'],
                $jury,
                $row['tanzpaar2ronda_id'],
                $tanzpaar2ronda,
                $row['punkte'],
                $row['id']
            );
            $i++;
        }
        return $punkte;
    }

    public static function getByJuryId($id)    {
        $db = DB::connect();
        $sql = "SELECT * FROM punkte WHERE jury_id = $id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        $punkte = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $jury = Jury::getById($row['jury_id']);
            $tanzpaar2ronda = Tanzpaar2ronda::getById($row['tanzpaar2ronda_id']);

            $punkte[$i] = new Punkte(
                $row['jury_id'],
                $jury,
                $row['tanzpaar2ronda_id'],
                $tanzpaar2ronda,
                $row['punkte'],
                $row['id']
            );
            $i++;
        }
        return $punkte;
    }

    public static function getByRondaId($id)    {
        $db = DB::connect();
        $sql = "SELECT * FROM info_punktetabelle WHERE ronda_id = $id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        $punkte = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $jury = new Jury($row['juryvorname'],$row['jurynachname'],$row['jury_id']);
            $tanzpaar2ronda = "dummy";//Tanzpaar2ronda::getById($row['tanzpaar2ronda_id']);
            $punkte[$i] = new Punkte(
                $row['jury_id'],
                $jury,
                $row['tanzpaar2ronda_id'],
                $tanzpaar2ronda,
                $row['punkte'],
                $row['punkte_id']
            );
            $i++;
        }
        return $punkte;
    }

    public static function getByKategorieIdAndStufeId($kategorie_id,$stufe_id)    {
        $db = DB::connect();
        $sql = "SELECT * FROM info_punktetabelle WHERE kategorie_id=$kategorie_id and stufe_id=$stufe_id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        $punkte = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $jury = "dummy";//new Jury($row['juryvorname'],$row['jurynachname'],$row['jury_id']);
            $tanzpaar2ronda = Tanzpaar2ronda::getById($row['tanzpaar2ronda_id']);
            $punkte[$i] = new Punkte(
                $row['jury_id'],
                $jury,
                $row['tanzpaar2ronda_id'],
                $tanzpaar2ronda,
                $row['punkte'],
                $row['punkte_id']
            );
            $i++;
        }
        return $punkte;
    }

    public static function getAmountByTanzpaar2RondaId($id){
        $db = DB::connect();
        $sql = "SELECT * FROM punkte WHERE tanzpaar2ronda_id = $id";
        $result = mysqli_query($db, $sql);
        $menge=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $menge=$menge+$row['punkte'];
        }
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        return $menge;
    }


    public static function change($punkte)    {
        $db = DB::connect();
        $sql = "Update punkte SET 
        jury_id= '". $punkte->getJuryId()."' , 
        tanzpaar2ronda_id = '". $punkte->getTanzpaar2rondaId()."',
        punkte = ". $punkte->getPunkte()."
        WHERE id = '".$punkte->getId()."'
        ";
        //echo "<br>".$sql;
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        return $success;
    }

    public static function save ($punkte){
        $db = DB::connect();#
        $sql = "INSERT INTO punkte (jury_id, tanzpaar2ronda_id, punkte)
                VALUES ('$punkte->jury_id', 
                        '$punkte->tanzpaar2ronda_id', 
                        $punkte->punkte)";
        //echo "<br>".$sql;
        Mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $punkte->setId($id);
        return $punkte;
    }

    public static function delete ($id){
        return "kommt noch";
    }


    public static function punkteVerarbeiten ($punkteArray){
        if ($punkteArray==null){
            return "<h1>!!!es wurden keine Punkte übergeben !!!</h1>";
        }
        else {
            foreach ($punkteArray as $punkteNeu){
                // leer soll null sein und Komma soll Punkt sein
                $wert=$punkteNeu['wert'];
                if ($wert==''){$wert='null';}
                else {
                    $wert = str_replace(",",".", $wert);
                    $wert = floatval($wert);
                    $wert=number_format($wert, 2, '.', '');
                }
                // Punktewertung Ändern:
                if ($punkteNeu['punkte_id']!=''){
                    // echo "update";
                    $punkte=new Punkte($punkteNeu['jury_id'],'dummy',$punkteNeu['tanzpaar2ronda'],'dummy',$wert,$punkteNeu['punkte_id']);
                    $success = Punkte::change($punkte);
                }
                // Punktewertung neu anlegen
                else {
                    $punkte=new Punkte($punkteNeu['jury_id'],'dummy',$punkteNeu['tanzpaar2ronda'],'dummy',$wert);
                    $success = Punkte::save($punkte);
                }
            }
        }

    }

}
