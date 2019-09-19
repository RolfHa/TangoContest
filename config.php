<?php

$stage = "local";
//$stage = "copy";
//$stage = "live";

switch ($stage){
    case 'local':
        define("HOST",'localhost');
        define("USER",'tango');
        define("PWD",'tango');
        define("DB_NAME",'tango');
        break;
    case 'copy':
        define("HOST",'10.101.209.13');
        define("USER",'tango');
        define("PWD",'tango');
        define("DB_NAME",'tangokopie');
        break;
    case 'live':
        define("HOST",'10.101.209.3');
        define("USER",'tango');
        define("PWD",'tango');
        define("DB_NAME",'tango');
        break;
    default:
        define("HOST",'localhost');
        define("USER",'tango');
        define("PWD",'tango');
        define("DB_NAME",'tango');
        break;
}


