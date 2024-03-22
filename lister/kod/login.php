<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/header_icon.svg">
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
    <title>Lister - Logowanie</title>
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
<body onload="checkStatus()">
    <header>
        <a href="index.php"><img src="img/logo.svg" alt="logo" class="logo"></a>
        <nav>
            <a href="#" class="chosen">SIGN IN</a>
            <a href="register.php">CREATE ACCOUNT</a>
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
        <article class="login_article">
        <h1>Logowanie</h1>
        <form method="post" action="">
            <h3>Login:</h3>
            <input type="text" name="login" required>
            <h3>Hasło:</h3> 
            <input type="password" name="password" required><br>
            <button type="submit" name="submit">Zaloguj się!</button>
            <p>Nie masz jeszcze konta? <a href="register.php">Zarejestruj się!</a></p>
        </form>
        <h2 id="loginOutput"></h2>
        </article>
    </main>
    <footer>
        <div class="footer_content">
            <nav class="footer_nav">
                <a href="#" class="chosen">Sign In</a>
                <a href="register.php">Create Account</a>
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

<?php
    // jeżeli zostal wciśnięty napis zastosuj
    if (isset($_POST['submit'])) {
        require 'vendor/autoload.php';
        $client = new MongoDB\Client('mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
        $login = $_POST['login'];
        $haslo = $_POST['password'];
        $logindb = $client->użytkownicy->konto;
        $datadump = $logindb->findOne(array('login' => $login));

        // $datadump zwraca NULL gdy nie znajdzie loginu 
        if ($datadump != NULL){
            $haslozbazy = $datadump['haslo'];
            //porównywanie haseł
            if (password_verify($haslo, $haslozbazy)) { ?>
                <script>
                    let date = new Date();
                    const login = "<?php echo $login; ?>";
                    date.setTime(date.getTime() + (60 * 60 * 1000));
                    let expirationDate = 'expires=' + date.toUTCString();
                    document.cookie = 'sesja=true;' + expirationDate + ';';
                    document.cookie = 'login=' + login + ';' + expirationDate + ';';
                </script>
                    <?php header("Refresh:0; url=index.html");
            } else {
                echo "<script>
                    document.getElementById('loginOutput').innerHTML = 'Niepoprawne hasło!';
                    </script>";
            }
        } else{
            echo "<script>
                    document.getElementById('loginOutput').innerHTML = 'Podany użytkownik nie istnieje!';
                    </script>";
        }
    }
?>