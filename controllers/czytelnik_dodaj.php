<?php

session_start();
/*
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

    } else{
        header('Location: ../index.php');
        exit(); //wyjscie z strony bez wczytania ponizszych linije kodu
    }
*/

//polaczenie z db

require_once "connect.php"; //by moć pobrać dane do logowania

$polaczenie = mysqli_connect ($db_host, $db_user, $db_password);
mysqli_select_db ($polaczenie, $db_name);


$imie_dodaj = $_POST['imie_dodaj'];
$nazwisko_dodaj = $_POST['nazwisko_dodaj'];
$adres_dodaj = $_POST['adres_dodaj'];
$email_dodaj = $_POST['email_dodaj'];

$login = $_POST['login'];
//$haslo_dodaj = $_POST['nazwisko_dodaj'];//TODO haslo podaje czytelnik w czasie rejestracji


//$rejestracja_nazwa  = htmlentities($rejestracja_nazwa , ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
$imie_dodaj = htmlentities($imie_dodaj , ENT_QUOTES, "UTF-8");
$nazwisko_dodaj  = htmlentities($nazwisko_dodaj , ENT_QUOTES, "UTF-8");
$adres_dodaj  = htmlentities($adres_dodaj , ENT_QUOTES, "UTF-8");
$email_dodaj  = htmlentities($email_dodaj , ENT_QUOTES, "UTF-8");

$login  = htmlentities($login , ENT_QUOTES, "UTF-8");

// TODO Spr czy login istnieje
$tabela = 'logowanie';

//$result = mysqli_query ($polaczenie, "SELECT * FROM $tabela WHERE login = '$login' "); //spr czy istnieje dany login
$result = mysqli_query ($polaczenie, "CALL czytelnik_dodajSLogin('$login')"); //spr czy istnieje dany login
$num_rows = mysqli_num_rows($result);

if ($num_rows == 1){  //idywidualny login? - kontrola
  /*
      $ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (imie_czytelnik, nazwisko_czytelnik, email_czytelnik, adres_czytelnik, login)
      VALUES ('$imie_dodaj', '$nazwisko_dodaj', '$email_dodaj', '$adres_dodaj', '$login') ");
      */

      $tabela = 'czytelnik';
      $polaczenie->next_result();
    //  $result = mysqli_query ($polaczenie, "SELECT * FROM $tabela WHERE nazwisko_czytelnik = '$nazwisko_dodaj' AND imie_czytelnik = '$imie_dodaj' AND adres_czytelnik = '$email_dodaj' "); //spr czy istnieje dany login
      $result = mysqli_query ($polaczenie, "CALL czytelnik_dodajSczytelnik('$nazwisko_dodaj', '$imie_dodaj', '$email_dodaj', '$login')"); //spr czy istnieje dany login

      $num_rows = mysqli_num_rows($result);

      if ($num_rows < 1){  //jest już taki czytelnik? - kontrola
  /*
      $ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (imie_czytelnik, nazwisko_czytelnik, email_czytelnik, adres_czytelnik, login)
      VALUES ('$imie_dodaj', '$nazwisko_dodaj', '$email_dodaj', '$adres_dodaj', '$login') ");
  */
      $polaczenie->next_result();
      $ins = mysqli_query ($polaczenie, "CALL czytelnik_dodajIczytelnik('$imie_dodaj', '$nazwisko_dodaj', '$email_dodaj', '$adres_dodaj', '$login') ");

      //$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (login, haslo, nazwa_klienta) VALUES ('$rejestracja_login ', '$rejestracja_haslo', '$rejestracja_nazwa') ");
      /*
            if($ins) {
              echo "Rejestracja zakończona poprawnie ";

            }else {
              echo "Błąd rejestracji ";
            }

      } else {
        echo "User już taki istnieje! ";
      }

      print '</br><a href = "../Bibliotekarz.php">Wróć</a>';
      */
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      if($ins) echo "Dodano czytelnika ";
        else echo "Błąd, nie udało się dodać czytelnika ";
        skryptpowrotu();

      } else {
      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';
      echo "Nie można dodać. Już taki czytelnik istnieje";
      skryptpowrotu();

      }
} else {
  print '<link href="../views/styles.css" rel="stylesheet">';

  print '<div class="frame-alert">';

  echo "Błąd, nie ma takiego loginu ";
    skryptpowrotu();
}


/*
}
} else{
print '<link href="../views/styles.css" rel="stylesheet">';

print '<div class="frame-alert">';
echo "Zaloguj się by zamówić pozycję. <br>";
skryptpowrotu();

}
*/
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

?>
