<table border="0" width="80%">
    <tr>
        <td colspan="2 " style='text-align: center'>
            <h1 >Optionen </h1>
        </td>
    </tr>
    <tr>
        <td width="70%"><h2>Werte für Ronda</h2></td>
        <td><h4>Kategorien, Bezahlarten und weitere Einstellungen</h4></td>
    </tr>
    <tr>
        <td valign="top">
            <table>
                <tr>
                    <th>Kategorie</th>
                    <th>Stufen</th>
                    <th>max Paare pro Ronda</th>
                    <th colspan="2">Paare die weiter kommen</th>
                </tr>
                <?php
                // db abfragen ausserhalb der schleifen
                $anzahlqualiAll=Anzahlquali::gesAll();
                $kategorieAll=Kategorie::getAll();
                $stufeAll=Stufe::getAll();
                foreach ($kategorieAll as $kategorie){
                    $katFlag=0;
                    foreach ($stufeAll as $stufe){
                        $katFlag++;
                        echo "\n\t<tr>\n\t\t<td>";
                        if ($katFlag==1){
                            echo $kategorie->getKategorie();
                        }
                        echo "</td>";
                        echo "\n\t\t<td style='border: 0px'>".$stufe->getStufe()."</td>";
                        foreach ($anzahlqualiAll as $anzahlquali){
                            if ($anzahlquali->getKategorie_id()==$kategorie->getId()){
                                if ($anzahlquali->getStufe_id()==$stufe->getId()){
                                    echo "\n\t\t\t\t\t\t<form action='index.php' method='post'>";
                                    echo "\n\t\t\t\t\t\t\t<input type='hidden' name='area' value='anzahlquali'>";
                                    echo "\n\t\t\t\t\t\t\t<input type='hidden' name='action' value='speichern'>";
                                    echo "\n\t\t\t\t\t\t\t<input type='hidden' name='kategorie_id' value='".$kategorie->getId()."'>";
                                    echo "\n\t\t\t\t\t\t\t<input type='hidden' name='stufe_id' value='".$stufe->getId()."'>";
                                    echo "\n\t\t<td style='border: 0px'>";
                                    echo "<input type='text' name='maxpaare' value='".$anzahlquali->getMaxpaare()."'></td>";
                                    if($stufe->getID()!=end($stufeAll)->getID()){
                                        echo "\n\t\t<td style='border: 0px'><input type='text' name='anzahlquali' value='".$anzahlquali->getAnzahlquali()."'></td>";
                                    }
                                    else {echo "\n\t\t<td style='border: 0px'><input type='hidden' name='anzahlquali' value='0'></td>";}
                                    echo "\n\t\t\t\t\t\t\t<td style='border: 0px'><input type='submit' value='ändern'></td>";
                                    echo "\n\t\t\t\t\t\t</form>";
                                }
                            }
                        }
                        echo "\n\t</tr>";
                    }
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
                            <td colspan="2">Kategorien</td>
                            </tr>
                            <?php
                            // db abfragen ausserhalb der schleifen
                            foreach ($kategorieAll as $kategorie){
                                echo "<form action='index.php' method='post'>";
                                echo "<input type='hidden' name='area' value='kategorie'>";
                                echo "<input type='hidden' name='action' value='speichern'>";
                                echo "<input type='hidden' name='id' value='".$kategorie->getId()."'>";
                                echo "<tr><td><input type='text' name='kategorie' value='".$kategorie->getKategorie()."'></td>";
                                echo "<td><input type='submit' value='ändern'></td></tr></form>";
                            }
                            ?>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='area' value='kategorie''>
                                <input type='hidden' name='action' value='neuanlegen'>
                                <tr>
                                    <td><input type='text' name='kategorie' value=''></td>
                                    <td><input type='submit' value='neu'></td>
                                </tr>
                            </form>
                        </table>
                    </th>
                    <th valign="top">
                        <table>
                            <tr>
                            <td colspan="2">Bezahlarten</td>
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
                                echo "<td><input type='submit' value='ändern'></td></tr></form>";
                            }
                            ?>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='area' value='bezahlart'>
                                <input type='hidden' name='action' value='neuanlegen'>
                                <tr>
                                    <td><input type='text' name='bezahlart' value=''></td>
                                    <td><input type='submit' value='neu'></td>
                                </tr>
                            </form>
                        </table>

                    </th>
                </thead>
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>optionen</td>
                                <td colspan="2">wert</td>
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
                                    echo "<td><input type='submit' value='ändern'></td></tr></form>";
                                }
                            ?>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='area' value='optionen'>
                                <input type='hidden' name='action' value='neuanlegen'>
                                <tr>
                                    <td><input type='text' name='name' value=''></td>
                                    <td><input type='number' name='wert' value=''></td>
                                    <td><input type='submit' value='neu'></td>
                                </tr>
                            </form>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
