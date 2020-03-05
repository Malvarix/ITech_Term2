<?php
    require_once("connect.php");

    $temp1 = $_POST['s_start'];
    $temp2 = $_POST['s_stop'];


    /*$stmt=$dbh->prepare("SELECT CLIENT.ID_CLIENT, CLIENT.NAME, CLIENT.IP, SEANSE.ID_SEANSE, SEANSE.START, SEANSE.STOP, SEANSE.IN_TRAFIC, SEANSE.OUT_TRAFIC
    FROM CLIENT INNER JOIN SEANSE ON CLIENT.ID_CLIENT=SEANSE.FID_CLIENT WHERE SEANSE.START = ? AND SEANSE.STOP = ?");
    $stmt->execute(array($temp1,$temp2));
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);*/

    $stmt=$dbh->prepare("SELECT CLIENT.ID_CLIENT, CLIENT.NAME, CLIENT.IP, SEANSE.ID_SEANSE, SEANSE.START, SEANSE.STOP, SEANSE.IN_TRAFIC, SEANSE.OUT_TRAFIC
    FROM CLIENT INNER JOIN SEANSE ON CLIENT.ID_CLIENT=SEANSE.FID_CLIENT WHERE SEANSE.START > ? AND SEANSE.STOP < ?");
    $stmt->execute(array($temp1,$temp2));
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result);
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