<?php

session_start();


$user = $_SESSION['user'];
$id = $_SESSION['id'];

//polaczenie z db

require_once "connect.php"; //by moć pobrać dane do logowania

include('polaczenie.php');


// funkcja walidacji
function validate($str) {
  return trim(htmlspecialchars($str));
}

// spr czy dane zostały przesłane i czy nie są puste
if (!isset($_POST['user_name']) && empty($_POST["user_name"])){
  echo "Brak podanego user_name";
  exit();
} else {
  $imie_dodaj = validate($_POST['user_name']);
}

if (!isset($_POST['user_surname']) && empty($_POST["user_surname"])){
  echo "Brak podanego user_surname";
  exit();
} else {
  $nazwisko_dodaj = validate($_POST['user_surname']);
}

if (!isset($_POST['user_adress']) && empty($_POST["user_adress"])){
  echo "Brak podanego user_adress";
  exit();
} else {
  $adres_dodaj = validate($_POST['user_adress']);
}

if (!isset($_POST['user_email']) && empty($_POST["user_email"])){
  echo "Brak podanego user_email";
  exit();
} else {
    $email_dodaj = validate($_POST['user_email']);
  if (!filter_var($email_dodaj, FILTER_VALIDATE_EMAIL)) {
    echo "Brak podanego poprawnego user_email";
    exit();
  }
}

$imie_dodaj = htmlentities($imie_dodaj , ENT_QUOTES, "UTF-8");
$nazwisko_dodaj  = htmlentities($nazwisko_dodaj , ENT_QUOTES, "UTF-8");
$adres_dodaj  = htmlentities($adres_dodaj , ENT_QUOTES, "UTF-8");
$email_dodaj  = htmlentities($email_dodaj , ENT_QUOTES, "UTF-8");

$tabela = 'czytelnik';


$upd= mysqli_query ($polaczenie, "CALL konto_aktualizujU('$imie_dodaj', '$nazwisko_dodaj', '$adres_dodaj', '$email_dodaj', '$user')");

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
