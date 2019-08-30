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
<nav>
    <table border="0">
        <tr><td>
                <a href="index.php?action=listeanzeigen&area=teilnehmer">
                    <button>Liste Teilnehmer</button>
                </a></td>
            <td><a href="index.php?action=listeanzeigen&area=tanzpaar">
                    <button>Liste Tanzpaare</button>
                </a></td>
            <td><a href="index.php?action=listeanzeigen&area=jurymitglieder">
                    <button>Liste Jurymitglieder</button>
                </a></td>
            <td><a href="index.php?action=listeanzeigen&area=ronda">
                    <button>Liste Ronda</button>
                </a></td>
            <td><a href="index.php?action=listeanzeigen&area=punkte">
                    <button>Liste Punkte</button>
                </a></td>
        </tr>
        <tr><td>
                <a href="index.php?action=viewSave&area=teilnehmer">
                    <button>neuer Teilnehmer</button>
                </a></td>
            <td><a href="index.php?action=viewSave&area=tanzpaar">
                    <button>neues Tanzpaar</button>
                </a></td>
            <td><a href="index.php?action=viewSave&area=jurymitglieder">
                    <button>neues Jurymitglied</button>
                </a></td>
            <td><a href="index.php?action=viewSave&area=ronda">
                    <button>Ronda anlegen</button>
                </a></td>
            <td><a href="index.php?action=viewSave&area=punkte">
                    <button>Punkte eingeben</button>
                </a></td>
        </tr>
    </table>
</nav>


<?php
include 'view/' . $view . '.php';

?>

</body></html>
