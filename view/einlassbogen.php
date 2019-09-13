<html>
<head></head>
<body>
<?php

$rondaAll=Ronda::getRondaIdByStufeIdAndKategorieId($_REQUEST['kategorie_id'],$_REQUEST['stufe_id']);

foreach ($rondaAll as $rondaId) {
    $ronda=Ronda::getById($rondaId);
    echo"<table width='100%' border='0' style='page-break-before:always'>";
    echo "<tr><td style='text-align: center'><h1> entrancelist </h1>";
    echo "<h3>Berlin Open Tango Contest ".date("Y", time())."</h3>";
    echo "<h4> Category:".$ronda->getKategorie()->getKategorie();
    echo "<br>" . $ronda->getStufe()->getStufe() . " Ronda: " . $ronda->getRonda()."</h4></td>";
    echo "<td align='right'><img src='botc-logo.png' height='100'></td></tr>";
    echo "<tr><td><br>";
    echo "<table width='100%' border='3' cellpadding='10' style='border-collapse: collapse'>";
    echo "<thead><th>start</th><th>number</th><th>partner 1</th><th>guide</th><th>partner 2</th></thead>";
    $tanzpaar2rondaAll = Tanzpaar2ronda::getByRondaId($rondaId);
    foreach ($tanzpaar2rondaAll as $tanzpaar2ronda) {

        //fülle teilnehmer 1
        $teilnehmer1=$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getVorname();
        $teilnehmer1.=" ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getNachname();
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getKuenstlername()!=""){
            $teilnehmer1.=" (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getKuenstlername().")";
        }
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getGeburtsname()!=""){
            $teilnehmer1.=" (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getGeburtsname().")";
        }
        $teilnehmer1.="<br>from: ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getWohnort();
        $teilnehmer1.=" / ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getWohnland();

        //fülle teilnehmer 2
        $teilnehmer2=$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getVorname();
        $teilnehmer2.=" ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getNachname();
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getKuenstlername()!=""){
            $teilnehmer2.=" (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getKuenstlername().")";
        }
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getGeburtsname()!=""){
            $teilnehmer2.=" (".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getGeburtsname().")";
        }
        $teilnehmer2.="<br>from: ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getWohnort();
        $teilnehmer2.=" / ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getWohnland();

        //fülle Tabelle
        echo "<tr><td>";
        echo $tanzpaar2ronda->getReihenfolge();
        echo "</td><td>";
        echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getStartnummer();
        echo "</td><td>";
        // der folgende soll immer zuerst angezeigt werden
        if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getFuehrungsfolge()==2){
            // der folgende
            echo $teilnehmer1;
            echo "</td><td>";
            echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getGeschlecht();
            echo "&nbsp;&rArr;&nbsp;";
            echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getGeschlecht();
            echo "</td><td>";
            echo $teilnehmer2;
        }
        else{
            // der führende
            echo $teilnehmer2;
            echo "</td><td>";
            echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getGeschlecht();
            echo "&nbsp;&rArr;&nbsp;";
            echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getGeschlecht();
            echo "</td><td>";
            echo $teilnehmer1;
        }
        echo "</td></tr>";
    }
    echo "</table>";
    echo "</td></tr></table>";
}
?>

</body>
</html>
