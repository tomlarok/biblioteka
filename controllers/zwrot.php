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

    $upd = mysqli_query ($polaczenie, "CALL zwrot_D($id_ksiazka)");

      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      if($upd) echo "Zmiany zatwierdozne. Zwrot dokonany. ";
        else echo "Błąd, nie udało się dokonać zwrotu ";

      print'
      <br><button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
         window.history.back();
     }
     </script>
      ';


      print '</div>';

}
