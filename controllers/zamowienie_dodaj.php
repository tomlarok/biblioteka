<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {



      //polaczenie z db

      require_once "connect.php"; //by moć pobrać dane do logowania

      include('polaczenie.php');;

      if ($polaczenie->connect_errno!=0)
      {
          echo "Error: ".$polaczenie->connect_errno;
      }
      else{

        // funkcja walidacji
        function validate($str) {
          return trim(htmlspecialchars($str));
        }

        $id_ksiazka = validate($_GET['id_ksiazka']);

        if (isset($_SESSION['bibliotekarz'])){ //  gdy wypozycza bibliotekarz ??
          $id_czytelnik = 2;
          $czytelnik = false;
        }else{

          $id_czytelnik = @$_SESSION['id_czytelnik'];
          $czytelnik = true;
        }

        if (isset($_SESSION['konto_aktywne'])){
          $konto_aktywne = $_SESSION['konto_aktywne'];
          if ($konto_aktywne == "Nie" && $czytelnik == true){
            print '<link href="../views/styles.css" rel="stylesheet">';

            print '<div class="frame-alert">';
            echo "Konto zablokowane. Nie można zamówić pozycji. </br>";
              skryptpowrotu();
            exit();
          }
        }


        $tabela = "zamowienie";

          $rezultat = mysqli_query ($polaczenie, "CALL zam_rezygnujS($id_ksiazka)");

          $num_rows = mysqli_num_rows($rezultat);
          $polaczenie->next_result();
          $rezultat_dostepnosc = mysqli_query ($polaczenie, "CALL zamowienie_dodajSk_dostepnosc($id_ksiazka)");
          $wiersz = mysqli_fetch_array ($rezultat_dostepnosc);
          $dostepnosc = $wiersz ['dostepnosc'];

          $num_rows = mysqli_num_rows($rezultat);

          if ($num_rows < 1 && $dostepnosc == "Tak"){

          // Dodawanie daty odbioru

          // Dodanie 30 minut do daty zamowienia w celu ustalenia czasu odbioru zamowienia
          $date = new DateTime('NOW', new DateTimeZone('UTC'));
          $date->add(new DateInterval('PT2H30M'));  //dodanie 30 minut i 2 h róznicy czasu dla stefy +2GMT
          $data_odbioru = $date->format('Y-m-d H:i:s');

          $polaczenie->next_result();
          $ins = mysqli_query ($polaczenie, "CALL zamowienie_dodajI($id_czytelnik, $id_ksiazka, '$data_odbioru')");

            print '<link href="../views/styles.css" rel="stylesheet">';

            print '<div class="frame-alert">';

            if($ins) echo "Zamówienie zostało przyjęte ";
              else echo "Błąd, nie udało się dodać zamówienia ";
              skryptpowrotu();

    } else {
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';
      echo "Nie można wypożyczyć. Pozycja jest już wypożyczona";
      skryptpowrotu();

    }

    }
  } else{
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';
      echo "Zaloguj się by zamówić pozycję. <br>";
      skryptpowrotu();

    }

    function skryptpowrotu(){
      print'<br>
      <button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
        // window.history.back(); // pyta sie o ponowne przeslanie danych z form
         window.location.assign("../index.php")
     }
     </script>
      ';


      print '</div>';
    }
