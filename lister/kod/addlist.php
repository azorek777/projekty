<?php
    // połączenie z bazą danych
    require 'vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');

    // pobranie wartości z formularza
    $listtype = $_POST['type'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $name = $_POST['nazwa'];

    // autor i jego id
    $konto = $client->użytkownicy->konto;
    $autor = $_COOKIE["login"];
    $result = $konto->findOne(array('login' => $autor));
    $id = $result['_id']; 

    //usuniecie spacji pomiedzy tytułami
    $usunentery = preg_replace('/\R/u', '', $content);
    $usunspacje = preg_replace('/\s*,\s*/', ',', $usunentery);

    //zamiana na małe litery
    $maletytuly = strtolower($usunspacje);

    //rodzielenie tytułów
    $tytuly = explode(",",$maletytuly);

    //sprawdzenie rodzaju listy
    if ($listtype == 'public'){
        $db = $client->listy->publiczne;
    } elseif ($listtype == 'private'){
        $db = $client->listy->prywatne;
    }


    //sprawdzenie czy podany tytuł jest w naszej bazie
    $tresc = ''; 
    foreach ($tytuly as $titles){
        $okladka = $client->listy->okladki;
        $szukaj = $okladka->findOne(array('nazwa' => $titles));
        if ($szukaj == NULL){
            echo '
            <script>
            if (confirm("Twojego tytułu: ' . $titles . ' nie ma w bazie. Czy chcesz go dodać?")) {
                window.location.replace("createcontent.php");
              } else {
                window.location.replace("createlist.php");
              }
            </script>
            ';
            exit;
        }else{
            echo "Tytuł " . $titles . " istnieje w bazie danych <br>";
            
            $tresc .= $titles . ',';
            
        }     

    }

    //usuniecie ostatniego przecinka po tytule
    $finaltresc = rtrim($tresc, ",");
    echo $finaltresc;

    //zamienienie nazwy na male litery
    $newname = strtolower($name);
    echo $newname;

    // wstawianie do bazy danych
    $insertdata = $db->insertOne([
        'nazwa' => $newname,
        'kategoria' => $category,
        'autor' => $autor,
        'tresc' => $finaltresc,
        'userid' => $id,
    ]);

    // powrót do strony głównej
    header('Location: index.php')










?>