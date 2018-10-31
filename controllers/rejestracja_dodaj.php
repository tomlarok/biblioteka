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


$rejestracja_login = $_POST['rejestracja_login'];
$rejestracja_haslo = $_POST['rejestracja_haslo'];

//$rejestracja_nazwa  = htmlentities($rejestracja_nazwa , ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
$rejestracja_login = htmlentities($rejestracja_login, ENT_QUOTES, "UTF-8");
$rejestracja_haslo  = htmlentities($rejestracja_haslo , ENT_QUOTES, "UTF-8");

$tabela = 'logowanie';

$result = mysqli_query ($polaczenie, "SELECT * FROM $tabela WHERE login = '$rejestracja_login' "); //spr czy istnieje dany login
$num_rows = mysqli_num_rows($result);

if ($num_rows < 1){  //idywidualny login? - kontrola
$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (login, password) VALUES ('$rejestracja_login ', '$rejestracja_haslo') ");
//$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (login, haslo, nazwa_klienta) VALUES ('$rejestracja_login ', '$rejestracja_haslo', '$rejestracja_nazwa') ");

      if($ins) {
        echo "Rejestracja zakończona poprawnie ";

      }else {
        echo "Błąd rejestracji ";
      }

} else {
  echo "Podaj inny login ";
}

print '</br><a href = "../index.php">Strona Główna</a>';
?>
