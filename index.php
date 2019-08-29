<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-16">
    <title>Berlin Open Tango Contest</title>
        <style>
			table {
					font-family: arial, sans-serif;
					border-collapse: collapse;
				 }
			th {
				font-weight: bold;
			}
			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}
			tr:nth-child(even) {
				background-color: #dddddd;
			}
    </style>
</head>
<body>

<!-- Navigationsleiste -->
<nav><form method="post" ><table border="0"><tr>
                <td><input type="submit" name="teilnehmerliste" value="Liste Teilnehmer"></td>
                <td><input type="submit" name="tanzpaarliste" value="Liste Tanzpaare"></td>
                <td><input type="submit" name="juryliste" value="Liste Jurymitglieder"></td>
                <td><input type="submit" name="rondaliste" value="Liste Ronda"></td>
                <td><input type="submit" name="punkteliste" value="Liste Punkte"></td>
            </tr><tr>
                <td><input type="submit" name="teilnehmerneu" value="neuer Teilnehmer"></td>
                <td><input type="submit" name="tanzpaarneu" value="neues Tanzpaar"></td>
                <td><input type="submit" name="juryneu" value="neues Jurymitglied"></td>
                <td><input type="submit" name="rondaneu" value="Ronda anlegen"></td>
                <td><input type="submit" name="punkeneu" value="Punkte eingeben"></td>
            </tr></table></form></nav>




<?php
// config datei laden (kann außerhalb des WEB-zugriffs gespeichert werden)
include_once  'config.php';
//alle andern klassen laden (dateien müssen den klassennamen haben und im Verzeichnis class liegen)
spl_autoload_register(function ($class_name) {include "class" . DIRECTORY_SEPARATOR . $class_name . '.php';});



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
</body></html>

