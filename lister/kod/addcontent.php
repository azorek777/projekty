<?php
    // połączenie z bazą
    require 'vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
      
        // przechwycenie wartości z formularza
        $tytul = $_POST['title'];
        $kategoria = $_POST['category'];
        $link = $_POST['link'];

    // wstawienie wartości do bazy danych
    $db = $client->sugestie->noweokladki;
    $insertdata = $db->insertOne([
        'tytul' => $tytul,
        'kategoria' => $kategoria,
        'link' => $link,
    ]);

    // wyświetlenie komunikatu z pytaniem
    echo '
    <script>
    if (confirm("Pomyślnie dodano: ' . $tytul . '. Czy chcesz dodać jeszcze jedną rzecz?")) {
        window.location.replace("createcontent.php");
      } else {
        window.location.replace("createlist.php");
      }
    </script>
    ';
?>