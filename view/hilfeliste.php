<style>
    td, th {        vertical-align: top;    }
</style>

<ul>
<br>

<table >
    <thead>
        <th colspan="3" style="border: 0px"><h1>Vorgehensweis:</h1>
        </th>
    </thead>
    <tr>
        <th> 1.</th>
        <td> Optionen einstellen</td>
        <td>
            Kategorien und Stufen anlegen<br>
            jeweils die maximalen Paare pro Ronda und die weiterkommen pro Stufe einstellen<br>
            Bezahlarten überprüfen
        </td>
    </tr>
    <tr>
        <th> 2.</th>
        <td> Teilnehmer anlegen</td>
        <td>gegebenfalls csv import in die DB
        </td>
    </tr>
    <tr>
        <th> 3.</th>
        <td> Tanzpaare anlegen</td>
        <td>gegebenfalls csv import in die DB
        </td>
    </tr>
    <tr>
        <th> 4.</th>
        <td> Tanzpaare in Kategorien</td>
        <td>über Tanzpaar "ändern" kann man jedem Tanzpaar eine oder mehre Kategorien zuordnen<br>
        </td>
    </tr>
    <tr>
        <th> 5.</th>
        <td> Jurymitglieder anlegen</td>
        <td>gegebenfalls csv import in die DB
        </td>
    </tr>
    <tr>
        <th> 6.</th>
        <td> Rondas anlegen</td>
        <td>mit klick auf "Rondas erstellen" werden automatisch alle Tanzpaare die in der Kategorie sind in Rondas verteilt (optionen beachten)<br>
            manuelle anpassungen möglich
        </td>
    </tr>
    <tr>
        <th> 7.</th>
        <td> Jury einstellen</td>
        <td>in Jeder Ronda muss eine Jury eingestellt werden!(<b>min 3 </b>da erst ab 3 Wertungen die Punkte gezählt werden)<br>
            dazu auf "Ronda Teilnehmer" und die entsprechene Ronda klicken
        </td>
    </tr>
    <tr>
        <th> 8.</th>
        <td> Punkte eingeben</td>
        <td>mit klick auf "Ronda Punkte" und die entsprechende Ronda können Punkte eingegeben werden<br>
            bitte jeweils die Punkte für <b>ein</b> Tanzpaar eingeben und auf "ändern" klicken<br>
            bitte nur numerische werte (wenn doch ist das Ergebnis = 0)<br>
            punkt oder komma geht beides <br>
            min. 3 Wertungen pro Paar sonst zählt es nicht
        </td>
    </tr>
    <tr>
        <th> 9.</th>
        <td> Stufe abschließen</td>
        <td>mit klick auf "Stufe abschließen" werden automatisch alle Tanzpaare die weiter sind auf die Rondas der nächsten Stufe verteilt (optionen beachten)<br>
            ab jetzt sind keine Änderungen der Teilnehemr, Jury oder Punkte in dieser Stufe mehr möglich<br>
            außerdem wird eine Punkteliste aller Tanzpaare generiert, diese kann mit dem Button "Bestenliste" jederzeit wieder erzeugt werden<br>
        </td>
    </tr>
    <th> 10.</th>
    <td> weiter</td>
    <td>weiter mit Punkt 7 bis 9 für die nächsten Stufen bis zum Ende
    </td>
</table>





<?php
/**
 * Created by PhpStorm.
 * User: Sebastian
 * Date: 10.09.2019
 * Time: 11:05
 */