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

              <div id="kontakt">
                <h3> Kontakt </h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nibh augue, suscipit a,
                  scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus.
                  Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis
                  vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci.
                  Nam congue, pede vitae dapibus aliquet,
                  elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis.
                  Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat,
                   purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue.
                   Cras suscipit, urna at aliquam rhoncus, urna quam viverra nisi, in interdum massa nibh nec erat.
                </p>

              </div>

              <div id="o_nas">
                <h3> O nas </h3>

                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nibh augue, suscipit a,
                  scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus.
                  Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis
                  vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci.
                  Nam congue, pede vitae dapibus aliquet,
                  elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis.
                  Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat,
                   purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue.
                   Cras suscipit, urna at aliquam rhoncus, urna quam viverra nisi, in interdum massa nibh nec erat.
                </p>

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
