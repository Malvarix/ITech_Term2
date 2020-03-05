<?php
    require_once("connect.php");

    $stmt=$dbh->prepare("SELECT CLIENT.ID_CLIENT, CLIENT.NAME, CLIENT.IP, CLIENT.BALANCE FROM CLIENT WHERE CLIENT.BALANCE < '0'");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    print "<table width=\"100%\" border=\"1\">\n";
    print "<tr>\n";

    foreach($result[0] as $key => $useless){
        print "<th>$key</th>";
    }
    print "</tr>";
    foreach($result as $row){
        print "<tr>";
        foreach($row as $key => $val){
            print "<td>$val</td>";
        }
        print "</tr>";
    }

    print "</table>";

    print "<a href='index.php'>Вернутся на главную страницу</a>";
?>