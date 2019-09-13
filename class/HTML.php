<?php
/* Klasse für alle HTML-Befehle*/
class HTML{

    // checked funktione für Radio Buttons
    /* z.B.  <input name="geschlecht" value="m" type="radio" <?php echo HTML::checked($teilnehmer->getGeschlecht(),'m'); ?> >m      */
    public static function  checked ($ist,$soll){
        if ($ist==$soll){$ausgabe =" checked ";}
        else {$ausgabe  =" ";}
        return $ausgabe ;
    }

    // Singelselect: vorname nachname
    public static function singleSelectName ($name,$arr,$select){
        echo '<select name="'.$name.'">';
        foreach ($arr as $wert)	{
            echo '<option value="'.$wert->getId().'"';
            if ($select==$wert->getId()){echo ' selected ';}
            echo '>'.$wert->getNachname().', '.$wert->getVorname().'</option>';
        }
        echo '</select>';
    }
    //select für Bezahlart
    /* zb         HTML::SelectBezahlart ('bezahlart',Bezahlart::getAll(),$tanzpaar->getBezahlartId());    */
    public static function SelectBezahlart ($name,$arr,$select){
        echo '<select name="'.$name.'">';
        foreach ($arr as $wert)	{
            echo '<option value="'.$wert->getId().'"';
            if ($select==$wert->getId()){echo ' selected ';}
            echo '>'.$wert->getBezahlart().'</option>';
        }
        echo '</select>';
    }

    public static function SelectKategorie ($name,$arr,$select){
        echo '<select name="'.$name.'">';
        foreach ($arr as $wert)	{
            echo '<option value="'.$wert->getId().'"';
            if ($select==$wert->getId()){echo ' selected ';}
            echo '>'.$wert->getKategorie().'</option>';
        }
        echo '</select>';
    }

    public static function SelectStufe ($name,$arr,$select){
        echo '<select name="'.$name.'">';
        foreach ($arr as $wert)	{
            echo '<option value="'.$wert->getId().'"';
            if ($select==$wert->getId()){echo ' selected ';}
            echo '>'.$wert->getStufe().'</option>';
        }
        echo '</select>';
    }
}