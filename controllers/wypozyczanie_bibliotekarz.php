<?php
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
  {

  if ( substr($user, 0, 12) == ("bibliotekarz"))
  {
    print '
    <a href="./controllers/wypozycz.php?id_ksiazka='.$id_ksiazka.'&id_czytelnik='.$id_czytelnik;
    print'">Wypożycz</a></br>';
  }

  }else{
    header('Location: ../index.php ');
  }
?>
