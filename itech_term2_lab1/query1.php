<?php
    require_once("connect.php");
    //include 'index.php';

    /*$sql="SELECT CLIENT.ID_Client, SEANSE.ID_Seanse, SEANSE.start, SEANSE.stop, SEANSE.in_trafic, SEANSE.out_trafic 
    FROM SEANSE INNER JOIN CLIENT ON SEANSE.FID_CLIENT = CLIENT.ID_Client WHERE CLIENT.ID_Client = {$_GET['ID_Client']}";
    echo "<select name='clients'>";
    foreach($dbh->query($sql) as $row)
    {
        echo "<option value=$row[0]></option>";
        //var_dump($sql);
    }*/

    /*    $stmt = $dbh->prepare("SELECT CLIENT.ID_CLIENT, SEANSE.ID_SEANSE, SEANSE.START, SEANSE.STOP, SEANSE.IN_TRAFIC, SEANSE.OUT_TRAFIC
    FROM CLIENT INNER JOIN SEANSE ON CLIENT.ID_CLIENT=SEANSE.FID_CLIENT WHERE CLIENT.NAME =  ");
    $id_client="CLIENT.ID_CLIENT";
    $id_seanse="SEANSE.ID_SEANSE";
    $s_start="SEANSE.START";
    $s_stop="SEANSE.STOP";
    $in_trafic="SEANSE.IN_TRAFIC";
    $out_trafic="SEANSE.OUT_TRAFIC";
    var_dump($stmt->bindParam(1,$id_client));
    $stmt->execute();
    $result = $stmt->fetchAll();
    print_r($result); 

    $sql="SELECT CLIENT.ID_Client, SEANSE.ID_Seanse, SEANSE.start, SEANSE.stop, SEANSE.in_trafic, SEANSE.out_trafic 
    FROM SEANSE INNER JOIN CLIENT ON SEANSE.FID_CLIENT = CLIENT.ID_Client /*WHERE CLIENT.ID_Client = {$_GET['ID_Client']}";
    foreach($dbh->query($sql) as $row)
    {
        echo "<option value=$row[0]></option>";
        //var_dump($sql);
    }*/

    //echo $_POST['clients'];

    $action = $_POST['clients'];
    $stmt = $dbh->prepare("SELECT CLIENT.NAME, SEANSE.ID_SEANSE, SEANSE.START, SEANSE.STOP, SEANSE.IN_TRAFIC, SEANSE.OUT_TRAFIC
    FROM CLIENT INNER JOIN SEANSE ON CLIENT.ID_CLIENT=SEANSE.FID_CLIENT WHERE CLIENT.NAME = ?");
    $stmt->execute(array($action));
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
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


    //print_r($result);
    //$results = $dbh->execute([$clients]);
    /*    echo '<table>
        <tr>
        <td>Forename</td>
        <td>Surname</td>
        </tr>
        <tr>
        <td>'.$result["forename"].'</td>
        <td>'.$result["surname"].'</td>
        </tr>
        </table>';
    print_r($result); */

    
    //$arrValues = 
?>