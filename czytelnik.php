<?php
/*
    session_start();

    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
      //  header('Location: index.php');
       // exit(); //wyjscie z strony bez wczytania ponizszych linijek kodu
      echo "Witaj";
    } else {
      header('Location: index.php');
      exit(); //wyjscie z strony bez wczytania ponizszych linijek kodu
    }
*/

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
  $polaczenie = @new mysqli($db_host, $db_user, $db_password, $db_name);
/*
  if((isset($_COOKIE['czytelnik'])) && ($_COOKIE['czytelnik']=='zalogowany')) {

      $tabela = "czytelnicy";
        $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_czytelnik = '$id' ");

            $wiersz = mysqli_fetch_array ($rezultat);

              $id_czytelnik = $wiersz ['id_czytelnik'];
              $imie_czytelnik = $wiersz ['imie_czytelnik'];
              $nazwisko_czytelnik = $wiersz ['nazwisko_czytelnik'];
              $adres_czytelnik = $wiersz ['adres_czytelnik'];
              $email_czytelnik = $wiersz ['email_czytelnikk'];

          }
          */

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
<!-- TODO nie działa pod menu nav dla div class- "collapse navbae-colapse"-->
<!--
              <div class="col-sm-6 col-md-5">
                <div class="collapse navbar-collapse" id="mainmenu">
        					Hej!
        					<ul class="navbar-nav mr-auto">
        						<li class="nav-item active">
        							<a class="nav-link" href="#"> Start </a>
        						</li>

        						<li class="nav-item dropdown">
        							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
        							role="button" aria-expanded="false" id="submenu"> Moje konto </a>

        							<div class="dropdown-menu" aria-labelledby="submenu">

        								<a class="dropdown-item" href="#"> Wypożyczone </a>
        								<a class="dropdown-item" href="#"> Zamówione </a>

        								<div class="dropdown-divider"></div>

        								<a class="dropdown-item" href="#"> Przetrzymywane </a>
        								<a class="dropdown-item" href="#"> Historia wypożyczone </a>

        							</div>

        						</li>

        						<li class="nav-item">
        							<a class="nav-link" href="#"> Historia </a>
        						</li>

        						<li class="nav-item">
        							<a class="nav-link" href="#"> Zdjęcia </a>
        						</li>

        						<li class="nav-item">
        							<a class="nav-link disabled" href="#"> Wywiady </a>
        						</li>

        						<li class="nav-item">
        							<a class="nav-link" href="#"> Kontakt </a>
        						</li>

  					</ul>

  				    </div>
          </div>
