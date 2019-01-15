<?php

    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: ../index.php');
        exit();
    }

    require_once "connect.php";

    $ipaddress = $_SERVER["REMOTE_ADDR"]; // pobieranie nr IP

    $polaczenie = @new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    else
    {        // WARTOŚCI LOGIN i HASŁO Z FORMULARZA
        $login = $_POST['login'];
        $haslo = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

        $_SESSION['login'] = $login;


        if ($rezultat = @$polaczenie->query(
          //sprintf("SELECT * FROM users WHERE login='%s' AND haslo='%s'",
        sprintf("SELECT * FROM logowanie WHERE login='%s' AND password='%s'",
        mysqli_real_escape_string($polaczenie,$login),  //f zabezpiecza przez InjectSQL (- ' itp')
        mysqli_real_escape_string($polaczenie,$haslo))))
        {
            $ilu_userow = $rezultat->num_rows;
            if($ilu_userow>0)
            {

                            // dadanie ciacha
              $nick = $login;
              $zalogowany = true;
              setcookie('login', $nick, time() + 60*60*3);
              setcookie('zalogowany', $zalogowany, time() + 60*60*3);
                // Zalogowany w sesji
                $_SESSION['zalogowany'] = true;

                $wiersz = $rezultat->fetch_assoc();
                $_SESSION['id'] = $wiersz['id'];
                $_SESSION['user'] = $wiersz['login'];

                unset($_SESSION['blad']); //usuwanie zmiennej blad. Po loogwaniu jest niepotrzebna.
                $rezultat->free_result();

                // Zapis IP do BD
                /*
                $user = $_SESSION['user']; //user login,

               // $slc = mysqli_query ($polaczenie, "SELECT * FROM $db_name.logi WHERE login = '$user'");
                 $upd = mysqli_query ($polaczenie, "UPDATE $db_name.users SET data_logowania = NOW() WHERE login = '$user' ");
                 */
                 /*
                if($upd) echo "Rekord został zmieniony poprawnie ";
                        else echo "Błąd, nie udało się dodać nowego rekordu ";
                        */
            // TODO Jak sposób weryfikacji bibliotekarza?
                if ( substr($login, 0, 12) == ("bibliotekarz"))
                {
                  setcookie('bibliotekarz', $nick, time() + 60*60*3);  // dodanie ciacha bibliotekarz
                  header('Location: ../bibliotekarz.php');
                } else {
                  header('Location: ../czytelnik.php');
                }

            } else {

                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: ../index.php');


              }


          }
          $polaczenie->close();
      }
?>
