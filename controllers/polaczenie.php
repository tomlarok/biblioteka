<?php

try {
  $polaczenie = @new mysqli($db_host, $db_user, $db_password, $db_name);
  $polaczenie -> set_charset("utf8");
} catch  (Exception $e) {
  echo 'Wystąpił wyjątek nr '.$e->getCode().', jego komunikat to: '.$e->getMessage();
}


 ?>
