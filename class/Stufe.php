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
        $sql = "SELECT * FROM stufe WHERE ID=$id";
        $result = mysqli_query($db, $sql);
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
        mysqli_query($db,$sql);
        $id = mysqli_insert_id($db); //gibt die eingetragen ID zurück
        $stufe->setId($id);
        // anzalquali anlegen
        foreach (Kategorie::getAll() as $kategorie){
            $anzahlquali=new Anzahlquali($kategorie->getId(),$kategorie->getKategorie(),$stufe->getId(),$stufe->getStufe(),1,10);
            Anzahlquali::save($anzahlquali);
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
        return $success;
    }

    public static function delete($id) {
        $db = DB::connect();
        $sql = "DELETE FROM anzahlquali WHERE stufe_id = $id";
        mysqli_query($db, $sql);
        $sql = "DELETE FROM stufe WHERE id = $id";
        $success = mysqli_query($db, $sql);
        if ($success!=1){
            foreach (Kategorie::getAll() as $kategorie){
                $anzahlquali=new Anzahlquali($kategorie->getId(),$kategorie->getKategorie(),$id,'dummy',50,10);
                Anzahlquali::save($anzahlquali);
            }
        }
        return $success;
    }

}
