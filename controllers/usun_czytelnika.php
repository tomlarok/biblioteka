<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) // TODO tylko dla bibliotekarz i admin
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

  $czytelnik_id= validate($_GET['szukaj_czyt_id']);


// USUWA pod loginie

    $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_S('$czytelnik_id')");
    $num_rows = mysqli_num_rows($rezultat);
    if ($num_rows == 1){

      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      $polaczenie->next_result();
      $del = mysqli_query ($polaczenie, "CALL usun_czytelnikaD('$czytelnik_id')");

      if($del) echo " Usunięto czytelnika ";
        else echo "Błąd, nie udało się usunąć czytelnika ";

      print'<br>
      <button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
        // window.history.back();
        window.location.assign("../index.php")
     }
     </script>
      ';


      print '</div>';


  } else echo " Nie ma takiego czytelnika ";
}
