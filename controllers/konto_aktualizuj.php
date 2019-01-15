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

$user = $_SESSION['user'];
$id = $_SESSION['id'];

//polaczenie z db

require_once "connect.php"; //by moć pobrać dane do logowania

$polaczenie = mysqli_connect ($db_host, $db_user, $db_password);
mysqli_select_db ($polaczenie, $db_name);


$imie_dodaj = $_POST['user_name'];
$nazwisko_dodaj = $_POST['user_surname'];
$adres_dodaj = $_POST['user_adress'];
$email_dodaj = $_POST['user_email'];

//$login = $_POST['login'];
//$haslo_dodaj = $_POST['nazwisko_dodaj'];//TODO haslo podaje czytelnik w czasie rejestracji


//$rejestracja_nazwa  = htmlentities($rejestracja_nazwa , ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
$imie_dodaj = htmlentities($imie_dodaj , ENT_QUOTES, "UTF-8");
$nazwisko_dodaj  = htmlentities($nazwisko_dodaj , ENT_QUOTES, "UTF-8");
$adres_dodaj  = htmlentities($adres_dodaj , ENT_QUOTES, "UTF-8");
$email_dodaj  = htmlentities($email_dodaj , ENT_QUOTES, "UTF-8");

//$login  = htmlentities($login , ENT_QUOTES, "UTF-8");

// TODO Spr czy login istnieje
$tabela = 'czytelnik';

//$result = mysqli_query ($polaczenie, "SELECT * FROM $tabela WHERE login = '$login' "); //spr czy istnieje dany login
$upd= mysqli_query ($polaczenie, "CALL konto_aktualizujU('$imie_dodaj', '$nazwisko_dodaj', '$adres_dodaj', '$email_dodaj', '$user')");

//$result = mysqli_query ($polaczenie, "CALL czytelnik_dodajSLogin('$login')"); //spr czy istnieje dany login

      print '<link href="../views/styles.css" rel="stylesheet">';

      print '<div class="frame-alert">';

      if($upd) echo "Zmieniono dane czytelnika ";
        else echo "Błąd, nie udało się zmienić dancyh czytelnika ";
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
