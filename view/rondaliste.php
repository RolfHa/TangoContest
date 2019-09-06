<?php
if ($area=='punkte'){$area = 'rondapunkte';}
if ($area=='ronda'){$area = 'rondateilnehmer';}
?>
<table>
    <tr>
        <th >Kategorie</th>
        <th >Stufe</th>
        <th>Rondas</th>
        <th></th>
    </tr>
    <?php
    //db abfrage außerhalb der schleifen
    $kategorieAll=Kategorie::getAll();
    $stufeAll=Stufe::getAll();
    $rondaAll=Ronda::getAll();
    foreach ($kategorieAll as $kategorie){
        $stufeCount=0;
        foreach ($stufeAll as $stufe){
            $stufeCount++;
                echo "\n\t<tr>\n\t\t<td><b>";
                if ($stufeCount==1){
                    echo $kategorie->getKategorie();
                }
                echo "</b></td>";
            echo "\n\t\t<td style='border: 0px'>".$stufe->getStufe()."</td>\n\t\t<td>\n\t\t\t<table border='0' >\n\t\t\t\t<tr>";
            $rondaCount=0;
            foreach ($rondaAll as $ronda){
                if ($ronda->getKategorie_id()==$kategorie->getId() and $ronda->getStufe_id()==$stufe->getId()){
                    $rondaCount++;
                    echo "\n\t\t\t\t\t<td style='border: 0px'><a href='index.php?action=aendern&area=".$area."&id=".$ronda->getId()."'>";
                    echo "<button>&nbsp;&nbsp;".$ronda->getRonda()."&nbsp;&nbsp;</button></a>";
                    //echo "(id=".$ronda->getId().")"; // zeigt id an
                    echo "</td>";
                }
            }
            echo "\n\t\t\t\t</tr>\n\t\t\t</table>\n\t\t</td>";
            echo "\n\t\t<td>";
            if ($rondaCount>0){
                if ($stufeCount<Count($stufeAll)){
                    $rondaInNextStufe=0;
                    // prüf ob es in der nächsten stufe schon rondas gibt
                    foreach ($rondaAll as $ronda){
                        if ($ronda->getKategorie_id()==$kategorie->getId() and $ronda->getStufe_id()==$stufeAll[$stufeCount]->getId()){
                           $rondaInNextStufe++;
                        }
                    }
                    // wenn nein kann diese stufe abgeschlossen werden und neues ronders erstellt werdenn
                    if ($rondaInNextStufe==0){
                        echo"<a href='index.php?action=generieren&area=ronda&kategorie_id=".$kategorie->getId()."&stufe_id=".$stufe->getId()."'>";
                        echo "<button>Stufe abschließen</button></a>";
                    }
                }
                // wenn es die letzte stufe ist kann der gewinner ermittelt werden
                else {
                    echo"<a href='index.php?action=generieren&area=gewinner&kategorie_id=".$kategorie->getId()."&stufe_id=".$stufe->getId()."'>";
                    echo "<button>zeige Gewinner</button></a>";
                }
            }
            // wenn noch keine ronndas in der stufe angelegt wurden ($rondaCount<=0) dann können rondas automatisch erstellt werden
            else{
                // das soll aber nur in der ersten Stufe passieren (bei den anderne passiert das beim abschließen)
                if ($stufeCount==1){
                    echo"<a href='index.php?action=generieren&area=rondastufe1&kategorie_id=".$kategorie->getId()."&stufe_id=".$stufe->getId()."'>";
                    echo "<button>Rondas erstellen</button></a>";
                }
            }
            echo "</td>\n\t</tr>";
        }
    }
    ?>
    </tr>
</table>