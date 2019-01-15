<?php

/*
session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

    } else{
        header('Location: ../index.php');
        exit(); //wyjscie z strony bez wczytania ponizszych linije kodu
    }
*/

//polaczenie z db

require_once "connect.php"; //by moć pobrać dane do logowania

$polaczenie = mysqli_connect ($db_host, $db_user, $db_password);
mysqli_select_db ($polaczenie, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else{


  $tytul = $_POST['tytul'];
  $autor = $_POST['autor'];
  $keywords = $_POST['keywords'];
  $rok = $_POST['rok'];

  $tytul = htmlentities($tytul, ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
  $autor = htmlentities($autor, ENT_QUOTES, "UTF-8");
  $keywords = htmlentities($keywords, ENT_QUOTES, "UTF-8");
  $rok = htmlentities($rok, ENT_QUOTES, "UTF-8");

// TODO Wyświetlanie dostępności książki dla zalogowanych

  $tabela = "ksiazka";

  // wartosci boolean dla znalezien po tytule, autorze ...

  //if (!isset($_POST['tytul']))

//  if (!empty($tytul))
  $lp = 1;

  if (isset($tytul) && !empty($tytul)){
      //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE tytul = '$tytul' ");
      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajTytul ('$tytul')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){
    //  $wiersz = mysqli_fetch_array ($rezultat);

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
        //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_kategoria = '$id_kategoria' ");
        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        //$keywords = "BRAK";


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
    //  exit();
  }

  if (isset($autor) && !empty($autor)){
      //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE autor = '$autor' ");
      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajAutor('$autor')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){
    //  $wiersz = mysqli_fetch_array ($rezultat);

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
        //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_kategoria = '$id_kategoria' ");
        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        //$keywords = "BRAK";


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
    //  exit();
  }

  if (isset($keywords) && !empty($keywords)){
      //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE keywords = '$keywords' ");
      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajKeyword('$keywords')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){
    //  $wiersz = mysqli_fetch_array ($rezultat);

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
        //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_kategoria = '$id_kategoria' ");
        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        //$keywords = "BRAK";


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
  //    exit();
  }


  if (isset($rok) && !empty($rok)){
      //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE rok_wydania = '$rok' ");
      $rezultat = mysqli_query ($polaczenie, "CALL wyszukajRok('$rok')");

      while ($wiersz = @mysqli_fetch_array ($rezultat)){
    //  $wiersz = mysqli_fetch_array ($rezultat);

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
        //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_kategoria = '$id_kategoria' ");
        $polaczenie->next_result();
        $rezultat2 = mysqli_query ($polaczenie, "CALL wyszukajKategoria('$id_kategoria')");
        $wiersz2 = mysqli_fetch_array ($rezultat2);
        $kategoria = $wiersz2 ['nazwa'];

        //$keywords = "BRAK";


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
  //    exit();
  }
}


  /*
    if($ins){
    }
  */
    // if tytul == null select

  // if autor

  // if keywords

  // if rok
