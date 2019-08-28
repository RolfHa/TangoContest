<?php
class Jury2ronda {

    private $id;
    private $jury_id;
    private $jury;
    private $ronda_id;
    private $ronda;
    private $sitzplatz;

    /**
     * jury2Ronda constructor.
     * @param $id
     * @param $jury_id
     * @param $ronda
     * @param $sitzplatz
     */
    public function __construct($jury_id, $ronda_id, $sitzplatz, $id = null)
    {
        if (isset($id)){
            $this->id = $id;
        }
        $this->jury_id = $jury_id;
        $this->jury = Jury::GetBYId($jury_id);
        $this->ronda_id = $ronda_id;
        $this->ronda = Ronda::GetBYId($ronda_id);
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
    public function getRonda()
    {
        return $this->ronda;
    }

    /**
     * @param mixed $ronda
     */
    public function setRonda($ronda)
    {
        $this->ronda = $ronda;
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

    public static function deleteByJuryId($id)
    {
        $db = DB::connect();
        $sql = "DELETE FROM jury2Ronda WHERE jury_id = $id";
        $success = mysqli_query($db, $sql);
        return $success;

    }
}
