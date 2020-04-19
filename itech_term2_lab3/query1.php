<?php
    require_once("connect.php");
    $action = $_REQUEST['clients'];
    $stmt = $dbh->prepare("SELECT CLIENT.NAME, SEANSE.ID_SEANSE, SEANSE.START, SEANSE.STOP, SEANSE.IN_TRAFIC, SEANSE.OUT_TRAFIC
    FROM CLIENT INNER JOIN SEANSE ON CLIENT.ID_CLIENT=SEANSE.FID_CLIENT WHERE CLIENT.NAME = ?");
    $stmt->execute(array($action));
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    if($result == null){
        exit("User data not found or does not exist");
    }

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
?>