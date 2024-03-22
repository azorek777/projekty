<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/header_icon.svg">
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
    <title>Lister - Konto</title>
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
<body onload="changeNav(), checkStatusRev()">
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
    <main>
    <?php
        // połączenie sie z bazą
        require 'vendor/autoload.php';
                $client = new MongoDB\Client(
                    'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
                $collection = $client->użytkownicy->konto;

                // pobranie loginu użytkownika
                $user = $_COOKIE["login"];
                echo "<h1>Cześć, <span class='list_title'>" . ($user) . "</span>!</h1><hr>";

                // szukanie danych osoby po jej loginie
                $result = $collection->findOne(array('login' => $user));
                
                $avatarnumber = $result['avatar'];

                // wyświetlenie odpowiedniego avataru
                switch ($avatarnumber){
                    case 1:
                        echo '<img class="avatar" src="img/avatar1.png">';
                        break;
                    case 2:
                        echo '<img class="avatar" src="img/avatar2.png">';
                        break;
                    case 3:
                        echo '<img class="avatar" src="img/avatar3.png">';
                        break;
                    case 4:
                        echo '<img class="avatar" src="img/avatar4.png">';
                        break;
                    case 5:
                        echo '<img class="avatar" src="img/avatar5.png">';
                        break;
                    case 6:
                        echo '<img class="avatar" src="img/avatar6.png">';
                        break;
                }

                // wyświetlanie pozostałych informacji
                echo "<div class='content'>";
                echo "<h4>Login: <span class='list_title'>" . $result['login'] . "</span></h4>";
                echo "<h4>Nazwisko: <span class='list_title'>" . $result['nazwisko'] . "</span></h4>";
                echo "<h4>Płeć: <span class='list_title'>" . $result['plec'] . "</span></h4>";
                echo "<h4>Data Urodzenia: <span class='list_title'>" . $result['data urodzenia'] . "</span></h4>";
                echo "<h4>E-mail: <span class='list_title'>" . $result['e-mail'] . "</span></h4></div><hr>";
    ?>
    <h1>Twoje listy publiczne:</h1><hr>
    <main class="list_main">
        <?php
            require 'vendor/autoload.php';
            $client = new MongoDB\Client(
            'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
            $publiczne = $client->listy->publiczne;
            $prywatne = $client->listy->prywatne;
            $konto = $client->użytkownicy->konto;

            // wyciagniecie id uzytkownika
            $login = $_COOKIE["login"];
            $result = $konto->findOne(array('login' => $login));
            $id = $result['_id'];
            echo "<br>";

            // sortowanie od najnowszego 
            $options = [
                'sort' => ['_id' => -1],
            ];

            // kryteria: listy tylko tego użytkownika
            $criteria = [
                'autor' => $login,
            ];

            $listypubliczne = $publiczne->find($criteria, $options);

            // wyświetl każdą listę publiczną spełniającą warunki
            foreach($listypubliczne as $publiczne){
                echo "<h1>Tytuł: <span class='list_title'>" . $publiczne['nazwa'] . "</span></h1>";
                echo "<div class='list_notes'><h4>Kategoria: <span class='list_title'>" . $publiczne['kategoria'] . "</span></h4>";
                echo "<h4>Autor: <span class='list_title'>" . $publiczne['autor'] . "</span></h4></div>";
                echo "<div id='".$publiczne['_id']."' class='display'>";
                $tresc = $publiczne['tresc'];
                $splittresc = explode(",",$tresc);
                foreach ($splittresc as $things){
                    $okladka = $client->listy->okladki;
                    $tytul = $okladka->findOne(array('nazwa' => $things));
                    echo '<img src="' . $tytul['img'] . '" />';
                }
                echo "</div><hr>";
            }


            echo "<hr><h1>Twoje listy prywatne:</h1><hr>";

            $listyprywatne = $prywatne->find($criteria, $options);

            // wyświetl każdą listę prywatną spełniającą warunki
            foreach($listyprywatne as $prywatne){
                echo "<h1>Tytuł: <span class='list_title'>" . $prywatne['nazwa'] . "</span></h1>";
                echo "<div class='list_notes'><h4>Kategoria: <span class='list_title'>" . $prywatne['kategoria'] . "</span></h4>";
                echo "<h4>Autor: <span class='list_title'>" . $prywatne['autor'] . "</span></h4></div>";
                echo "<div id='".$prywatne['_id']."' class='display'>";
                $tresc = $prywatne['tresc'];
                $splittresc = explode(",",$tresc);
                foreach ($splittresc as $things){
                    $okladka = $client->listy->okladki;
                    $tytul = $okladka->findOne(array('nazwa' => $things));
                    echo '<img src="' . $tytul['img'] . '" />';
                }
                echo "</div><hr>";
            }

        ?>
    </main>


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