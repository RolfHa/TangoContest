<?php
class Jury2ronda {
    private $id;
    private $jury_id;
    private $ronda_id;
    private $sitzplatz;

    public function __construct($jury_id, $ronda_id, $sitzplatz,$id)
    {
        $this->id = $id;
        $this->jury_id = $jury_id;
        $this->ronda_id = $ronda_id;
        $this->sitzplatz = $sitzplatz;
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
    public function getJuryId()
    {
        return $this->jury_id;
    }

    /**
     * @param mixed $jury_id
     */
    public function setJuryId($jury_id)
    {
        $this->jury_id = $jury_id;
    }

    /**
     * @return mixed
     */
    public function getRondaId()
    {
        return $this->ronda_id;
    }

    /**
     * @param mixed $ronda_id
     */
    public function setRondaId($ronda_id)
    {
        $this->ronda_id = $ronda_id;
    }

    /**
     * @return mixed
     */
    public function getSitzplatz()
    {
        return $this->sitzplatz;
    }

    /**
     * @param mixed $sitzplatz
     */
    public function setSitzplatz($sitzplatz)
    {
        $this->sitzplatz = $sitzplatz;
    }




    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM jury2ronda WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $jury = Jury.getById($row['jury_id']);
        $ronda = Ronda.getById($row['ronda_id']);
        
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
}
