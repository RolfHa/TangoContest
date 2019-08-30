<?php
$liste = Teilnehmer::getAll();
//echo '<pre>';
//print_r($liste);
//echo '</pre>';
?>
<table>
    <thead>
        <th>id</th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>Geschlecht</th>
        <th>Telefonnummer</th>
        <th>Wohnort</th>
        <th>Wohnland</th>
        <th>Künstlername</th>
        <th>Geburtsname</th>
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
                    <?php echo $liste[$i]->getGeschlecht(); ?>
                </td>
                <td>
                    <?php echo $liste[$i]->getTelefonnummer(); ?>
                </td>
                <td>
                    <?php echo $liste[$i]->getWohnort(); ?>
                </td>
                <td>
                    <?php echo $liste[$i]->getWohnland(); ?>
                </td>
                <td>
                    <?php echo $liste[$i]->getKuenstlername(); ?>
                </td>
                <td>
                    <?php echo $liste[$i]->getGeburtsname(); ?>
                </td>
                <td>
                    <a href="index.php?action=aendern&area=teilnehmer&id=<?php echo $liste[$i]->getId(); ?>"><button>ändern</button></a>
                </td>
                <td>
                    <a href="index.php?action=loeschen&area=teilnehmer&id=<?php echo $liste[$i]->getId(); ?>"><button>löschen</button></a>
                </td>
        </tr>
    <?php
    }
    ?>

    </tbody>
</table>


