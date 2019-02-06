<?php

function spr_termin($wypozyczone_data_zwrotu){
  // spr czy przkroczono termin oddania książki
  $dateTime = new DateTime('+2H');  //pobranie aktualnej daty + 2h - strefa czasowa
  $dateTime->format('%Y-%m-%d');
  $wypozyczone_data_zwrotu = date_create($wypozyczone_data_zwrotu);
  $wypozyczone_data_zwrotu->format('%Y-%m-%d');

  if ($dateTime > $wypozyczone_data_zwrotu) {
    $interval = $dateTime->diff($wypozyczone_data_zwrotu);

    $y = $interval->y;
    $m = $interval->m;
    $d = $interval->d;
    $roznica = $d + $m * 30 + $y * 365; // bez uwzględnienia dni wolnych itp

    if ($roznica > 1){
      print '</br><span style="color:red"> Po terminie: '.$roznica.' dni </span></br>';

      $kara = number_format($roznica * 0.30, 2, ',', ' ');  //format liczby do wyświetlania wg polskich norm
      print '</br><span style="color:red"> Opłata: '.$kara.' zł </span></br>';
    }
  }

}

 ?>
