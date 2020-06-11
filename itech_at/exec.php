<?php
    $nickname = $_GET['nickname'];
    //print_r($nickname);
    $result = " ";

    $firstch = curl_init();
    curl_setopt($firstch, CURLOPT_URL, "https://api.worldoftanks.ru/wot/account/list/?application_id=b427b58683159bc5f29fc51aee206c4b&search=".$nickname."&fields=account_id&type=exact");
    curl_setopt($firstch, CURLOPT_RETURNTRANSFER, 1);
    $firstdata = curl_exec($firstch);
    
    $obj = json_decode($firstdata,true);
    $datacheker = $obj['data'];
    $countcheker = $obj['meta']['count'];
    //$account_id = $obj['meta'][0]['account_id'];
    
    if($datacheker != null && $countcheker == 1){
        //print_r($obj);
        $account_id = $obj['data'][0]['account_id'];
        //print_r($account_id);
        //print_r($obj['data'][0][account_id]);
        //print_r($obj['meta'][0]['account_id']);

        $secondch = curl_init();
        curl_setopt($secondch, CURLOPT_URL, "https://api.worldoftanks.ru/wot/account/info/?application_id=b427b58683159bc5f29fc51aee206c4b&account_id=".$account_id."&language=ru&fields=nickname%2Cglobal_rating%2Cstatistics.all.battles%2Cstatistics.all.wins%2Cstatistics.all.damage_dealt%2Cstatistics.all.battle_avg_xp%2Cstatistics.all.hits_percents%2Cstatistics.all.max_damage%2Cstatistics.all.max_frags");
        curl_setopt($secondch, CURLOPT_RETURNTRANSFER, 1);
        $seconddata = curl_exec($secondch);
        //print_r($seconddata);

        $obj2 = json_decode($seconddata,true);
        $realnickname = $obj2['data'][$account_id]['nickname'];
        $globalrating = $obj2['data'][$account_id]['global_rating'];
        $allbattles = $obj2['data'][$account_id]['statistics']['all']['battles'];
        $bavgxp = $obj2['data'][$account_id]['statistics']['all']['battle_avg_xp'];
        $allbattles = $obj2['data'][$account_id]['statistics']['all']['battles'];
        $damagedealt = $obj2['data'][$account_id]['statistics']['all']['damage_dealt'];
        $hitpercents = $obj2['data'][$account_id]['statistics']['all']['hits_percents'];
        $maxdmg = $obj2['data'][$account_id]['statistics']['all']['max_damage'];
        $maxfrgs = $obj2['data'][$account_id]['statistics']['all']['max_frags'];
        $wins = $obj2['data'][$account_id]['statistics']['all']['wins'];
        $avgdmg = round(($damagedealt / $allbattles),0);
        $winsperc = round((($wins * 100) / $allbattles),2);

        print "<p>Nick-name in game : $realnickname<br>";
        print "Global rating : $globalrating<br>";
        print "Battles : $allbattles<br>";
        print "Win rate (%): $winsperc<br>";
        print "Average damage per battle : $avgdmg<br>";
        print "Average hit rate (%) : $hitpercents<br>";
        print "Average xp per battle : $bavgxp<br>";
        print "Maximum damage in battle : $maxdmg<br>";
        print "Maximum frags in battle : $maxfrgs<br></p>";   
    }
    else{
        echo "<p>User with this name does not exist</p>";
    }

?>