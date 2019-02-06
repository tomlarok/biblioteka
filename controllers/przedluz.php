<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

    } else{
        header('Location: ../index.php');
        exit(); //wyjscie z strony bez wczytania ponizszych linije kodu
    }


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

  $tabela = "wypozyczenia";

    $rezultat = mysqli_query ($polaczenie, "CALL przedluz_Swypozyczenia('$id_ksiazka')");
    $num_rows = mysqli_num_rows($rezultat);
    if ($num_rows == 1){

    $date = new DateTime('NOW', new DateTimeZone('UTC'));
    $date->add(new DateInterval('P30D'));
    $data_zwrotu= $date->format('Y-m-d');
    echo $data_zwrotu;
    // nowe połączenie
    include('polaczenie.php');

    if ($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }

    $upd = mysqli_query ($polaczenie, "CALL przedluz_Uwypozyczenia('$id_ksiazka', '$data_zwrotu')");

      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      if($upd) echo "Zmiany zatwierdzone. Prolongata dokonana. ";
        else echo "Błąd, nie udało się dokonać prolongaty. ";

      print'</br>
      <button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
         window.history.back();
     }
     </script>
      ';


      print '</div>';

  } else {
    echo "Błąd, może nie być takiej pozycji lub błędy danych książek";
  }
}
