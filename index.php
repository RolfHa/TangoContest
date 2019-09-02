<?php
// config datei laden (kann außerhalb des WEB-zugriffs gespeichert werden)
include_once  'config.php';
//alle andern klassen laden (dateien müssen den klassennamen haben und im Verzeichnis class liegen)
spl_autoload_register(function ($class_name) {include "class" . DIRECTORY_SEPARATOR . $class_name . '.php';});

$area = '';
$action = '';
//$action = 'anzeigen';
// beide Werte müssen immer übergeben werden, nur bei Erstaufruf gibt es sie nicht
if (isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    $area = $_REQUEST['area'];
}
$id = 0;
if (isset($_GET['id'])){
    $id = (int)$_GET['id'];
}

//$action = 'anzeigen';
//$area = 'teilnehmer';
$area = 'teilnehmer';

switch ($action){
    case 'anzeigen':
        //if ($area === 'teilnehmer' || $area === 'jury' || $area === 'tanzpaar') {
            $view = $area . 'liste';
        //}
            break;
    case 'aendern':

            $view = $area . 'aendern';
            $t = Teilnehmer::getById($id);
            break;
    default :
        $view = 'teilnehmerliste';
}



//$view = 'tanzpaarliste';

include 'view/basicview.php';

// post variablen übergeben
if  (isset ($_POST["id"]) ){$id=$_POST["id"];}




//Teilnehmer
if  (isset ($_POST["teilnehmerliste"]) ){
    //HTML::teilnehmerListe(Teilnehmer::getAll());
    $teilnehmer=Teilnehmer::getAll();
    echo '<pre>';
    print_r($teilnehmer);
    echo '</pre>';
    }
//elseif (isset ($_POST["teilnehmeredit"]) ){HTML::teilnehmerEdit(Teilnehmer::getById($id));}

elseif (isset ($_POST["teilnehmerneu"]) ){
    //HTML::teilnehmerNew();
    echo'test id 10';
    //HTML::teilnehmerEdit(Teilnehmer::getById($id));
    $teilnehmer=Teilnehmer::getById(10);
    echo '<pre>';
    print_r($teilnehmer);
    echo '</pre>';
}
//elseif (isset ($_POST["teilnehmerspeichern"]) ){   }
//elseif (isset ($_POST["teilnehmerloeschen"]) ){   }

/*
//Tanzpaar::
elseif (isset ($_POST["tanzpaarliste"]) ){HTML::tanzpaarListe(Tanzpaar::getAll());}
elseif (isset ($_POST["tanzpaaredit"]) ){HTML::tanzpaarEdit(Tanzpaar::getById($id));}
elseif (isset ($_POST["tanzpaarneu"]) ){HTML::tanzpaarNew(Tanzpaar::getAll());}
elseif (isset ($_POST["tanzpaarspeichern"]) ){   }
elseif (isset ($_POST["tanzpaarloeschen"]) ){   }
*/

//Jury
elseif (isset ($_POST["juryliste"]) ){
    //HTML::juryListe(Jury::getAll());}
    $test=Jury::getAll();
    echo '<pre>';
    print_r($test);
    echo '</pre>';
    }
//elseif (isset ($_POST["juryedit"]) ){HTML::juryEdit(Jury::getById($id));}
elseif (isset ($_POST["juryneu"]) ){
    //HTML::juryNew();}
    echo 'test id 5';
    $test=Jury::getById(5);
    echo '<pre>';
    print_r($test);
    echo '</pre>';
}
elseif (isset ($_POST["juryspeichern"]) ){   }
elseif (isset ($_POST["juryloeschen"]) ){   }


//Ronda
elseif (isset ($_POST["rondaliste"]) ){
    //HTML::rondaListe(Ronda::getAll());}
    $test=Ronda::getAll();
    echo '<pre>';
    print_r($test);
    echo '</pre>';
}
//elseif (isset ($_POST["rondaedit"]) ){HTML::rondaEdit(Ronda::getById($id));}
elseif (isset ($_POST["rondaneu"]) ){
    //HTML::rondaNew();}
    echo 'test id 5';
    $test=Ronda::getById(5);
    echo '<pre>';
    print_r($test);
    echo '</pre>';
}
elseif (isset ($_POST["rondaspeichern"]) ){   }
elseif (isset ($_POST["rondaoeschen"]) ){   }

/*
//Punkte
elseif (isset ($_POST["punkteliste"]) ){HTML::punkteUebersicht(Ronda::getUebersicht());}
elseif (isset ($_POST["punktetabelle"]) ){HTML::punkteListe(Tanzpaar::getTanzpaarByRondaId($id),Punkt::getAll());}
elseif (isset ($_POST["punkteedit"]) ){HTML::punkteEdit(Punkt::getById($id));}
elseif (isset ($_POST["punkeneu"]) ){HTML::juryNew();}
elseif (isset ($_POST["punktespeichern"]) ){   }
elseif (isset ($_POST["punkteloeschen"]) ){   }
*/



?>


