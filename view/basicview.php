<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-16">
    <!--  Neuladen der Orginal Adresse erzwingen - also Browser und Proxy Caches ignorieren: -->
    <meta http-equiv="expires" content="0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache">
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
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=teilnehmer&checkID=<?php echo $checkID; ?>"><button style="width: 130px">Liste Teilnehmer</button></a></th>
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=tanzpaar&checkID=<?php echo $checkID; ?>"><button style="width: 130px">Liste Tanzpaare</button></a></th>
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=jury&checkID=<?php echo $checkID; ?>"><button style="width: 130px">Liste Jurymitglieder</button></a></th>
                    <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=ronda&checkID=<?php echo $checkID; ?>"><button style="width: 130px">Ronda Tanzpaar</button></a></th>
                    <th style="border: 0px" width="100" ></th>
                    <th style="border: 0px" valign="top"><a href="index.php?action=listeanzeigen&area=optionen&checkID=<?php echo $checkID; ?>"><button style="width: 130px">Optionen</button></a></th>
                    <th style="border: 0px" valign="top"><a href="index.php?action=listeanzeigen&area=hilfe&checkID=<?php echo $checkID; ?>"><button style="width: 130px">Hilfe</button></a></th>
                    </thead>
                    <thead>
                        <th style="border: 0px"><a href="index.php?action=eingeben&area=teilnehmer&checkID=<?php echo $checkID; ?>"><button style="width: 130px">neuer Teilnehmer</button></a></th>
                        <th style="border: 0px"><a href="index.php?action=eingeben&area=tanzpaar&checkID=<?php echo $checkID; ?>"><button style="width: 130px">neues Tanzpaar</button></a></th>
                        <th style="border: 0px"><a href="index.php?action=eingeben&area=jury&checkID=<?php echo $checkID; ?>"><button style="width: 130px">neues Jurymitglied</button></a></th>
                        <th style="border: 0px"><a href="index.php?action=listeanzeigen&area=punkte&checkID=<?php echo $checkID; ?>"><button style="width: 130px">Ronda Punkte</button></a></th>
                        <th style="border: 0px" colspan="3"></th>
                    </thead>
                </table>
            </td>
            <td style="border: 10px; text-align: right" align="right" valign="top"><a href="index.php"><?php if ($optionLogo==1){echo "<img src='botc-logo.png' height='100'>"; } ?></a>
            </td>
        </tr>
    </table>


</nav>


<?php
//echo "view ist:";echo $view;
if ($view !=""){    include 'view/' . $view . '.php';}
else {
    if ($optionStartbild==1){
        echo '<br><br><ul><ul><ul><ul><ul><img src="tango.jpg">';
    }
}
?>

</body>
</html>
