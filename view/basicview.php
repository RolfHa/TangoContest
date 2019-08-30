<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-16">
    <title>Berlin Open Tango Contest</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
        }
        th {
            font-weight: bold;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<!-- Navigationsleiste -->
<nav><form method="post" ><table border="0"><tr>
                <td><input type="submit" name="teilnehmerliste" value="Liste Teilnehmer"></td>
                <td><input type="submit" name="tanzpaarliste" value="Liste Tanzpaare"></td>
                <td><input type="submit" name="juryliste" value="Liste Jurymitglieder"></td>
                <td><input type="submit" name="rondaliste" value="Liste Ronda"></td>
                <td><input type="submit" name="punkteliste" value="Liste Punkte"></td>
            </tr><tr>
                <td><input type="submit" name="teilnehmerneu" value="neuer Teilnehmer"></td>
                <td><input type="submit" name="tanzpaarneu" value="neues Tanzpaar"></td>
                <td><input type="submit" name="juryneu" value="neues Jurymitglied"></td>
                <td><input type="submit" name="rondaneu" value="Ronda anlegen"></td>
                <td><input type="submit" name="punkeneu" value="Punkte eingeben"></td>
            </tr></table></form></nav>


<?php
include 'view/' . $view . '.php';

?>

</body></html>
