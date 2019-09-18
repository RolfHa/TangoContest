<?php
$liste = Jury::getAll();
//echo '<pre>';
//print_r($liste);
//echo '</pre>';
?>
<table>
    <thead>
    <th>id</th>
    <th>Vorname</th>
    <th>Nachname</th>
    <th></th>
    <th></th>
    </thead>
    <tbody>
    <?php
    for ($i = 0; $i < count($liste); $i++){
        ?>
        <tr>
            <td>
                <?php echo $liste[$i]->getId(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getVorname(); ?>
            </td>
            <td>
                <?php echo $liste[$i]->getNachname(); ?>
            </td>
            <td>
                <a href="index.php?action=aendern&area=jury&id=<?php echo $liste[$i]->getId(); ?>&checkID=<?php echo $checkID; ?>"><button>ändern</button></a>
            </td>
            <td>
                <a href="index.php?action=loeschen&area=jury&id=<?php echo $liste[$i]->getId(); ?>&checkID=<?php echo $checkID; ?>"><button>löschen</button></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>


