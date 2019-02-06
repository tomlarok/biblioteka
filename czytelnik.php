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


  //  spr czy konto czytelnika jest aktywne poprzez zapytanie do bd

  //połączenie z BD
  if (!isset($_POST['szukaj_czyt_id'])){
    include('./controllers/polaczenie.php');

    try{
    $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_S_aktywny('$user')");
      } catch  (Exception $e) {
        echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
      }
      $num_rows = mysqli_num_rows($rezultat);
      if($num_rows != 1)
      {
        print '<div class="frame-alert">';
        print '</br><span style="color:red">Konto nieaktywne. Aktywuj u bibliotekarza. </span></br>';
        print'
        <br><button onclick="goBack()">Powrót</button>
       <script>
       function goBack() {
           //window.history.back();
           window.location.assign("index.php")
       }
       </script>
        ';
        print '</div>';
        exit();
      }
    } // end of if isset szukaj_czyt_id

  ?>

    <!-- Banner -->
  <?php include('banner.php'); ?>

<!-- <nav> -->
  <?php include('nav.php'); ?>

  <!-- Submenu pod głównym  'Moje konto' -->
  <ul id="reader-menu" class="subpanel">
    <li><a class="mainmenu-item" href="#wypozyczone"> Wypożyczone </a></li>
    <li><a class="mainmenu-item" href="#zamowione"> Zamówione </a></li>
    <li><a class="mainmenu-item" href="#moje_dane">Moje dane</a></li>
    <li><a class="mainmenu-item" href="#historia"> Historia wypożyczone </a></li>
  </ul>


