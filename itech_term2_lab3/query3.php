<?php
    header('Content-Type: application/json');
    header("Cache-Control: no-cache, must-revalidate");

    require_once("connect.php");

    $stmt=$dbh->prepare("SELECT CLIENT.ID_CLIENT, CLIENT.NAME, CLIENT.IP, CLIENT.BALANCE FROM CLIENT WHERE CLIENT.BALANCE < '0'");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($result);
?>