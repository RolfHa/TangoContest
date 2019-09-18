<?php
$liste = Tanzpaar::getAll();
//echo '<pre>';
//print_r($liste);
//echo '</pre>';
?>
<table>
    <thead>
    <th>Startnummer</th>
    <th>Führung</th>
    <th>Teilnehmer1</th>
    <th>Teilnehmer2</th>
    <th>Wohnort</th>
    <th>Land</th>
    <th>Anmeldebetrag</th>
    <th>bezahlt</th>
    <th>Bezahldatum</th>
    <th>Bezahlart</th>
    <th></th>
    <th></th>
    </thead>
    <tbody>
    <?php
    for ($i = 0; $i < count($liste); $i++){
        ?>
        <tr>
            <td>
                <?php echo $liste[$i]->getStartnummer(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getFuehrungsfolge(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getTeilnehmer1()->getName(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getTeilnehmer2()->getName(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getWohnort(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getWohnland(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getAnmeldebetrag(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getBezahlt(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getBezahldatum(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getBezahlart()->getBezahlart(); ?>
            </td>
            <td>
                <a href="index.php?action=aendern&area=tanzpaar&id=<?php echo $liste[$i]->getId(); ?>&checkID=<?php echo $checkID; ?>"><button>ändern</button></a>
            </td>
            <td>
                <a href="index.php?action=loeschen&area=tanzpaar&id=<?php echo $liste[$i]->getId(); ?>&checkID=<?php echo $checkID; ?>"><button>löschen</button></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>


