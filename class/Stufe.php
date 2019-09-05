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
        mysqli_query($db, $sql);
        $stufeId = "SELECT id, stufe
                    FROM stufe
                    WHERE stufe LIKE '$stufe->stufe'";
        $result = mysqli_query($db, $stufeId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];
        $stufe -> setId($resultID);
        return $stufe;
    }

    public static function delete()    {
        //Wird nicht benötigt
    }

}
