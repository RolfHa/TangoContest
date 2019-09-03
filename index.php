<?php
// config datei laden (kann außerhalb des WEB-zugriffs gespeichert werden)
include_once  'config.php';
//alle andern klassen laden (dateien müssen den klassennamen haben und im Verzeichnis class liegen)
spl_autoload_register(function ($class_name) {include "class" . DIRECTORY_SEPARATOR . $class_name . '.php';});

echo '<pre>';
print_r($_POST);
print_r($_REQUEST);
echo '</pre>';

$area = '';
$action = '';
$view = '';
$id = 0;
// beide Werte müssen immer übergeben werden, nur bei Erstaufruf gibt es sie nicht
if (isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    $area = $_REQUEST['area'];
}
if (isset($_REQUEST['id'])){
    $id = (int)$_REQUEST['id'];
}

switch ($action){
    case 'listeanzeigen':
        $view = $area . 'liste';
        break;
    case 'aendern':
        $view = $area . 'aendern';
        break;
    case 'eingeben':
        $view = $area . 'eingeben';
        break;
    case 'speichern':
        $view =  $area . 'liste';
        switch ($area){
            case 'teilnehmer':
                $teinehmer = new Teilnehmer($_POST['vorname'],$_POST['nachname'],$_POST['geschlecht'],$_POST['telefonnummer'],$_POST['wohnort'],$_POST['wohnland'],$_POST['kuenstlername'], $_POST['geburtsname']);
                $teinehmer->setId($_POST['id']);
                $success = Teilnehmer::change($teinehmer);
            case 'tanzpaar':
                $tanzpaar = new Tanzpaar($_POST['startnummer'],$_POST['teilnehmer1'],'',$_POST['teilnehmer2'],'',$_POST['fuehrungsfolge'],$_POST['anmeldebetrag'],$_POST['bezahlt'],$_POST['bezahldatum'],$_POST['bezahlart'],'');
                $tanzpaar ->setId($_POST['id']);
                $success = Tanzpaar::change($tanzpaar);
            case 'jury':
                $jury = new Jury($_POST['vorname'],$_POST['nachname']);
                $jury->setId($_POST['id']);
                $success = Jury::change($jury);
            case 'ronda':
            case 'punke':
        }
    case 'neuanlegen':
        $view =  $area . 'liste';
        switch ($area){
            case 'teilnehmer':
                $teinehmer = new Teilnehmer($_POST['vorname'],$_POST['nachname'],$_POST['geschlecht'],$_POST['telefonnummer'],$_POST['wohnort'],$_POST['wohnland'],$_POST['kuenstlername'], $_POST['geburtsname']);
                $success = Teilnehmer::save($teinehmer);
            case 'tanzpaar':
                $tanzpaar = new Tanzpaar($_POST['startnummer'],$_POST['teilnehmer1'],'',$_POST['teilnehmer2'],'',$_POST['fuehrungsfolge'],$_POST['anmeldebetrag'],$_POST['bezahlt'],$_POST['bezahldatum'],$_POST['bezahlart'],'');
                $success = Tanzpaar::save($tanzpaar);
                echo 'angelegt';
            case 'jury':
                $jury = new Jury($_POST['vorname'],$_POST['nachname']);
                $success = Jury::save($jury);
            case 'ronda':
            case 'punke':
        }
    case 'loeschen':
        $view =  $area . 'liste';
        switch ($area){
            case 'teilnehmer':
                Teilnehmer::delete($id);
            case 'tanzpaar':
                Tanzpaar::delete($id);
            case 'jury':
                Jury::delete($id);
            case 'ronda':
                Ronda::delete($id);
            case 'punke':
                Punkte::delete($id);
        }
    default :
     //   $view = 'teilnehmerliste';
}

include 'view/basicview.php';

?>


