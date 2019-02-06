<?php

    session_start();
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

    //  echo "Witaj";
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

$user = $_SESSION['user'];
$id = $_SESSION['id'];

  //połączenie z BD

include('./controllers/polaczenie.php');

  ?>

    <!-- Banner -->
  <?php include('banner.php'); ?>

  <?php include('nav.php'); ?>

<main>
<div class="container">

      <?php
      if(isset($_SESSION['blad']))    echo $_SESSION['blad'];

      ?>
      <div>
  <!--      <figure>
        Biblioteka - zapraszamy!
        </figure> -->
        <br>
      </div>


        <div class="row">
            <div class="col-sm-6 col-md-5  offset-md-1">

              <div id= "wyszukiwarka">
                <h3> Wyszukiwarka książek </h3>
                <?php include('wyszukiwarka.php'); ?>
              </div>
            </div>

            <div class="col-sm-6 col-md-5">
              <div id = "moje_dane" >
                <h3> Bibliotekarz </h3>
                <!-- pobieranie z BD danych -->
                <?php

                $tabela = "bibliotekarze";

                  try{
                  $rezultat = mysqli_query ($polaczenie, "CALL bibliotekarz_S('$id')");
                      $wiersz = mysqli_fetch_array ($rezultat);
                    } catch  (Exception $e) {
                      echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
                    }
                        $id_bibliotekarz = $wiersz ['id_bibliotekarz'];
                        $bibliotekarz_imie = $wiersz ['bibliotekarz_imie'];
                        $bibliotekarz_nazwisko = $wiersz ['bibliotekarz_nazwisko'];
                        $bibliotekarz_ulica = $wiersz ['bibliotekarz_ulica'];
                        $bibliotekarz_miasto  = $wiersz ['bibliotekarz_miasto'];
                        $bibliotekarz_kod = $wiersz ['bibliotekarz_kod'];
                        $bibliotekarz_email = $wiersz ['bibliotekarz_email'];

                 ?>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela">
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
                  include('./controllers/termin_wypozyczen.php');
              ?>

                </TABLE>

                <br>
              </div>  <!-- end moje dane - bibliotekarz -->
            </div>
              <!-- Szukaj po id -> przjedź do profilu -->
            <div class="col-sm-6 col-md-5  offset-md-1">
              <div id = "bib-szukaj-czyt">
                <?php include("./controllers/szukaj_czytelnika_form.php"); ?>
              </div>
            </div>

            <div class="col-sm-6 col-md-5">
              <div id = "bib-dodaj-czyt">
                <h3> Dodaj czytelnika <h3>
                  <?php include("./controllers/dodaj_czytelnika.php"); ?>
              </div>
            </div>

          </div> <!-- end div row -->

            <div class="col-sm-6 col-md-5">
              <div id = "zamowione">
                <h3> Zamówione </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data zamówienia</TD><TD>Data odbioru</TD><TD>Sygantura</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD> </TD>
                </TR>

                <?php
                $tabela = "zamowienie";
                try{
                $polaczenie->next_result(); // using sprocs have to do this before next call !

                  $rezultat = mysqli_query ($polaczenie, "CALL bibliotekarz_zamowienia()");

                } catch  (Exception $e) {
                  echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
                }
                  $lp = 1;

                    while ($wiersz = mysqli_fetch_array ($rezultat)){

                        $id_zamowienie = $wiersz ['id_zamowienie'];
                        $id_czytelnik = $wiersz ['id_czytelnik'];
                        $id_ksiazka = $wiersz ['id_ksiazka'];
                        $data_odbioru = $wiersz ['data_odbioru'];
                        $data_zwrotu = $wiersz ['data_zwrotu'];
                        $data_zamowienia = $wiersz ['data_zamowienia'];

                        $isbn = $wiersz ['isbn'];
                        $tytul = $wiersz ['tytul'];
                        $autor = $wiersz ['autor'];

                        $imie_czytelnik = $wiersz ['imie_czytelnik'];
                        $nazwisko_czytelnik = $wiersz ['nazwisko_czytelnik'];

                        print "
                        <TR>
                          <TD>$lp</TD><TD>$tytul</TD><TD>$autor</TD><TD>$data_zamowienia</TD><TD>$data_odbioru</TD><TD>$isbn</TD>
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

                <TABLE CELLPADDING=5 BORDER=1 class="tabela">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data wypożyczenia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD> </TD>
                </TR>

                <?php
                $tabela = "wypozyczenia";
                try{
                $polaczenie->next_result();

                  $rezultat = mysqli_query ($polaczenie, "CALL bibliotekarz_wypozyczenia()");
                } catch  (Exception $e) {
                  echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
                }
                  $lp = 1;

                    while ($wiersz = mysqli_fetch_array ($rezultat)){

                        $id_wypozyczenia = $wiersz ['id_wypozyczenia'];
                        $id_czytelnik = $wiersz ['id_czytelnik'];
                        $id_ksiazka = $wiersz ['id_ksiazka'];
                        $data_wypozyczenia = $wiersz ['data_wypozyczenia'];
                        $data_zwrotu = $wiersz ['data_zwrotu'];

                        $isbn = $wiersz ['isbn'];
                        $tytul = $wiersz ['tytul'];
                        $autor = $wiersz ['autor'];

                        $imie_czytelnik = $wiersz ['imie_czytelnik'];
                        $nazwisko_czytelnik = $wiersz ['nazwisko_czytelnik'];

                        print "
                        <TR>
                          <TD>$lp</TD><TD>$tytul</TD><TD>$autor</TD><TD>$data_wypozyczenia</TD><TD>$data_zwrotu
                          ";
                          $wypozyczone_data_zwrotu = $data_zwrotu;
                          spr_termin($wypozyczone_data_zwrotu);
                          print "
                          </TD><TD>$isbn</TD>
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

        </div> <!-- end div container -->
  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
