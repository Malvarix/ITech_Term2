<!DOCTYPE html>
<html>
<head>
    <title>ITech_Term2_Lab1</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="style/code.png">
</head>
<body>
    <h3>First task. Статистика работы в сети выбранного клиента.</h3>
    <form method="POST" action="query1.php">
        <label for="clients">Выберите пользователя:</label>
        <select name='clients' id="clients">
            <?php
                require_once("connect.php");
                $sqlClients = "SELECT `name` FROM `client`";
                // var_dump($dbh->query("SELECT * FROM client"));

                foreach($dbh->query($sqlClients) as $row)
                {
                    // print_r( $row);
                    echo "<option value=$row[0]>$row[0]</option>";
                    //var_dump($sql);
                }
            ?>
        </select>
        <input type="submit" value="Просмотреть статистику">
    </form>

    <h3>Second task. Cтатистика работы в сети за указанный промежуток времени.</h3>
    <form method="POST" action="query2.php">
        <h4>Укажите начало и конец сессии для получения данных (выбор данных доступен только из перечня существующих):</h4>
        <label for = "s_start">Начало сессии:</label>
        <select name = "s_start">
            <?php
                require_once("connect.php");
                $sqlSStart = "SELECT SEANSE.START FROM SEANSE";

                foreach($dbh->query($sqlSStart) as $row){
                    echo "<option value=$row[0]>$row[0]</option>";
                }
            ?>
        </select>
        <label for = "s_stop">Конец сессии:</label>
        <select name = "s_stop">
            <?php
                require_once("connect.php");
                $sqlSStop = "SELECT SEANSE.STOP FROM SEANSE";

                foreach($dbh->query($sqlSStop) as $row){
                    echo "<option value=$row[0]>$row[0]</option>";
                }
            ?>
        </select>
        <input type="submit" value="Просмотреть статистику">
    </form>

    <h3>Second task. Вывести список клиентов с отрицательным балансом счета.</h3>
    <form method="POST" action="query3.php">
        <input type="submit" value="Вывести!">
    </form>
    
</body>
</html>


<?php
        //phpinfo();
        //var_dump(PDO::getAvailableDrivers());
        // try{
        //    $username="root"; $password="";
        //    $dbn = new PDO('mysql:host=localhost;dbname=itech_term2_lab1', $username, $password);
        //    echo "You`ve successfully connected!";
        //}
        //catch(PDOException $e){
        //    echo "Error!".$e->getMessage();die();
        //}

        /*function firstQuery($dbn){
            $sql = "SELECT CLIENT.ID_Client, CLIENT.name, CLIENT.balance FROM CLIENT WHERE CLIENT.BALANCE < 0";
            foreach($dbn->query($sql)as$row){
                //print "<br>$row['ID_Client']$row['name']";
                var_dump($row);echo"<br>";
            }
        }*/


       //$sql = "SELECT CLIENT.ID_Client, CLIENT.name, CLIENT.balance FROM CLIENT WHERE CLIENT.BALANCE < 0";
        /*foreach($dbn->query($sql)as$row){
            //print "<br>$row['ID_Client']$row['name']";
            var_dump($row);echo"<br>";
        }*/


        //PDO::query(string $sql);

        // SELECT CLIENT.ID_Client, SEANSE.ID_Seanse, SEANSE.start, SEANSE.stop, SEANSE.in_trafic, SEANSE.out_trafic 
        //FROM SEANSE INNER JOIN CLIENT ON SEANSE.FID_CLIENT = CLIENT.ID_Client WHERE CLIENT.ID_Client = 23

        //SELECT CLIENT.ID_Client, SEANSE.ID_Seanse, SEANSE.start, SEANSE.stop, SEANSE.in_trafic, SEANSE.out_trafic 
        //FROM SEANSE INNER JOIN CLIENT ON SEANSE.FID_CLIENT = CLIENT.ID_Client WHERE SEANSE.start > '2020-01-01' AND SEANSE.STOP < '2020-01-01 23:59:59'

        //SELECT CLIENT.ID_Client, CLIENT.name, CLIENT.balance FROM CLIENT WHERE CLIENT.BALANCE < 0
?>