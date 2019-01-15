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

$polaczenie = mysqli_connect ($db_host, $db_user, $db_password);
mysqli_select_db ($polaczenie, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else{

  $id_ksiazka = $_GET['id_ksiazka'];
  // TODO Test
  echo $id_ksiazka;

  $tabela = "zamowienie";
    //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_ksiazka = '$id_ksiazka' ");
    $rezultat = mysqli_query ($polaczenie, "CALL zam_rezygnujS($id_ksiazka)");
    $num_rows = mysqli_num_rows($rezultat);
    if ($num_rows == 1){
      //$del = mysqli_query ($polaczenie, "DELETE FROM $db_name.$tabela WHERE id_ksiazka = '$id_ksiazka' ");
      $polaczenie->next_result();
      $del = mysqli_query ($polaczenie, "CALL zam_rezygnujD($id_ksiazka)");
      //header('Location: ../index.php ');
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      if($del) echo "Zamówienie anulowano ";
        else echo "Błąd, nie udało się anulować zamówienia ";

      //print'<a href = "../index.php">Powrót</a>';
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
