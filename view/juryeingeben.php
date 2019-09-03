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
            <td></td>
            <td><input type="submit" value="speichern"><input type="reset">
        </tr>
        </tbody>
    </table>
</form>
