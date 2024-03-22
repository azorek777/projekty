<?php
    require 'vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');

    $logindb = $client->użytkownicy->konto;
    
    // Stworzenie bazy danych
    //$db = $client->użytkownicy;

    //stworzenie kolekcji konto
    //$dodajlogin = $db->createCollection('konto');

    // pobranie informacji z formularza
    $login = $_POST['login'];
    $haslo = $_POST['password'];
    $imie = $_POST['name'];
    $nazwisko = $_POST['surname'];
    $dataurodzenia = $_POST['date'];
    $email = $_POST['email'];
    $avatar = $_POST['avatar'];
    switch ($avatar){
        case 1:
            $avatarnumber = 1;
            break;
        case 2:
            $avatarnumber = 2;
            break;
        case 3:
            $avatarnumber = 3;
            break;
        case 4:
            $avatarnumber = 4;
            break;
        case 5:
            $avatarnumber = 5;
            break;
        case 6:
            $avatarnumber = 6;
            break;
    }


    // hashowanie hasła w celu bezpieczeństwa
    $hashhaslo = password_hash($haslo, PASSWORD_DEFAULT);

    //sprawdzenie płci 
    if($_POST['sex']=="mezczyzna") {
        $plec = "mezczyzna";
    } else {
        $plec = "kobieta";
    }

    // sprawdzenie czy podany login już istnieje (loginy są unikalne)
    $loginExists = $logindb->findOne(['login' => $login]);
    if ($loginExists) {
        // Jeżeli login już istnieje, wyświetl komunikat
        echo '<script>alert("Podany login już istnieje");
        window.location.replace("register.php");</script>';
        exit;
      } else {
        // Jeżeli login jest wolny, dodaj go do kolekcji
        $insertdata = $logindb->insertOne([
            'login' => $login,
            'haslo' => $hashhaslo,
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'plec' => $plec,
            'data urodzenia' => $dataurodzenia,
            'e-mail' => $email,
            'avatar' => $avatarnumber,
        ]);

        // wyświetlenie informacji o pomyślnym zarejestrowaniu i natychmiastowe przekierowanie na strone główną
        printf("Wysłano " . $insertdata->getInsertedCount() . " rekord");
        echo "<script>alert('Pomyślnie zarejestrowano!')</script>";
        header("Refresh:0; url=index.php");
      }
      

?>