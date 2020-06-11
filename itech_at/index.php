<!DOCTYPE html>
<html>
<head>
    <title>Task : WG API</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="style/tank.png">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script>
        const ajax = new XMLHttpRequest();

        function getInfo(){
            var inputted = document.getElementById('nickname').value;
            const regex = /^\w{3,24}$/gm ;
            if(!inputted.match(regex)){
                alert("Nick-name должен иметь от 3 до 24 символов. Допустимыми символами являются любые символы латинского алфавита и знак подчеркивания.")
            }
            else{
                var XHR = ("onload" in new XMLHttpRequest()) ? XMLHttpRequest : XDomainRequest;
                var xhr = new XHR();
                xhr.open('GET','https://api.worldoftanks.ru/wot/account/list/?application_id=b427b58683159bc5f29fc51aee206c4b&limit=1&type=startswith&fields=account_id&language=ru&search=' + inputted,true);
                xhr.onload = function(){
                    var result = this.responseText;
                    alert(result);
                }
                xhr.onerror = function(){
                    alert('Ошибка' + this.status)
                }
                xhr.send();
                
            }
        }

        function get1(){
            let nickname = document.getElementById('nickname').value;
            //alert(nickname);
            const regex = /^\w{3,24}$/gm ;
            if(!nickname.match(regex)){
                alert("Nick-name должен иметь от 3 до 24 символов. Допустимыми символами являются любые символы латинского алфавита и знак подчеркивания.");
            }
            else{
                ajax.open('GET',"exec.php?nickname=" + nickname);
                ajax.onreadystatechange = update1;
                ajax.send();
            }
            
        }

        function update1(){
            if(ajax.readyState === 4){
                if(ajax.status === 200){
                    document.getElementById('result').innerHTML = ajax.responseText;
                }
            }
        }

        function clearPage(){
            document.getElementById('result').innerHTML = "";
            document.getElementById('nickname').value = "";
        }
    </script>
</head>
<body>
    <h3>Вывести информацию о игроке World of Tanks</h3>

    <label for="nickname">Введите nick-name игрока:</label>
    <input type="text" name="nickname" id="nickname">
    <input type="button" value="Вывести статистику" onclick="get1()">
    <input type="button" value="Очистить страницу" onclick="clearPage()"> 
        
    <div id="result"></div><br> 
    
</body>
</html>