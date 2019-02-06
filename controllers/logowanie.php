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

      // funkcja walidacji
      function validate($str) {
        // trim -Remove characters from both sides of a string
      	return trim(htmlspecialchars($str)); /*przeszukują ciąg znaków, podany jako argument, w celu znalezienia znaczników HTML i PHP.
         HTMLSPECIALCHARS zamienia znaki specialne (<,>,’,”,&) na ich „bezpieczne odpowiedniki”. */
      }

      // spr czy dane zostały przesłane i czy nie są puste
      if (!isset($_POST['login']) && empty($_POST["login"])){
        echo "Brak podanego login";
      } else {
        $login = validate($_POST['login']);
        if (strlen($login) > 100) {  // Return the length of the string
          echo "Za długi login";
          exit();
        }
      }

      if (!isset($_POST['password']) && empty($_POST['password'])){
        echo "Brak podanego haslo";
      } else {
        $haslo = validate($_POST['password']);
        if (strlen($haslo) > 100) {  // Return the length of the string
          echo "Za długi - haslo";
          exit();
        }
      }

        $login = htmlentities($login, ENT_QUOTES, "UTF-8"); //spr czy nie wstrzyknieto zapytania SQL, Wstawia encje HTMLa
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

        $_SESSION['login'] = $login;


        if ($rezultat = @$polaczenie->query(

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
