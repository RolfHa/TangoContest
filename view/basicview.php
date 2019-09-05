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
    <table>
        <thead>
            <td style="border: 0px"><a href="index.php?action=listeanzeigen&area=teilnehmer"><button>Liste Teilnehmer</button></a></td>
            <td style="border: 0px"><a href="index.php?action=listeanzeigen&area=tanzpaar"><button>Liste Tanzpaare</button></a></td>
            <td style="border: 0px"><a href="index.php?action=listeanzeigen&area=jury"><button>Liste Jurymitglieder</button></a></td>
            <td style="border: 0px"><a href="index.php?action=listeanzeigen&area=ronda"><button>Ronda Teilnehmer</button></a></td>
            <td style="border: 0px"><a href="index.php?action=listeanzeigen&area=punkte"><button>Ronda Punkte</button></a></td>
            <td style="border: 0px" width="150" ></td>
            <td style="border: 0px"><a href="index.php?action=listeanzeigen&area=optionen"><button>Optionen</button></a></td>
        </thead>
        <tr>
            <td style="border: 0px"><a href="index.php?action=eingeben&area=teilnehmer"><button>neuer Teilnehmer</button></a></td>
            <td style="border: 0px"><a href="index.php?action=eingeben&area=tanzpaar"><button>neues Tanzpaar</button></a></td>
            <td style="border: 0px"><a href="index.php?action=eingeben&area=jury"><button>neues Jurymitglied</button></a></td>
            <td style="border: 0px"><a href="index.php?action=''&area=''"><button>Ronda anlegen</button></a></td>
            <td style="border: 0px"><a href="index.php?action=''&area=''"><button>Auswertung</button></a></td>
            <td style="border: 0px"></td>
            <td style="border: 0px"></td>
        </tr>
    </table>
</nav>


<?php
if ($view !=""){    include 'view/' . $view . '.php';}
else {echo '<br><br><ul><ul><ul><ul><ul><img src="tango.jpg">';}
?>

</body>
</html>
