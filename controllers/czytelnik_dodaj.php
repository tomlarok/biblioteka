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

include('polaczenie.php');
/*
$polaczenie = mysqli_connect ($db_host, $db_user, $db_password);
mysqli_select_db ($polaczenie, $db_name);
*/

// funkcja walidacji
function validate($str) {
  return trim(htmlspecialchars($str));
}

// spr czy dane zostały przesłane i czy nie są puste
if (!isset($_POST['imie_dodaj']) && empty($_POST["imie_dodaj"])){
  echo "Brak podanego imie";
} else {
  $imie_dodaj = validate($_POST['imie_dodaj']);
}

if (!isset($_POST['nazwisko_dodaj']) && empty($_POST["nazwisko_dodaj"])){
  echo "Brak podanego nazwisko_dodaj";
} else {
  $nazwisko_dodaj = validate($_POST['nazwisko_dodaj']);
}

if (!isset($_POST['adres_dodaj']) && empty($_POST["adres_dodaj"])){
  echo "Brak podanego adres_dodaj";
} else {
  $adres_dodaj = validate($_POST['adres_dodaj']);
}

if (!isset($_POST['email_dodaj']) && empty($_POST["email_dodaj"])){
  echo "Brak podanego email_dodaj";
  exit();
} else {
    $email_dodaj = validate($_POST['email_dodaj']);
  if (!filter_var($email_dodaj, FILTER_VALIDATE_EMAIL)) {
    echo "Brak podanego poprawnego email_dodaj";
    exit();
  }
}

$login = validate($_POST['login']);
 //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
$imie_dodaj = htmlentities($imie_dodaj , ENT_QUOTES, "UTF-8");
$nazwisko_dodaj  = htmlentities($nazwisko_dodaj , ENT_QUOTES, "UTF-8");
$adres_dodaj  = htmlentities($adres_dodaj , ENT_QUOTES, "UTF-8");
$email_dodaj  = htmlentities($email_dodaj , ENT_QUOTES, "UTF-8");

$login  = htmlentities($login , ENT_QUOTES, "UTF-8");

$tabela = 'logowanie';

$result = mysqli_query ($polaczenie, "CALL czytelnik_dodajSLogin('$login')"); //spr czy istnieje dany login
$num_rows = mysqli_num_rows($result);

if ($num_rows == 1){

      $tabela = 'czytelnik';
      $polaczenie->next_result();

      $result = mysqli_query ($polaczenie, "CALL czytelnik_dodajSczytelnik('$nazwisko_dodaj', '$imie_dodaj', '$email_dodaj', '$login')"); //spr czy istnieje dany login

      $num_rows = mysqli_num_rows($result);

      if ($num_rows < 1){  //jest już taki czytelnik? - kontrola

      $polaczenie->next_result();
      $ins = mysqli_query ($polaczenie, "CALL czytelnik_dodajIczytelnik('$imie_dodaj', '$nazwisko_dodaj', '$email_dodaj', '$adres_dodaj', '$login') ");

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
