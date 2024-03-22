<?php
    // połączenie z bazą danych
    require 'vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
    
    // pobieranie informacji z formularza
    $login = $_POST['login'];
    $haslo = $_POST['password'];
    $logindb = $client->użytkownicy->konto;
    $datadump = $logindb->findOne(array('login' => $login));

    // $datadump zwraca NULL gdy nie znajdzie loginu 
    if ($datadump != NULL){
        $haslozbazy = $datadump['haslo'];
        //porównywanie haseł
        if (password_verify($haslo, $haslozbazy)) {
            echo("Zalogowano pomyślnie");
        } else {
            echo '
            <script>
            alert("Błędne hasło");
            window.location = "login.php";
            </script>
            ';
        }
    }else{
        // wyświetlenie informacji gdy użytkownik nie istnieje
        echo '
        <script>
        alert("Podany użytkownik nie istnieje");
        window.location = "login.php";
        </script>
        ';
    }
?>