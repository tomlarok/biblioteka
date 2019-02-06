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
if (!isset($_POST['tytul']) && empty($_POST["tytul"])){
  echo "Brak podanego tytułu";
} else {
  $tytul = validate($_POST['tytul']);
}

if (!isset($_POST['autor']) && empty($_POST["autor"])){
  echo "Brak podanego autora";
} else {
  $autor = validate($_POST['autor']);
}

$keywords = validate($_POST['keywords']);
if (strlen($keywords) > 300) {  // Return the length of the string
  echo "Za długi - keywords";
  exit();
}
$rok = validate($_POST['rok']);
// ctype_digit — Check for numeric character(s)
if (isset($rok) && !empty($rok)){
    if (ctype_digit($rok)){
      if (strlen($rok) > 4) {  // Return the length of the string
        echo "Za długi - rok";
        exit();
      }
    } else {
      exit();
    }
}

$sygnatura = validate($_POST['sygnatura']);
$wydawnictwo = validate($_POST['wydawnictwo']);
$kategoria = validate($_POST['kategoria']);

$opis = validate($_POST['opis']);
$stron = validate($_POST['stron']);

$tytul = htmlentities($tytul , ENT_QUOTES, "UTF-8");  //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
$autor  = htmlentities($autor , ENT_QUOTES, "UTF-8");
$sygnatura  = htmlentities($sygnatura , ENT_QUOTES, "UTF-8");
$wydawnictwo  = htmlentities($wydawnictwo, ENT_QUOTES, "UTF-8");
$kategoria  = htmlentities($kategoria, ENT_QUOTES, "UTF-8");
$keywords = htmlentities($keywords, ENT_QUOTES, "UTF-8");
$opis  = htmlentities($opis, ENT_QUOTES, "UTF-8");
$stron  = htmlentities($stron, ENT_QUOTES, "UTF-8");
$rok  = htmlentities($rok, ENT_QUOTES, "UTF-8");


$tabela = 'ksiazka';

$ins = mysqli_query ($polaczenie, "INSERT INTO $db_name.$tabela (id_ksiazka, id_kategoria, isbn, tytul, autor, stron, wydawnictwo, rok_wydania, opis, keywords, dostepnosc)
VALUES (NULL, '$kategoria', '$sygnatura', '$tytul', '$autor', '$stron', '$wydawnictwo', '$rok', '$opis', '$keywords', '');");

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
