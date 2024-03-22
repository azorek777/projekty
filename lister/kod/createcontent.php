<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="img/header_icon.svg">
    <script src="index.js" defer></script>
    <title>Lister - dodawanie listy</title>
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
            <a id="accountNav" href="account.php">ACCOUNT: <span id="accountNavName" class="list_title"></span></a>
            <a id="loginNav" href="login.php">SIGN IN</a>
            <a id="registerNav" href="register.php">CREATE ACCOUNT</a>
            <a id="listsNav" href="lists.php">LISTS</a>
            <a id="membersNav" href="members.php">MEMBERS</a>
            <a id="createListNav" href="createlist.php">CREATE LIST</a>
            <a id="addDataNav" href="createcontent.php" class="chosen">ADD DATA</a>
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
        <article class="login_article">
            <h1>Dodawanie nowej zawartości</h1>
            <form method="post" action="addcontent.php">
                <h3>Tytuł:</h3>
                <input type="text" name="title" required><br><br>
                <h3>Wybierz kategorię:</h3>
                <div class="sex">
                    <label>Film</label><input type="radio" name="category" value="filmy" required>
                    <label>Książka</label><input type="radio" name="category" value="ksiazki" required>
                </div><br>
                <h3>Link do dzieła: <span class="opcjonalnie">(opcjonalnie)</span></h3> 
                <input type="url" name="link" ><br>
                <button type="submit" name="submit">Wyślij do administracji!</button>
                <p><a href="createlist.php">Powrót do tworzenia list</a></p>
            </form>
        </article>
    </main>
    <footer>
        <div class="footer_content">
            <nav class="footer_nav">
                <a id="accountNavBottom" href="account.php">ACCOUNT: <span id="accountNavNameBottom" class="list_title"></span></a>
                <a id="loginNavBottom" href="login.php">Sign In</a>
                <a id="registerNavBottom" href="register.php">Create Account</a>
                <a id="listsNavBottom" href="lists.php">Lists</a>
                <a id="createListNavBottom" href="createlist.php">Create List</a>
                <a id="membersNavBottom" href="members.php">Members</a>
                <a id="addDataNavBottom" href="createcontent.php" class="chosen">Add Data</a>
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