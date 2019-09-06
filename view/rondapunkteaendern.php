<table border="0" width="80%">
    <thead>
        <th style='text-align: center'>
            <h1>
            <?php
            $ronda=Ronda::getById($id);
            echo $ronda->getKategorie()->getKategorie()." ".$ronda->getStufe()->getStufe()." Ronda: ".$ronda->getRonda();
            ?>
            </h1>
        </th>
    </thead>
    <tr>
        <td>
            <table border="0">
                <thead>
                    <th>Folge</th>
                    <th>Nr.</th>
                    <th>Tanzpaar</th>
                    <?php
                    // juryliste
                    $jury2rondaAll=Jury2ronda::getByRondaId($id);
                    foreach ($jury2rondaAll as $jury2ronda){
                        echo "\n\t\t\t\t\t<th>";
                        echo $jury2ronda->getSitzplatz()."&nbsp;".$jury2ronda->getJury()->getVorname()."<br>".$jury2ronda->getJury()->getNachname();
                        //echo " (".$jury2ronda->getId().")";
                        echo "\n\t\t\t\t\t</th>";
                    }
                    ?>
                    <th></th>
                </thead>
                <?php
                $tanzpaar2rondaAll=Tanzpaar2ronda::getByRondaId($id);
                $punkteAll=Punkte::getByRondaId($id) ;
                foreach ( $tanzpaar2rondaAll as $tanzpaar2ronda){
                    echo "\n\t\t<form action='index.php' method='post'>";
                    echo "\n\t\t\t<input type='hidden' name='area' value='punkte'>";
                    echo "\n\t\t\t<input type='hidden' name='action' value='speichern'>";
                    echo "\n\t\t\t<input type='hidden' name='id' value='".$id."'>";
                    echo "\n\t\t\t<input type='hidden' name='tanzpaar2ronda' value='".$tanzpaar2ronda->getId()."'>";
                    echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getReihenfolge();
                    echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getStartnummer();
                    echo "\n\t\t\t\t\t</td>\n\t\t\t\t\t<td>";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getVorname()." ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer1()->getNachname();
                    echo " & ";
                    echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getVorname()." ".$tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTeilnehmer2()->getNachname();
                    echo "</td>";
                    $i=0;
                    foreach ($jury2rondaAll as $jury2ronda){
                        $punkteId=null;
                        echo "<td>";
                        echo "\n\t\t\t<input type='hidden' name='punkte[$i][jury_id]' value='".$jury2ronda->getJury()->getId()."'>";
                        echo "\n\t\t\t<input type='text' name='punkte[$i][wert]' maxlength='3' size='3' value='";
                        foreach ($punkteAll as $punkte){
                            if($jury2ronda->getJury()->getId()==$punkte->getJuryId()) {
                                if($tanzpaar2ronda->getId()==$punkte->getTanzpaar2rondaId()  ) {
                                    echo $punkte->getPunkte();
                                    $punkteId=$punkte->getId();
                                }
                            }
                        }
                        echo "'></td>";
                        echo "\n\t\t\t<input type='hidden' name='punkte[$i][punkte_id]' value='".$punkteId."'>";
                        $i++;
                    }
                    echo "\n\t\t\t<td><input type='submit' value='ändern'></td>";
                    echo "\n\t\t</form>";

                }
                ?>
            </table>
        </td>
    </tr>
</table>

