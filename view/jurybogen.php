<html>
<head></head>
<body>

<?php
// juryliste
$jury2rondaAll=Jury2ronda::getByRondaId($id);
$ronda = Ronda::getById($id);
foreach ($jury2rondaAll as $jury2ronda) {
    echo"<table width='100%  ' border='0' style='page-break-before:always'><tr><td align='right' colspan='2'><img src='botc-logo.png' height='100'></td></tr>";
    echo "<tr><td colspan='2' style='text-align: center'><br><br><br><h1> QUALIFICATION </h1>";
    echo "<h3>Berlin Open Tango Contest ".date("Y", time())."</h3> <h4> Category:".$ronda->getKategorie()->getKategorie();
    echo "<br>" . $ronda->getStufe()->getStufe() . " Ronda: " . $ronda->getRonda()."</h4>";
    echo "</h1></td></tr>";
    echo "<tr><th align='right'>Name of Judge: </th><td>". $jury2ronda->getJury()->getVorname() . "<br>" . $jury2ronda->getJury()->getNachname()."</td></tr>";
    echo "<tr><th align='right'>Judge Position: </th><td>".$jury2ronda->getSitzplatz()."</td></tr>";
    echo "<tr><td> </td><td> <br><br>";
    echo "<table border='3' cellpadding='10' style='border-collapse: collapse'>";
    echo "<thead><th>Start</th><th>Number</th><!--th>Tanzpaar</th--><th>Score (3-8)</th></thead>";
    $tanzpaar2rondaAll = Tanzpaar2ronda::getByRondaId($id);
    foreach ($tanzpaar2rondaAll as $tanzpaar2ronda) {
        echo "<tr><td>";
        echo $tanzpaar2ronda->getReihenfolge();
        echo "</td><td>";
        echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getStartnummer();
        //Tanzpaarname soll nicht angezeigt werden
        //echo "</td><td>";
        // echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTanzpaarnamen();
        echo "</td>";
        echo "<td ></td></tr>";
    }
    echo "</table>";
    echo "</td></tr><tr><td colspan='2' style='text-align: right'><br><br>Signature:_______________</td></tr></table>";

}
?>

</body>
</html>
