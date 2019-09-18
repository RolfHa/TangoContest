<form action="index.php" method="post">
    <input type="hidden" name="area" value="ronda">
    <input type="hidden" name="action" value="neuanlegen">
    <input name='checkID' type='hidden' value="<?php echo $checkID; ?>">

    <table>
        <thead>
        <th colspan="2"> Neue Ronda erstellen</th>
        </thead>
        <tr>
            <td>Kategorie und stufe</td>
            <td>
                <?php
                HTML::SelectKategorie2stufe('kategorie2stufe_id',Kategorie2Stufe::getAll(),"");
                ?>
            </td>
        </tr>
        <tr>
            <td>Nummer</td>
            <td>nächste freie Nr.</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="speichern"><input type="reset">
        </tr>
    </table>
</form>