<div class="links-up">
    <!-- Tworzenie konta -->
              <!-- Przycisk uruchamiający modal -->
      <button class="button" data-toggle="modal" data-target="#myModal" id="button">
      <!-- <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="button"> -->
        Załóż konto
      </button>
<?php
  if (!isset($_SESSION['zalogowany']))
  //  if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
  {
    print '<button class="button" data-toggle="modal" data-target="#myModalLog" id="button">';
    /*<!--   <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalLog" id="button"> -->*/
    print 'Zaloguj się';
    print'</button>';
  } else {
    print '<a href = "./controllers/logout.php"';
    //    print '<button class="button" id="button" action="./controllers/logout.php">';
    print '<button class="button" id="button">';
    print 'Wyloguj';
    print'</button></a>';
  //  print '<br><a href = "./controllers/logout.php">Wyloguj</a></br>';
  }
?>



      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
      <!--        <h4 class="modal-title" id="myModalLabel">Stwórz konto</h4> -->
            </div>
            <div class="modal-body">
              <h3 class = "logText"> Rejestacja </h3></br>

            <form class="form" id="Formularz_rejestracja" name="Formularz_rejestracja" method="POST" action="./controllers/rejestracja_dodaj.php">
            <br>
              <!--
                Nazwa :
                <input type="text" name="rejestracja_nazwa" maxlength="20" size="20" id="rejestracja_nazwa" required /><br> -->
                Login:
                <input type="text" name="rejestracja_login" maxlength="20" size="20" id="rejestracja_login" required /><br>
                Hasło:
                <input type="password" name="rejestracja_haslo" maxlength="20" size="20" id="rejestracja_haslo" required /><br>
                <!-- TODO Powtórzeni i spr hasal -->

              <input type="submit" value="Utwórz konto" class="button" id="button" />
              </form>

          </br>

          <?php
          //if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
          ?>
            </div>
            <!--
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
              <button type="button" class="btn btn-primary">Zapisz zmiany</button>
            </div>
          -->
          </div>
        </div>
      </div>

      <!-- Logowanie -->

      <!-- Modal -->
      <div class="modal fade" id="myModalLog" tabindex="-1" role="dialog" aria-labelledby="myModalLabelLog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
      <!--        <h4 class="modal-title" id="myModalLabelLog">Logowanie</h4> -->
            </div>
            <div class="modal-body">
              <h3 class = "logText"> Logowanie </h3></br>

            <form class="form" id="Formularz_rejestracja" name="Formularz_rejestracja" method="POST" action="./controllers/logowanie.php">
            <br>
                Login:
                <input type="text" name="login" maxlength="20" size="20" id="log_login" required /><br>
                Hasło:
                <input type="password" name="password" maxlength="20" size="20" id="log_password" required /><br>

              <input type="submit" value="OK" class="button" id="button" />
              </form>

          </br>

          <?php
          if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
          ?>
            </div>
            <!--
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
              <button type="button" class="btn btn-primary">Zapisz zmiany</button>
            </div>
          -->
          </div>
        </div>
      </div>

</div>
<?php
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
 //  header('Location: index.php');
  // exit(); //wyjscie z strony bez wczytania ponizszych linijek kodu
 echo "Witaj ";
 $user = $_SESSION['user'];
 echo $user;
 echo "<br>";
} else {
// header('Location: index.php');
// exit(); //wyjscie z strony bez wczytania ponizszych linijek kodu
}
?>

<img src= "./views/img/logo.png" class="logo" alt="Brak loga?" />

<ul id="mainmenu" class="panel topnav">
  <li><a class="mainmenu-item" href="index.php">Strona Główna</a></li>
  <li><a class="mainmenu-item" href="index.php#wyszukiwarka">Katalog  online</a></li>
  <li><a class="mainmenu-item" href="index.php#kontakt">Kontakt</a></li> <!-- <li><a class="mainmenu-item" href="index.php/#kontakt">Kontakt</a></li> -->
  <li><a class="mainmenu-item" href="index.php#o_nas">O nas</a></li>
  <?php
  if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
  {
    //    if (!isset($_COOKIE['bibliotekarz'])){
  //  if (isset($_COOKIE['bibliotekarz'])){ // TODO czemu nie widzi ciacha??
    if ( substr($user, 0, 12) == ("bibliotekarz"))
    {
      print '
      <li><a class="mainmenu-item" href="bibliotekarz.php">Bibliotekarz konto</a></li>
      ';
    }else{
      print '
      <li><a class="mainmenu-item" href="czytelnik.php">Moje konto</a></li>
      ';

    }
  }
  ?>
</ul>


<?php

?>
