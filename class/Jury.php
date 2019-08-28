<?php
class Jury {

    private $id;
    private $vorname;
    private $nachname;

    /**
     * jury constructor.
     * @param $id
     * @param $vorname
     * @param $nachname
     */
    public function __construct($vorname, $nachname, $id = null)
    {
        if (isset($id)){
            $this->id = $id;
        }
        $this->vorname = $vorname;
        $this->nachname = $nachname;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * @param mixed $vorname
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * @return mixed
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * @param mixed $nachname
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;
    }
    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM jury WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $jury = new Jury( 
            $row['vorname'],
            $row['nachname'],
            $row['id']
        );
        return $jury;
    }

    public static function getAll(){
        $db = DB::connect();
        $sql = "SELECT * FROM jury WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $jury = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $jury[$i] = new Jury(
                $row['vorname'],
                $row['nachname'],
                $row['id']
            );
        }
        return $jury;
    }





    public static function delete($id)
    {
        $db = DB::connect();
        $result = Punkte::getByJuryId($id);
        if ($result === 0)
        {
            $success1 = Jury2ronda::deleteByJuryId($id);
            $sql = "DELETE FROM jury WHERE id = $id";
            $success2 = mysqli_query($db, $sql);
            return $success1 && $success2;
        }
        return false;
    }
}
