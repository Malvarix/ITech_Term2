<?php
    require_once("connect.php");
    $action = $_REQUEST['publishers'];
    //print_r($action);
    //$cursor = $collection -> find(['publisherName'=>$action],['projection'=>['publisherName'=>1,'_id'=>0]]);
    //$cursor = $collection->find();
    //print_r($cursor);
    //echo $cursor->count();
    //print_r($collection);
    $cursor = $collection -> find(['publisherName'=>$action],['projection'=>['_id'=>0]]);
    $result = iterator_to_array($cursor);
    /*
    foreach($result as $row){
        print_r($row);
        echo "<br>";
    }*/

    //$rows = $connection->executeQuery($collection,$query);
    //print_r($cursor);
    if($result == null){
        exit("Data not found or does not exist");
    }

    print "<table border=\"1\">\n";
    print "<tr>\n";

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
                //print "<td>";
                $date = $val->toDateTime()->format("Y");//("Y-m-d H:i:s");
                print "<td>$date</td>";
                //$date = $vale -> toDateTime();
                //print "<td>$date</td>";
            }
            else{
                print "<td>";
                for($i=0; $i<count($val);$i++){
                    $temp = $val[$i]."<br>";
                    print "$temp";
                }
                print "</td>";
            }
            //else{
                //for($i = 1; i < count($va))
                //print_r($val);
                //print "<td>$val</td>";
            //}
        }
        print "</tr>";
    }
    print "</table>";
?>