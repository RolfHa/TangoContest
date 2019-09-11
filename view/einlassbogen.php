<html>
<head></head>
<body>
<?php

$rondaAll=Ronda::getRondaIdByStufeIdAndKategorieId($_REQUEST['kategorie_id'],$_REQUEST['stufe_id']);

foreach ($rondaAll as $rondaId) {
    $ronda=Ronda::getById($rondaId);
    echo"<table width='100%  ' border='0' style='page-break-before:always'><tr><td>";
    echo"<table width='100%  ' border='0' ><tr><td style='text-align: center'><h1> Einlass- / Ansageliste </h1>";
    echo "<h3>Berlin Open Tango Contest ".date("Y", time())."</h3> <h4> Category:".$ronda->getKategorie()->getKategorie();
    echo "<br>" . $ronda->getStufe()->getStufe() . " Ronda: " . $ronda->getRonda()."</h4></td>";
    echo "<td align='right'><img src='botc-logo.png' height='100'></td></tr>";
    echo "<tr><td><br>";
    echo "<table border='3' cellpadding='10' style='border-collapse: collapse'>";
    echo "<thead><th>start</th><th>number</th><th>partner 1</th><th>guide</th><th>partner 2</th></thead>";
    $tanzpaar2rondaAll = Tanzpaar2ronda::getByRondaId($rondaId);
    foreach ($tanzpaar2rondaAll as $tanzpaar2ronda) {
        echo "<tr><td>";
        echo $tanzpaar2ronda->getReihenfolge();
        echo "</td><td>";
        echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getStartnummer();
        echo "</td><td>";
        echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getVorname();
        echo " ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getNachname();
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getKuenstlername()!=""){
        echo " (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getKuenstlername().")";
        }
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getGeburtsname()!=""){
            echo " (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getGeburtsname().")";
        }
        echo "<br>from: ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getWohnort();
        echo " / ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getWohnland();
        echo "</td><td>";
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getFuehrungsfolge()==1){echo "<--";}
        else {echo "-->";}
        echo "</td><td>";
        echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getVorname();
        echo " ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getNachname();
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getKuenstlername()!=""){
            echo " (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getKuenstlername().")";
        }
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getGeburtsname()!=""){
            echo " (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getGeburtsname().")";
        }
        echo "<br>from: ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getWohnort();
        echo " / ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getWohnland();
        echo "</td></tr>";
    }
    echo "</table>";
    echo "</td></tr></table>";
}
?>

</body>
</html>
