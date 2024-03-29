<?php
/* Klasse für alle HTML-Befehle*/
class HTML{

    // checked funktione für Radio Buttons
    /* z.B.  <input name="geschlecht" value="m" type="radio" <?php echo HTML::checked($teilnehmer->getGeschlecht(),'m'); ?> >m  */
    public static function  checked ($ist,$soll){
        if ($ist==$soll){$ausgabe =" checked ";}
        else {$ausgabe  =" ";}
        return $ausgabe ;
    }

    // Singelselect: vorname nachname
    public static function singleSelect ($name,$arr,$select){
        echo '<select name="'.$name.'">';
        foreach ($arr as $wert)	{
            echo '<option value="'.$wert->getId().'"';
            if ($select==$wert->getId()){echo ' selected ';}
            echo '>'.$wert->getVorname().' '.$wert->getNachname().'</option>';
        }
        echo '</select>';
    }
    //select für Bezahlart
    public static function SelectBezahlart ($name,$arr,$select){
        echo '<select name="'.$name.'">';
        foreach ($arr as $wert)	{
            echo '<option value="'.$wert->getId().'"';
            if ($select==$wert->getId()){echo ' selected ';}
            echo '>'.$wert->getBezahlart().'</option>';
        }
        echo '</select>';
    }
}