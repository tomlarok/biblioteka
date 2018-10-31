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
//$haslo_dodaj = $_POST['nazwisko_dodaj'];//TODO haslo podaje czytelnik w czasie rejestracji


//$rejestracja_nazwa  = htmlentities($rejestracja_nazwa , ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
$imie_dodaj = htmlentities($imie_dodaj , ENT_QUOTES, "UTF-8");
$nazwisko_dodaj  = htmlentities($nazwisko_dodaj , ENT_QUOTES, "UTF-8");
$adres_dodaj  = htmlentities($adres_dodaj , ENT_QUOTES, "UTF-8");
$email_dodaj  = htmlentities($email_dodaj , ENT_QUOTES, "UTF-8");
//$haslo_dodaj  = htmlentities($haslo_dodaj , ENT_QUOTES, "UTF-8");

$tabela = 'users';

$result = mysqli_query ($polaczenie, "SELECT * FROM $tabela WHERE nazwisko = '$nazwisko_dodajn' AND imie = '$imie_dodaj' AND email = '$email_dodaj' "); //spr czy istnieje dany login
$num_rows = mysqli_num_rows($result);

if ($num_rows < 1){  //idywidualny login? - kontrola
$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (imie, nazwisko, email, adres) VALUES ('$imie_dodaj', '$nazwisko_dodaj', '$adres_dodaj', '$email_dodaj') ");
//$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (login, haslo, nazwa_klienta) VALUES ('$rejestracja_login ', '$rejestracja_haslo', '$rejestracja_nazwa') ");

      if($ins) {
        echo "Rejestracja zakończona poprawnie ";

      }else {
        echo "Błąd rejestracji ";
      }

} else {
  echo "User już taki istnieje! ";
}

print '</br><a href = "../Bibliotekarz.php">Wróć</a>';
?>
