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

                ?>

            </div>

            <div class="col-sm-6 col-md-5">
              <figure>
              Admin - panel zarzadzania
            </figure>
            </div>

            <div class="col-sm-6 col-md-5">

              <div id= "wyszukiwarka">
                <h3> Wyszukiwarka książek </h3>
                <?php //include('wyszukiwarka.php'); ?>
              </div>

              <div id= "dodaj_ksiazke">
                <h3> Dodaj książki </h3>
                <?php include('./controllers/dodaj_ksiazke_form.php'); ?>
              </div>

              <div id = "bib-dodaj-czyt">
                <h3> Dodaj czytelnika <h3>
                  <?php include("./controllers/dodaj_czytelnika.php"); ?>
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
