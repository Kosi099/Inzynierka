<?php
    session_start();
    include 'cfg.php';
    include 'showpage.php';
    include 'admin/admin.php';
    include 'contact.php';
    include 'produkty.php';
    include 'kategorie.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    if($_GET['idp'] == '') $strona = 'html/glowna.html' and $css = 'css/stronaglowna.css';
    else if($_GET['idp'] == 'Ciekawostki') $strona = 'html/Ciekawostki.html' and $css = 'css/Ciekawostki.css';
    else if($_GET['idp'] == 'Ranking') $strona = PokazPodstrone(3, $link) and $css = 'css/Ranking.css' ;
    else if($_GET['idp'] == 'Most1') $strona = PokazPodstrone(4, $link) and $css = 'css/Most1.css' ;
    else if($_GET['idp'] == 'Most2') $strona = PokazPodstrone(5, $link) and $css = 'css/Most2.css' ;
    else if($_GET['idp'] == 'Most3') $strona = PokazPodstrone(6, $link) and $css = 'css/Most3.css' ;
    else if($_GET['idp'] == 'Most4') $strona = PokazPodstrone(7, $link) and $css = 'css/Most4.css' ;
    else if($_GET['idp'] == 'Most5') $strona = PokazPodstrone(8, $link) and $css = 'css/Most5.css' ;
    else if($_GET['idp'] == 'Filmy') $strona = PokazPodstrone(9, $link) and $css = 'css/Filmy.css' ;
    else if($_GET['idp'] == 'admin') $strona = PokazPodstrone(10, $link) and $css = 'css/admin.css' ;
    else if($_GET['idp'] == 'Kontakt') $strona = PokazPodstrone(11, $link) and $css = 'css/kontakt.css' ;
    else if($_GET['idp'] == 'logowanie') $strona = 'html/logowanie.html' and $css = 'css/logowanie.css' ;
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="Michał Kosiński" />
    <title>Największe mosty świata</title>
</head>
<script>
    <?php
        include 'js/timedate.js';
        include 'js/kolorujtlo.js';
    ?>
</script>
<style type="text/css">
    <?php
        if(file_exists($css)) include($css);
        else echo '<div>Nie znaleziono stylów</div>';
    ?>
</style>
<body class="body" onload="startclock()">
    
    <?php
        if(file_exists($strona)) include($strona);
        else echo '<div>Nie znaleziono strony</div>';
    ?>

    <?php
        if($_GET['idp'] == 'logowanie')
        {
            if(isset($_POST['zaloguj']))
            {
                if($_POST['login']==$login && $_POST['pass']==$pass)
                {
                    header("Location:?idp=admin");
                }
                else
                {
                    echo '
                    <h1>Logowanie Admina</h1>
                    Błędne logowanie
                    <form method="post" >
                        Login:<br/><input type="text" name="login"/><br/>
                        Hasło:<br/><input type="password" name="pass"/><br/><br/>
                        <input type="submit" name="zaloguj" value="Zaloguj się"/></br></br>
                    </form>';
                    echo PrzypomnijHaslo();
                }
                
            }
            else
            {
                echo '
                <h1>Logowanie Admina</h1>
                <form method="post" >
                    Login:<br/><input type="text" name="login"/><br/>
                    Hasło:<br/><input type="password" name="pass"/><br/><br/>
                    <input type="submit" name="zaloguj" value="Zaloguj się"/></br></br>
                </form>';
                echo PrzypomnijHaslo();
            }
        }
        if($_GET['idp'] == 'admin')
        {
            echo ZalogowanyAdmin($link);
            echo '<h1>Zarządzanie sklepem</h1>';
            echo '<h2>Zarządzanie Kategoriami</h2>';
            echo PokazKategorie($link);
            echo '<h2>Zarządzanie Produktami</h2>';
            echo PokazProdukty($link);     
        }

        if($_GET['idp']=='Kontakt')
        {
            echo WyslijMailKontakt('kosiara066@wp.pl');
        }
    ?>
</body>
</html>