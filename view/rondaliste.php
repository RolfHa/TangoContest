<?php
if ($area=='punkte'){$area = 'rondapunkte';}
if ($area=='ronda'){$area = 'rondateilnehmer';}
?>
<table>
    <tr>
        <th colspan="2">Kategorie</th>
        <th>Rondas</th>
    </tr>
    <?php foreach (Kategorie::getAll() as $kategorie){
        $katFlag=0;
        foreach (Stufe::getAll() as $stufe){
            $katFlag++;
                echo "\n\t<tr>\n\t\t<td>";
                if ($katFlag==1){
                    echo $kategorie->getKategorie();
                }
                echo "</td>";
            echo "\n\t\t<td style='border: 0px'>".$stufe->getStufe()."</td>\n\t\t<td>\n\t\t\t<table border='0' >\n\t\t\t\t<tr>";
            foreach (Ronda::getAll() as $ronda){
                if ($ronda->getKategorie_id()==$kategorie->getId() and $ronda->getStufe_id()==$stufe->getId()){
                    echo "\n\t\t\t\t\t<td style='border: 0px'><a href='index.php?action=aendern&area=".$area."&id=".$ronda->getId()."'>";
                    echo "<button>&nbsp;&nbsp;".$ronda->getRonda()."&nbsp;&nbsp;</button></a>";
                    //echo "(id=".$ronda->getId().")"; // zeigt id an
                    echo "</td>";
                }
            }
            echo "\n\t\t\t\t</tr>\n\t\t\t</table>\n\t\t</td>\n\t</tr>";
        }
    }
    ?>
    </tr>
</table>