<main>
<div class="container">

      <?php
      if(isset($_SESSION['blad']))    echo $_SESSION['blad'];

      ?>

    <div>
      <!-- Tekst przywitalny, obrazek? -->
      <br>
    </div>
        <div class="row">

                <?php
                include('./controllers/polaczenie.php');
                ?>

          <div class="col-sm-6 col-md-5  offset-md-1">

            <div id= "wyszukiwarka">
                <h3> Wyszukiwarka książek </h3>
                <?php include('wyszukiwarka.php'); ?>
            </div>
          </div>

          <div class="col-sm-6 col-md-5">
              <div id = "moje_dane">
                <div class="separator">
                  <br><br>
                </div>
    <?php

          if (isset($_POST['szukaj_czyt_id'])){
            $user = $_POST['szukaj_czyt_id']; // login lub id czytelnika
            print'
            <a href = "./controllers/usun_czytelnika.php?szukaj_czyt_id='.$user.'">
            <button class="button" id="button_usun">Usuń czytelnika</button>
            </a>
            ';
          }

                    $tabela = "czytelnik";

                      try{
                      $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_S('$user')");
                          $wiersz = mysqli_fetch_array ($rezultat);
                        } catch  (Exception $e) {
                          echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
                        }
                            $id_czytelnik = $wiersz ['id_czytelnik'];
                            $imie_czytelnik = $wiersz ['imie_czytelnik'];
                            $nazwisko_czytelnik = $wiersz ['nazwisko_czytelnik'];
                            $adres_czytelnik = $wiersz ['adres_czytelnik'];
                            $email_czytelnik = $wiersz ['email_czytelnik'];
                            $konto_aktywne = $wiersz ['konto_aktywne'];

                            $_SESSION['konto_aktywne'] = $konto_aktywne;
                            $_SESSION['id_czytelnik'] = $wiersz['id_czytelnik'];  //ustawienie id_czytelnik dla id opercji dla BD

                 ?>
                <h3> Dane </h3>

                <form class="form" id="Formularz_konto" name="Formularz_konto" method="POST" action="./controllers/konto_aktualizuj.php">
                <TABLE CELLPADDING=5 BORDER=1 class="tabela_Czytelnika">

                <TR>
                  <TD>Imię: </TD><TD><input type="text" name="user_name" value="<?php echo $imie_czytelnik ?>" required
                    pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" title="Imię może zawierać tylko znaki alfanumeryczne" > </input></TD>
                </TR>
                <TR>
                  <TD>Nazwisko: </TD><TD><input type="text" name="user_surname" value="<?php echo $nazwisko_czytelnik ?>" required
                    pattern="[a-zA-Z0-9\s |,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" title="Nazwisko może zawierać tylko znaki alfanumeryczne"> </input></TD>
                </TR>
                <TR>
                  <TD>Adres: </TD><TD><input type="text" name="user_adress" value="<?php echo $adres_czytelnik ?>" required
                    pattern="[a-zA-Z0-9\s  |\|/|,|.|ą|ę|ś|ć|ż|ź|ł|ó|ĄĘŚĆŻŹŁÓ]+" title="Podaj poprawny adres"> </input></TD>
                </TR>
                <TR>
                  <TD>Adres e-mail: </TD><TD><input type="email" name="user_email" value="<?php echo $email_czytelnik ?>" required> </input></TD>
                </TR>
              </TABLE>
                <input type="submit" value="Zmień dane" class="button" id="button" />
              </form>

            </div> <!-- end div moje dane -->
          </div>
      </div> <!-- end div row -->

                <?php

                include('./controllers/termin_wypozyczen.php');
          ?>

            <div class="col-sm-6 col-md-5">
              <div id = "zamowione">
                <h3> Zamówione </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data zamówienia</TD><TD>Data odbioru</TD><TD>Sygantura</TD>
                  <TD> </TD>
                </TR>

          <?php
                // pobieranie z tabeli zamowione gdzie id czytelnika == id...
                $lp = 1;

                try{
                $polaczenie->next_result(); // using sprocs have to do this before next call !
                $tabela = "zamowienie";

                  $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_Szamowienie($id_czytelnik)");
                } catch  (Exception $e) {
                  echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
                }

                    while ($wiersz = @mysqli_fetch_array ($rezultat)){

                        $id_zamowienie = $wiersz ['id_zamowienie'];
                        $id_ksiazka = $wiersz ['id_ksiazka'];

                        $tabela2 = "ksiazka";

                        $polaczenie->next_result();
                        $rezultat2 = mysqli_query ($polaczenie, "CALL  czytelnik_Sksiazka($id_ksiazka) ");
                        $wiersz2 = mysqli_fetch_array ($rezultat2);
                        $zamowienie_tytul = $wiersz2 ['tytul'];
                        $zamowienie_autor = $wiersz2 ['autor'];
                        $sygnatura = $wiersz2 ['isbn'];


                        $data_zamowienia 	 = $wiersz ['data_zamowienia'];
                        $data_odbioru = $wiersz ['data_odbioru'];
                        $data_zwrotu = $wiersz ['data_zwrotu'];

                        print '
                        <TR>
                          <TD>'; echo $lp; print'</TD><TD>'; echo $zamowienie_tytul; print'</TD><TD>'; echo $zamowienie_autor; print'</TD><TD>';
                          echo $data_zamowienia; print'</TD><TD>'; echo $data_odbioru; print'</TD><TD>';
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
            </div>



          <div class="col-sm-6 col-md-5">

          </div>

            <div class="col-sm-6 col-md-5">
              <div id = "wypozyczone">
                <h3> Wypożyczone </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela">
                <TR class="naglowekTabela">

                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Data wypożyczenia</TD><TD>Data oddania</TD><TD>Sygantura</TD>
                  <TD> </TD>
                </TR>
                <?php

                // pobieranie z tabeli zamowione gdzie id czytelnika == id...
                $lp = 1;

                $tabela = "wypozyczenia";
                try{
                $polaczenie->next_result();

                  $rezultat = mysqli_query ($polaczenie, "CALL czytelnik_Swypozyczenia($id_czytelnik)");
                } catch  (Exception $e) {
                  echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
                }
                  while ($wiersz = @mysqli_fetch_array ($rezultat)){
                      $id_wypozyczenia = $wiersz ['id_wypozyczenia'];
                      $wypozyczone_data_wypozyczenia = $wiersz ['data_wypozyczenia'];
                      $wypozyczone_data_zwrotu  = $wiersz ['data_zwrotu'];
                      $wypozyczone_id_czytelnik  = $wiersz ['id_czytelnik'];
                      $id_ksiazka = $wiersz ['id_ksiazka'];

                      $tabela2 = "ksiazka";

                      $polaczenie->next_result();
                      $rezultat2 = mysqli_query ($polaczenie, "CALL  czytelnik_Sksiazka($id_ksiazka) ");
                      $wiersz2 = mysqli_fetch_array ($rezultat2);
                      $wypozyczone_tytul = $wiersz2 ['tytul'];
                      $wypozyczone_autor = $wiersz2 ['autor'];
                      $sygnatura = $wiersz2 ['isbn'];
                      $prolongata = $wiersz2 ['prolongata'];


                      print'
                      <TR>
                        <TD>'; echo $lp; print'</TD><TD>'; echo $wypozyczone_tytul; print'</TD><TD>'; echo $wypozyczone_autor; print'</TD><TD>';
                        echo $wypozyczone_data_wypozyczenia; print'</TD><TD>'; echo $wypozyczone_data_zwrotu;

                      spr_termin($wypozyczone_data_zwrotu);
                        print'</TD><TD>';
                        echo $sygnatura; print'</TD><TD>';
                        if ($prolongata > 1 ) { //ilość prolongat - dozwolona
                          echo "Nie można jeszcze raz przedłużyć";
                        }else {
                          if ($konto_aktywne == "Tak"){
                            print'
                              <a href="./controllers/przedluz.php?id_ksiazka='; echo $id_ksiazka;
                              print'">Prolongata</a></br>';
                          }
                        }

                        if ($konto_aktywne == "Nie" ) {
                          echo "Prolongata niedozwolona";
                        }
                            print'
                          </TD>
                      </TR>
                      ';
                      $lp++;
                  }

                ?>

                </TABLE>
                <br>
              </div>  <!-- end div id wypozyczenia -->
            </div>


        </div>  <!-- end div container -->

  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
