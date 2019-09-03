<form action="index.php" method="post">
    <input type="hidden" name="area" value="<?php echo $area; ?>">
    <input type="hidden" name="action" value="neuanlegen">

    <table>
        <tbody>
        <tr>
            <td>Startnummer</td>
            <td><input required type="text" name="startnummer" value=""> </td>
        </tr>
        <tr>
            <td>Teilnehmer 1</td>
            <td><?php HTML::singleSelectName('teilnehmer1',Teilnehmer::getAll(),''); ?> </td>
        </tr>
        <tr>
            <td>Teilnehmer 2</td>
            <td><?php HTML::singleSelectName('teilnehmer2',Teilnehmer::getAll(),''); ?> </td>
        </tr>
        <tr>
            <td>Führungsfolge</td>
            <td><input name="fuehrungsfolge" value="1" type="radio"  checked >1
                <input name="fuehrungsfolge" value="2" type="radio" >2
            </td>
        </tr>
        <tr>
            <td>Anmeldebetrag</td>
            <td><input type="number" name="anmeldebetrag" min="0" value="0.00" step=".01"></td>
        </tr>
        <tr>
            <td>Bezahlt</td>
            <td><input name="bezahlt" value="1" type="radio"  >ja
                <input name="bezahlt" value="0" type="radio"  checked  >nein
            </td>
        </tr>
        <tr>
            <td>Bezahldatum</td>
            <td><input type="date" name="bezahldatum" value="<?php echo date("Y-m-d"); ?>"></td>
        </tr>
        <tr>
            <td>Bezahlart</td>
            <td><?php HTML::SelectBezahlart ('bezahlart',Bezahlart::getAll(),''); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="speichern"><input type="reset">
        </tr>
        </tbody>
    </table>
</form>
