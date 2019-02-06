<?php

//polaczenie z db

require_once "connect.php"; //by moć pobrać dane do logowania

include('polaczenie.php');

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else{

  // funkcja walidacji
  function validate($str) {
    // trim -Remove characters from both sides of a string
  	return trim(htmlspecialchars($str)); /*przeszukują ciąg znaków, podany jako argument, w celu znalezienia znaczników HTML i PHP.
     HTMLSPECIALCHARS zamienia znaki specialne (<,>,’,”,&) na ich „bezpieczne odpowiedniki”. */
  }

  $tytul = validate($_POST['tytul']);
  if (strlen($tytul) > 100) {  // Return the length of the string
  	echo "Za długi tytuł";
    exit();
  }
  $autor = validate($_POST['autor']);
  if (strlen($autor) > 100) {  // Return the length of the string
    echo "Za długi - autor";
    exit();
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

  $tytul = htmlentities($tytul, ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
  $autor = htmlentities($autor, ENT_QUOTES, "UTF-8");
  $keywords = htmlentities($keywords, ENT_QUOTES, "UTF-8");
  $rok = htmlentities($rok, ENT_QUOTES, "UTF-8");

  $tabela = "ksiazka";

  $lp = 1;

  if (isset($tytul) && !empty($tytul)){

      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajTytul ('$tytul')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){


        $id_ksiazka = $wiersz ['id_ksiazka'];
        $id_kategoria = $wiersz ['id_kategoria'];
        $isbn = $wiersz ['isbn'];
        $tytul = $wiersz ['tytul'];
        $autor = $wiersz ['autor'];
        $stron = $wiersz ['stron'];
        $wydawnictwo = $wiersz ['wydawnictwo'];
        $rok_wydania = $wiersz ['rok_wydania'];
        $opis = $wiersz ['opis'];
        $keywords = $wiersz ['keywords'];
        $dostepnosc = $wiersz ['dostepnosc'];
        $tabela2 = "kategoria";

        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        print '
        <TR>
          <TD>'; echo $lp; print'</TD><TD>'; echo $tytul; print'</TD><TD>'; echo $autor; print'</TD><TD>';
          echo $kategoria; print'</TD><TD>'; echo $wydawnictwo; print'</TD><TD>'; echo $rok_wydania; print'</TD><TD>';
          echo $stron;  print'</TD><TD>'; echo $opis; print'</TD><TD>'; echo $keywords;

            print'
            </TD><TD><a href="./controllers/zamowienie_dodaj.php?id_ksiazka='; echo $id_ksiazka;
            print'">Zamów i wypożycz</a></br>';

          if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
          {
            if ($dostepnosc == "Tak"){
              echo '<br>Dostępna<br>';
              print '<img src="./views/img/dostepnosc.png" class="icon" alt="Img dostp?" ';
            }
          }
          print'
          </TR>
          ';

        $lp ++;
      }

  }

  if (isset($autor) && !empty($autor)){

      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajAutor('$autor')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){

        $id_ksiazka = $wiersz ['id_ksiazka'];
        $id_kategoria = $wiersz ['id_kategoria'];
        $isbn = $wiersz ['isbn'];
        $tytul = $wiersz ['tytul'];
        $autor = $wiersz ['autor'];
        $stron = $wiersz ['stron'];
        $wydawnictwo = $wiersz ['wydawnictwo'];
        $rok_wydania = $wiersz ['rok_wydania'];
        $opis = $wiersz ['opis'];
        $keywords = $wiersz ['keywords'];
        $dostepnosc = $wiersz ['dostepnosc'];
        $tabela2 = "kategoria";

        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        print '
        <TR>
          <TD>'; echo $lp; print'</TD><TD>'; echo $tytul; print'</TD><TD>'; echo $autor; print'</TD><TD>';
          echo $kategoria; print'</TD><TD>'; echo $wydawnictwo; print'</TD><TD>'; echo $rok_wydania; print'</TD><TD>';
          echo $stron;  print'</TD><TD>'; echo $opis; print'</TD><TD>'; echo $keywords; print'
          </TD><TD><a href="./controllers/zamowienie_dodaj.php?id_ksiazka='; echo $id_ksiazka;
          print'">Zamów i wypożycz</a></br>';
          if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
          {
            if ($dostepnosc == "Tak"){
              echo '<br>Dostępna<br>';
              print '<img src="./views/img/dostepnosc.png" class="icon" alt="Img dostp?" ';
            }
          }
          print'
          </TR>
          ';

        $lp ++;
      }

  }

  if (isset($keywords) && !empty($keywords)){

      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajKeyword('$keywords')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){


        $id_ksiazka = $wiersz ['id_ksiazka'];
        $id_kategoria = $wiersz ['id_kategoria'];
        $isbn = $wiersz ['isbn'];
        $tytul = $wiersz ['tytul'];
        $autor = $wiersz ['autor'];
        $stron = $wiersz ['stron'];
        $wydawnictwo = $wiersz ['wydawnictwo'];
        $rok_wydania = $wiersz ['rok_wydania'];
        $opis = $wiersz ['opis'];
        $keywords = $wiersz ['keywords'];
        $dostepnosc = $wiersz ['dostepnosc'];
        $tabela2 = "kategoria";

        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        print '
        <TR>
          <TD>'; echo $lp; print'</TD><TD>'; echo $tytul; print'</TD><TD>'; echo $autor; print'</TD><TD>';
          echo $kategoria; print'</TD><TD>'; echo $wydawnictwo; print'</TD><TD>'; echo $rok_wydania; print'</TD><TD>';
          echo $stron;  print'</TD><TD>'; echo $opis; print'</TD><TD>'; echo $keywords; print'
          </TD><TD><a href="./controllers/zamowienie_dodaj.php?id_ksiazka='; echo $id_ksiazka;
          print'">Zamów i wypożycz</a></br>';
          if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
          {
            if ($dostepnosc == "Tak"){
              echo '<br>Dostępna<br>';
              print '<img src="./views/img/dostepnosc.png" class="icon" alt="Img dostp?" ';
            }
          }
          print'
          </TR>
          ';

        $lp ++;
      }

  }


  if (isset($rok) && !empty($rok)){

      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajRok('$rok')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){

        $id_ksiazka = $wiersz ['id_ksiazka'];
        $id_kategoria = $wiersz ['id_kategoria'];
        $isbn = $wiersz ['isbn'];
        $tytul = $wiersz ['tytul'];
        $autor = $wiersz ['autor'];
        $stron = $wiersz ['stron'];
        $wydawnictwo = $wiersz ['wydawnictwo'];
        $rok_wydania = $wiersz ['rok_wydania'];
        $opis = $wiersz ['opis'];
        $keywords = $wiersz ['keywords'];
        $dostepnosc = $wiersz ['dostepnosc'];
        $tabela2 = "kategoria";

        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        print '
        <TR>
          <TD>'; echo $lp; print'</TD><TD>'; echo $tytul; print'</TD><TD>'; echo $autor; print'</TD><TD>';
          echo $kategoria; print'</TD><TD>'; echo $wydawnictwo; print'</TD><TD>'; echo $rok_wydania; print'</TD><TD>';
          echo $stron;  print'</TD><TD>'; echo $opis; print'</TD><TD>'; echo $keywords; print'
          </TD><TD><a href="./controllers/zamowienie_dodaj.php?id_ksiazka='; echo $id_ksiazka;
          print'">Zamów i wypożycz</a></br>';
          if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
          {
            if ($dostepnosc == "Tak"){
              echo '<br>Dostępna<br>';
              print '<img src="./views/img/dostepnosc.png" class="icon" alt="Img dostp?" ';
            }
          }
          print'
          </TR>
          ';

        $lp ++;
      }

  }
  if ($lp < 2){     // brak wyników?
    print '</br><span style="color:red">Brak wyników</span></br>';
  }
}
