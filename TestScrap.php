<?php

    $ch = curl_init('https://script.google.com/macros/s/AKfycbxqpJIVwnCZz5YMx1MNpgPH1LBy45TapnY39I04shu6ON86EwSX/exec');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $page = curl_exec($ch);

    curl_close($ch);

    $grade = json_decode($page);

    echo($grade[0][1]);

?>