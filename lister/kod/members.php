<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/header_icon.svg">
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
    <title>Lister - Użytkownicy</title>
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
<body onload="changeNav()">
    <header>
        <a href="index.php"><img src="img/logo.svg" alt="logo" class="logo"></a>
        <nav>
            <a href="login.php">SIGN IN</a>
            <a href="#" class="chosen">CREATE ACCOUNT</a>
            <a href="lists.php">LISTS</a>
            <a href="members.php">MEMBERS</a>
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
        <hr>
    <?php
        require 'vendor/autoload.php';
                $client = new MongoDB\Client(
                    'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
                $collection = $client->użytkownicy->konto;

                // szukanie według kryteriów
                $criteria = [
                ];
                
                // sortowanie od najnowszego 
                $options = [
                    'sort' => ['_id' => -1],
                    // 'limit' => 1,
                ];

                // definiowanie pustej tablicy
                $users = array();


                $result = $collection->find($criteria, $options);
                foreach ($result as $value) {
                    // pobieranie użytkowników
                    array_push($users, $value['login']);

                    // sprawdzanie avatarow
                    $avatarnumber = $value['avatar'];

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
                    echo "<div class='content'>";
                    echo "<h4>Użytkownik: <span class='list_title'>" . $value['login'] . "</span></h4>";
                    
  
                    // liczenie liczby list opublikowanych przez użytkownika
                    $userpubliczne = $client->listy->publiczne;
                    $userprywatne = $client->listy->prywatne;
                    
                    // dla każdego użytkownika ustawia kryteria wyszukiwania
                    foreach($users as $eachuser){
                        $criteria2 = [
                            "autor" => $eachuser
                        ];

                        $licz = 0;

                        // liczenie liczby list użytkownika w listach publicznych
                        $listypubliczne = $userpubliczne->find($criteria2);
                        foreach($listypubliczne as $niewiem){
                            if($niewiem['nazwa']!==NULL){
                                $licz += 1;
                            }
                        }
                        // liczenie liczby list użytkownika w listach prywatnych
                        $listyprywatne = $userprywatne->find($criteria2);
                        foreach($listyprywatne as $niewiem2){
                            if($niewiem2['nazwa']!==NULL){
                            $licz += 1;
                            }
                    }
                    }

                    // sprawdzanie wieku użytkownika
                    $dzisiaj = date("Y-m-d");
                    $dataurodzenia = new DateTime($value['data urodzenia']);
                    $dzisiaj = new DateTime("$dzisiaj");
                    $roznica = date_diff($dataurodzenia, $dzisiaj);
                    $wiek = $roznica->format("%Y");

                    // usuwanie pierwszego zera
                    if (strpos($wiek, "0") === 0) {
                        $wiek = substr($wiek, 1);
                      }


                    // wyświetlenie wyników
                    echo "<h4>Płeć: <span class='list_title'>" . $value['plec'] . "</span></h4>";
                    echo "<h4>Liczba opublikowanych list: <span class='list_title'>" . $licz . "</span></h4>";
                    echo "<h4>Wiek: <span class='list_title'>" . $wiek . "</span> lat</h4>";
                    echo "<h4>    </h4>";
                    echo "<br>";
                    echo "<br>";
                    echo "</div><hr>";
                }

                    
    ?>
    </main>
    <footer>
        <div class="footer_content">
            <nav class="footer_nav">
                <a href="login.php">Sign In</a>
                <a href="#" class="chosen">Create Account</a>
                <a href="lists.php">Lists</a>
                <a href="members.php">Members</a>
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