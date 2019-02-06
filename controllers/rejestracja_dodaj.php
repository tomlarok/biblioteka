<?php

session_start();


//polaczenie z db

require_once "connect.php"; //by moć pobrać dane do logowania

include('polaczenie.php');


// funkcja walidacji
function validate($str) {
  // trim -Remove characters from both sides of a string
  return trim(htmlspecialchars($str)); /*przeszukują ciąg znaków, podany jako argument, w celu znalezienia znaczników HTML i PHP.
   HTMLSPECIALCHARS zamienia znaki specialne (<,>,’,”,&) na ich „bezpieczne odpowiedniki”. */
}

// spr czy dane zostały przesłane i czy nie są puste
if (!isset($_POST['rejestracja_login']) && empty($_POST["rejestracja_login"])){
  echo "Brak podanego rejestracja_login";
} else {
  $rejestracja_login = validate($_POST['rejestracja_login']);
  if (strlen($rejestracja_login) > 100) {  // Return the length of the string
    echo "Za długi login";
    exit();
  }
}

if (!isset($_POST['rejestracja_haslo']) && empty($_POST["rejestracja_haslo"])){
  echo "Brak podanego rejestracja_haslo";
} else {
  $rejestracja_haslo = validate($_POST['rejestracja_haslo']);
  if (strlen($rejestracja_haslo) > 100) {  // Return the length of the string
    echo "Za długi haslo";
    exit();
  }
}

if (!isset($_POST['rejestracja_haslo_spr']) && empty($_POST["rejestracja_haslo_spr"])){
  echo "Brak podanego rejestracja_haslo";
} else {
  $rejestracja_haslo_spr = validate($_POST['rejestracja_haslo_spr']);
  if (strlen($rejestracja_haslo_spr) > 100) {  // Return the length of the string
    echo "Za długi haslo";
    exit();
  }
}

$rejestracja_login = htmlentities($rejestracja_login, ENT_QUOTES, "UTF-8");
$rejestracja_haslo  = htmlentities($rejestracja_haslo , ENT_QUOTES, "UTF-8");
$rejestracja_haslo_spr  = htmlentities($rejestracja_haslo_spr , ENT_QUOTES, "UTF-8");

$tabela = 'logowanie';
$polaczenie->next_result();

$result = mysqli_query ($polaczenie, "CALL czytelnik_dodajSLogin('$rejestracja_login')"); //spr czy istnieje dany login
$num_rows = mysqli_num_rows($result);

print '<link href="../views/styles.css" rel="stylesheet">';
print '<div class="frame-alert">';

if ($rejestracja_haslo != $rejestracja_haslo_spr){
  echo "Hasła są różne. Powtórz hasło.";
  skryptpowrotu();
  exit();
}


if ($num_rows < 1){  //idywidualny login? - kontrola

$polaczenie->next_result();
$ins = mysqli_query ($polaczenie, "CALL rejestracja_dodajIuser('$rejestracja_login ', '$rejestracja_haslo')");


      if($ins) {
        echo "Rejestracja zakończona poprawnie ";
      }else {
        echo "Błąd rejestracji ";
      }

} else {
  echo "Podaj inny login ";
}
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
