<?php
class Tanzpaar2ronda {

    private $id;
    private $tanzpaar2kategorie_id;
    private $tanzpaar2kategorie;
    private $ronda_id;
    private $ronda;
    private $reihenfolge;

    /**
     * tanzpaar2ronda constructor.
     * @param $id
     * @param $tanzpaar2kategorie_id
     * @param $ronda_id
     * @param $reihenfolge
     */
    public function __construct( $tanzpaar2kategorie_id, $ronda_id, $reihenfolge, $id = null)
    {
        if (isset($id)){
            $this->id = $id;
        }
        $this->tanzpaar2kategorie_id = $tanzpaar2kategorie_id;
        $this->tanzpaar2kategorie = Tanzpaar2kategorie::GetById($tanzpaar2kategorie_id);
        $this->ronda_id = $ronda_id;
        $this->ronda = Ronda::GetById($ronda_id);
        $this->reihenfolge = $reihenfolge;
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
    public function getTanzpaar2kategorieId()
    {
        return $this->tanzpaar2kategorie_id;
    }

    /**
     * @param mixed $tanzpaar2kategorie_id
     */
    public function setTanzpaar2kategorieId($tanzpaar2kategorie_id)
    {
        $this->tanzpaar2kategorie_id = $tanzpaar2kategorie_id;
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
    public function getReihenfolge()
    {
        return $this->reihenfolge;
    }

    /**
     * @param mixed $reihenfolge
     */
    public function setReihenfolge($reihenfolge)
    {
        $this->reihenfolge = $reihenfolge;
    }
    public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM tanzpaar2ronda WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $tanzpaar2kategorie = Tanzpaar2kategorie.getById($row['tanzpaar2kategorie_id']);
        $ronda = Ronda.getById($row['ronda_id']);
        
        $tanzpaar2ronda = new Tanzpaar2ronda( 
            $row['tanzpaar2kategorie_id'],
            $tanzpaar2kategorie,
            $row['ronda_id'],
            $ronda,
            $row['reihenfolge'],
            $row['id']
        );
        return $tanzpaar2ronda;
    }

    public static function delete($id)
    {
        $db = DB::connect();
        $sql = "DELETE FROM tanzpaar2ronda WHERE id = $id";
        $success = mysqli_query($db, $sql);
        return $success;
    }

    public static function getIdByRondaId($id)
    {
        $db = DB::connect();
        $sql = "SELECT id FROM tanzpaar2ronda WHERE ronda_id = $id";
        $result = mysqli_query($db, $sql);
        $ids = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $ids[] = $row['id'];
        }
        return $ids;
    }
}
