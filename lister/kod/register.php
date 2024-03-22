<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/header_icon.svg">
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
    <title>Lister - Rejestracja</title>
    <script> 
        function checkPassword(form){
            password1 = form.password.value;
            password2 = form.password_repeat.value;

            if (password1 != password2) {
                alert ("\nHasła się różnią!");
                return false;
            }
        }
    </script>
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
        <article class="login_article">
            <h1>Rejestracja</h1>
            <!-- Formularz rejestracji -->
            <form method="post" action="addUser.php" onSubmit="return checkPassword(this)" >
                <h3>Login:</h3>
                <input type="text" name="login" required >
                <h3>Hasło:</h3> 
                <input type="password" name="password" required>
                <h3>Powtórz hasło:</h3> 
                <input type="password" name="password_repeat" required>
                <h3>Imię:</h3>
                <input type="text" name="name" required>
                <h3>Nazwisko:</h3> 
                <input type="text" name="surname" required>
                <h3>Data urodzenia:</h3>   
                <input type="date" name="date" required>
                <h3>Płeć:</h3>
                <div class="sex">
                    <label>Mężczyzna</label><input type="radio" name="sex" value="mezczyzna" required>
                    <label>Kobieta</label><input type="radio" name="sex" value="kobieta" required>
                </div>
                <h3>E-mail:</h3>
                <input type="email" name="email" required>
                <h3>Avatar:</h3>
                <label><input type="radio" name="avatar" value="1"><img src="img/avatar1.png"></label>
                <label><input type="radio" name="avatar" value="2"><img src="img/avatar2.png"></label>
                <label><input type="radio" name="avatar" value="3"><img src="img/avatar3.png"></label>
                <label><input type="radio" name="avatar" value="4"><img src="img/avatar4.png"></label>
                <label><input type="radio" name="avatar" value="5"><img src="img/avatar5.png"></label>
                <label><input type="radio" name="avatar" value="6"><img src="img/avatar6.png"></label>
                <br><button type="submit" name="submit">Zarejestuj się!</button>
                <p>Masz już konto? <a href="login.php">Zaloguj się!</a></p>
            </form>
        </article>
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