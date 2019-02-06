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
/*
$polaczenie = mysqli_connect ($db_host, $db_user, $db_password);
mysqli_select_db ($polaczenie, $db_name);
*/


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

  $tabela = "zamowienie";

    $rezultat = mysqli_query ($polaczenie, "CALL zam_rezygnujS($id_ksiazka)");
    $num_rows = mysqli_num_rows($rezultat);
    if ($num_rows == 1){

      $polaczenie->next_result();
      $del = mysqli_query ($polaczenie, "CALL zam_rezygnujD($id_ksiazka)");

      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      if($del) echo "Zamówienie anulowano ";
        else echo "Błąd, nie udało się anulować zamówienia ";

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
}
