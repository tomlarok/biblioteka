<form class="form" id="Form_dodaj_ksiazke" name="Form_dodaj_ksiazke" method="POST" action="./controllers/ksiazka_dodaj.php">
  <!-- <form class="form" id="Formularz_wyszukaj" name="Formularz_wyszukaj" method="POST" action="./controllers/wyszukaj.php"> -->
<br>

    Tytuł:
    <input type="text" name="tytul" maxlength="70" size="70" id="tytul" /><br>
    Autor:
    <input type="text" name="autor" maxlength="70" size="70" id="autor" /><br>
    Sygnatura (ISBN):
    <input type="text" name="sygnatura" maxlength="70" size="70" id="sygnatura" /><br>
    Wydawnictwo:
    <input type="text" name="wydawnictwo" maxlength="70" size="70" id="wydawnictwo" /><br>
    Kategoria:
    <input type="text" name="kategoria" maxlength="70" size="70" id="kategoria" /><br>
    Słowa kluczowe:
    <input type="text" name="keywords" maxlength="70" size="70" id="keywords" /><br>
    Opis:
    <input type="text" name="opis" maxlength="100" size="100" id="opis" /><br>
    Liczba stron:
    <input type="text" name="stron" maxlength="7" size="20" id="stron" /><br>
    Rok:
    <input type="text" name="rok" maxlength="4" size="20" id="rok" /><br>

  <input type="submit" value="Dodaj" class="button" id="button" />
  </form>
