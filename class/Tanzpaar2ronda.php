<?php
class Tanzpaar2ronda {

    private $id;
    private $tanzpaar2kategorie_id;
    private $tanzpaar2kategorie;
    private $ronda_id;
    private $ronda;
    private $reihenfolge;

    public function __construct($tanzpaar2kategorie_id, $tanzpaar2kategorie, $ronda_id, $ronda, $reihenfolge, $id = null)
    {
        if (isset($id)){$this->id = $id;}
        $this->tanzpaar2kategorie_id = $tanzpaar2kategorie_id;
        if ($tanzpaar2kategorie==''){$this->tanzpaar2kategorie = Tanzpaar2kategorie::GetById($tanzpaar2kategorie_id);}
        else {$this->tanzpaar2kategorie = $tanzpaar2kategorie;}
        $this->ronda_id = $ronda_id;
        if ($ronda==''){ $this->ronda = Ronda::GetById($ronda_id);}
        else {$this->ronda = $ronda;}
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
        $tanzpaar2kategorie = Tanzpaar2kategorie::getById($row['tanzpaar2kategorie_id']);
        $ronda = Ronda::getById($row['ronda_id']);
        $tanzpaar2ronda = new Tanzpaar2ronda($row['tanzpaar2kategorie_id'],$tanzpaar2kategorie,$row['ronda_id'],$ronda,$row['reihenfolge'],$row['id']);
        return $tanzpaar2ronda;
    }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2ronda order by reihenfolge;";
        $result = mysqli_query($db, $sql);
        $tanzpaar2ronda= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $tanzpaar2kategorie = Tanzpaar2kategorie::getById($row['tanzpaar2kategorie_id']);
            $ronda = Ronda::getById($row['ronda_id']);
            $tanzpaar2ronda[$i] = new Tanzpaar2ronda(
                $row['tanzpaar2kategorie_id'],
                $tanzpaar2kategorie,
                $row['ronda_id'],
                $ronda,
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
            $tanzpaar2kategorie = Tanzpaar2kategorie::getById($row['tanzpaar2kategorie_id']);
            $ronda = Ronda::getById($row['ronda_id']);
            $tanzpaar2ronda[$i] = new Tanzpaar2ronda(
                $row['tanzpaar2kategorie_id'],
                $tanzpaar2kategorie,
                $row['ronda_id'],
                $ronda,
                $row['reihenfolge'],
                $row['id']
            );
            $i++;
        }
        return $tanzpaar2ronda;
    }

    public static function save ($tanzpaar2ronda)    {
        $db = DB::connect();#
        $sql = "INSERT INTO tanzpaar2ronda (tanzpaar2kategorie_id, ronda_id, reihenfolge)
                VALUES ('$tanzpaar2ronda->tanzpaar2kategorie_id', 
                        '$tanzpaar2ronda->ronda_id', 
                        '$tanzpaar2ronda->reihenfolge');";
        Mysqli_query($db, $sql);
        //echo "<br>".$sql;
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $tanzpaar2ronda->setId($id);
        return $tanzpaar2ronda;
    }

    public static function delete($id)    {
        $db = DB::connect();
        $sql = "DELETE FROM tanzpaar2ronda WHERE id = $id";
        echo $sql;
        $success = mysqli_query($db, $sql);
        return $success;
    }

    public static function generiereQuali($kategorie_id,$stufe_id){
        $tanzpaar2kategorieAll=Tanzpaar2kategorie::getByKategorieId($kategorie_id);
        $anzahlquali=Anzahlquali::getById($kategorie_id,$stufe_id);
        $reihenfolge=1;
        $rondaNr=1;
        foreach ($tanzpaar2kategorieAll as $tanzpaar2kategorie) {
            //erzeuge Ronda beim ersten mal
            if ($tanzpaar2kategorieAll[0]->getId()==$tanzpaar2kategorie->getId()){
                $ronda=new Ronda($kategorie_id,'dummy',$stufe_id,'dummy',$rondaNr);
                Ronda::save($ronda);
            }
            //erzeuge Ronda wenn der Maxwert erreicht ist
            if ($reihenfolge>$anzahlquali->getMaxpaare()){
                $rondaNr++;
                $reihenfolge=1;
                $ronda=new Ronda($kategorie_id,'dummy',$stufe_id,'dummy',$rondaNr);
                Ronda::save($ronda);
            }
            $tanzpaar2ronda= new Tanzpaar2ronda($tanzpaar2kategorie->getId(),'dummy',$ronda->getId(),'dummy',$reihenfolge,);
            Tanzpaar2ronda::save($tanzpaar2ronda);
            $reihenfolge++;
            //echo "<pre>";
            //print_r($tanzpaar2ronda);
        }

    }

    public static function generiereStufe($kategorie_id,$stufe_id){
        echo "<pre>";
        $fehler="";
        $tanzpaar2kategorieAll=Tanzpaar2kategorie::getByKategorieId($kategorie_id);

        //berechne Punkte
        $punkteAll=Punkte::getByKategorieIdAndStufeId($kategorie_id,$stufe_id);
        foreach ( $tanzpaar2kategorieAll as $tanzpaar2kategorie){
            $tanzpaarPunkte=array();
            foreach ($punkteAll as $punkte){
                if($tanzpaar2kategorie->getId()==$punkte->getTanzpaar2ronda()->getTanzpaar2kategorieId()) {
                    if ($punkte->getPunkte()!=null){
                        $tanzpaarPunkte[]=$punkte->getPunkte();
                    }
                }
            }
            //Prüft ob mindes 3 punkte vorhanden sind
            if (count($tanzpaarPunkte)<3){
                $fehler="<br><b>Achntung:</b> weniger als 3 Wertungen bei Tanzpaar: ".$tanzpaar2kategorie->getTanzpaar()->getStartnummer()." ".$tanzpaar2kategorie->getTanzpaar()->getTanzpaarnamen();
            }
            else {
                //errechnet den Durchschnitt
                $durchschnitt=0;
                sort($tanzpaarPunkte);
                // nimmt den kleinsten und den größten wert nicht mit in die auswertung
                for ($i=1; $i<count($tanzpaarPunkte)-1;$i++){
                    $durchschnitt=$durchschnitt+$tanzpaarPunkte[$i];
                }
                $durchschnitt=$durchschnitt/(count($tanzpaarPunkte)-2);
                $durchschnitt=number_format($durchschnitt,3);
                $tanzpaar2kategorie->setStufendurchschnitt($durchschnitt);
            }
        }

        // funktion für die usort sortierung
        function cmp($a, $b)  {
            if ($a->getStufendurchschnitt() == $b->getStufendurchschnitt()) { return 0; }
            return ($a->getStufendurchschnitt() > $b->getStufendurchschnitt()) ? -1 : 1;
        }
        // sortiert das Array anhand des Punktedruchschnitt von groß nach klein
        usort($tanzpaar2kategorieAll, "cmp");

        /*//test
        foreach ($tanzpaar2kategorieAll as $tanzpaar2kategorie) {
            echo "<br>";
            echo $tanzpaar2kategorie->getId();
            echo " - ";
            echo $tanzpaar2kategorie->getStufendurchschnitt();
        }*/

        //nächste Stufe ermitteln
        $nextStufe=null;
        $stufeAll=$stufeAll=Stufe::getAll();
        for ($i=0; $i<count($stufeAll);$i++){
            if ($stufeAll[$i]->getId()==$stufe_id){
                $nextStufe=$stufeAll[$i+1]->getId();
            }
        }
        if ($nextStufe==null){
            $fehler="<br><b>Achntung:</b> nächste Stufe konnte nicht ermittelt werden";
        }
        /*
        echo "<br>diese stufe=".$stufe_id;
        echo "<br>nächste stufe=".$nextStufe;
        */

        //anzahl der weiterkommenden
        $anzahlquali=Anzahlquali::getById($kategorie_id,$stufe_id);
        $anzahlquali=$anzahlquali->getAnzahlquali();
        //anzahl der maxpaare für die nächst stufe
        $maxpaare=Anzahlquali::getById($kategorie_id,$nextStufe);
        $maxpaare=$maxpaare->getMaxpaare();
        $anzahlRonda=round($anzahlquali/$maxpaare, 0, PHP_ROUND_HALF_UP);
        if ($anzahlRonda==0){$anzahlRonda=1;}
        /*
        // test $anzahlRonda=2;
        echo "<br>anzahlquali=".$anzahlquali;
        echo "<br>maxpaare=".$maxpaare;
        echo "<br>anzahlronda=".$anzahlRonda;
        */
        if (count($tanzpaar2kategorieAll)<$anzahlquali){
            $fehler="<br><b>Achntung:</b> die Anzahl der teilnehmenden Tanzpaare ist kleiner als die Anzahlquali, d.h. es würden alle weierkommen. Bitte in Optionen anpassen.";
        }

        // bei "nuranzeige" oder fehler abbrechen, ansonsten die rondas und die tanzpaar2kategorie erzeugen
        if ($fehler!=""){
            echo $fehler;
        }
        else {
            $ronda=array();
            $reihenfolge=array();
            for ($i=1; $i<=$anzahlRonda;$i++){
                //reihenfolge je ronda anlegen
                $reihenfolge[$i]=0;
                //ronda anlegen ($i ist die rondaNummer)
                $ronda[$i]=new Ronda($kategorie_id,'dummy',$nextStufe,'dummy',$i);
                Ronda::save($ronda[$i]);
                //$ronda[$i]->setId($i);//nur für test
                //print_r($ronda[$i]);
            }

            $tanzpaarCounter=0;
            $letzerwert=0;
            foreach ($tanzpaar2kategorieAll as $tanzpaar2kategorie) {
                $tanzpaarCounter++;
                $erzeugeTanzpaar2ronda=0;
                if ($tanzpaarCounter<=$anzahlquali) {
                    $erzeugeTanzpaar2ronda=1;
                }
                else{
                    //wenn ein Tanzpaare die selben Druchschnitswert wie das letzte Paar hat, kommt es auch mit in die ronda
                    if ($letzerwert==$tanzpaar2kategorie->getStufendurchschnitt()){
                        $erzeugeTanzpaar2ronda=1;
                    }
                }

                if ($erzeugeTanzpaar2ronda==1){
                    $rondaNr=$tanzpaarCounter%$anzahlRonda;
                    if ($rondaNr==0) {$rondaNr=$anzahlRonda;}
                    $reihenfolge[$rondaNr]++;
                    $letzerwert=$tanzpaar2kategorie->getStufendurchschnitt();

                    /*
                    echo "<br>ronda nr: ".$rondaNr;
                    echo " tanzpaar id: ".$tanzpaar2kategorie->getId();
                    echo " punkte= ".$tanzpaar2kategorie->getStufendurchschnitt();
                    echo "reichenfolge: ".$reihenfolge[$rondaNr];
                    */

                    $tanzpaar2ronda= new Tanzpaar2ronda($tanzpaar2kategorie->getId(),'dummy',$ronda[$rondaNr]->getId(),'dummy',$reihenfolge[$rondaNr],);
                    Tanzpaar2ronda::save($tanzpaar2ronda);
                    //print_r($tanzpaar2ronda);
                }
            }
        }
    }


}
