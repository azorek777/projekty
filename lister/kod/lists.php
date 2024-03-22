<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/header_icon.svg">
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
    <title>Lister - Listy</title>
</head>
<?php
    // pobieranie list do js
    require 'vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
    $okladki = $client->listy->publiczne;
    $datadump = $okladki->find();
    $array = iterator_to_array($datadump);

    echo "<script>const cache = [];</script>";
    $count = 0;

    foreach ($array as $value){
        echo '<script>cache[' . $count . ']="' . $value["nazwa"] . '";</script>';
        $count += 1;
    }

    // wyszukiwarka
    echo "<script>
    function szukaj() {
        let query = document.getElementById('search').value;
        document.getElementById('zabawa').innerHTML = '';
        document.getElementById('searchfield').style.display = 'block';
        console.clear();
        // Przechodzimy przez wszystkie elementy tablicy
        if (query.length>0) {
        for (let i = 0; i < cache.length; i++) {
        // Sprawdzamy, czy aktualny element zaczyna się od ciągu znaków zapytania
        if (cache[i].startsWith(query)) {
            // Jeśli tak, wyświetlamy go w konsoli
            console.log(cache[i]);
            // document.getElementById('zabawa').innerHTML += cache[i];
    
            const text = document.createElement('div');
            text.innerText = cache[i];
            text.style.cursor = 'pointer'
            text.onclick = () => {
                 document.getElementById('search').value = cache[i];
            }
            document.getElementById('zabawa').appendChild(text);
        }
        }
        }
    }
    </script>
    ";
