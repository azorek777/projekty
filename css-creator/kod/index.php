<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Sono:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="script.js"></script>

</head>
<body>

    <h1>Podgląd: </h1>
    <div class="podglad😎">
        <style id="🖼️">
            .🖼️{
                height: 350px;
                width: 70%;
                margin: auto;
                margin-top: 1rem;
                margin-bottom: 1rem;
                text-align: center;
                color: white;
                background-color: rgb(30, 134, 204);
                aspect-ratio: 16 / 9;
            }
        </style>
        <div class="🖼️">
            <div id="0️⃣">Nazwa...</div>
        </div>
        <div class="🌈" id="🌈"> 
            <div id="1️⃣">background-color: blue;</div>
            <div id="2️⃣">border-radius: dsaoidas;</div>
            <div id="3️⃣">border-width: 12px;</div>
            <div id="4️⃣">border-color: red;</div>
            <div id="5️⃣">border-type: dotted;</div>
            <div id="6️⃣">box-shadow: 0px 0px 0px black;</div>
            <div id="7️⃣">color: black;</div>
            <div id="8️⃣">font-family: Arial;</div>
            <div id="9️⃣">font-size: 12px;</div>
            <div id="1️⃣0️⃣">text-align: left;</div>
            <div id="1️⃣1️⃣">text-shadow: 0px 0px 0px black;</div>
        </div> 

    </div>


    <div class="🤯">

    <form method="post" action="zapisywanie.php" class="formularz">
        <h2>Edytor </h2>
        <div class="📂"> Ogólne </div>
        <div>Nazwa: </div>
        <input type="text" onkeyup="changetext(); changecss();" placeholder="Nazwa..." name="tekst" id="tekst">
        <br> 
        <div>Kolor: </div> 
        <input type="color" oninput="changeboxcolor(); changecss();" name="color" id="boxcolor" value="#1e86cc"> 
        <br>
        <div class="📂"> Obramowanie </div>
		<br> 
        <div>Zaokrąglenie: </div>
        <input type="range" oninput="changeradius(); changecss();" value=0 min="0" max="100" name="zaokraglenie" id="zaokraglenie">
        <div>Grubość: </div>
        <input type="range" oninput="changeborderwidth(); changecss();" value=0  min="0" max="100" name="grubosc" id="grubosc">
        <br> 
        <div>Kolor: </div>
        <input type="color" oninput="changebordercolor(); changecss();" name="bordercolor" id="bordercolor" value="#ecfc3d"> 
        <br> 
        <div>Typ: </div>
        <select id="bordertype" name="bordertype" onchange="changebordertype(); changecss();">
            <option value="dotted">Kropkowane </option>
            <option value="dashed">Przerywane </option>
            <option value="solid">Ciągłe </option>
            <option value="double">Podwójne </option>
            <option value="groove">3D </option>
            <option value="none">Brak </option>
        </select>
		<br>
        <div>Cień (lewo-prawo)</div>
        <input type="range" oninput="changeboxshadow(); changecss();" value=0 min="-100" max="100" name="boxshadowx" id="boxshadowx">
        <br>
        <div>Cień (góra-dół)</div>
        <input type="range" oninput="changeboxshadow(); changecss();" value=0 min="-100" max="100" name="boxshadowy" id="boxshadowy">
        <br>
        <div>Cień (rozmycie)</div>
        <input type="range" oninput="changeboxshadow(); changecss();" value=0 min="0" max="50" name="boxshadowblur" id="boxshadowblur">
		<br>
        <div>Cień (kolor)</div>
        <input type="color" oninput="changeboxshadow(); changecss();" name="boxshadowcolor" id="boxshadowcolor" value="#ecfc3d"> 

        <!-- box shadow 0rem 0rem 1rem 1rem #AAAAAA -->
        <br>
        <div class="📂">Tekst </div>
        <br>
        <div>Kolor </div>
        <input type="color" name="textcolor" oninput="changetextcolor(); changecss();" id="textcolor" value="#ffffff"> 
        <br>
        <div>Nazwa czcionki </div>
        <select name="fontname" id="fontname" onchange="changefontname(); changecss();">
            <option value="Arial">Arial </option>
            <option value="Lucida Sans">Lucida Sans </option>
            <option value="Rockwell">Rockwell </option>
            <option value="Consolas">Consolas </option>
            <option value="Lucida Console">Lucida Console </option>
            <option value="Comic Sans MS">Comic Sans MS </option>
            <option value="Brush Script MT">Brush Script MT </option>
            <option value="Impact">Impact </option>
        </select>
        <br>
        <div>Wielkość czcionki </div>
        <input id="fontsize" name="fontsize" type="number" oninput="changefontsize(); changecss();" min="0" max="50" value="15">
        <br>
        <div>Położenie tekstu</div>
        <select id="textalign" name="textalign" onchange="changetextalign(); changecss();" >
            <option value="center">Środek </option> 
            <option value="left">Lewo </option>
            <option value="right">Prawo </option>
        </select>
        <br>
        <div class="📂">Cień tekstu</div>
        <div>Kolor</div>
        <div>Cień (lewo-prawo)</div>
        <input type="range" oninput="changetextshadow(); changecss();" value=0 min="-100" max="100" name="textshadowx" id="textshadowx">
        <br>
        <div>Cień (góra-dół)</div>
        <input type="range" oninput="changetextshadow(); changecss();" value=0 min="-100" max="100" name="textshadowy" id="textshadowy">
        <br>
        <div>Cień (rozmycie)</div>
        <input type="range" oninput="changetextshadow(); changecss();" value=0 min="0" max="50" name="textshadowblur" id="textshadowblur">
		<br>
        <div>Cień (kolor)</div>
        <input type="color" oninput="changetextshadow(); changecss();" name="textshadowcolor" id="textshadowcolor" value="#ecfc3d"> 
        <br>
        <input type="submit" value="Zapisz">
    </form>
        <br>
        <a href="index.php"><button>Resetuj🗑️</button></a>
    </div>

    
<?php 
error_reporting(0);
ini_set('display_errors', 0);
$newcss = $_GET['css'];
$text1 = '<script>';
$text2 = '.🖼️{';
$text3 = $text2 . $newcss;

$text4 = $text3 . '}";';
$text5 = 'let finishcss = "';
$text6 = "document.getElementById('🖼️').innerHTML = finishcss;";
$text7 = '</script>';
$text8 = $text1 . $text5 . $text4 . $text6 . $text7;
echo($text8);

$check = "<script>let zmienna = document.getElementById('🖼️');console.log(zmienna);</script>";
echo($check);



?>



</body>
</html>