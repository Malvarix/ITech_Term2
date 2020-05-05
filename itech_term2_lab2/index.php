<!DOCTYPE html>
<html>
<head>
    <title>ITech_Term2_Lab2</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="style/code.ico">
    <script>
        const ajax = new XMLHttpRequest();

        function get1(){
            let publishers =  document.getElementById("publishers").value;
            if(localStorage[publishers] !== undefined){
                document.getElementById('body11').innerHTML = localStorage[publishers];
            }
            ajax.open("GET","query1.php?publishers=" + publishers);
            ajax.onreadystatechange = update1;
            ajax.send();
        }

        function update1(){
            if(ajax.readyState === 4){
                if(ajax.status === 200){
                    let publishers =  document.getElementById("publishers").value;
                    localStorage[publishers] = ajax.responseText;
                    document.getElementById('body1').innerHTML = ajax.responseText;
                }
            }
        }

        function get2(){
            let y_start = document.getElementById('y_start').value;
            let y_end = document.getElementById('y_end').value;
            if(localStorage[y_start,y_end] !== undefined){
                document.getElementById('body21').innerHTML = localStorage[y_start,y_end];
            }
            ajax.open("GET","query2.php?y_start=" + y_start + "&y_end=" + y_end);
            ajax.onreadystatechange = update2;
            ajax.send();
        }

        function update2(){
            if(ajax.readyState === 4){
                //var body2 = document.getElementById("body2");
                if(ajax.status === 200){
                    let y_start = document.getElementById('y_start').value;
                    let y_end = document.getElementById('y_end').value;
                    localStorage[y_start,y_end] = ajax.responseText;
                    document.getElementById('body2').innerHTML = ajax.response;
                    /*var result = JSON.parse(ajax.response);
                    //var res = "";
                    for(key in result){
                        var ul = document.createElement('ul');
                        //for(key2 in result[key]){
                        for(key2 in result[key]){
                            var li = document.createElement('li');
                            li.innerHTML += result[key][key2];
                            ul.appendChild(li);
                
                        }
                        //document.body.appendChild(ul);
                        body2.innerHTML += "";
                        body2.appendChild(ul);
                        localStorage[y_start,y_end] = body2.appendChild(ul);
                        //document.body.appendChild(document.createElement("br"));
                    }*/
                    
                    /*for(var key in result['items']){
                        res += "<ul><li>Item : " + $(key) + "</li></ul>";
                    }*/
                    /*for(int i = 0; i < result.length; i++){
                        $.each(result[i],function(index, item){
                            res += "<ul>" + item.
                        })*/
                    /*result.forEach(function(i) {
                        console.log(Object.keys(i));
                    });*/
                    //body2.innerHTML = res;
                }
            }
        }
        

        function get3(){
            let author = document.getElementById('author').value;
            if(localStorage[author] !== undefined){
                document.getElementById('body31').innerHTML = localStorage[author];
            }
            ajax.open("GET","query3.php?author=" + author);
            ajax.onreadystatechange = update3;
            ajax.send();
        }

        function update3(){
            if(ajax.readyState === 4){
                var body3 = document.getElementById("body3");
                if(ajax.status === 200){
                    let author = document.getElementById('author').value;
                    localStorage[author] = ajax.responseText;
                    document.getElementById("body3").innerHTML = ajax.response;
                }
            }
        }

    </script>
</head>
<body>
    <h3>First task. Информация о литературе выбранного издательства.</h3>
    <label for="publishers">Выберите издетельство:</label>
    <select name="publishers" id="publishers">
        <?php
            require_once("connect.php");
            $cursor = $collection -> distinct('publisherName');//find([],['projection'=>['publisherName'=>1, '_id'=>0]]).distinct() ;
            print_r($cursor);
            foreach($cursor as $row)
            {
                print "<option value='$row'>$row</option>";
            }   
        ?>
    </select>
    <input type="button" value="Вывести нформацию" onclick="get1()">
    <div id="body1"></div>
    <p>Ранее сохранённые данные по данному запросу:<p>
    <div id="body11"></div>

    <h3>Second task. Информация о литературе за указанный промежуток времени.</h3>
    <h4>Укажите начальный и конечный год для поиска литературы (выбор доступен только из определённого перечня дат, присущих имеющейся литературе):</h4>
    <label for = "y_start">Вывести литературу в промежутке с </label>
    <select name = "y_start" id="y_start">
    <?php
            require_once("connect.php");
            $cursor = $collection -> distinct('date');
            foreach($cursor as $row)
            {
                $date = $row->toDateTime()->format("Y");
                print "<option value='$date'>$date</option>";
            }   
        ?>
    </select>
    <label for = "y_end"> по </label>
    <select name = "y_end" id="y_end">
    <?php
            require_once("connect.php");
            $cursor = $collection -> distinct('date');
            foreach($cursor as $row)
            {
                $date = $row->toDateTime()->format("Y");
                print "<option value='$date'>$date</option>";
            }   
        ?>
    </select>
    <input type="button" value="Вывести информацию" onclick="get2()">
    <div id="body2"></div>
    <p>Ранее сохранённые данные по данному запросу:<p>
    <div id="body21"></div>

    <h3>Third task. Информация о литературе за указанный автора.</h3>
    <label for = "author">Вывести литературу такого автора как: </label>
    <select name = "author" id="author">
    <?php
            require_once("connect.php");
            $cursor = $collection -> distinct('author');
            foreach($cursor as $row)
            {
                print "<option value='$row'>$row</option>";
            }   
        ?>
    </select>
    <input type="button" value="Вывести информацию" onclick="get3()">
    <div id="body3"></div>
    <p>Ранее сохранённые данные по данному запросу:<p>
    <div id="body31"></div>
</body>
</html>