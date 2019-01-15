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


$tytul = $_POST['tytul'];
$autor = $_POST['autor'];
$sygnatura = $_POST['sygnatura'];
$wydawnictwo = $_POST['wydawnictwo'];
$kategoria = $_POST['kategoria'];
$keywords = $_POST['keywords'];
$opis = $_POST['opis'];
$stron = $_POST['stron'];
$rok = $_POST['rok'];

//$rejestracja_nazwa  = htmlentities($rejestracja_nazwa , ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
$tytul = htmlentities($tytul , ENT_QUOTES, "UTF-8");
$autor  = htmlentities($autor , ENT_QUOTES, "UTF-8");
$sygnatura  = htmlentities($sygnatura , ENT_QUOTES, "UTF-8");
$wydawnictwo  = htmlentities($wydawnictwo, ENT_QUOTES, "UTF-8");
$kategoria  = htmlentities($kategoria, ENT_QUOTES, "UTF-8");
$keywords = htmlentities($keywords, ENT_QUOTES, "UTF-8");
$opis  = htmlentities($opis, ENT_QUOTES, "UTF-8");
$stron  = htmlentities($stron, ENT_QUOTES, "UTF-8");
$rok  = htmlentities($rok, ENT_QUOTES, "UTF-8");
//$haslo_dodaj  = htmlentities($haslo_dodaj , ENT_QUOTES, "UTF-8");

$tabela = 'ksiazka';
/*
$result = mysqli_query ($polaczenie, "SELECT * FROM $tabela WHERE nazwisko = '$nazwisko_dodajn' AND imie = '$imie_dodaj' AND email = '$email_dodaj' "); //spr czy istnieje dany login
$num_rows = mysqli_num_rows($result);
*/
//if ($num_rows < 1){  //idywidualny login? - kontrola
/*
$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (tytul, autor)
VALUES ('$tytul', '$autor') ");
*/
/* // OK zamiast structured procedure
$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (tytul, autor, isbn, wydawnictwo, opis, stron, rok_wydania)
VALUES ('$tytul', '$autor', '$sygnatura', '$wydawnictwo', '$opis', '$stron', '$rok') ");
*/
//$ins = mysqli_query ($polaczenie, "CALL ksiazka_dodajI('$tytul', '$autor', '$sygnatura', '$wydawnictwo', '$kategoria', '$opis', '$stron', '$rok') ");

$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (id_ksiazka, id_kategoria, isbn, tytul, autor, stron, wydawnictwo, rok_wydania, opis, keywords, dostepnosc)
VALUES (NULL, '$kategoria', '$sygnatura', '$tytul', '$autor', '$stron', '$wydawnictwo', '$rok', '$opis', '$keywords', '');");
// VALUES (NULL, '1', '9827127483214', 'Ogniem i mieczem', 'Henryk Sienkiewicz', '378', 'Polska Klasyka', '2007', NULL, '', '');");
/*
$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (tytul, autor, isbn, wydawnictwo, kategoria, keywords, opis, stron, rok_wydania)
VALUES ('$tytul', '$autor', '$sygnatura', '$wydawnictwo', '$kategoria', '$keywords', '$opis', $stron, $rok) ");
*/
//$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (login, haslo, nazwa_klienta) VALUES ('$rejestracja_login ', '$rejestracja_haslo', '$rejestracja_nazwa') ");

print '<link href="../views/styles.css" rel="stylesheet">';

print '<div class="frame-alert">';
  if($ins) echo "Dodano pozycje do bazy danych ";
          else echo "Błąd, nie udało się dodać ";
          skryptpowrotu();

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
