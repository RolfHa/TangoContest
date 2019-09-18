<?php


abstract class DB
{
    private static $db;

    public static function connect ()
    {
        if (!isset(self::$db)){ //wenn es schon erstellt wurde wird es nicht neu erstellt
            //self::$db = mysqli_connect('10.101.209.13','buch', 'buch', 'buchkopie');

            // �ber konstanten der config.php
            //echo 'selfdb ('.HOST.','.USER.', '.PWD.', '.DB_NAME.'):';
            self::$db = mysqli_connect(HOST,USER, PWD, DB_NAME);
            //print_r(self::$db);
        }
        return self::$db;
    }

    public static function checkDB ($checkID){
        global $action;
        global $area;
        global $optionCheckIDSpeicher;

        //prüfen ob in schon datenbank vorhanden
        $db = DB::connect();

        // löscht alle einträge die äler als einen Monat sind
        $alte=microtime(true)-60*60*24*$optionCheckIDSpeicher;
        $sql = "delete FROM dbcheck WHERE  id < $alte";
        mysqli_query($db, $sql);


        $sql = "SELECT id FROM dbcheck WHERE  id = $checkID";
        $result = mysqli_query($db, $sql);
        global $optionZeigeSQL;
        if ($optionZeigeSQL==1){
            echo "<br>".$sql;
        }

        //echo "<pre>";
        //print_r($result->num_rows);
        //$row = mysqli_fetch_assoc($result);
        //print_r($row);

        if($result->num_rows==0)
        {
            $sql= "INSERT INTO dbcheck (id) VALUES ('$checkID')";
            //echo "checkID :".$checkID;
            mysqli_query($db, $sql);
            global $optionZeigeSQL;
            if ($optionZeigeSQL==1){
                echo "<br>".$sql;
            }
        }
        else        {
            echo "<h2>Ihre Daten wurden bereits gespeichert!</h2,>";
            echo "<h3>( Bitte nicht Refresh(F5)- oder die Vor- und Zurückfunktion des Browsers benutzen. )</h3>";
            $action = "";
            $area = "";
        }
    }
}