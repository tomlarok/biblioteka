<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="#"><img src="./views/img/home2.png"></a>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Strona Główna</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php#wyszukiwarka">Katalog  online</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php#kontakt">Kontakt</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php#o_nas">O nas</a>
    </li>
    <?php
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {

      if ( substr($user, 0, 12) == ("bibliotekarz"))
      {
        print '
        <li class="nav-item">
          <a class="nav-link" href="bibliotekarz.php">Bibliotekarz konto</a></li>
        ';
      }else{
        print '
        <li class="nav-item">
          <a class="nav-link" href="czytelnik.php">Moje konto</a></li>
        ';
      }
    }
    ?>
  </ul>


<ul class="navbar-nav">

</ul>
<div class="d-flex">
  <ul class="navbar-nav">
  <li class="navbar-right">
      <input type="image" data-toggle="modal" data-target="#myModal" src="./views/img/sign_in4.png" />

    <!--  Utwórz konto -->
  </li>
  <li class="navbar-right">  | </li>
  <?php
if (!isset($_SESSION['zalogowany']))

{

  // Logowania
  print '
  <li class="navbar-right">
     <input type="image"  data-toggle="modal" data-target="#myModalLog" src="./views/img/log_in.png" />
    <!--  <a href = "#" data-toggle="modal" data-target="#myModalLog"  > Zaloguj</a> -->
  </li>
  ';
} else {

print '
  <li class="navbar-right">
      <a href = "./controllers/logout.php"><img src="./views/img/log_out.png" /></a>
  <!--    <a href = "./controllers/logout.php">Wyloguj</a> -->
  </li>
  ';
}

?>
</ul>

</div>

</nav>
