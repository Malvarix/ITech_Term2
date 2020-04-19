<?php
        $db_driver="mysql";
        $host="localhost";
        $dbname="itech_term2_lab1";
        $username="root";
        $password="";
        $dsn="$db_driver:host=$host;dbname=$dbname";
        try{
            $dbh=new PDO($dsn,$username,$password);
            //echo "You`ve successfully connected!";
        }
        catch(PDOException $e){
            echo "Database aren`t connected! Error! $e->getMessage()";
        }
    ?>