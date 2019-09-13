<table border="0" width="80%">
    <tr>
        <th colspan="4" style='border: 0px; text-align: center'>
            <h1>
                <?php
                $ronda=Ronda::getById($id);
                echo $ronda->getKategorie()->getKategorie()." ".$ronda->getStufe()->getStufe()." Ronda ".$ronda->getRonda();
                $rondaInNextStufe=Ronda::rondaInNextStufe($ronda);
                ?>
            </h1>
        </th>
    </tr>
    <tr>
        <td colspan="4">
            <table border="0" width="100%">
                <thead>
                <td width="50%" style="border: 0px">
                    Rondas:
                    <?php
                    foreach (Ronda::getRondaIdByStufeIdAndKategorieId($ronda->getKategorie_id(),$ronda->getStufe_id())as $rondaId){
                        $rondaliste=Ronda::getById($rondaId);
                        echo "<a href='index.php?action=aendern&area=rondapunkte&id=".$rondaliste->getId()."'>";
                        echo "<button";
                        if ($rondaliste->getId()==$ronda->getId()){echo " disabled ";}
                        echo ">&nbsp;&nbsp;".$rondaliste->getRonda()."&nbsp;&nbsp;</button></a>";
                    }
                    ?>
                </td>
                <td style="border: 0px;text-align: center">
                    <a href='index.php?action=aendern&area=rondateilnehmer&id=<?php echo $id; ?>'><button>Jury / Teilnehmer einstellen</button></a>
                </td>
                <td style="border: 0px;text-align: right">
                    <a href='index.php?action=loeschen&area=ronda&id=<?php echo $id; ?>'><button <?php if ($rondaInNextStufe) {echo " disabled ";} ?>>Ronda löschen</button></a>
                    <br><div style="font-size: x-small"> (nur möglich wenn keine Punkte vergeben sind)</div>
                </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <form action='index.php' method='post'>
                <input type='hidden' name='area' value='punkte'>
                <input type='hidden' name='action' value='speichern'>
                <input type='hidden' name='id' value='<?php echo $id; ?>'>
            <table border="0">
                <tr>
                    <td style="border: 0px">
                        <table border="0">
                            <thead>
                                <th>Folge</th>
                                <th>Nr.</th>
                                <th>Tanzpaar</th>
                                <?php
                                // juryliste
                                $jury2rondaAll=Jury2ronda::getByRondaId($id);
                                foreach ($jury2rondaAll as $jury2ronda){
                                    echo "\n\t\t\t\t\t\t\t\t<th>";
                                    echo $jury2ronda->getSitzplatz()."&nbsp;".$jury2ronda->getJury()->getVorname()." <br> ".$jury2ronda->getJury()->getNachname();
                                    //echo " (".$jury2ronda->getId().")";
                                    echo "\n\t\t\t\t\t\t\t\t</th>\n";
                                }
                                ?>
                                <th>Druchschnitt</th>
                            </thead>
                            <?php
                            $punkezaehler=0;
                            $tanzpaar2rondaAll=Tanzpaar2ronda::getByRondaId($id);
                            $punkteAll=Punkte::getByRondaId($id) ;
                            foreach ( $tanzpaar2rondaAll as $tanzpaar2ronda){
                                echo "\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td>";
                                echo $tanzpaar2ronda->getReihenfolge();
                                echo "</td>\n\t\t\t\t\t\t\t\t<td>";
                                echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getStartnummer();
                                echo "</td>\n\t\t\t\t\t\t\t\t<td>";
                                echo $tanzpaar2ronda->getTanzpaar2kategorie()->getTanzpaar()->getTanzpaarnamen();
                                echo "</td>";
                                $durchschnitt=array();
                                foreach ($jury2rondaAll as $jury2ronda){
                                    $punkteId=null;
                                    echo "\n\t\t\t\t\t\t\t\t<td>";
                                    echo "\n\t\t\t\t\t\t\t\t\t<!-- punkt ".$punkezaehler." -->";
                                    echo "\n\t\t\t\t\t\t\t\t\t<input type='text' name='punkte[$punkezaehler][wert]' maxlength='3' size='3' value='";
                                    foreach ($punkteAll as $punkte){
                                        if($jury2ronda->getJury()->getId()==$punkte->getJuryId()) {
                                            if($tanzpaar2ronda->getId()==$punkte->getTanzpaar2rondaId()  ) {
                                                //print_r($punkte);
                                                echo $punkte->getPunkte();
                                                if ($punkte->getPunkte()!=null){
                                                    $durchschnitt[]=$punkte->getPunkte();
                                                }
                                                $punkteId=$punkte->getId();
                                            }
                                        }
                                    }
                                    echo "'>";
                                    echo "\n\t\t\t\t\t\t\t\t\t<input type='hidden' name='punkte[$punkezaehler][punkte_id]' value='".$punkteId."'>";
                                    echo "\n\t\t\t\t\t\t\t\t\t<input type='hidden' name='punkte[$punkezaehler][tanzpaar2ronda]' value='".$tanzpaar2ronda->getId()."'>";
                                    echo "\n\t\t\t\t\t\t\t\t\t<input type='hidden' name='punkte[$punkezaehler][jury_id]' value='".$jury2ronda->getJury()->getId()."'>";
                                    echo "\n\t\t\t\t\t\t\t\t</td>";
                                    $punkezaehler++;
                                }
                                echo "\n\t\t\t\t\t\t\t\t<td style='text-align: center'>";
                                if (count($durchschnitt)>2){
                                    $ergenis=0;
                                    sort($durchschnitt);
                                    // nimmt den kleinsten und den größten wert nicht mit in die auswertung
                                    for ($i=1; $i<count($durchschnitt)-1;$i++){
                                        $ergenis=$ergenis+$durchschnitt[$i];
                                        //echo $ergenis."<br>";
                                    }
                                    $ergenis=$ergenis/(count($durchschnitt)-2);
                                    echo number_format($ergenis,3);
                                }
                                echo "</td>";
                                echo "\n\t\t\t\t\t\t\t</tr>\n";
                            }
                            ?>

                        </table>
                    </td>
                    <td style="border: 0px">
                        <!-- wenn es schon eine nächste stufe gibt sollen die werte nicht mehr verändert werden können-->
                        <input type='submit' <?php if ($rondaInNextStufe){echo " disabled ";} ?> value='Eingaben speichern'>
                    </td>
                </tr>
            </table>
            </form>
        </td>
    </tr>
</table>

