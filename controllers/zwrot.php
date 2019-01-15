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
//  echo $id_ksiazka;

  $tabela = "wypozyczenia";
    //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_ksiazka = '$id_ksiazka' ");
    /*
    $rezultat = mysqli_query ($polaczenie, "CALL zwrotD('$id_ksiazka')");
    $num_rows = mysqli_num_rows($rezultat);
    if ($num_rows == 1){  //idywidualny login? - kontrola
    */
  /*
    $ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (id_ksiazka, data_zwrotu)
    VALUES ('$id_ksiazka', NOW() ) ");
  */
    $upd = mysqli_query ($polaczenie, "CALL zwrot_D($id_ksiazka)");

      //header('Location: ../index.php ');
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      if($upd) echo "Zmiany zatwierdozne. Zwrot dokonany. ";
        else echo "Błąd, nie udało się dokonać zwrotu ";

      //print'<a href = "../index.php">Powrót</a>';
      print'
      <br><button onclick="goBack()">Powrót</button>

     <script>
     function goBack() {
         window.history.back();
     }
     </script>
      ';


      print '</div>';

/*
  } else {
    print '<link href="../views/styles.css" rel="stylesheet">';

    print '<div class="frame-alert">';
    echo "Nie można zamówić dokonać danej operacji";
    print '</div>';

  }
*/
//  }
}
