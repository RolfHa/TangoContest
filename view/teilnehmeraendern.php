<form action="index.php" method="post">
<input type="hidden" name="area" value="<?php echo $area; ?>">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="action" value="speichern">

<table>
    <tbody>
        <tr>
            <td>Vorname</td>
            <td><input type="text" name="vorname" value="<?php echo $t->getVorname(); ?>"> </td>
        </tr>
        <tr>
            <td>Nachname</td>
            <td><input type="text" name="nachname" value="<?php echo $t->getNachname(); ?>"></td>
        </tr><tr>
            <td>Geschlecht</td>
            <td><input type="radio" name="geschlecht" value="d" <?php echo ''; ?>> Divers
                <input type="radio" name="geschlecht" value="w" > Frau
                <input type="radio" name="geschlecht" value="m" > Mann</td>
        </tr><tr>
            <td>Telefonnummer</td>
            <td><input type="text" name="telefonnummer" value="<?php echo $t->getTelefonnummer(); ?>"></td>
        </tr><tr>
            <td>Wohnort</td>
            <td><input type="text" name="wohnort" value="<?php echo $t->getWohnort(); ?>"></td>
        </tr><tr>
            <td>Land</td>
            <td><input type="text" name="wohnland" value="<?php echo $t->getWohnland(); ?>"></td>
        </tr><tr>
            <td>Künstlername</td>
            <td><input type="text" name="kuenstlername" value="<?php echo $t->getKuenstlername(); ?>"></td>
        </tr><tr>
            <td>Geburtsname</td>
            <td><input type="text" name="geburtsname" value="<?php echo $t->getGeburtsname(); ?>"></td>
        </tr><tr>
            <td></td>
            <td><input type="submit" value="aendern"><input type="reset">
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
</form>