-->


          <ul class="navbar-nav mr-auto"> <!-- mr-auto marines automatyczny -->

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
              role="button" aria-expanded="false" id="submenu"> Moje konto </a>

              <div class="dropdown-menu" aria-labelledby="submenu">

                <a class="dropdown-item" href="#"> Wypożyczone </a>
                <a class="dropdown-item" href="#"> Zamówione </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="#"> Przetrzymywane </a>
                <a class="dropdown-item" href="#"> Historia wypożyczone </a>

              </div>

            </li>

            <li class="nav-item">
              <a class="nav-link" href="#"> *Schowek </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#wyszukiwarka"> Wyszukaj </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#moje_dane"> Moje dane </a>
            </li>

    </ul>

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
                /*
                Spr czy zalogowany jest bibliotekarz. If bibliotekarz then znajdź czytelnika o nr i wyświetl dane.
                Bibliotekarz może prongotować i zmieniać status z wypożyczona na dostępna
                */
                ?>

            </div>

              <figure>
              Czytenik - konto
            </figure>
          </div>

            <div class="col-sm-6 col-md-5">

              <div id= "wyszukiwarka">
                <h3> Wyszukiwarka książek </h3>
                <?php include('wyszukiwarka.php'); ?>
              </div>

              <div id = "moje_dane">
                <?php
            //    if((isset($_COOKIE['czytelnik'])) && ($_COOKIE['czytelnik']=='zalogowany')) {

                    $tabela = "czytelnicy";
                      $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_czytelnik = '$id' ");

                          $wiersz = mysqli_fetch_array ($rezultat);

                            $id_czytelnik = $wiersz ['id_czytelnik'];
                            $imie_czytelnik = $wiersz ['imie_czytelnik'];
                            $nazwisko_czytelnik = $wiersz ['nazwisko_czytelnik'];
                            $adres_czytelnik = $wiersz ['adres_czytelnik'];
                            $email_czytelnik = $wiersz ['email_czytelnik'];
              //          }

                      //  $_SESSION['id_kierownik'] = $id_kierownik;
                 ?>
                <h3> Dane </h3>
                <!-- TODO zmiana na wczytywany plik z inclde konto_zal_form.php, zamiast swóch samych form u czytlenika i przy
                zakładaniu konta przez bibliotekarza -->
                <form class="form" id="Formularz_konto" name="Formularz_konto" method="POST" action="./controllers/konto.php">
                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
                <TR>
                  <TD>Imię: </TD><TD><input type="text" name="user_name" value="Jan" required> </input></TD>
                </TR>
                <TR>
                  <TD>Nazwisko: </TD><TD><input type="text" name="user_surname" value="Kowalski" required> </input></TD>
                </TR>
                <TR>
                  <TD>Adres: </TD><TD><input type="text" name="user_adress" value="ul. Zielona 4, Londek Zdrój" required> </input></TD>
                </TR>
                <TR>
                  <TD>Adres e-mail: </TD><TD><input type="text" name="user_email" value="jan@kowalski.pl" required> </input></TD>
                </TR>
                <?php
                /*
                print '
                <TR>
                  <TD>Imię: </TD><TD><input type="text" name="user_name" value="'; echo $imie_czytelnik; print'" required> </input></TD>
                </TR>
                <TR>
                  <TD>Nazwisko: </TD><TD><input type="text" name="user_surname"' ;echo $nazwisko_czytelnik; print'" required> </input></TD>
                </TR>
                <TR>
                  <TD>Adres: </TD><TD><input type="text" name="user_adress" value="'; echo $adres_czytelnik; print'" required> </input></TD>
                </TR>
                <TR>
                  <TD>Adres e-mail: </TD><TD><input type="text" name="user_email" value="'; echo $email_czytelnik; print'" required> </input></TD>
                </TR>
                ';
                */
                ?>

                </TABLE>
                <input type="submit" value="Zmień dane" class="button" id="button" />
                </form>

                <br>
              </div>

              <div id = "zamowione">
                <h3> Zamówione </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data zamówienia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD> </TD>
                </TR>

                <TR>
                  <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                  <TD>
                    <a href="./controllers/zam_rezygnuj.php">Rezygnuj z zamówienia</a></br>
                    </TD>
                </TR>

                <?php
                // pobieranie z tabeli zamowione gdzie id czytelnika == id...
                $lp = 1;

                $tabela = "zamowione";
                  $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_czytelnik = '$id' ");

                    //  $wiersz = mysqli_fetch_array ($rezultat);
                    while ($wiersz = mysqli_fetch_array ($rezultat)){

                        $id_zamowienie = $wiersz ['id_zamowienie'];
                        $zamowienie_sygnatura = $wiersz ['sygnatura']; // zamowienie_sygantura ???

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

                        $zamowienie_tytul = $wiersz ['zamowienie_tytul']; // TODO potem ma pobierać z tabeli ksiazki
                        $zamowienie_autor = $wiersz ['zamowienie_autor']; // TODO potem ma pobierać z tabeli ksiazki
                        $zamowienie_data = $wiersz ['zamowienie_data'];
                        $zamowienie_data_oddania = $wiersz ['zamowienie_data_oddania']; // TODO potem ma pobierać z tabeli wypozyczone ?

                        $lp++;
                    }

                    print '
                    <TR>
                      <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                      <TD>
                        <a href="./controllers/zam_rezygnuj.php">Rezygnuj z zamówienia</a></br>
                        </TD>
                    </TR>
                    ';

                ?>

                </TABLE>
                <br>
              </div>

              <div id = "wypozyczone">
                <h3> Wypożyczone </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data wypożyczenia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD> </TD>
                </TR>
                <?php
                print'
                <TR>
                  <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                  <TD>
                    <a href="./controllers/przedluz.php">Prolongata</a></br>';
                 /*if Bibliotekarz; */
                 print '<a href="./controllers/przyjmij_ksiazke.php">Oddana</a></br>
                    </TD>
                </TR>
                '; // TODO potem usunąć

                // pobieranie z tabeli zamowione gdzie id czytelnika == id...
                $lp = 1;

                $tabela = "wypozyczone";
                  $rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_czytelnik = '$id' ");
                  while ($wiersz = mysqli_fetch_array ($rezultat)){

                      $id_wypozyczone = $wiersz ['id_wypozyczone'];
                      $wypozyczone_sygnatura = $wiersz ['sygnatura']; // zamowienie_sygantura ???
                      $wypozyczone_data_oddania = $wiersz ['data_oddania']; //  z tabeli wypozyczone

                      /*
                      // pobieranie danych książek  z tab ksiazki
                      $tabela = 'ksiazki';
                      $rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE sygnatura = '$zamowienie_sygnatura' ");
                      while ($wiersz = mysqli_fetch_array ($rezultat2)){
                        $wypozyczone__tytul = $wiersz ['tytul'];
                        $wypozyczone__autor = $wiersz ['autor'];
                        $wypozyczone__rok_wydania = $wiersz ['rok_wydania'];
                      }

                      $tabela = 'wypozyczone';
                      $rezultat3 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE sygnatura = '$zamowienie_sygnatura' ");
                      while ($wiersz = mysqli_fetch_array ($rezultat2)){
                        $zamowienie_data_oddania = $wiersz ['data_oddania']; //  z tabeli wypozyczone
                      }
                      */

                      print'
                      <TR>
                        <TD>1</TD><TD>ABC</TD><TD>XCS</TD><TD>2017-11-07</TD><TD>2017-12-21</TD><TD>SN1_012</TD>
                        <TD>
                          <a href="./controllers/przedluz.php">Prolongata</a></br>';

                          /*if Bibliotekarz; <a href="./controllers/przyjmij_ksiazke.php">Oddana</a></br>*/
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
  <!--      </div>
  </div> -->
    </div>
  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
