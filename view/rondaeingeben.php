<form action="index.php" method="post">
    <input type="hidden" name="area" value="ronda">
    <input type="hidden" name="action" value="neuanlegen">

    <table>
        <thead>
        <th colspan="2"> Neue Ronda erstellen</th>
        </thead>
        <tr>
            <td>Kategorie</td>
            <td>
                <?php
                HTML::SelectKategorie('kategorie_id',Kategorie::getAll(),"");
                ?>
            </td>
        </tr>
        <tr>
            <td>Stufe</td>
            <td>
                <?php
                HTML::SelectStufe('stufe_id',Stufe::getAll(),"");
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