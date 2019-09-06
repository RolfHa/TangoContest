<?php $tanzpaar= Tanzpaar::getById($id);?>

<table>
    <tbody>
    <tr>
        <td>
            <form action="index.php" method="post">
                <input type="hidden" name="area" value="<?php echo $area; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="action" value="speichern">

                <table>
                    <tbody>
                    <tr>
                        <td>Startnummer</td>
                        <td><input type="text" name="startnummer" value="<?php echo $tanzpaar->getStartnummer(); ?>"> </td>
                    </tr>
                    <tr>
                        <td>Teilnehmer 1</td>
                        <td><?php HTML::singleSelectName('teilnehmer1',Teilnehmer::getAll(),$tanzpaar->getTeilnehmer1()->getId()); ?> </td>
                    </tr>
                    <tr>
                        <td>Teilnehmer 2</td>
                        <td><?php HTML::singleSelectName('teilnehmer2',Teilnehmer::getAll(),$tanzpaar->getTeilnehmer2()->getId()); ?> </td>
                    </tr>
                    <tr>
                        <td>Führungsfolge</td>
                        <td><input name="fuehrungsfolge" value="1" type="radio" <?php echo HTML::checked($tanzpaar->getFuehrungsfolge(),'1'); ?> >1
                            <input name="fuehrungsfolge" value="2" type="radio" <?php echo HTML::checked($tanzpaar->getFuehrungsfolge(),'2'); ?> >2
                        </td>
                    </tr>
                    <tr>
                        <td>Anmeldebetrag</td>
                        <td><input type="text" name="anmeldebetrag" value="<?php echo $tanzpaar->getAnmeldebetrag(); ?>"></td>
                    </tr>
                    <tr>
                        <td>Bezahlt</td>
                        <td><input name="bezahlt" value="1" type="radio" <?php echo HTML::checked($tanzpaar->getBezahlt(),'ja'); ?> >ja
                            <input name="bezahlt" value="0" type="radio" <?php echo HTML::checked($tanzpaar->getBezahlt(),'nein'); ?> >nein
                        </td>
                    </tr>
                    <tr>
                        <td>Bezahldatum</td>
                        <td><input type="date" name="bezahldatum" value="<?php echo $tanzpaar->getBezahldatum(); ?>"></td>
                    </tr>
                    <tr>
                        <td>Bezahlart</td>
                        <td><?php HTML::SelectBezahlart ('bezahlart',Bezahlart::getAll(),$tanzpaar->getBezahlart()->getId()); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="speichern"><input type="reset"></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </td>
        <td valign="top">
            <table border="0">
                <thead>
                    <th colspan="2">Ausgewählte Kategorien</th>
                </thead>
                <?php
                $tanzpaar2kategorieAll=Tanzpaar2kategorie::getAll();
                foreach ($tanzpaar2kategorieAll as $tanzpaar2kategorie){
                    if ($tanzpaar2kategorie->getTanzpaar_id()==$id){
                        echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                        echo $tanzpaar2kategorie->getKategorie()->getKategorie();
                        echo "</td>\n\t\t\t\t\t<td>";
                        echo "<a href='index.php?action=loeschen&area=tanzpaar2kategorie&id=".$id."&tanzpaar2kategorie_id=".$tanzpaar2kategorie->getId()."'><button>löschen</button></a>";
                        echo "</td>\n\t\t\t\t</tr>";
                    }
                }
                ?>
            </table>
        </td>
        <td valign="top">
            <table border="0">
                <thead>
                    <th colspan='2'>weiter Kategorien</th>
                </thead>
                <?php
                foreach (Kategorie::getAll() as $kategorie){
                    $match=0;
                    foreach ($tanzpaar2kategorieAll as $tanzpaar2kategorie){
                        if ($tanzpaar2kategorie->getTanzpaar_id()==$id){
                            if ($tanzpaar2kategorie->getKategorie_id()==$kategorie->getId()){
                                $match=1;
                            }
                        }
                    }
                    if ($match==0) {
                        echo "\n\t\t\t\t<tr>\n\t\t\t\t\t<td>";
                        echo $kategorie->getKategorie();
                        echo "</td>\n\t\t\t\t\t<td>";
                        echo "<a href='index.php?action=speichern&area=tanzpaar2kategorie&id=".$id."&kategorie_id=".$kategorie->getId()."'><button>hinzufügen</button></a>";
                        echo "</td>\n\t\t\t\t</tr>";
                    }
                }
                ?>
            </table>

        </td>
    </tr>
    </tbody>
</table>