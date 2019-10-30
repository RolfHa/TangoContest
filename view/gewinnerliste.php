<table >
    <tr>
        <td style="border: 0px">
            <img src="gewinner.jpg">
        </td>
        <td style="border: 0px; text-align: center" >
            <?php
            $letztestufe=Kategorie2Stufe::getByKategorieId($_REQUEST['kategorie_id']);
            $letztestufe=end($letztestufe)->getStufe()->getId();
            if ($_REQUEST['stufe_id']==$letztestufe){
                echo "<br><br><br><h1>Gewinner</h1> <h4>in der Kategorie ".Kategorie::getById($_REQUEST['kategorie_id'])->getKategorie()." sind:</h4>";
                echo "<h2>".$tanzpaar2kategorieAll[0]->getTanzpaar()->getTanzpaarnamen();
                for($i=1;$i<count($tanzpaar2kategorieAll);$i++){
                    if ($tanzpaar2kategorieAll[0]->getStufendurchschnitt()==$tanzpaar2kategorieAll[$i]->getStufendurchschnitt()){
                        echo "<br>".$tanzpaar2kategorieAll[$i]->getTanzpaar()->getTanzpaarnamen();
                    }
                }
                echo "</h2><br><hr>";
            }
            ?>
            <table>
                <thead>
                <th colspan="4" style="text-align: center ; border: 0px"><h2>Bestenliste <?php echo Stufe::getById($_REQUEST['stufe_id'])->getStufe ();?></h2>
                    <h4>in der Kategorie: <?php echo Kategorie::getById($_REQUEST['kategorie_id'])->getKategorie();?></h4>
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
                $anzahlquali=Kategorie2Stufe::getByKategorieIdAndStufeId($_REQUEST['kategorie_id'],$_REQUEST['stufe_id']);
                $anzahlquali=$anzahlquali->getAnzahlquali();

                $platz=1;
                for($i=0;$i<count($tanzpaar2kategorieAll);$i++){
                    //print_r($tanzpaar2kategorie);
                    echo "<tr><td>";
                    echo $platz;
                    echo "</td><td>";
                    echo $tanzpaar2kategorieAll[$i]->getTanzpaar()->getStartnummer();
                    echo "</td><td>";
                    echo $tanzpaar2kategorieAll[$i]->getTanzpaar()->getTanzpaarnamen();
                    echo "</td><td>";
                    echo $tanzpaar2kategorieAll[$i]->getStufendurchschnitt();
                    echo "</td></tr>";
                    //wird beim letzten platz nicht geprüft
                    if ($i+1<count($tanzpaar2kategorieAll)){
                        if ($tanzpaar2kategorieAll[$i+1]->getStufendurchschnitt()!=$tanzpaar2kategorieAll[$i]->getStufendurchschnitt()) {
                            $platz++;
                            if ($i + 1 == $anzahlquali) {
                                echo "<tr><th colspan='4'>Leider nicht weiter sind:</th></tr>";
                            }
                        }
                        //wenn sie den gleichen werdt haben wird die anzahl der qualifikationen hochgesetzt
                        else {
                            if ($i + 1 == $anzahlquali) {
                                $anzahlquali++;
                            }
                        }
                    }
                }
                ?>
            </table>
        </td>
    </tr>
</table>
