<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
// TODO spr czzy bibliotekarz


      //polaczenie z db

      require_once "connect.php"; //by moć pobrać dane do logowania

      $polaczenie = mysqli_connect ($db_host, $db_user, $db_password);
      mysqli_select_db ($polaczenie, $db_name);

      if ($polaczenie->connect_errno!=0)
      {
          echo "Error: ".$polaczenie->connect_errno;
      }
      else{

        $id_ksiazka = $_GET['id_ksiazka'];
        $id_czytelnik = $_GET['id_czytelnik'];
        //$id_czytelnik = $_SESSION['id'];

        // TODO Test
        echo $id_ksiazka;
        echo "\n";
        echo $id_czytelnik;

        $tabela = "zamowienie";
          $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_ksiazka = '$id_ksiazka' AND id_czytelnik = '$id_czytelnik' ");
          $num_rows = mysqli_num_rows($rezultat);
          if ($num_rows == 1){

          $tabela2 = "wypozyczenia";
          $ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela2 (id_czytelnik, id_ksiazka, data_wypozyczenia)
          VALUES ($id_czytelnik, $id_ksiazka, NOW() )");
          //$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (id_czytelnik, id_ksiazka, data_zamowienia, data_odbioru, data_zwrotu) VALUES ('$id_czytelnik', '$id_ksiazka', NOW(), NOW(), NOW() ) ");
          //$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (login, haslo, nazwa_klienta) VALUES ('$rejestracja_login ', '$rejestracja_haslo', '$rejestracja_nazwa') ");

            //header('Location: ../index.php ');
            print '<link href="../views/styles.css" rel="stylesheet">';

            print '<div class="frame-alert">';

            if($ins) echo "Zamówienie zostało przyjęte ";
              else echo "Błąd, nie udało się dodać zamówienia ";
              skryptpowrotu();
            //print'<a href = "../index.php">Powrót</a>';
            /*
            print'
            <button onclick="goBack()">Powrót</button>

           <script>
           function goBack() {
               window.history.back();
           }
           </script>
            ';


            print '</div>';
            */
      /*
        } else {
          print '<link href="../views/styles.css" rel="stylesheet">';

          print '<div class="frame-alert">';
          echo "Nie można zamówić danej pozycji";
          print '</div>';

        }
      */
    } else {
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';
      echo "Nie można wypożyczyć. Pozycja jest już wypożyczona";
      skryptpowrotu();
/*
      //print'<a href = "../index.php">Powrót</a>';
      print'
      <button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
         window.history.back();
     }
     </script>
      ';


      print '</div>'; */
    }

    }
  } else{
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';
      echo "Zaloguj się by wypożyczyć pozycję. <br>";
      skryptpowrotu();
      /*
      print'
      <button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
         window.history.back();
     }
     </script>
      ';
      print '</div>';
*/
      //  header('Location: ../index.php');
      //  exit(); //wyjscie z strony bez wczytania ponizszych linije kodu
    }

    function skryptpowrotu(){
      print'<br>
      <button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
         window.history.back();
     }
     </script>
      ';


      print '</div>';
    }
