<?php
class Stufe {
    private $id;
    private $stufe;
    
    function __construct($stufe, $id = null) {
        if(isset($id)){
            $this->id = $id;
        }
        $this->stufe = $stufe;
    }
    
    function getId() {
        return $this->id;
    }
    function getStufe() {
        return $this->stufe;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setStufe($stufe) {
        $this->stufe = $stufe;
    }


    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM stufe WHERE id=$id";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $row = mysqli_fetch_assoc($result);

        $stufe = new Stufe( 
            $row['stufe'],
            $row['id']
        );
        return $stufe;
    }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM stufe order by id;";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $stufe = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $stufe[$i] = new Stufe(
                $row['stufe'],
                $row['id']
            );

            $i++;
        }
        return $stufe;
    }


    function save ($stufe)    {
        $db = DB::connect();
        $sql = "INSERT INTO stufe (stufe)
                VALUES ('$stufe->stufe')";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $stufe->setId($id);
        // anzalquali anlegen
        foreach (Kategorie::getAll() as $kategorie){
            $anzahlquali=new Kategorie2Stufe($kategorie->getId(),$kategorie->getKategorie(),$stufe->getId(),$stufe->getStufe(),1,10);
            Kategorie2Stufe::save($anzahlquali);
        }
        return $stufe;
    }

    public static function change($stufe)    {
        $db = DB::connect();
        $sql = "Update stufe SET 
        stufe = '". $stufe->getStufe()."' 
        WHERE id = '".$stufe->getId()."'
        ";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        return $success;
    }

    public static function delete($id) {
        $db = DB::connect();
        $sql = "DELETE FROM anzahlquali WHERE stufe_id = $id";
        mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        $sql = "DELETE FROM stufe WHERE id = $id";
        $success = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }
        
        if ($success!=1){
            foreach (Kategorie::getAll() as $kategorie){
                $anzahlquali=new Kategorie2Stufe($kategorie->getId(),$kategorie->getKategorie(),$id,'dummy',50,10);
                Kategorie2Stufe::save($anzahlquali);
            }
        }
        return $success;
    }

    public static function ueberspringen($kategorie_id,$stufe_id) {
        $stufeAll=Stufe::getAll();
        for ($i=0; $i<count($stufeAll);$i++){
            if ($stufeAll[$i]->getId()==$stufe_id and $i<count($stufeAll)-1){
                foreach (Ronda::getRondaIdByStufeIdAndKategorieId($kategorie_id,$stufe_id) as $rondaId) {
                    $ronda=Ronda::getById($rondaId);
                    $ronda->setStufe_id($stufeAll[$i+1]->getId());
                    Ronda::change($ronda);
                }
                $option=Optionen::getById('StufeUeberspringen');
                $option->setWert(0);
                Optionen::change($option);
            }
        }



    }

}
