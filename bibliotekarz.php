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
/*
    // zalogowany jako??
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
      print '<p align = "right">';
      echo "Witaj ".$_SESSION['user'];
      print '<br><a href = "./controllers/logout.php">Wyloguj</a></br>';
      print '</p>';
    }
*/
  ?>

<nav>
  <?php include('nav.php'); ?>
</nav>


<!--
<div class="main-content">


    <div class="home page" >
-->
<main>
<div class="container">

      <?php
      if(isset($_SESSION['blad']))    echo $_SESSION['blad'];

      ?>


            <div class="row">
              <div class="col-sm-6 col-md-5 offset-md-1">
                <?php
/*
                if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
                {
                  print '<br><a href = "./controllers/logout.php">Wyloguj</a></br>';
                }
*/
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
                  $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE bibliotekarz_id = '$id' ");

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
      <!--
                <TR>
                  <TD>Imię: </TD><TD>Jan</TD>
                </TR>
                <TR>
                  <TD>Nazwisko: </TD><TD>Kowalski</TD>
                </TR>
                <TR>
                  <TD>Adres: </TD><TD>ul. Zielona 4, Londek Zdrój</TD>
                </TR>
                <TR>
                  <TD>Adres e-mail: </TD><TD>jan@kowalski.pl</TD>
                </TR>
      -->

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

            /*
                print '
                <TR>
                  <TD>Imię: </TD><TD>';  echo $bibliotekarz_imie; print'</TD>
                </TR>
                <TR>
                  <TD>Nazwisko: </TD><TD>'; echo $bibliotekarz_nazwisko; print'</TD>
                </TR>
                <TR>
                  <TD>Adres: </TD><TD>'; echo $bibliotekarz_ulica; echo " "; echo $bibliotekarz_miasto;  print'</TD>
                </TR>
                <TR>
                  <TD>Adres e-mail: </TD><TD>'; echo $bibliotekarz_email; print'</TD>
                </TR>
                ';
            */
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
<!--
                <TR>
                  <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD>
                    <a href="./controllers/zam_wypozycz.php">Wypożycz</a></br>
                    </TD>
                </TR>
-->
                <!-- TODO obsługa -->
                <?php
                $tabela = "zamowienie";
                  $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela");

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
                        $rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_ksiazka = '$id_ksiazka' ");
                        $wiersz2 = mysqli_fetch_array ($rezultat2);
                        $isbn = $wiersz2 ['isbn'];
                        $tytul = $wiersz2 ['tytul'];
                        $autor = $wiersz2 ['autor'];

                        $tabela3 = "czytelnik";
                        $rezultat3 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela3 WHERE id_czytelnik = '$id_czytelnik' ");
                        $wiersz3 = mysqli_fetch_array ($rezultat3);
                        $imie_czytelnik = $wiersz3 ['imie_czytelnik'];
                        $nazwisko_czytelnik = $wiersz3 ['nazwisko_czytelnik'];

                        /*
                        // pobieranie danych książek  z tab ksiazki
                        $tabela = 'ksiazki';
                        $rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE sygnatura = '$zamowienie_sygnatura' ");
                        while ($wiersz = mysqli_fetch_array ($rezultat2)){
                          $zamowienie_tytul = $wiersz ['tytul'];
                          $zamowienie_autor = $wiersz ['autor'];
                          $zamowienie_rok_wydania = $wiersz ['rok_wydania'];
                        }

                        $tabela = 'wypozyczone';
                        $rezultat3 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE sygnatura = '$zamowienie_sygnatura' ");
                        while ($wiersz = mysqli_fetch_array ($rezultat2)){
                          $zamowienie_data_oddania = $wiersz ['data_oddania']; //  z tabeli wypozyczone
                        }
                        */

                      //  $zamowienie_tytul = $wiersz ['zamowienie_tytul']; // TODO potem ma pobierać z tabeli ksiazki
                      //  $zamowienie_autor = $wiersz ['zamowienie_autor']; // TODO potem ma pobierać z tabeli ksiazki


                        print "
                        <TR>
                          <TD>$lp</TD><TD>$tytul</TD><TD>$autor</TD><TD>$data_zamowienia</TD><TD>$data_odbioru</TD><TD>$data_zwrotu</TD><TD>$isbn</TD>
                          <TD>$imie_czytelnik</TD><TD>$nazwisko_czytelnik</TD>
                          <TD>";
                          print'
                            <a href="./controllers/zam_rezygnuj.php?id_ksiazka='; echo $id_ksiazka;
                            print'">Rezygnuj z zamówienia</a></br>
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
<!--
                <TR>
                  <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD>
                    <a href="./controllers/przedluz.php">Prolongata</a></br>
                    </TD>
                </TR>
-->
                <?php
                $tabela = "wypozyczenia";
                  $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela");

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
                        $rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_ksiazka = '$id_ksiazka' ");
                        $wiersz2 = mysqli_fetch_array ($rezultat2);
                        $isbn = $wiersz2 ['isbn'];
                        $tytul = $wiersz2 ['tytul'];
                        $autor = $wiersz2 ['autor'];

                        $tabela3 = "czytelnik";
                        $rezultat3 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela3 WHERE id_czytelnik = '$id_czytelnik' ");
                        $wiersz3 = mysqli_fetch_array ($rezultat3);
                        $imie_czytelnik = $wiersz3 ['imie_czytelnik'];
                        $nazwisko_czytelnik = $wiersz3 ['nazwisko_czytelnik'];

                        /*
                        // pobieranie danych książek  z tab ksiazki
                        $tabela = 'ksiazki';
                        $rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE sygnatura = '$zamowienie_sygnatura' ");
                        while ($wiersz = mysqli_fetch_array ($rezultat2)){
                          $zamowienie_tytul = $wiersz ['tytul'];
                          $zamowienie_autor = $wiersz ['autor'];
                          $zamowienie_rok_wydania = $wiersz ['rok_wydania'];
                        }

                        $tabela = 'wypozyczone';
                        $rezultat3 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE sygnatura = '$zamowienie_sygnatura' ");
                        while ($wiersz = mysqli_fetch_array ($rezultat2)){
                          $zamowienie_data_oddania = $wiersz ['data_oddania']; //  z tabeli wypozyczone
                        }
                        */

                      //  $zamowienie_tytul = $wiersz ['zamowienie_tytul']; // TODO potem ma pobierać z tabeli ksiazki
                      //  $zamowienie_autor = $wiersz ['zamowienie_autor']; // TODO potem ma pobierać z tabeli ksiazki

                        print "
                        <TR>
                          <TD>$lp</TD><TD>$tytul</TD><TD>$autor</TD><TD>$data_wypozyczenia</TD><TD>$data_odbioru</TD><TD>$data_zwrotu</TD><TD>$isbn</TD>
                          <TD>$imie_czytelnik</TD><TD>$nazwisko_czytelnik</TD>
                          <TD>";
                          print'
                            <a href="./controllers/przedluz.php?id_ksiazka='; echo $id_ksiazka;
                            print'">Prolongata</a></br>
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
  <!--      </div>
  </div> -->
    </div>
  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
