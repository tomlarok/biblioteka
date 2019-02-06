<html>
  <head>
    <?php include('head.php'); ?>
  </head>

<body>
  <?php
  @session_start();
  require_once "./controllers/connect.php";

  ?>

<nav>
    <?php include('banner.php'); ?>
</nav>

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

                if(isset($_SESSION['konto_aktywne'])){
                  $konto_aktywne = $_SESSION['konto_aktywne'];
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

              <div id="lista-wyszukiwania">
                <h3> Wyniki wyszukiwania </h3>

                <TABLE CELLPADDING=5 BORDER=1 class="tabela">
                <TR class="naglowekTabela">
                  <TD>Lp</TD><TD>Tytuł</TD><TD>Autor</TD><TD>Kategoria</TD><TD>Wydawnictwo</TD><TD>Rok wydania</TD><TD>Liczba stron</TD>
                  <TD>Opis</TD><TD>Słowa kluczowe</TD><TD></TD>
                </TR>

                <?php include('./controllers/wyszukaj.php'); ?>

              </TABLE>

              </div>

          </div>
        </div> <!-- end div row -->

    </div> <!-- end div container -->
  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
