<table border="0" width="90%">
    <tr>
        <td colspan="2 " style='text-align: center'>
            <h1 >Optionen </h1>
        </td>
    </tr>
    <tr>
        <td width="60%"><h2>Werte für Ronda</h2>
            Legen fest wieviele Paare maximal in einer Ronda sind und wieviele Paare in die nächste Stufe weiter kommen.
        </td>
        <td><h4>Kategorien, Bezahlarten und weitere Einstellungen</h4>
            Das Löschen funktioniert nur wenn der Wert nicht benutzt wird,
             gegebenenfalls werden die Rondawerte(Tabelle links)auf Standard gesetzt.
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table>
                <tr>
                    <th><b>Kategorie</b></th>
                    <th colspan="2"><b>Stufen</b></th>
                    <th><b>max Paare</b></th>
                    <th colspan="2"><b>kommen weiter</b></th>
                </tr>
                <?php
                // db abfragen ausserhalb der schleifen
                $anzahlqualiAll=Anzahlquali::getAll();
                $kategorieAll=Kategorie::getAll();
                $stufeAll=Stufe::getAll();
                foreach ($kategorieAll as $kategorie){
                    echo "\n\t<tr>\n\t\t<td>";
                    echo $kategorie->getKategorie();
                    echo "</td>";
                    $stufeAuswahl=$stufeAll;
                    foreach ($anzahlqualiAll as $anzahlquali){
                        if ($anzahlquali->getKategorie_id()==$kategorie->getId()){
                            echo "\n\t\t<td style='border: 0px'>".$anzahlquali->getStufe()->getStufe()."</td>";
                            echo "\n\t\t<td style='border: 0px'>";
                            echo "<a href='index.php?action=loeschen&area=stufe2kategorie&id=".$anzahlquali->getStufe()->getId()."'><button>löschen</button></a></td>";
                            echo "\n\t\t\t\t\t\t<form action='index.php' method='post'>";
                            echo "\n\t\t\t\t\t\t\t<input type='hidden' name='area' value='stufe2kategorie'>";
                            echo "\n\t\t\t\t\t\t\t<input type='hidden' name='action' value='neuanlegen>";
                            echo "\n\t\t\t\t\t\t\t<input type='hidden' name='kategorie_id' value='".$kategorie->getId()."'>";
                            echo "\n\t\t\t\t\t\t\t<input type='hidden' name='stufe_id' value='".$anzahlquali->getStufe()->getId()."'>";
                            echo "\n\t\t<td style='border: 0px'>";
                            echo "<input type='text' name='maxpaare' value='".$anzahlquali->getMaxpaare()."'></td>";
                            if($anzahlquali->getStufe()->getID()!=end($stufeAll)->getID()){
                                echo "\n\t\t<td style='border: 0px'><input type='text' name='anzahlquali' value='".$anzahlquali->getAnzahlquali()."'></td>";
                            }
                            else {echo "\n\t\t<td style='border: 0px'><input type='hidden' name='anzahlquali' value='0'></td>";}
                            echo "\n\t\t\t\t\t\t\t<td style='border: 0px'><input type='submit' value='ändern'></td>";
                            echo "\n\t\t\t\t\t\t</form>";
                            echo "\n\t</tr>";
                            echo "\n\t<tr>\n\t\t<td style='border: 0px'></td>";

                            echo "<pre>";
                            print_r($stufeAuswahl);
                            for ($i=0;$i<count($stufeAuswahl);$i++){
                                if (isset($stufeAuswahl[$i])){
                                    if ($stufeAuswahl[$i]->getId()==$anzahlquali->getStufe()->getID()){
                                        print_r($stufeAuswahl[$i]);
                                        unset($stufeAuswahl[$i]);
                                    }
                                }
                            }
                            print_r($stufeAuswahl);
                        }
                    }
                    echo "\n\t\t<td style='border: 0px'>";
                    echo "\n\t\t\t\t\t\t<form action='index.php' method='post'>";
                    echo "\n\t\t\t\t\t\t\t<input type='hidden' name='area' value='anzahlquali'>";
                    echo "\n\t\t\t\t\t\t\t<input type='hidden' name='action' value='speichern'>";
                    echo "\n\t\t\t\t\t\t\t<input type='hidden' name='kategorie_id' value='".$kategorie->getId()."'>";
                    HTML::SelectStufe('stufe_id',$stufeAuswahl,'');
                    echo "</td><td colspan='4' style='border: 0px;'><input type='submit' value='Stufe hinzufügen'></td>";
                }
                ?>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table>
                <thead>
                    <th valign="top">
                        <table>
                            <tr>
                            <td colspan="3"><b>Kategorien<b></td>
                            </tr>
                            <?php
                            // db abfragen ausserhalb der schleifen
                            foreach ($kategorieAll as $kategorie){
                                echo "<form action='index.php' method='post'>";
                                echo "<input type='hidden' name='area' value='kategorie'>";
                                echo "<input type='hidden' name='action' value='speichern'>";
                                echo "<input type='hidden' name='id' value='".$kategorie->getId()."'>";
                                echo "<tr><td><input type='text' name='kategorie' value='".$kategorie->getKategorie()."'></td>";
                                echo "<td><input type='submit' value='ändern'></td></form>";
                                echo "<td><a href='index.php?action=loeschen&area=kategorie&id=".$kategorie->getId()."'><button>löschen</button></a></td>";
                                echo "</tr>";
                            }
                            ?>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='area' value='kategorie'>
                                <input type='hidden' name='action' value='neuanlegen'>
                                <tr>
                                    <td><input type='text' name='kategorie' value=''></td>
                                    <td colspan="2"><input type='submit' value='neu'></td>
                                </tr>
                            </form>
                        </table>
                        <table>
                            <tr>
                                <td colspan="3"><b>Stufen</b></td>
                            </tr>
                            <?php
                            // db abfragen ausserhalb der schleifen
                            foreach ($stufeAll as $stufe){
                                echo "<form action='index.php' method='post'>";
                                echo "<input type='hidden' name='area' value='stufe'>";
                                echo "<input type='hidden' name='action' value='speichern'>";
                                echo "<input type='hidden' name='id' value='".$stufe->getId()."'>";
                                echo "<tr><td><input type='text' name='stufe' value='".$stufe->getStufe()."'></td>";
                                echo "<td><input type='submit' value='ändern'></td></form>";
                                echo "<td><a href='index.php?action=loeschen&area=stufe&id=".$stufe->getId()."'><button>löschen</button></a></td>";
                                echo "</tr>";

                            }
                            ?>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='area' value='stufe'>
                                <input type='hidden' name='action' value='neuanlegen'>
                                <tr>
                                    <td><input type='text' name='stufe' value=''></td>
                                    <td colspan="2"><input type='submit' value='neu'></td>
                                </tr>
                            </form>
                        </table>
                    </th>
                    <th valign="top">
                        <table>
                            <tr>
                            <td colspan="3"><b>Bezahlarten</b></td>
                            </tr>
                            <?php
                            // db abfragen ausserhalb der schleifen
                            $bezahlartAll=Bezahlart::getAll();
                            foreach ($bezahlartAll as $bezahlart){
                                echo "<form action='index.php' method='post'>";
                                echo "<input type='hidden' name='area' value='bezahlart'>";
                                echo "<input type='hidden' name='action' value='speichern'>";
                                echo "<input type='hidden' name='id' value='".$bezahlart->getId()."'>";
                                echo "<tr><td><input type='text' name='bezahlart' value='".$bezahlart->getBezahlart()."'></td>";
                                echo "<td><input type='submit' value='ändern'></td></form>";
                                echo "<td><a href='index.php?action=loeschen&area=bezahlart&id=".$bezahlart->getId()."'><button>löschen</button></a></td>";
                                echo "</tr>";
                            }
                            ?>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='area' value='bezahlart'>
                                <input type='hidden' name='action' value='neuanlegen'>
                                <tr>
                                    <td><input type='text' name='bezahlart' value=''></td>
                                    <td colspan="2"><input type='submit' value='neu'></td>
                                </tr>
                            </form>
                        </table>

                    </th>
                </thead>
                <thead>
                    <th colspan="2">
                        <table>
                            <tr>
                                <td><b>optionen</b></td>
                                <td colspan="3" ><b>wert</b></td>
                            </tr>
                            <?php
                                // db abfragen ausserhalb der schleifen
                                $optionenAll=Optionen::getAll();
                                foreach ($optionenAll as $optionen){
                                    echo "<form action='index.php' method='post'>";
                                    echo "<input type='hidden' name='area' value='optionen'>";
                                    echo "<input type='hidden' name='action' value='speichern'>";
                                    echo "<input type='hidden' name='name' value='".$optionen->getName()."'>";
                                    echo "<tr><td style='text-align: right'>".$optionen->getName()."</td>";
                                    echo "<td><input type='number' name='wert' value='".$optionen->getWert()."'></td>";
                                    echo "<td><input type='submit' value='ändern'></td></form>";
                                    echo "<td><a href='index.php?action=loeschen&area=optionen&id=".$optionen->getName()."'><button>löschen</button></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='area' value='optionen'>
                                <input type='hidden' name='action' value='neuanlegen'>
                                <tr>
                                    <td><input type='text' name='name' value=''></td>
                                    <td><input type='number' name='wert' value=''></td>
                                    <td colspan="2"><input type='submit' value='neu'></td>
                                </tr>
                            </form>
                        </table>
                    </th>
                </thead>
            </table>
        </td>
    </tr>
</table>
