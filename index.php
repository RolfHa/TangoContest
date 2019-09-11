<?php
// config datei laden (kann außerhalb des WEB-zugriffs gespeichert werden)
include_once  'config.php';
//alle andern klassen laden (dateien müssen den klassennamen haben und im Verzeichnis class liegen)
spl_autoload_register(function ($class_name) {include "class" . DIRECTORY_SEPARATOR . $class_name . '.php';});

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
$nobasicview=0;




switch ($action){
    case 'listeanzeigen':
        $view = $area . 'liste';
        if ($area=='punkte'){$view = 'rondaliste';}
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
                break;
            case 'tanzpaar':
                $tanzpaar = new Tanzpaar($_POST['startnummer'],$_POST['teilnehmer1'],'',$_POST['teilnehmer2'],'',$_POST['fuehrungsfolge'],$_POST['anmeldebetrag'],$_POST['bezahlt'],$_POST['bezahldatum'],$_POST['bezahlart'],'');
                $tanzpaar ->setId($_POST['id']);
                $success = Tanzpaar::change($tanzpaar);
                break;
            case 'tanzpaar2kategorie':
                $tanzpaar2kategorie = new Tanzpaar2kategorie($_REQUEST['id'],'dummy',$_REQUEST['kategorie_id'],'dummy');
                $success = Tanzpaar2kategorie::save($tanzpaar2kategorie);
                $view =  'tanzpaaraendern';
                break;
            case 'tanzpaar2ronda':
                $tanzpaar2ronda = new Tanzpaar2ronda($_REQUEST['tanzpaar2kategorie_id'],'dummy',$_REQUEST['ronda_id'],'dummy',$_REQUEST['reihenfolge']);
                $success = Tanzpaar2ronda::save($tanzpaar2ronda);
                $id=$_REQUEST['ronda_id'];
                $view =  'rondateilnehmeraendern';
                break;
            case 'kategorie':
                $kategorie = new Kategorie($_POST['kategorie'],$_POST['id']);
                $success = Kategorie::change($kategorie);
                $view =  'optionenliste';
                break;
            case 'stufe':
                $stufe = new Stufe($_POST['stufe'],$_POST['id']);
                $success = Stufe::change($stufe);
                $view =  'optionenliste';
                break;
            case 'bezahlart':
                $bezahlart = new Bezahlart($_POST['bezahlart'],$_POST['id']);
                $success = Bezahlart::change($bezahlart);
                $view =  'optionenliste';
                break;
            case 'jury':
                $jury = new Jury($_REQUEST['vorname'],$_REQUEST['nachname']);
                $jury->setId($_POST['id']);
                $success = Jury::change($jury);
                break;
            case 'jury2ronda':
                $jury2ronda = new Jury2ronda($_REQUEST['jury_id'],'',$_REQUEST['ronda_id'],'',$_REQUEST['sitzplatz']);
                $success = Jury2ronda::save($jury2ronda);
                $id=$_REQUEST['ronda_id'];
                $view =  'rondateilnehmeraendern';
                break;
            case 'ronda':
                $view =  'rondaeingeben';
                break;
            case 'punkte':
                Punkte::punkteVerarbeiten($_REQUEST['punkte']);
                $view =  'rondapunkteaendern';
                break;
            case 'anzahlquali':
                $anzahlquali = new Anzahlquali($_REQUEST['kategorie_id'],'',$_REQUEST['stufe_id'],'',$_REQUEST['anzahlquali'],$_REQUEST['maxpaare']);
                $success = Anzahlquali::change($anzahlquali);
                $view =  'optionenliste';
                break;
            case 'optionen':
                $optionen =new Optionen($_POST['name'],$_POST['wert']);
                $success = Optionen::change($optionen);
                break;
        }
        break;
    case 'neuanlegen':
        $view =  $area . 'liste';
        switch ($area){
            case 'teilnehmer':
                $teinehmer = new Teilnehmer($_POST['vorname'],$_POST['nachname'],$_POST['geschlecht'],$_POST['telefonnummer'],$_POST['wohnort'],$_POST['wohnland'],$_POST['kuenstlername'], $_POST['geburtsname']);
                $success = Teilnehmer::save($teinehmer);
                break;
            case 'tanzpaar':
                $tanzpaar = new Tanzpaar($_POST['startnummer'],$_POST['teilnehmer1'],'',$_POST['teilnehmer2'],'',$_POST['fuehrungsfolge'],$_POST['anmeldebetrag'],$_POST['bezahlt'],$_POST['bezahldatum'],$_POST['bezahlart'],'');
                $success = Tanzpaar::save($tanzpaar);
                echo 'angelegt';
                break;
            case 'kategorie':
                $kategorie = new Kategorie($_POST['kategorie']);
                $success = Kategorie::save($kategorie);
                $view =  'optionenliste';
                break;
            case 'stufe':
                $stufe = new Stufe($_POST['stufe']);
                $success = Stufe::save($stufe);
                $view =  'optionenliste';
                break;
            case 'bezahlart':
                $bezahlart = new Bezahlart($_POST['bezahlart']);
                $success = Bezahlart::save($bezahlart);
                $view =  'optionenliste';
                break;
            case 'jury':
                $jury = new Jury($_POST['vorname'],$_POST['nachname']);
                $success = Jury::save($jury);
                break;
            case 'ronda':
                Ronda::neuanlegen($_REQUEST['kategorie_id'],$_REQUEST['stufe_id']);
                $view =  'rondaliste';
                break;
            case 'punkte':
                //siehe Punke speichern
                break;
            case 'optionen':
                $optionen =new Optionen($_POST['name'],$_POST['wert']);
                $success = Optionen::save($optionen);
                break;
        }
        break;
    case 'generieren':
        switch ($area){
            case 'rondastufe1':
                Tanzpaar2ronda::generiereQuali($_REQUEST['kategorie_id'],$_REQUEST['stufe_id']);
                $area = 'ronda';
                $view = 'rondaliste';
                break;
            case 'ronda':
                $tanzpaar2kategorieAll=Tanzpaar2ronda::generiereStufe($_REQUEST['kategorie_id'],$_REQUEST['stufe_id'],'anlegen');
                $area = 'ronda';
                $view = 'gewinnerliste';
                break;
            case 'gewinner':
                $tanzpaar2kategorieAll=Tanzpaar2ronda::generiereStufe($_REQUEST['kategorie_id'],$_REQUEST['stufe_id'],'nurAnsicht');
                $view = 'gewinnerliste';
                break;
            case 'vorigejury':
                Jury2ronda::vorigeJury($id);
                $view = 'rondateilnehmeraendern';
                break;
        }
        break;
    case 'drucken':
        $nobasicview=1;
        switch ($area){
            case 'jurybogen':
                include 'view/jurybogen.php';
                break;
            case 'einlassbogen':
                include 'view/einlassbogen.php';
                break;
        }
        break;
    case 'loeschen':
        $view =  $area . 'liste';
        switch ($area){
            case 'teilnehmer':
                Teilnehmer::delete($id);
                break;
            case 'tanzpaar':
                Tanzpaar::delete($id);
                break;
            case 'tanzpaar2kategorie':
                $success = Tanzpaar2kategorie::delete($_REQUEST['tanzpaar2kategorie_id']);
                $view =  'tanzpaaraendern';
                break;
            case 'tanzpaar2ronda':
                tanzpaar2ronda::delete($id);
                $id=$_REQUEST['ronda_id'];
                $view =  'rondateilnehmeraendern';
                break;
            case 'kategorie':
                Kategorie::delete($id);
                $view =  'optionenliste';
                break;
            case 'stufe':
                Stufe::delete($id);
                $view =  'optionenliste';
                break;
            case 'bezahlart':
                Bezahlart::delete($id);
                $view =  'optionenliste';
                break;
            case 'jury':
                Jury::delete($id);
                break;
            case 'jury2ronda':
                Jury2ronda::delete($id);
                $id=$_REQUEST['ronda_id'];
                $view =  'rondateilnehmeraendern';
                break;
            case 'ronda':
                Ronda::delete($id);
                break;
            case 'punke':
                //Punkte::delete($id);
                break;
            case 'optionen':
                Optionen::delete($_REQUEST['id']); //$id ist ein int !
                $view =  'optionenliste';
                break;
        }
        break;
    default :
        //   $view = 'teilnehmerliste';
        break;
}