?>  
<body onload="changeNav(), accountHref()">
    <header>
        <a href="index.php"><img src="img/logo.svg" alt="logo" class="logo"></a>
        <nav>
            <a id="accountNav" href="account.php">ACCOUNT: <span id="accountNavName" class="list_title"></span></a>
            <a id="loginNav" href="login.php">SIGN IN</a>
            <a id="registerNav" href="register.php">CREATE ACCOUNT</a>
            <a id="listsNav" href="lists.php">LISTS</a>
            <a id="membersNav" href="members.php">MEMBERS</a>
            <a id="createListNav" href="createlist.php">CREATE LIST</a>
            <a id="addDataNav" href="createcontent.php">ADD DATA</a>
            <a id="logoutNav" href="" onclick="logout()">LOG OUT</a>
        </nav>
        <fieldset>
            <form method="POST" action="searchengine.php">
                <input type="search" autocomplete="off" class="search" name="search" id="search" onkeyup="szukaj()">
                <input type="submit" class="searchAction" value="" fill="none">
            </form>
            <div id="searchfield">
                <div id="zabawa" class="wynikiwyszukiwania"></div>
            </div>
        </fieldset>
    </header>
    <main class="list_main">
        <hr><p id="accountListsRef">Szukasz swoich list? <a href="account.php">Są tutaj!</a></p><hr>
        <h3 style="display:flex;justify-content: center;">Filtruj według kategorii</h3>
        <form name="kategorie" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="sex" style="display:flex;justify-content: center;">
        <!-- Przyciski do sortowania -->
            <label>Książki</label><input type="radio" name="category" value="ksiazki" onclick="kategoria(this);">
            <label>Filmy</label><input type="radio" name="category" value="filmy" onclick="kategoria(this);">
        </div>
        <!-- Przycisk resetuj do usunięcia filtrowania i zastosuj -->
        <div class="przyciski_filtr" style="display:flex;justify-content:center;">
            <input id="reset_filtr" type="button" value="reset" onclick="obydwie();kategoria(this);">
            <input id="submit_filtr" type="submit" onclick="window.location.href='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'" value="zastosuj">
        </div>
        </form>
        <br><hr>

        <script>
            let wybranakategoria = 'reset';
            function kategoria(mojakategoria){
                wybranakategoria = mojakategoria.value;
                console.log(wybranakategoria);
                // zapisanie w cookie żeby wyciagnac w php 
                document.cookie="kategoria=" + wybranakategoria;
            }

            // funkcja do czyszczenia inputow typu radio
            function clear(){
                let radio = document.getElementsByName('category');
                
                for (let i = 0; i < radio.length; i++) {
                    radio[i].checked = false;
                }
            }

            // clear w innej funkcji, gdyż normalnie wywołanie clear() nie działało
            function obydwie(){
                clear();
            }

        </script>

        <?php

            // jeżeli nie ma cookie (nowa sesja) wyświetla wszystko
            function myErrorHandler($errno, $errstr, $errfile, $errline) {
                //wyswietlanie publicznych list
                require 'vendor/autoload.php';
                $client = new MongoDB\Client(
                    'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
                $collection = $client->listy->publiczne;
                $datadump = $collection->find();
                // $ilosc = count($datadump->toArray());
                $baza = $collection->find();
                $array = iterator_to_array($baza);
                
                //wypisanie list wg ich nazwy 
                foreach ($array as $value){
                    echo "<h1>Tytuł: <span class='list_title'>" . $value['nazwa'] . "</span></h1>";
                    echo "<div class='list_notes'><h4>Kategoria: <span class='list_title'>" . $value['kategoria'] . "</span></h4>";
                    echo "<h4>Autor: <span class='list_title'>" . $value['autor'] . "</span></h4></div>";
                    echo "<div id='".$value['_id']."' class='display'>";
                    $tresc = $value['tresc'];
                    $splittresc = explode(",",$tresc);
                    foreach ($splittresc as $things){
                        $okladka = $client->listy->okladki;
                        $tytul = $okladka->findOne(array('nazwa' => $things));
                        echo '<img src="' . $tytul['img'] . '" />';
                    }
                    echo "</div><hr>";
                }
            }
            set_error_handler('myErrorHandler', E_WARNING);

            //sprawdzenie kategorii
            $kategoria = $_COOKIE['kategoria'];

             // jeżeli wybrany jest brak kategorii
            if ($kategoria == "reset"){
                //wyswietlanie publicznych list
                require 'vendor/autoload.php';
                $client = new MongoDB\Client(
                    'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
                $collection = $client->listy->publiczne;
                $datadump = $collection->find();
                $baza = $collection->find();
                $array = iterator_to_array($baza);
                
                //wypisanie list wg ich nazwy 
                foreach ($array as $value){
                    echo "<h1>Tytuł: <span class='list_title'>" . $value['nazwa'] . "</span></h1>";
                    echo "<div class='list_notes'><h4>Kategoria: <span class='list_title'>" . $value['kategoria'] . "</span></h4>";
                    echo "<h4>Autor: <span class='list_title'>" . $value['autor'] . "</span></h4></div>";
                    echo "<div id='".$value['_id']."' class='display'>";
                    $tresc = $value['tresc'];
                    $splittresc = explode(",",$tresc);
                    foreach ($splittresc as $things){
                        $okladka = $client->listy->okladki;
                        $tytul = $okladka->findOne(array('nazwa' => $things));
                        echo '<img src="' . $tytul['img'] . '" />';
                    }
                    echo "</div><hr>";
                }
            }
            // wyświetlenie samych książek
            elseif($kategoria == "ksiazki"){
                require 'vendor/autoload.php';
                $client = new MongoDB\Client(
                    'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
                $collection = $client->listy->publiczne;

                // szukanie według kryteriów
                $criteria = [
                    'kategoria' => 'ksiazki',
                ];
                
                // sortowanie od najnowszego 
                $options = [
                    'sort' => ['_id' => -1],
                ];

                $result = $collection->find($criteria, $options);
                foreach ($result as $value) {
                    echo "<h1>Tytuł: <span class='list_title'>" . $value['nazwa'] . "</span></h1>";
                    echo "<div class='list_notes'><h4>Kategoria: <span class='list_title'>" . $value['kategoria'] . "</span></h4>";
                    echo "<h4>Autor: <span class='list_title'>" . $value['autor'] . "</span></h4></div>";
                    echo "<div id='".$value['_id']."' class='display'>";
                    $tresc = $value['tresc'];
                    $splittresc = explode(",",$tresc);
                    foreach ($splittresc as $things){
                        $okladka = $client->listy->okladki;
                        $tytul = $okladka->findOne(array('nazwa' => $things));
                        echo '<img src="' . $tytul['img'] . '" />';
                    }
                    echo "</div><hr>";
                }
            }
            // wyświetlenie samych filmów
            elseif($kategoria == "filmy"){
                require 'vendor/autoload.php';
                $client = new MongoDB\Client(
                    'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
                $collection = $client->listy->publiczne;

                // szukanie według kryteriów
                $criteria = [
                    'kategoria' => 'filmy',
                ];
                
                // sortowanie od najnowszego 
                $options = [
                    'sort' => ['_id' => -1],
                ];

                $result = $collection->find($criteria, $options);
                foreach ($result as $value) {
                    echo "<h1>Tytuł: <span class='list_title'>" . $value['nazwa'] . "</span></h1>";
                    echo "<div class='list_notes'><h4>Kategoria: <span class='list_title'>" . $value['kategoria'] . "</span></h4>";
                    echo "<h4>Autor: <span class='list_title'>" . $value['autor'] . "</span></h4></div>";
                    echo "<div id='".$value['_id']."' class='display'>";
                    $tresc = $value['tresc'];
                    $splittresc = explode(",",$tresc);
                    foreach ($splittresc as $things){
                        $okladka = $client->listy->okladki;
                        $tytul = $okladka->findOne(array('nazwa' => $things));
                        echo '<img src="' . $tytul['img'] . '" />';
                    }
                    echo "</div><hr>";
                }
                
            }

        ?>
    </main>
    <footer>
        <div class="footer_content">
            <nav class="footer_nav">
                <a id="accountNavBottom" href="account.php">Account: <span id="accountNavNameBottom" class="list_title"></span></a>
                <a id="loginNavBottom" href="login.php">Sign In</a>
                <a id="registerNavBottom" href="register.php">Create Account</a>
                <a id="listsNavBottom" href="lists.php">Lists</a>
                <a id="createListNavBottom" href="createlist.php">Create List</a>
                <a id="membersNavBottom" href="members.php">Members</a>
                <a id="addDataNavBottom" href="createcontent.php">Add Data</a>
                <a id="logoutNavBottom" href="" onclick="logout()">Log out</a>
            </nav>
            <aside>
                <div class="logos">
                    <a href="https://www.facebook.com/"><img src="img/facebook.svg" alt="social media icon"></a>
                    <a href="https://www.instagram.com/"><img src="img/instagram.svg" alt="social media icon"></a>
                    <a href="https://www.tiktok.com/"><img src="img/tiktok.svg" alt="social media icon"></a>
                    <a href="https://twitter.com/"><img src="img/twitter.svg" alt="social media icon"></a>
                    <a href="https://www.youtube.com/"><img src="img/youtube.svg" alt="social media icon"></a>
                </div>
            </aside><br>
            <p>&copy Lister 2022. Mobile app coming soon.</p>
        </div>
    </footer>
</body>
</html>
