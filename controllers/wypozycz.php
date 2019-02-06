<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

      //polaczenie z db

      require_once "connect.php"; //by moć pobrać dane do logowania

      include('polaczenie.php');

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
        $id_czytelnik  = validate($_GET['id_czytelnik']);


        $tabela = "zamowienie";

          $rezultat = mysqli_query ($polaczenie, "CALL wypozycz_Szamowienie($id_ksiazka, $id_czytelnik)");
          $num_rows = mysqli_num_rows($rezultat);
          if ($num_rows == 1){

          $tabela2 = "wypozyczenia";

          $date = new DateTime('NOW', new DateTimeZone('UTC'));
          $date->add(new DateInterval('P30D'));  //dodanie 30 minut i 2 h róznicy czasu dla stefy +2GMT
          $data_zwrotu= $date->format('Y-m-d'); // 'PT2H30M3S' 'Y-m-d H:i:s'

          include('polaczenie.php');

          if ($polaczenie->connect_errno!=0)
          {
              echo "Error: ".$polaczenie->connect_errno;
          }

          $ins = mysqli_query ($polaczenie, "CALL wypozycz_Iwypozyczenia($id_czytelnik, $id_ksiazka, '$data_zwrotu')");

            print '<link href="../views/styles.css" rel="stylesheet">';

            print '<div class="frame-alert">';

            if($ins) echo "Wypożyczenie zrealizowane ";
              else echo "Błąd wypożyczenia ";
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
      echo "Zaloguj się by wypożyczyć pozycję. <br>";
      skryptpowrotu();

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
