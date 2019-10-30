<?php
    function rondaInKategorie ($kategorie_id){
        foreach (Stufe::getAll() as $stufen){
            foreach (Ronda::getRondaIdByStufeIdAndKategorieId($kategorie_id,$stufen->getId())as $ronda){
                return true;
            }
        }
    return false;
    }

if ($area=='punkte'){$area = 'rondapunkte';}
elseif ($area=='ronda'){$area = 'rondateilnehmer';}
else {$area = 'rondapunkte';}
?>
<table>
    <tr>
        <th >Kategorie</th>
        <th >Stufe</th>
        <th>
            <table border="0">
                <thead>
                    <th style="border: 0px">Rondas</th>
                    <th style="border: 0px">
                        <a href='index.php?action=speichern&area=ronda&checkID=<?php echo $checkID; ?>'><button>Ronda manuell Anlegen</button></a>
                    </th>
                </thead>
            </table>
        </th>
        <th>Auswertung</th>
        <th>Ausdruck</th>
    </tr>
    <?php
    //db abfrage außerhalb der schleifen
    $kategorieAll=Kategorie::getAll();
    $rondaAll=Ronda::getAll();
    foreach ($kategorieAll as $kategorie){
        $anzahlqualiKat=Kategorie2Stufe::getByKategorieId($kategorie->getId());
        $stufeCount=0;
        foreach ($anzahlqualiKat as $anzahlqualiStufe){
            $stufeCount++;
                echo "\n\t<tr>\n\t\t<td><b>";
                if ($stufeCount==1){
                    echo $kategorie->getKategorie();
                }
                echo "</b></td>";
            echo "\n\t\t<td>".$anzahlqualiStufe->getStufe()->getStufe()."</td>\n\t\t<td>\n\t\t\t<table border='0' >\n\t\t\t\t<tr>";
            $rondaCount=0;
            foreach ($rondaAll as $ronda){
                if ($ronda->getKategorie_id()==$kategorie->getId() and $ronda->getStufe_id()==$anzahlqualiStufe->getStufe()->getId()){
                    $rondaCount++;
                    echo "\n\t\t\t\t\t<td style='border: 0px'><a href='index.php?action=aendern&area=".$area."&id=".$ronda->getId()."&checkID=".$checkID."'>";
                    echo "<button>&nbsp;&nbsp;".$ronda->getRonda()."&nbsp;&nbsp;</button></a>";
                    //echo "(id=".$ronda->getId().")"; // zeigt id an
                    echo "</td>";
                }
            }
            echo "\n\t\t\t\t</tr>\n\t\t\t</table>\n\t\t</td>";
            echo "\n\t\t<td>";
            if ($rondaCount>0){
                if ($stufeCount<Count($anzahlqualiKat)){
                    $rondaInNextStufe=0;
                    // prüf ob es in der nächsten stufe schon rondas gibt
                    foreach ($rondaAll as $ronda){
                        if ($ronda->getKategorie_id()==$kategorie->getId() and $ronda->getStufe_id()==$anzahlqualiKat[$stufeCount]->getStufe()->getId()){
                           $rondaInNextStufe++;
                        }
                    }
                    // wenn "0" kann diese stufe abgeschlossen werden und neues ronders erstellt werdenn
                    if ($rondaInNextStufe==0){
                        if ($optionStufeUeberspringen==1){
                            echo"<a href='index.php?action=generieren&area=stufeueberspringen&kategorie_id=".$kategorie->getId()."&stufe_id=".$anzahlqualiStufe->getStufe()->getId()."&checkID=".$checkID."'>";
                            echo "<button>Stufe überspringen</button></a>";

                        }
                        else {
                            echo"<a href='index.php?action=generieren&area=ronda&kategorie_id=".$kategorie->getId()."&stufe_id=".$anzahlqualiStufe->getStufe()->getId()."&checkID=".$checkID."'>";
                            echo "<button>Stufe abschließen</button></a>";
                        }
                    }
                    else {
                        echo"<a href='index.php?action=generieren&area=gewinner&kategorie_id=".$kategorie->getId()."&stufe_id=".$anzahlqualiStufe->getStufe()->getId()."&checkID=".$checkID."'>";
                        echo "<button>Bestenliste</button></a>";
                    }
                }
                // wenn es die letzte Stufe ist kann der gewinner ermittelt werden ($stufeCount==Count($anzahlqualiKat))
                else {
                    echo"<a href='index.php?action=generieren&area=gewinner&kategorie_id=".$kategorie->getId()."&stufe_id=".$anzahlqualiStufe->getStufe()->getId()."&checkID=".$checkID."'>";
                    echo "<button>zeige Gewinner</button></a>";
                }
            }
            // wenn noch keine ronndas in der stufe angelegt wurden ($rondaCount<=0) dann können rondas automatisch erstellt werden
            else{
                // das soll aber nur in der ersten Stufe passieren (bei den anderne passiert das beim abschließen)
                if ($stufeCount==1 and !rondaInKategorie($kategorie->getId())){
                    echo"<a href='index.php?action=generieren&area=rondastufe1&kategorie_id=".$kategorie->getId()."&stufe_id=".$anzahlqualiStufe->getStufe()->getId()."&checkID=".$checkID."'>";
                    echo "<button>Rondas autom. erstellen</button></a>";
                }
            }
            echo "</td><td>";
            if ($rondaCount>0){
                echo "<a href='index.php?action=drucken&area=einlassbogen&kategorie_id=".$kategorie->getId()."&stufe_id=".$anzahlqualiStufe->getStufe()->getId()."&checkID=".$checkID."' target='_blank'><button>Einlass drucken</button></a></th>";
            }
            echo "</td>\n\t</tr>";
        }
    }
    ?>
    </tr>
</table>

