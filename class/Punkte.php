<?php
class Punkte {
    private $id;
    private $jury_id;
    private $jury;
    private $tanzpaar2ronda_id;
    private $punkte;

    /**
     * punkte constructor.
     * @param $id
     * @param $jury_id
     * @param $tanzppar2ronda_id
     * @param $punkte
     */
    public function __construct($jury_id, $tanzpaar2ronda_id, $punkte, $id = null)
    {
        if (isset($id)){
            $this->id = $id;
        }
        $this->jury_id = $jury_id;
        $this->jury = Jury::GetById($jury_id);
        $this->tanzpaar2ronda_id = $tanzpaar2ronda_id;
        $this->punkte = $punkte;
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
    public function getTanzpaar2rondaId()
    {
        return $this->tanzppar2ronda_id;
    }

    /**
     * @param mixed $tanzppar2ronda_id
     */
    public function setTanzpaar2rondaId($tanzpaar2ronda_id)
    {
        $this->tanzpaar2ronda_id = $tanzpaar2ronda_id;
    }

    /**
     * @return mixed
     */
    public function getPunkte()
    {
        return $this->punkte;
    }

    /**
     * @param mixed $punkte
     */
    public function setPunkte($punkte)
    {
        $this->punkte = $punkte;
    }

   public static function getById($id){
        $db = DB::connect();
        $sql = "SELECT * FROM punkte WHERE ID=$id";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $jury = Jury.getById($row['jury_id']);
        $tanzpaar2ronda = Tanzpaar2ronda.getById($row['tanzpaar2ronda_id']);
        
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
        $punkte = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $jury = Jury.getById($row['jury_id']);
            $tanzpaar2ronda = Tanzpaar2ronda.getById($row['tanzpaar2ronda_id']);

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

    public static function getByJuryId($id)
    {
        $db = DB::connect();
        $sql = "SELECT * FROM punkte WHERE jury_id = $id";
        $result = mysqli_num_rows($db, $sql);
        return $result;
    }

    public static function getAmountByTanzpaar2RondaId($id)
    {
        $db = DB::connect();
        $sql = "SELECT * FROM punkte WHERE tanzpaar2ronda_id = $id";
        $result = mysqli_num_rows($db, $sql);
        $menge=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $menge=$menge+$row['punkte'];
        }
        return $menge;
    }

    function save ($punkte)
    {
        $db = DB::connect();#
        $sql = "INSERT INTO punkte (jury_id, tanzpaar2ronda_id, punkte)
                VALUES ('$punkte->jury_id', 
                        '$punkte->tanzpaar2ronda_id', 
                        '$punkte->punkte')";

        Mysqli_query($db,$sql);

        $punkteId = "SELECT id, jury_id, tanzpaar2ronda_id, punkte
                     FROM punkte
                     WHERE jury_id LIKE '$punkte->jury_id'
                     AND tanzpaar2ronda_id LIKE '$punkte->tanzpaar2ronda_id'";

        $result = mysqli_query($db, $punkteId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $punkte->setId($resultID);

        return $punkte;
    }

}
