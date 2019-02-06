<?php

    session_start();

    session_unset();  //niszczenie sesji
// niszczenie COOOKIES
    setcookie('zalogowany', '', time() - 60*60*3);
    setcookie('bibliotekarz', '', time() - 60*60*3);

    print '<link href="../views/styles.css" rel="stylesheet">';

    print '<div class="frame-alert">';
    echo "Wylogowano</br>";
    print'<a href = "../index.php">Powrót</a>';
    print '</div>';

?>
