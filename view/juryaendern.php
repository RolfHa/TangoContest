<?php $jury = Jury::getById($id);?>


<form action="index.php" method="post">
    <input type="hidden" name="area" value="<?php echo $area; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="action" value="speichern">

    <table>
        <tbody>
        <tr>
            <td>Vorname</td>
            <td><input type="text" name="vorname" value="<?php echo $jury->getVorname(); ?>"> </td>
        </tr>
        <tr>
            <td>Nachname</td>
            <td><input type="text" name="nachname" value="<?php echo $jury->getNachname(); ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="aendern"><input type="reset">
        </tr>
        </tbody>
    </table>
</form>
