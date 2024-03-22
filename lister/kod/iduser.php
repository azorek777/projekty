<?php
  //wyciaganie id użytkownika
      require 'vendor/autoload.php';
      $client = new MongoDB\Client(
          'mongodb+srv://kartofel2003:PaulinegNews@cluster0.zvxrfsg.mongodb.net/?retryWrites=true&w=majority');
      $collection = $client->użytkownicy->konto;
      $login = "test";
      $result = $collection->findOne(array('login' => $login));
      //szukanie po id
      
      $idzbazy = $result['_id'];
      echo($idzbazy);



      // pobieranie list do js
      $okladki = $client->listy->publiczne;
      $datadump = $okladki->find();
      $array = iterator_to_array($datadump);

      echo "<script>const cache = [];</script>";
      $count = 0;

      foreach ($array as $value){
          echo '<script>cache[' . $count . ']="' . $value["nazwa"] . '";</script>';
          $count += 1;
      }

      echo "<script>console.log(cache);</script>";

      echo '
      function dupa() {
          let query = document.getElementById("search").value;
          document.getElementById("zabawa").innerHTML = "";
          console.clear();
        
        
          // Przechodzimy przez wszystkie elementy tablicy
          for (let i = 0; i < cache.length; i++) {
            // Sprawdzamy, czy aktualny element zaczyna się od ciągu znaków zapytania
            if (cache[i].startsWith(query)) {
              // Jeśli tak, wyświetlamy go w konsoli
              console.log(cache[i]);
              // document.getElementById("zabawa").innerHTML += cache[i];
        
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
      ';


?>