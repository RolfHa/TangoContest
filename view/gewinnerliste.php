<?php

?>
<table >
    <tr>
        <td style="border: 0px">
            <img src="gewinner.jpg">
        </td>
        <td style="border: 0px; text-align: center" >
            <?php
            $letztestufe=Stufe::getAll();
            $letztestufe=end($letztestufe)->getId();
            if ($_REQUEST['stufe_id']==$letztestufe){
                echo "<br><br><br><h1>Gewinner</h1> <h3>in der Kategorie ".Kategorie::getById($_REQUEST['kategorie_id'])->getKategorie()." sind:</h3>";
                echo "<h2>".$tanzpaar2kategorieAll[0]->getTanzpaar()->getTanzpaarnamen()."</h2><br><hr>";
            }
            ?>
            <table>
                <thead>
                <th colspan="4" style="text-align: center ; border: 0px"><h2>Bestenliste <?php echo Stufe::getById($_REQUEST['stufe_id'])->getStufe ();?></h2>
                    <h3>in der Kategorie: <?php echo Kategorie::getById($_REQUEST['kategorie_id'])->getKategorie();?></h3>
                </th>
                </thead>
                <thead>
                <th>Platz</th>
                <th>Nr</th>
                <th>Tanzpaar</th>
                <th>Punkte</th>

                </thead>
                <?php
                //anzahl der weiterkommenden
                $anzahlquali=Anzahlquali::getById($_REQUEST['kategorie_id'],$_REQUEST['stufe_id']);
                $anzahlquali=$anzahlquali->getAnzahlquali();


                $platz=0;
                foreach ($tanzpaar2kategorieAll as $tanzpaar2kategorie){
                    //print_r($tanzpaar2kategorie);
                    $platz++;
                    echo "<tr><td>";
                    echo $platz;
                    echo "</td><td>";
                    echo $tanzpaar2kategorie->getTanzpaar()->getStartnummer();
                    echo "</td><td>";
                    echo $tanzpaar2kategorie->getTanzpaar()->getTanzpaarnamen();
                    echo "</td><td>";
                    echo $tanzpaar2kategorie->getStufendurchschnitt();
                    echo "</td></tr>";
                    if ($platz==$anzahlquali){
                        echo "<tr><th colspan='4'>Leider nicht weiter sind:</th></tr>";
                    }

                }

                ?>
            </table>
        </td>
    </tr>
</table>
