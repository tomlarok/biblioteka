<?php

    session_start();

    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true) && isset($_COOKIE['bibliotekarz']))
    {

      echo "Witaj";
    } else {
      header('Location: index.php');
      exit(); //wyjscie z strony bez wczytania ponizszych linijek kodu
    }


?>

<html>
  <head>
    <?php include('head.php'); ?>
  </head>

<body>
  <?php
  @session_start();
  require_once "./controllers/connect.php";
// TODO user id??
$user = $_SESSION['user'];
$id = $_SESSION['id'];

  //połączenie z BD
  $polaczenie = @new mysqli($db_host, $db_user, $db_password, $db_name);

  ?>

<nav>
  <?php include('nav.php'); ?>
</nav>


<main>
<div class="container">

      <?php
      if(isset($_SESSION['blad']))    echo $_SESSION['blad'];

      ?>


            <div class="row">
              <div class="col-sm-6 col-md-5 offset-md-1">
                <?php

                ?>

            </div>

            <div class="col-sm-6 col-md-5">
              <figure>
              Biblioteka - zapraszamy!
            </figure>
            </div>

            <div class="col-sm-6 col-md-5">

              <div id= "wyszukiwarka">
                <h3> Wyszukiwarka książek </h3>
                <?php include('wyszukiwarka.php'); ?>
              </div>

              <div id = "moje_dane">
                <h3> Bibliotekarz </h3>
                <!-- TODO pobieranie z BD danych -->
                <?php

                $tabela = "bibliotekarze";
                  //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE bibliotekarz_id = '$id' ");
                  $rezultat = mysqli_query ($polaczenie, "CALL bibliotekarz_S('$id')");
                      $wiersz = mysqli_fetch_array ($rezultat);

                        $id_bibliotekarz = $wiersz ['id_bibliotekarz'];
                        $bibliotekarz_imie = $wiersz ['bibliotekarz_imie'];
                        $bibliotekarz_nazwisko = $wiersz ['bibliotekarz_nazwisko'];
                        $bibliotekarz_ulica = $wiersz ['bibliotekarz_ulica'];
                        $bibliotekarz_miasto  = $wiersz ['bibliotekarz_miasto'];
                        $bibliotekarz_kod = $wiersz ['bibliotekarz_kod'];
                        $bibliotekarz_email = $wiersz ['bibliotekarz_email'];
                      //  $nr_login = $wiersz ['id'];
                 ?>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">


                <TR>
                  <TD>Imię: </TD><TD><?php  echo $bibliotekarz_imie; ?></TD>
                </TR>
                <TR>
                  <TD>Nazwisko: </TD><TD><?php echo $bibliotekarz_nazwisko; ?></TD>
                </TR>
                <TR>
                  <TD>Adres: </TD><TD><?php echo $bibliotekarz_ulica; echo " "; echo $bibliotekarz_miasto; ?></TD>
                </TR>
                <TR>
                  <TD>Adres e-mail: </TD><TD><?php echo $bibliotekarz_email; ?></TD>
                </TR>

                <?php


                ?>

                </TABLE>

                <br>
              </div>

              <div id = "bib-szukaj-czyt">
                <h3> Szukaj czytelnika <h3>
                <form class="form" id="form_szukaj_czyt" name="form_szukaj_czyt" method="POST" action="./czytelnik.php">
                  <input type="text" name="szukaj_czyt_id" maxlength="10" size="10" id="szukaj_czyt_id" required /><br>
                  <input type="submit" value="OK" class="button" id="button" />
                </form>
              </div>

              <div id = "bib-dodaj-czyt">
                <h3> Dodaj czytelnika <h3>
                  <?php include("./controllers/dodaj_czytelnika.php"); ?>
              </div>

              <div id = "zamowione">
                <h3> Zamówione </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data zamówienia</TD><TD>Data odbioru</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD> </TD>
                </TR>

                <!-- TODO obsługa proc structured-->
                <?php
                $tabela = "zamowienie";
                $polaczenie->next_result(); // using sprocs have to do this before next call !
                  //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela");
                  $rezultat = mysqli_query ($polaczenie, "CALL zamowienieS()");

                  $lp = 1;
                    //  $wiersz = mysqli_fetch_array ($rezultat);
                    while ($wiersz = mysqli_fetch_array ($rezultat)){

                        $id_zamowienie = $wiersz ['id_zamowienie'];
                        $id_czytelnik = $wiersz ['id_czytelnik'];
                        $id_ksiazka = $wiersz ['id_ksiazka'];
                        $data_odbioru = $wiersz ['data_odbioru'];
                        $data_zwrotu = $wiersz ['data_zwrotu']; // TODO potem ma pobierać z tabeli wypozyczone ?
                        $data_zamowienia = $wiersz ['data_zamowienia'];
                    //    $zamowienie_sygnatura = $wiersz ['sygnatura']; // zamowienie_sygantura ???
                        $tabela2 = "ksiazka";
                        $polaczenie->next_result();
                        //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_ksiazka = '$id_ksiazka' ");
                        $rezultat2 = mysqli_query ($polaczenie, "CALL bibliotekarz_Sksiazka($id_ksiazka)");
                        $wiersz2 = mysqli_fetch_array ($rezultat2);
                        $isbn = $wiersz2 ['isbn'];
                        $tytul = $wiersz2 ['tytul'];
                        $autor = $wiersz2 ['autor'];

                        $tabela3 = "czytelnik";
                        $polaczenie->next_result();
                        //$rezultat3 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela3 WHERE id_czytelnik = '$id_czytelnik' ");
                        $rezultat3 = mysqli_query ($polaczenie, "CALL bibliotekarz_Sczytelnik($id_czytelnik)");
                        $wiersz3 = mysqli_fetch_array ($rezultat3);
                        $imie_czytelnik = $wiersz3 ['imie_czytelnik'];
                        $nazwisko_czytelnik = $wiersz3 ['nazwisko_czytelnik'];

  

                      //  $zamowienie_tytul = $wiersz ['zamowienie_tytul']; // TODO potem ma pobierać z tabeli ksiazki
                      //  $zamowienie_autor = $wiersz ['zamowienie_autor']; // TODO potem ma pobierać z tabeli ksiazki


                        print "
                        <TR>
                          <TD>$lp</TD><TD>$tytul</TD><TD>$autor</TD><TD>$data_zamowienia</TD><TD>$data_odbioru</TD><TD>$data_zwrotu</TD><TD>$isbn</TD>
                          <TD>$imie_czytelnik</TD><TD>$nazwisko_czytelnik</TD>
                          <TD>";
                          print'
                            <a href="./controllers/zam_rezygnuj.php?id_ksiazka='; echo $id_ksiazka;
                            print'">Rezygnuj z zamówienia</a></br>';
                            include('./controllers/wypozyczanie_bibliotekarz.php');
                            print'
                            </TD>
                        </TR>
                        ';

                        $lp++;
                    }


                ?>


                </TABLE>
                <br>
              </div>

              <div id = "wypozyczone">
                <h3> Wypożyczone </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data wypożyczenia</TD><TD>Data zamówienia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD> </TD>
                </TR>

                <?php
                $tabela = "wypozyczenia";
                $polaczenie->next_result();
                  //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela");
                  $rezultat = mysqli_query ($polaczenie, "CALL wypozyczeniaS()");

                  $lp = 1;
                    //  $wiersz = mysqli_fetch_array ($rezultat);
                    while ($wiersz = mysqli_fetch_array ($rezultat)){

                        $id_wypozyczenia = $wiersz ['id_wypozyczenia'];
                        $id_czytelnik = $wiersz ['id_czytelnik'];
                        $id_ksiazka = $wiersz ['id_ksiazka'];
                        $data_wypozyczenia = $wiersz ['data_wypozyczenia'];
                        $data_zwrotu = $wiersz ['data_zwrotu'];

                    //    $zamowienie_sygnatura = $wiersz ['sygnatura']; // zamowienie_sygantura ???
                        $tabela2 = "ksiazka";
                        $polaczenie->next_result();
                        //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_ksiazka = '$id_ksiazka' ");
                        $rezultat2 = mysqli_query ($polaczenie, "CALL bibliotekarz_Sksiazka($id_ksiazka)");
                        $wiersz2 = mysqli_fetch_array ($rezultat2);
                        $isbn = $wiersz2 ['isbn'];
                        $tytul = $wiersz2 ['tytul'];
                        $autor = $wiersz2 ['autor'];

                        $tabela3 = "czytelnik";
                        $polaczenie->next_result();
                        //$rezultat3 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela3 WHERE id_czytelnik = '$id_czytelnik' ");
                        $rezultat3 = mysqli_query ($polaczenie, "CALL bibliotekarz_Sczytelnik($id_czytelnik)");
                        $wiersz3 = mysqli_fetch_array ($rezultat3);
                        $imie_czytelnik = $wiersz3 ['imie_czytelnik'];
                        $nazwisko_czytelnik = $wiersz3 ['nazwisko_czytelnik'];



                      //  $zamowienie_tytul = $wiersz ['zamowienie_tytul']; // TODO potem ma pobierać z tabeli ksiazki
                      //  $zamowienie_autor = $wiersz ['zamowienie_autor']; // TODO potem ma pobierać z tabeli ksiazki

                        print "
                        <TR>
                          <TD>$lp</TD><TD>$tytul</TD><TD>$autor</TD><TD>$data_wypozyczenia</TD><TD>$data_odbioru</TD><TD>$data_zwrotu</TD><TD>$isbn</TD>
                          <TD>$imie_czytelnik</TD><TD>$nazwisko_czytelnik</TD>
                          <TD>";
                          print'
                            <a href="./controllers/przedluz.php?id_ksiazka='; echo $id_ksiazka;
                            print'">Prolongata</a></br>';
                          print'
                              <a href="./controllers/zwrot.php?id_ksiazka='; echo $id_ksiazka;
                              print'">Zwrot</a></br>';
                          print'
                            </TD>
                        </TR>
                        ';

                        $lp++;
                    }


                ?>


                </TABLE>
                <br>
              </div>


          </div>
          </div>

    </div>
  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
