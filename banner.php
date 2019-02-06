<div class="links-up">

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>

            </div>
            <div class="modal-body">
              <h3 class = "logText"> Rejestacja </h3></br>

            <form class="form" id="Formularz_rejestracja" name="Formularz_rejestracja" method="POST" action="./controllers/rejestracja_dodaj.php">
            <br>

                Login:
                <input type="text" name="rejestracja_login" maxlength="20" size="20" id="rejestracja_login" required pattern="[a-zA-Z0-9\s]+"
                 title="Login może zawierać tylko znaki alfanumeryczne" /><br>
                Hasło:
                <input type="password" name="rejestracja_haslo" maxlength="20" size="20" id="rejestracja_haslo" required /><br>
                <!--  Powtórzenie i spr hasla -->
                Powtórz hasło:
                <input type="password" name="rejestracja_haslo_spr" maxlength="20" size="20" id="rejestracja_haslo_spr" required /><br>


              <input type="submit" value="Utwórz konto" class="button" id="button" />
              </form>

          </br>

          </div>  <!-- class="modal-body" -->

          </div> <!-- end class="modal-content -->
        </div> <!-- class="modal-dialog -->
      </div> <!-- class="modal fade -->

      <!-- Logowanie -->

      <!-- Modal -->
      <div class="modal fade" id="myModalLog" tabindex="-1" role="dialog" aria-labelledby="myModalLabelLog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>

            </div>
            <div class="modal-body">
              <h3 class = "logText"> Logowanie </h3></br>

            <form class="form" id="Formularz_logowania" name="Formularz_logowania" method="POST" action="./controllers/logowanie.php">
            <br>
                Login:
                <input type="text" name="login" maxlength="20" size="20" id="log_login" required
                pattern="[a-zA-Z0-9\s]+" title="Login może zawierać tylko znaki alfanumeryczne" /><br>
                Hasło:
                <input type="password" name="password" maxlength="20" size="20" id="log_password" required /><br>

              <input type="submit" value="OK" class="button" id="button" />
              </form>

          </br>

          <?php
          if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
          ?>
            </div>

          </div>  <!-- end class="modal-content -->
        </div>  <!-- class="modal-dialog -->
      </div>  <!-- class="modal fade -->

</div>
<?php
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{

 echo "Witaj ";
 $user = $_SESSION['user'];
 echo $user;
 echo "<br>";
} else {
// exit(); //wyjscie z strony bez wczytania ponizszych linijek kodu
}
?>

<img src= "./views/img/logo_750_200.png" class="logo" alt="Brak loga?" />
