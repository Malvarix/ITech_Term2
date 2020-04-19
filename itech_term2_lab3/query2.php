<?php
    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");

    require_once("connect.php");

    $temp1 = $_REQUEST['s_start'];
    $temp2 = $_REQUEST['s_stop'];

    $stmt=$dbh->prepare("SELECT CLIENT.ID_CLIENT, CLIENT.NAME, CLIENT.IP, SEANSE.ID_SEANSE, SEANSE.START, SEANSE.STOP, SEANSE.IN_TRAFIC, SEANSE.OUT_TRAFIC
    FROM CLIENT INNER JOIN SEANSE ON CLIENT.ID_CLIENT=SEANSE.FID_CLIENT WHERE SEANSE.START > ? AND SEANSE.STOP < ?");
    $stmt->execute(array($temp1,$temp2));
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if($result == null){
        exit("Data not found or does not exist");
    }

    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");
    echo '<?xml version="1.0" encoding="utf8" ?>';
    echo "<query2>";
    print "<row>\n";
    foreach($result[0] as $key => $useless){
        print "<headers>$key</headers>";
    }
    echo "</row>";
    foreach($result as $row){
        print "<row>";
        foreach($row as $key => $val){
            print "<def>$val</def>";
        }
        print "</row>";
    }
    echo "</query2>"
?>