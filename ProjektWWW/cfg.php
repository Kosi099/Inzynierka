<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'moj_sklep';
    $login = 'admin';
    $pass = 'admin';

    $link = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$link) echo '<b>Przerwane połączenie </b>';
    if(!mysqli_select_db($link, $baza)) echo 'nie wybrano bazy';
?>