      <button class="button" data-toggle="modal" data-target="#myModal_Dodaj_Czyt" id="button">Dodaj czytelnika</button>

<!-- Modal -->
<div class="modal fade" id="myModal_Dodaj_Czyt" tabindex="-1" role="dialog" aria-labelledby="myModal_Dodaj_Czyt" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>

      </div>
      <div class="modal-body">
        <h3 class = "logText"> Dodaj czytelnika </h3></br>

      <form class="form" id="form_dodaj_czytelnika" name="form_dodaj_czytelnika" method="POST" action="./controllers/czytelnik_dodaj.php">
      <br>
          Imię:</br>
          <input type="text" name="imie_dodaj" maxlength="40" size="40" id="imie_dodaj" required
          pattern="[a-zA-Z0-9\s |ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" title="Imię może zawierać tylko znaki alfanumeryczne" /><br>
          Nazwisko:</br>
          <input type="text" name="nazwisko_dodaj" maxlength="40" size="40" id="nazwisko_dodaj" required
          pattern="[a-zA-Z0-9\s |ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" title="Nazwisko może zawierać tylko znaki alfanumeryczne" /><br>
          Adres:</br>
          <input type="text" name="adres_dodaj" maxlength="40" size="40" id="adres_dodaj" required
          pattern="([a-zA-Z0-9| |/|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" title="Podaj poprawny adres" /><br>
          E-mail:</br>
          <input type="email" name="email_dodaj" maxlength="40" size="40" id="email_dodaj" required /><br>
          <!-- Login z systemu logowania konta -->
          Login:</br>
          <input type="text" name="login" maxlength="40" size="40" id="login" required
          pattern="[a-zA-Z0-9\s]+" title="Login może zawierać tylko znaki alfanumeryczne" /><br>

        <input type="submit" value="Dodaj czytelnika" class="button" id="button" />
        </form>

    </br>

    <?php
    if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
    ?>
      </div>

    </div> <!-- end class="modal-content -->
  </div>  <!-- class="modal-dialog modal-lg" -->
</div>  <!-- class="modal fade -->
