<!DOCTYPE html>
<html>
<head>
    <title>ITech_Term2_Lab3</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="style/code.png">
    <script>
        const ajax = new XMLHttpRequest();

        function get1(){
            let clients =  document.getElementById("clients").value;
            ajax.open("GET","query1.php?clients=" + clients);
            ajax.onreadystatechange = update1;
            ajax.send();
        }

        function update1(){
            if(ajax.readyState === 4){
                if(ajax.status === 200){
                    document.getElementById('body1').innerHTML = ajax.responseText;
                }
            }
        }

        function get2(){
            let s_start = document.getElementById('s_start').value;
            let s_stop = document.getElementById('s_stop').value;
            ajax.open("GET","query2.php?s_start="+s_start+"&s_stop="+s_stop);
            ajax.onreadystatechange = update2;
            ajax.send();
        }

        function update2(){
            if(ajax.readyState === 4){
                if(ajax.status === 200){
                    var res = document.getElementById("body2"); 
                    var result = "";
                    if(ajax.responseXML == null){
                        result += "<p>Data not found or does not exist</p>"
                    }
                    else{
                        var rows = ajax.responseXML.firstChild.children;
                        result += "<table width=\"100%\" border=\"1\">\n"
                        for (var i = 0; i < rows.length; i++) {
                            if(i == rows[0]){
                                result += "<tr>";
                                for(var y = 0; y < rows[0].children.length; y++){
                                    result += "<th>"+rows[0].children[y].textContent+"</th>"
                                }
                                result += "</tr>";
                            }
                            else{
                                result += "<tr>";
                                for(var y = 0; y < rows[i].children.length; y++){
                                    result += "<td>"+rows[i].children[y].textContent+"</td>"
                                }
                                result += "</tr>";
                            }
                        }
                        result += "</table>";
                    }
                }
                res.innerHTML = result;
            }
        }

        function get3(){
            ajax.open("GET","query3.php");
            ajax.onreadystatechange = update3;
            ajax.send();
        }

        function update3(){
            if(ajax.readyState === 4){
                var body3 = document.getElementById("body3");
                //var formatedResult = "";
                if(ajax.status === 200){
                    let result = JSON.parse(ajax.responseText);
                    //formatedResult += "<table width=\"100%\" border=\"1\" id=\"body31\">\n";
                    //formatedResult += "<tr><th>ID_CLIENT</th><th>NAME</th><th>IP</th><th>BALANCE</th></tr>"

                    var columns = [];

                    for(var i = 0; i < result.length; i++){
                        for(var key in result[i]){
                            if(columns.indexOf(key) === -1){
                                columns.push(key);
                            }
                        }
                    }

                    var table = document.createElement("table");
                    table.style.width = '100%';
                    table.setAttribute('border', '1');
                    var tr = table.insertRow(-1);
                    for(var i = 0; i < columns.length; i++){
                        var thead = document.createElement("th");
                        thead.innerHTML = columns[i];
                        tr.appendChild(thead);
                    }
                    for(var i = 0; i < result.length; i++){
                        var trow = table.insertRow(-1);
                        for(var j = 0; j < columns.length; j++){
                            var cell = trow.insertCell(-1);
                            cell.innerHTML = result[i][columns[j]];
                        }
                    }
                    var body3 = document.getElementById("body3");
                    body3.innerHTML = "";
                    body3.appendChild(table);
                    //formatedResult += "</table>";
                }
                //body3.innerHTML = formatedResult;
            }
        }

    </script>
</head>
<body>
    <h3>First task. Статистика работы в сети выбранного клиента.</h3>
    <label for="clients">Выберите пользователя:</label>
    <select name='clients' id="clients">
        <?php
            require_once("connect.php");
            $sqlClients = "SELECT `name` FROM `client`";
            foreach($dbh->query($sqlClients) as $row)
            {
                 echo "<option value=$row[0]>$row[0]</option>";
            }
        ?>
    </select>
    <input type="button" value="Просмотреть статистику" onclick="get1()">
    <div id="body1"></div>

    <h3>Second task. Cтатистика работы в сети за указанный промежуток времени.</h3>
    <h4>Укажите начало и конец сессии для получения данных (выбор данных доступен только из перечня существующих):</h4>
    <label for = "s_start">Начало сессии:</label>
    <select name = "s_start" id="s_start">
        <?php
            require_once("connect.php");
            $sqlSStart = "SELECT SEANSE.START FROM SEANSE";
            foreach($dbh->query($sqlSStart) as $row){
                echo "<option value=$row[0]>$row[0]</option>";
            }
        ?>
    </select>
    <label for = "s_stop">Конец сессии:</label>
    <select name = "s_stop" id="s_stop">
        <?php
            require_once("connect.php");
            $sqlSStop = "SELECT SEANSE.STOP FROM SEANSE";
            foreach($dbh->query($sqlSStop) as $row){
                echo "<option value=$row[0]>$row[0]</option>";
            }
        ?>
    </select>
    <input type="button" value="Просмотреть статистику" onclick="get2()">
    <div id="body2"></div>

    <h3>Second task. Вывести список клиентов с отрицательным балансом счета.</h3>
    <input type="button" value="Вывести!" onclick="get3()">
    <div id="body3" width="100%"></div>

</body>
</html>