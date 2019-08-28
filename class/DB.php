<?php


abstract class DB
{
    private static $db;
    public function connect ()
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
}