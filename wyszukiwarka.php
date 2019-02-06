<form class="form" id="Formularz_wyszukaj" name="Formularz_wyszukaj" method="POST" action="./lista_wyszukiwania.php">

<br>
  
    Tytuł:
    <input type="text" name="tytul" maxlength="70" size="40" id="tytul" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
    Autor:
    <input type="text" name="autor" maxlength="70" size="40" id="autor" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
    Słowa kluczowe:
    <input type="text" name="keywords" maxlength="40" size="40" id="keywords" pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" /><br>
    Rok:
    <input type="text" name="rok" maxlength="4" size="20" id="rok" pattern="^\d{4}" title="Podaj rok składający się z 4 cyfr" /><br>


  <input type="submit" value="Szukaj" class="button" id="button" />
  </form>
