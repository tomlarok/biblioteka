<?php

    session_start();

    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

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
  $polaczenie = @new mysqli($db_host, $db_user, $db_password, $db_name);



  ?>

<nav>
  <?php include('nav.php'); ?>

  <!-- Submenu pod głównym w przypadku braku rozwijanego 'Moje konto' -->
  <!-- <ul id="mainmenu" class="panel topnav">  -->
<!-- <ul id="reader-menu" class="panel sub"> -->
  <ul id="reader-menu" class="subpanel">
    <li><a class="mainmenu-item" href="#wypozyczone"> Wypożyczone </a></li>
    <li><a class="mainmenu-item" href="#zamowione"> Zamówione </a></li>
    <li><a class="mainmenu-item" href="#moje_dane">Moje dane</a></li>
    <li><a class="mainmenu-item" href="#historia"> Historia wypożyczone </a></li>
  </ul>

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

                  //  $tabela = "czytelnicy";
                    $tabela = "czytelnik";
                      //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_czytelnik = '$id' ");
                      //$rezultat = mysqli_query ($polaczenie, "CALL czytelnik_S('$id')");
                      $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_S('$user')");
                          $wiersz = mysqli_fetch_array ($rezultat);

                            $id_czytelnik = $wiersz ['id_czytelnik'];
                            $imie_czytelnik = $wiersz ['imie_czytelnik'];
                            $nazwisko_czytelnik = $wiersz ['nazwisko_czytelnik'];
                            $adres_czytelnik = $wiersz ['adres_czytelnik'];
                            $email_czytelnik = $wiersz ['email_czytelnik'];

                            $_SESSION['id_czytelnik'] = $wiersz['id_czytelnik'];  //ustawienie id_czytelnik dla id opercji dla BD
              //          }

                      //  $_SESSION['id_kierownik'] = $id_kierownik;
                 ?>
                <h3> Dane </h3>
                <!-- TODO ?? zmiana na wczytywany plik z inclde konto_zal_form.php, zamiast swóch samych form u czytlenika i przy
                zakładaniu konta przez bibliotekarza ??? -->
                <!-- TODO Utowrzenie konto_aktualizuj.php w cotrollers update sql-->
                <form class="form" id="Formularz_konto" name="Formularz_konto" method="POST" action="./controllers/konto_aktualizuj.php">
                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">

                <TR>
                  <TD>Imię: </TD><TD><input type="text" name="user_name" value="<?php echo $imie_czytelnik ?>" required> </input></TD>
                </TR>
                <TR>
                  <TD>Nazwisko: </TD><TD><input type="text" name="user_surname" value="<?php echo $nazwisko_czytelnik ?>" required> </input></TD>
                </TR>
                <TR>
                  <TD>Adres: </TD><TD><input type="text" name="user_adress" value="<?php echo $adres_czytelnik ?>" required> </input></TD>
                </TR>
                <TR>
                  <TD>Adres e-mail: </TD><TD><input type="text" name="user_email" value="<?php echo $email_czytelnik ?>" required> </input></TD>
                </TR>

                <?php

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
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data zamówienia</TD><TD>Data oddania</TD><TD>Data odbioru</TD><TD>Sygantura</TD>
                  <TD> </TD>
                </TR>


                <?php
                // pobieranie z tabeli zamowione gdzie id czytelnika == id...
                $lp = 1;
                // TODO zmiana na proc structured
                // Perform multiple queries against the database. Use mysqli_next_result() function to prepare the next result
                $polaczenie->next_result(); // using sprocs have to do this before next call !
                $tabela = "zamowienie";
                  //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_czytelnik = '$id_czytelnik' ");
                  $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_Szamowienie($id_czytelnik)");
                    //  $wiersz = mysqli_fetch_array ($rezultat);
                    while ($wiersz = mysqli_fetch_array ($rezultat)){

                        $id_zamowienie = $wiersz ['id_zamowienie'];
                        $id_ksiazka = $wiersz ['id_ksiazka'];

                        $tabela2 = "ksiazka";
                        //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_ksiazka = '$id_ksiazka' ");
                        $polaczenie->next_result();
                        $rezultat2 = mysqli_query ($polaczenie, "CALL  czytelnik_Sksiazka($id_ksiazka) ");
                        $wiersz2 = mysqli_fetch_array ($rezultat2);
                        $zamowienie_tytul = $wiersz2 ['tytul'];
                        $zamowienie_autor = $wiersz2 ['autor'];
                        $sygnatura = $wiersz2 ['isbn'];

                      //  $zamowienie_sygnatura = $wiersz ['sygnatura']; // zamowienie_sygantura ???



                      //  $zamowienie_tytul = $wiersz ['zamowienie_tytul']; // TODO potem ma pobierać z tabeli ksiazki
                      //  $zamowienie_autor = $wiersz ['zamowienie_autor']; // TODO potem ma pobierać z tabeli ksiazki
                        $data_zamowienia 	 = $wiersz ['data_zamowienia'];
                        $data_odbioru = $wiersz ['data_odbioru']; // TODO potem ma pobierać z tabeli wypozyczone ?
                        $data_zwrotu = $wiersz ['data_zwrotu'];

                        print '
                        <TR>
                          <TD>'; echo $lp; print'</TD><TD>'; echo $zamowienie_tytul; print'</TD><TD>'; echo $zamowienie_autor; print'</TD><TD>';
                          echo $data_zamowienia; print'</TD><TD>'; echo $data_zwrotu; print'</TD><TD>'; echo $data_zwrotu; print'</TD><TD>';
                          echo $sygnatura;  print'</TD><TD><a href="./controllers/zam_rezygnuj.php?id_ksiazka='; echo $id_ksiazka;
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

                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data wypożyczenia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD> </TD>
                </TR>
                <?php

                // pobieranie z tabeli zamowione gdzie id czytelnika == id...
                $lp = 1;

                $tabela = "wypozyczenia";
                $polaczenie->next_result();
                  //$rezultat = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela WHERE id_czytelnik = '$id_czytelnik' ");
                  $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_Swypozyczenia($id_czytelnik)");
                  while ($wiersz = mysqli_fetch_array ($rezultat)){

                      $id_wypozyczenia = $wiersz ['id_wypozyczenia'];
                      $wypozyczone_data_wypozyczenia = $wiersz ['data_wypozyczenia']; //  z tabeli wypozyczone
                      $wypozyczone_data_zwrotu  = $wiersz ['data_zwrotu'];
                      $wypozyczone_id_czytelnik  = $wiersz ['id_czytelnik'];
                      $id_ksiazka = $wiersz ['id_ksiazka'];

                      $tabela2 = "ksiazka";
                      //$rezultat2 = mysqli_query ($polaczenie, "SELECT * FROM $db_name.$tabela2 WHERE id_ksiazka = '$id_ksiazka' ");
                      $polaczenie->next_result();
                      $rezultat2 = mysqli_query ($polaczenie, "CALL  czytelnik_Sksiazka($id_ksiazka) ");
                      $wiersz2 = mysqli_fetch_array ($rezultat2);
                      $wypozyczone_tytul = $wiersz2 ['tytul'];
                      $wypozyczone_autor = $wiersz2 ['autor'];
                      $sygnatura = $wiersz2 ['isbn'];

 

                      print'
                      <TR>
                        <TD>'; echo $lp; print'</TD><TD>'; echo $wypozyczone_tytul; print'</TD><TD>'; echo $wypozyczone_autor; print'</TD><TD>';
                        echo $wypozyczone_data_wypozyczenia; print'</TD><TD>'; echo $wypozyczone_data_zwrotu; print'</TD><TD>';
                        echo $sygnatura; print'</TD><TD>';
                        print'
                          <a href="./controllers/przedluz.php?id_ksiazka='; echo $id_ksiazka;
                          print'">Prolongata</a></br>';

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

    </div>
  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
