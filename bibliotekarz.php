<html>
  <head>
    <?php include('head.php'); ?>
  </head>

<body>
  <?php
  @session_start();
  require_once "./controllers/connect.php";
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

                if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
                {
                  print '<br><a href = "./controllers/logout.php">Wyloguj</a></br>';
                }
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
                <!-- TODO pobierani z BD danych -->
                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
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
                  <?php include("./controllers/dodaj_czytelnka.php"); ?>
              </div>

              <div id = "zamowione">
                <h3> Zamówione </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data zamówienia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD> </TD>
                </TR>

                <TR>
                  <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD>
                    <a href="./controllers/zam_wypozycz.php">Wypożycz</a></br>
                    </TD>
                </TR>
                </TABLE>
                <br>
              </div>

              <div id = "wypozyczone">
                <h3> Wypożyczone </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data wypożyczenia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD> </TD>
                </TR>

                <TR>
                  <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                  <TD>Imię czytelnika</TD><TD>Nazwisko czytelnika</TD>
                  <TD>
                    <a href="./controllers/przedluz.php">Prolongata</a></br>
                    </TD>
                </TR>
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
