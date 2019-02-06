<form class="form" id="Form_dodaj_ksiazke" name="Form_dodaj_ksiazke" method="POST" action="./controllers/ksiazka_dodaj.php">

<br>

    Tytuł:
    <input type="text" name="tytul" maxlength="70" size="70" id="tytul" required="Podaj tytuł"
    pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
    title="Może zawierać tylko znaki alfanumeryczne" /><br>
    Autor:
    <input type="text" name="autor" maxlength="70" size="70" id="autor"
    pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
    title="Może zawierać tylko znaki alfanumeryczne" /><br>
    Sygnatura (ISBN):
    <input type="text" name="sygnatura" maxlength="70" size="70" id="sygnatura"
    pattern="[a-zA-Z0-9\s]+" title="Może zawierać tylko znaki alfanumeryczne" /><br>
    Wydawnictwo:
    <input type="text" name="wydawnictwo" maxlength="70" size="70" id="wydawnictwo"
    pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
    title="Numer kategorii" /><br>
    Kategoria:

    <select name="kategoria">
      <?php

      include('polaczenie.php');

      if ($polaczenie->connect_errno!=0)
      {
          echo "Error: ".$polaczenie->connect_errno;
          print '<input type="text" name="kategoria" maxlength="70" size="70" id="kategoria"
              pattern="[0-9\s]+" title="Może zawierać tylko znaki alfanumeryczne" /><br>';
      }
      else{
        try{
        $rezultat = mysqli_query ($polaczenie, "CALL ksiazka_kategoria()");
            $wiersz = mysqli_fetch_array ($rezultat);
          } catch  (Exception $e) {
            echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
          }

              while ($wiersz = mysqli_fetch_array ($rezultat)){
                $id_kategoria = $wiersz ['id_kategoria'];
                $nazwa = $wiersz ['nazwa'];
                print '<option value="'.$id_kategoria.'">'.$id_kategoria.' - '.$nazwa.'</option>';
              }
      }
      ?>

    </select> </br>
    Słowa kluczowe:
    <input type="text" name="keywords" maxlength="70" size="70" id="keywords"
    pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
    title="Może zawierać tylko znaki alfanumeryczne" /><br>
    Opis:
    <input type="text" name="opis" maxlength="100" size="100" id="opis"
    pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+"
    title="Może zawierać tylko znaki alfanumeryczne" /><br>
    Liczba stron:
    <input type="text" name="stron" maxlength="7" size="20" id="stron"
    pattern="[0-9\s]+" title="Podaj liczbę" /><br>
    Rok:
    <input type="text" name="rok" maxlength="4" size="20" id="rok"
    pattern="[0-9\s]+" title="Podaj liczbę" /><br>

  <input type="submit" value="Dodaj" class="button" id="button" />
  </form>
