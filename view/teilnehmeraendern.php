<?php $teilnehmer = Teilnehmer::getById($id);?>

<form action="index.php" method="post">
    <input type="hidden" name="area" value="<?php echo $area; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="action" value="speichern">
    <input name='checkID' type='hidden' value="<?php echo $checkID; ?>">

    <table>
        <tbody>
        <tr>
            <td>Vorname</td>
            <td><input type="text" name="vorname" value="<?php echo $teilnehmer->getVorname(); ?>"> </td>
        </tr>
        <tr>
            <td>Nachname</td>
            <td><input type="text" name="nachname" value="<?php echo $teilnehmer->getNachname(); ?>"></td>
        </tr>
        <tr>
            <td>Geschlecht</td>
            <td><input name="geschlecht" value="m" type="radio" <?php echo HTML::checked($teilnehmer->getGeschlecht(),'m'); ?> >männlich
                <input name="geschlecht" value="w" type="radio" <?php echo HTML::checked($teilnehmer->getGeschlecht(),'w'); ?> >weiblich
                <input name="geschlecht" value="d" type="radio" <?php echo HTML::checked($teilnehmer->getGeschlecht(),'d'); ?> >divers
            </td>
        </tr>
        <tr>
            <td>Telefonnummer</td>
            <td><input type="text" name="telefonnummer" value="<?php echo $teilnehmer->getTelefonnummer(); ?>"></td>
        </tr>
        <tr>
            <td>Wohnort</td>
            <td><input type="text" name="wohnort" value="<?php echo $teilnehmer->getWohnort(); ?>"></td>
        </tr>
        <tr>
            <td>Land</td>
            <td><input type="text" name="wohnland" value="<?php echo $teilnehmer->getWohnland(); ?>"></td>
        </tr>
        <tr>
            <td>Künstlername</td>
            <td><input type="text" name="kuenstlername" value="<?php echo $teilnehmer->getKuenstlername(); ?>"></td>
        </tr>
        <tr>
            <td>Geburtsname</td>
            <td><input type="text" name="geburtsname" value="<?php echo $teilnehmer->getGeburtsname(); ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="aendern"><input type="reset"></td>
        </tr>
        </tbody>
    </table>
</form>
