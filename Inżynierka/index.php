<?php
    session_start();
    include 'cfg.php';
    include 'showpage.php';
    include 'admin/admin.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    if($_GET['idp'] == '') $strona = 'html/glowna.html' and $css = 'css/glowna.css';
    else if($_GET['idp'] == 'logowanie') $strona = 'html/logowanie.html' and $css = 'css/logowanie.css';
    else if($_GET['idp'] == 'rejestracja') $strona = 'html/rejestracja.html' and $css = 'css/rejestracja.css';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="Michał Kosiński" />
    <title>Edukacyjna Strona Internetowa</title>
</head>
<style type="text/css">
    <?php
        if(file_exists($css)) include($css);
        else echo '<div>Nie znaleziono stylów</div>';
        include('css/bootstrap.min.css');
    ?>
</style>
<script src="js/bootstrap.bundle.min.js"></script>
<body class="body">
    
    <?php
        if(file_exists($strona)) include($strona);
        else echo '<div>Nie znaleziono strony</div>';
    ?>

</body>
</html>