if ($nobasicview!=1){include 'view/basicview.php';}



/*

// werden direkt übergeben
if (isset($_REQUEST['vorname'])){    $vorname = (int)$_REQUEST['vorname'];}
if (isset($_REQUEST['nachname'])){   $nachname = (int)$_REQUEST['nachname'];}
if (isset($_REQUEST['geschlecht'])){    $geschlecht = (int)$_REQUEST['geschlecht'];}
if (isset($_REQUEST['telefonnummer'])){ $telefonnummer = (int)$_REQUEST['telefonnummer'];}
if (isset($_REQUEST['wohnort'])){    $wohnort = (int)$_REQUEST['wohnort'];}
if (isset($_REQUEST['wohnland'])){   $wohnland = (int)$_REQUEST['wohnland'];}
if (isset($_REQUEST['kuenstlername'])){  $kuenstlername = (int)$_REQUEST['kuenstlername'];}
if (isset($_REQUEST['geburtsname'])){    $geburtsname = (int)$_REQUEST['geburtsname'];}
if (isset($_REQUEST['startnummer'])){    $startnummer = (int)$_REQUEST['startnummer'];}
if (isset($_REQUEST['teilnehmer1'])){    $teilnehmer1= (int)$_REQUEST['teilnehmer1'];}
if (isset($_REQUEST['teilnehmer2'])){    $teilnehmer2= (int)$_REQUEST['teilnehmer2'];}
if (isset($_REQUEST['fuehrungsfolge'])){ $fuehrungsfolge = (int)$_REQUEST['fuehrungsfolge'];}
if (isset($_REQUEST['anmeldebetrag'])){  $anmeldebetrag = (int)$_REQUEST['anmeldebetrag'];}
if (isset($_REQUEST['bezahlt'])){        $bezahlt = (int)$_REQUEST['bezahlt'];}
if (isset($_REQUEST['bezahldatum'])){    $bezahldatum = (int)$_REQUEST['bezahldatum'];}
if (isset($_REQUEST['bezahlart'])){      $bezahlart = (int)$_REQUEST['bezahlart'];}
if (isset($_REQUEST['reihenfolge'])){    $reihenfolge = (int)$_REQUEST['reihenfolge'];}

*/

// Übergabewerte für testzwecke ausgeben
/*
echo '<br><br><br><pre>';
print_r($_REQUEST);
echo '</pre>';
*/

// erweiterte Test
/*
echo "<pre>anfang-";
print_r($id);
print_r($sql);
print_r($result);
print_r($row);
echo "-ende</pre>";
*/

?>
