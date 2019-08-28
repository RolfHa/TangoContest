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

    public static function delete()
    {
        //Wird nicht benötigt
    }

}
