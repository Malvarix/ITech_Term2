<?php
    header("Cache-Control: no-cache, must-revalidate");

    require_once("connect.php");

    $receiver1 = $_REQUEST['y_start']."-01-01 00:00:00";
    $start = new MongoDB\BSON\UTCDateTime(strtotime($receiver1)*1000);
    //print_r($start);
    //$s_date = $start -> toDateTime();
    //print_r($s_date);
    //$y_start = date("c",strtotime($receiver1));
    //print "</br>";
    //print_r(gettype($receiver1));
    //$y_start = $receiver1 ->toDateTime()->format("Y-m-d H:i:s");//("Y-m-d H:i:s");;
    //print_r($temp1);
    $receiver2 = $_REQUEST['y_end']."-12-31 23:59:59";
    $end = new MongoDB\BSON\UTCDateTime(strtotime($receiver2)*1000);
    //print_r($end);

    //$y_end = date("c",strtotime($receiver2));
    //print "</br>";
    //print_r($start); 
    //print_r(date("c",strtotime($receiver1)));
    //print "</br>";
    //print_r(strtotime($receiver2));
    //print "</br>";

    $cursor = $collection -> find(['date' => ['$gte' => $start , '$lte' => $end ]],['projection' => ['_id' => 0, 'item' =>  1 , 'articleTitle' => 1, 'bookTitle' => 1, 'author' => 1, 'publisherName' => 1]]);
    //['$dateFromString' => [ 'dateString' => '$receiver1']] , '$lte' => ['$dateFromString' => [ 'dateString' => '$receiver2']]]]);
    //$cursor = $collection -> find(['publisherName'=>$action],['projection'=>['_id'=>0]]); 'item' => 1, 'articleTitle' => 1, 'bookTitle' => 1
    $result = iterator_to_array($cursor);
    //print_r($result);

    foreach($result as $row){
        $item = $row['item'];
        //print_r($item);
        if($item == 'book'){
            $bookTitle = $row['bookTitle'];
            $author = $row['author'];
            $publisherName = $row['publisherName'];
            print "<ul><li>Type of literature : $item</li>";
            print "<li>Book title : $bookTitle</li>";
            print "<li>Author : $author</li>";
            print "<li>Publisher : $publisherName</li></ul>";
        }
        elseif ($item == 'magazine') {
            $magazineTitle = $row['articleTitle'];
            $publisherName = $row['publisherName'];
            print "<ul><li>Type of literature : $item</li>";
            print "<li>Magazine article title : $magazineTitle</li>";
            print "<li>Publisher : $publisherName</li></ul>";
        }
        else {
            $newspaperTitle = $row['articleTitle'];
            $publisherName = $row['publisherName'];
            print "<ul><li>Type of literature : $item</li>";
            print "<li>Newspaper article title : $newspaperTitle</li>";
            print "<li>Publisher : $publisherName</li></ul>";
        }
    }

    //$res = "";

    /*print "<ul>";
    foreach($result as $row){

    }
    print "</ul>";*/

    //echo json_encode($result);
    //print_r($result);

    /*if($result == null){
        exit("Data not found or does not exist");
    }*/

    
    /*foreach($result[0] as $key => $useless){
        print "<headers>$key</headers>";
    }
    echo "</row>";
    foreach($result as $row){
        print "<row>";
        foreach($row as $key => $val){
            print "<def>$val</def>";
        }
        print "</row>";
    }*/

    /*print "<table border=\"1\">\n";
    print "<tr>\n";

    for($i = 0; $i < $result.count; $i++){
        print "<th>$result[$i]</th>";
    }

    foreach($result[0] as $key => $useless){
        print "<th>$key</th>";
    }
    
    print "</tr>";
    foreach($result as $row){
        print "<tr>";
        foreach($row as $key => $val){
            if(is_string($val)){
                print "<td>$val</td>";
            }
            else if(is_numeric($val)){
                print "<td>$val</td>";
            }
            else if(!is_countable($val)){
                $date = $val->toDateTime()->format("Y-m-d");//("Y-m-d H:i:s");
                print "<td>$date</td>";
            }
            else{
                print "<td>";
                for($i=0; $i<count($val);$i++){
                    $temp = $val[$i]."<br>";
                    print "$temp";
                }
                print "</td>";
            }
        }
        print "</tr>";
    }
    print "</table>";*/
?>