

<table border="0" width="80%">
    <tr>
        <td colspan="3 "  style='text-align: center'>
            <h1>
            <?php
            $ronda=Ronda::getById($id);
            echo $ronda->getKategorie()->getKategorie()." ".$ronda->getStufe()->getStufe()." Ronda: ".$ronda->getRonda();
            ?>
            </h1>
        </td>
    </tr>
    <tr>
        <td width="50%"><h2>Tanzpaare in dieser Ronda</h2></td>
        <td><h2>Jury in dieser Ronda</h2></td>
        <td><h3>weitere Jurymitglieder</h3></td>
    </tr>
    <tr>
        <td>
            <table border="0">
                <thead>
                    <th>Folge</th>
                    <th>Nr.</th>
                    <th>Tanzpaar</th>
                    <th></th>
                </thead>
                <?php
                foreach (Tanzpaar2ronda::getByRondaId($id) as $tanzpaar2ronda){
                    //echo $tanzpaar2ronda->getId();
                    echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getReihenfolge();
                    echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getStartnummer();
                    echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getVorname()." ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getNachname();
                    echo " & ";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getVorname()." ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getNachname();
                    echo "</td>\n\t\t\t\t\t<td>";
                    echo "<a href='index.php?action=loeschen&area=tanzpaar2ronda&id=".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getId()."&ronda_id=".$ronda->getId()."'><button>löschen</button></a>";
                    echo "</td>\n\t\t\t\t</tr>";
                }
                ?>
            </table>
        </td>
        <td>
            <table border="0">
                <thead>
                <th>Sitzplatz</th>
                <th>Name</th>
                <th></th>
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
                    echo "<a href='index.php?action=loeschen&area=jury2ronda&id=".$jury2ronda->getId()."&ronda_id=".$ronda->getId()."'><button>löschen</button></a>";
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
                echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td colspan='2'>nächster freier platz:".min($sitz)."</td>\n\t\t\t\t</tr>";
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
                        echo "\n\t\t\t\t\t\t\t<input type='hidden' name='action' value='speichern'>";
                        echo "\n\t\t\t\t\t\t\t<input type='submit' value='hinzufügen'>";
                        echo "\n\t\t\t\t\t\t</form>";
                        echo "</td>\n\t\t\t\t</tr>";
                    }
                }
                ?>
            </table>
        </td>
    </tr>
</table>
