<html>
  <head>
    <?php include('head.php'); ?>
  </head>

<body>
  <?php
  @session_start();
  require_once "./controllers/connect.php";

  ?>
<!--
<nav>
  <?php // include('nav.php'); ?>
</nav>
-->

<main>
<div class="container">

      <?php
      if(isset($_SESSION['blad']))    echo $_SESSION['blad'];

      ?>


            <div class="row">
              <div class="col-sm-6 col-md-5 offset-md-1">


            </div>

            <div class="col-sm-6 col-md-5">
              <figure>
              Admin - panel zarządzania
            </figure>
            </div>

            <div class="col-sm-6 col-md-5">

              <div id= "wyszukiwarka">
                <h3> Wyszukiwarka książek </h3>
                <?php include('wyszukiwarka.php'); ?>
              </div>

              <div id= "dodaj_ksiazke">
                <h3> Dodaj książkę </h3>
                <?php include('./controllers/dodaj_ksiazke_form.php'); ?>
              </div>

              <div id = "bib-dodaj-czyt">
                <h3> Dodaj czytelnika <h3>
                  <?php include("./controllers/dodaj_czytelnika.php"); ?>
              </div>
              <!-- usuwanie użytkowników - poprzez szukaj/konto czytelnika/[usun konto] -->
              <div id = "bib-szukaj-czyt">
                <?php include("./controllers/szukaj_czytelnika_form.php"); ?>
              </div>

          </div>
        </div> <!-- end row -->

    </div> <!-- end container -->
  </main>
  <footer>
  <?php include('footer.php'); ?>
  </footer>

</body>

</html>
