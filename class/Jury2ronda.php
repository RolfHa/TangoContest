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
    public function __construct($jury_id, $jury, $ronda_id, $ronda, $sitzplatz, $id = null)
    {
        if (isset($id)){
            $this->id = $id;
        }

        $this->jury_id = $jury_id;
        if ($jury==""){
            $this->jury = Jury::GetBYId($jury_id);
        }
        else {
            $this->jury = $jury;
            }

        $this->ronda_id = $ronda_id;
        if ($ronda==""){
            $this->ronda = Ronda::GetBYId($ronda_id);
        }
        else {
            $this->ronda = $ronda;
        }
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

    /**
     * @return mixed
     */
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * @param mixed $jury
     */
    public function setJury($jury)
    {
        $this->jury = $jury;
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

    public static function getAll(){
        $db = DB::connect();
        //$sql = "SELECT * FROM jury2ronda";
        $sql = "SELECT jury2ronda.id, 
                jury_id, 
                jury.vorname,
                jury.nachname, 
                jury2ronda.ronda_id, 
                ronda.ronda, 
                kategorie_id, 
                kategorie, 
                stufe_id, 
                stufe, 
                sitzplatz 
                FROM jury2ronda 
                join jury on jury2ronda.jury_id = jury.id
                join ronda on jury2ronda.ronda_id=ronda.id
                join kategorie on ronda.kategorie_id=kategorie.id
                join stufe on ronda.stufe_id=stufe.id
                order by sitzplatz
                ;";
        $result = mysqli_query($db, $sql);

        $jury2ronda = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            //  *** Versuch Datenbankabfragen innerhalb einer Schleife zu vermeiden***

            //$jury = Jury.getById($row['jury_id']);
            $jury = new Jury($row['vorname'], $row['nachname'], $row['jury_id']);

            //$kategorie = Kategorie.getById($row['kategorie_id']);
            $kategorie = new Kategorie($row['kategorie'], $row['kategorie_id']);

            //$stufe = Stufe.getById($row['stufe_id']);
            $stufe =new Stufe( $row['stufe'], $row['stufe_id']);

            //$ronda = Ronda.getById($row['ronda_id']);
            $ronda = new Ronda(
                $row['kategorie_id'],
                $kategorie,
                $row['stufe_id'],
                $stufe,
                $row['ronda'],
                $row['ronda_id']
            );

            $jury2ronda[$i] = new Jury2ronda(
                $row['jury_id'],
                $jury,
                $row['ronda_id'],
                $ronda,
                $row['sitzplatz'],
                $row['id']
            );
            $i++;
        }


        return $jury2ronda;
    }

    public static function deleteByJuryId($id)
    {
        $db = DB::connect();
        $sql = "DELETE FROM jury2Ronda WHERE jury_id = $id";
        $success = mysqli_query($db, $sql);
        return $success;

    }

    function save ($jury2ronda)
    {
        $db = DB::connect();#
        $sql = "INSERT INTO jury2ronda (jury_id, ronda_id, sitzplatz)
                VALUES ('$jury2ronda->jury_id', 
                        '$jury2ronda->ronda_id', 
                        '$jury2ronda->sitzplatz')";

        Mysqli_query($db, $sql);

        $jury2rondaId = "SELECT id, jury_id, ronda_id, sitzplatz
                         FROM jury2ronda
                         WHERE jury_id LIKE '$jury2ronda->jury_id'
                         AND ronda_id LIKE '$jury2ronda->ronda_id'";

        $result = mysqli_query($db, $jury2rondaId);
        $row = mysqli_fetch_assoc($result);
        $resultID = $row['id'];

        $jury2ronda->setId($resultID);

        return $jury2ronda;
    }
}
