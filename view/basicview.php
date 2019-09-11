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
    <table border="0" width="80%">
        <tr>
            <td style="border: 0px" width="70%">
                <table border="0" width="100%">
                    <thead>
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=teilnehmer"><button style="width: 130px">Liste Teilnehmer</button></a></th>
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=tanzpaar"><button style="width: 130px">Liste Tanzpaare</button></a></th>
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=jury"><button style="width: 130px">Liste Jurymitglieder</button></a></th>
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=ronda"><button style="width: 130px">Ronda Tanzpaar</button></a></th>
                    <th style="border: 0px" width="100" ></th>
                    <th style="border: 0px" valign="top"><a href="index.php?action=listeanzeigen&area=optionen"><button style="width: 130px">Optionen</button></a></th>
                    <th style="border: 0px" valign="top"><a href="index.php?action=listeanzeigen&area=hilfe"><button style="width: 130px">Hilfe</button></a></th>
                    </thead>
                    <thead>
                        <th style="border: 0px"><a href="index.php?action=eingeben&area=teilnehmer"><button style="width: 130px">neuer Teilnehmer</button></a></th>
                        <th style="border: 0px"><a href="index.php?action=eingeben&area=tanzpaar"><button style="width: 130px">neues Tanzpaar</button></a></th>
                        <th style="border: 0px"><a href="index.php?action=eingeben&area=jury"><button style="width: 130px">neues Jurymitglied</button></a></th>
                        <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=punkte"><button style="width: 130px">Ronda Punkte</button></a></th>
                        <th style="border: 0px" colspan="3"></th>
                    </thead>
                </table>
            </td>
            <td style="border: 10px; text-align: right" align="right" valign="top">
                <img src='botc-logo.png' height='100'>
            </td>
        </tr>
    </table>


</nav>


<?php
if ($view !=""){    include 'view/' . $view . '.php';}
else {echo '<br><br><ul><ul><ul><ul><ul><img src="tango.jpg">';}
?>

</body>
</html>
