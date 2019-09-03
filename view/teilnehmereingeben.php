<form action="index.php" method="post">
    <input type="hidden" name="area" value="<?php echo $area; ?>">
    <input type="hidden" name="action" value="neuanlegen">

    <table>
        <tbody>
        <tr>
            <td>Vorname</td>
            <td><input type="text" name="vorname" value=""> </td>
        </tr>
        <tr>
            <td>Nachname</td>
            <td><input type="text" name="nachname" value=""></td>
        </tr>
        <tr>
            <td>Geschlecht</td>
            <td><input name="geschlecht" value="m" type="radio"  >männlich
                <input name="geschlecht" value="w" type="radio"  >weiblich
                <input name="geschlecht" value="d" type="radio"  >divers
            </td>
        </tr>
        <tr>
            <td>Telefonnummer</td>
            <td><input type="text" name="telefonnummer" value=""></td>
        </tr>
        <tr>
            <td>Wohnort</td>
            <td><input type="text" name="wohnort" value=""></td>
        </tr>
        <tr>
            <td>Land</td>
            <td><input type="text" name="wohnland" value=""></td>
        </tr>
        <tr>
            <td>Künstlername</td>
            <td><input type="text" name="kuenstlername" value=""></td>
        </tr>
        <tr>
            <td>Geburtsname</td>
            <td><input type="text" name="geburtsname" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="speichern"><input type="reset">
        </tr>
        </tbody>
    </table>
</form>
