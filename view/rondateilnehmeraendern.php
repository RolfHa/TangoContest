

<table border="0" width="80%">
    <thead>
        <th colspan="4" style='border: 0px; text-align: center'>
            <h1>
            <?php
            $ronda=Ronda::getById($id);
            echo $ronda->getKategorie()->getKategorie()." ".$ronda->getStufe()->getStufe()." Ronda ".$ronda->getRonda();
            $rondaInNextStufe=Ronda::rondaInNextStufe($ronda);
            ?>
            </h1>
        </th>
    </thead>
    <tr>
        <td colspan="4">
            <table border="0" width="100%">
                <thead>
                    <td width="50%" style="border: 0px">
                        Rondas:
                        <?php
                        foreach (Ronda::getRondaIdByStufeIdAndKategorieId($ronda->getKategorie_id(),$ronda->getStufe_id())as $rondaId){
                            $rondaliste=Ronda::getById($rondaId);
                            echo "<a href='index.php?action=aendern&area=rondateilnehmer&id=".$rondaliste->getId()."&checkID=".$checkID."'>";
                            echo "<button";
                            if ($rondaliste->getId()==$ronda->getId()){echo " disabled ";}
                            echo ">&nbsp;&nbsp;".$rondaliste->getRonda()."&nbsp;&nbsp;</button></a>";
                        }
                        ?>
                    </td>
                    <td style="border: 0px;text-align: center">
                        <a href='index.php?action=aendern&area=rondapunkte&id=<?php echo $id; ?>&checkID=<?php echo $checkID; ?>'><button>zur Punkteeingabe</button></a>
                    </td>
                    <td style="border: 0px;text-align: right">
                        <a href='index.php?action=loeschen&area=ronda&id=<?php echo $id; ?>&checkID=<?php echo $checkID; ?>'><button>Ronda löschen</button></a>
                        <br><div style="font-size: x-small"> (nur möglich wenn keine Punkte vergeben sind)</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top"><h2>Tanzpaare in dieser Ronda</h2></td>
        <td ><h4>Tanzpaare ohne Ronda</h4></td>
        <td valign="top" >
            <table>
                <thead>
                <th colspan="3" style="padding: 0px;"><h2>Jury in dieser Ronda</h2></th>
                </thead>
                </tr>
                <th style="padding: 0px;">
                    <?php
                    if (!$rondaInNextStufe){
                        echo "<a href='index.php?action=generieren&area=vorigejury&id=".$id."&checkID=".$checkID."'><button>vorige Jury übernehmen</button></a></th>";
                    }
                    ?>
                <th style="padding: 0px;" width="10"></th>
                <th style="padding: 0px;"><a href='index.php?action=drucken&area=jurybogen&id=<?php echo $id; ?>&checkID=<?php echo $checkID; ?>' target="_blank"><button>Jurybogen drucken</button></a></th>
                </tr>
            </table>
            </td>
        <td><h4>weitere Jurymitglieder</h4></td>
    </tr>
    <tr valign="top">
        <td>
            <table border="0">
                <thead>
                    <th>Folge</th>
                    <th>Nr.</th>
                    <th>Tanzpaar</th>
                    <th style="font-size: x-small">nicht löschbar wenn<br>Punkte vorhanden sind</th>
                </thead>
                <?php
                $reihenfolge= array();
                $tanzpaar2rondaAll=Tanzpaar2ronda::getByRondaId($id);
                foreach ( $tanzpaar2rondaAll as $tanzpaar2ronda){
                    $reihenfolge[]=$tanzpaar2ronda->getReihenfolge();  //array für die reihenfolge
                    //echo $tanzpaar2ronda->getId();
                    echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getReihenfolge();
                    echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getStartnummer();
                    echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTanzpaarnamen();
                    echo "</td>\n\t\t\t\t\t<td>";
                    if (!$rondaInNextStufe){
                        echo "<a href='index.php?action=loeschen&area=tanzpaar2ronda&id=".$tanzpaar2ronda->getId()."&ronda_id=".$ronda->getId()."&checkID=".$checkID."'><button>löschen</button></a>";
                    }
                    echo "</td>\n\t\t\t\t</tr>";
                }
                ?>
            </table>
        </td>
        <td>
            <table border="0">
                <?php
                //suche freien startplatz
                $platz=array();
                for ($i=1; $i<=count($tanzpaar2rondaAll)+1;$i++){
                    if (!in_array($i, $reihenfolge)) {
                        $platz[$i]=$i;
                    }
                }
                echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td colspan='2'>nächster freier platz: <b>".min($platz)."</b></td>\n\t\t\t\t</tr>";
                // noch mögliche Tanzpaare in der gleichen Kategorie
                $tanzpaar2kategorieAll=Tanzpaar2kategorie::getByKategorieId($ronda->getKategorie_id());
                $tanzpaar2rondaAll=Tanzpaar2ronda::getAll();
                foreach ( $tanzpaar2kategorieAll as $tanzpaar2kategorie) {
                    $match = 0;
                    foreach ($tanzpaar2rondaAll as $tanzpaar2ronda) {
                        if ($tanzpaar2ronda->getRonda()->getKategorie_id() == $ronda->getKategorie_id()) {
                            if ($tanzpaar2ronda->getRonda()->getStufe_id() == $ronda->getStufe_id()) {
                                if ($tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar_id() == $tanzpaar2kategorie->getTanzpaar_id()) {
                                    //echo "<br>" . $tanzpaar2kategorie->getTanzpaar()->getStartnummer() . $tanzpaar2kategorie->getTanzpaar()->getTanzpaarnamen();
                                    $match = 1;
                                }
                            }
                        }
                    }
                    if ($match == 0) {
                        echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                        echo $tanzpaar2kategorie->getTanzpaar()->getStartnummer();
                        echo " ";
                        echo $tanzpaar2kategorie->getTanzpaar()->getTanzpaarnamen();
                        echo "</td>\n\t\t\t\t\t<td>";
                        echo "\n\t\t\t\t\t\t<form action='index.php' method='post'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='area' value='tanzpaar2ronda'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='ronda_id' value='" . $ronda->getId() . "'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='tanzpaar2kategorie_id' value='" . $tanzpaar2kategorie->getId() . "'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='reihenfolge' value='" . min($platz) . "'>";
                        echo "\n\t\t\t\t\t\t\t<input name='checkID' type='hidden' value=".$checkID.">";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='action' value='speichern'>";
                        if (!$rondaInNextStufe) {
                            echo "\n\t\t\t\t\t\t\t<input type='submit' value='hinzufügen'>";
                        }
                        echo "\n\t\t\t\t\t\t</form>";
                        echo "</td>\n\t\t\t\t</tr>";
                    }
                }
                ?>
            </table>
        </td>
        <td>
            <table border="0">
                <thead>
                <th>Sitzplatz</th>
                <th>Name</th>
                <th style="font-size: x-small">nicht löschbar wenn<br>Punkte vorhanden sind</th>
                </thead>
                <?php
                $sitzplatz= array();
                // juryliste
                foreach (Jury2ronda::getByRondaId($id) as $jury2ronda){
                    $sitzplatz[]=$jury2ronda->getSitzplatz();  //array für die sitzplatzsuche
                    echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                    echo $jury2ronda->getSitzplatz();
                    echo "</td>\n\t\t\t\t\t<td>";
                    echo $jury2ronda->getJury()->getVorname()." ".$jury2ronda->getJury()->getNachname();
                    echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t<td>";
                    if (!$rondaInNextStufe){
                        echo "<a href='index.php?action=loeschen&area=jury2ronda&id=".$jury2ronda->getId()."&ronda_id=".$ronda->getId()."&checkID=".$checkID."'><button>löschen</button></a>";
                    }
                    echo "</td>\n\t\t\t\t</tr>";
                }
                ?>
            </table>
        </td>
        <td>
            <table border="0">
                <?php
                //suche freien sitzplatz
                $sitz=array();
                for ($i=1; $i<20;$i++){
                    if (!in_array($i, $sitzplatz)) {
                        $sitz[$i]=$i;
                    }
                }
                echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td colspan='2'>nächster freier platz: <b>".min($sitz)."</b></td>\n\t\t\t\t</tr>";
                // noch mögliche Jury mitglieder
                foreach (Jury::getAll() as $juryAll){
                    $match=0;
                    foreach (Jury2ronda::getByRondaId($id) as $jury2ronda){
                        if ($jury2ronda->getJuryId()==$juryAll->getId()){$match=1;}
                    }
                    if ($match==0) {
                        echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                        echo $juryAll->getVorname()." ".$juryAll->getNachname();
                        echo "</td>\n\t\t\t\t\t<td>";
                        echo "\n\t\t\t\t\t\t<form action='index.php' method='post'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='area' value='jury2ronda'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='ronda_id' value='".$ronda->getId()."'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='jury_id' value='".$juryAll->getId()."'>";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='sitzplatz' value='".min($sitz)."'>";
                        echo "\n\t\t\t\t\t\t\t<input name='checkID' type='hidden' value=".$checkID.">";
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='action' value='speichern'>";
                        if (!$rondaInNextStufe){
                            echo "\n\t\t\t\t\t\t\t<input type='submit' value='hinzufügen'>";
                        }
                        echo "\n\t\t\t\t\t\t</form>";
                        echo "</td>\n\t\t\t\t</tr>";
                    }
                }
                ?>
            </table>
        </td>
    </tr>
</table>
