<?php
    
    function PokazKontakt()
    {
        echo 
        '<form method="POST">
            <input type="text" name="temat" placeholder="Wpisz Temat" Required>
            <textarea type="text" name="tresc" placeholder="Treść"></textarea>
            <input type="text" name="email" placeholder="Email">
            <input type="submit" name="wyslij" value="Wyślij">
        </form';
    }
    function WyslijMailKontakt()
    {
        if(empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email']))
        {
            echo PokazKontakt();
        }
        else
        {
            $subject = $_POST['temat'];
            $body= $_POST['tresc'];
            $sender = $_POST['email'];
            $reciptient = 'kosiara099gmail.com';

            $header = "From: Formularz kontaktowy <".$sender.">\n";
            
            if(mail($reciptient,$subject,$body,$header))
            {
                echo 'Wiadomość wysłana';
                session_destroy();
            }
            else
            {
                echo 'Wiadomość nie wysłana poprawnie';
            }

            
            echo
                '<footer class="footer">
                    <div>
                        <a href="/Projekty/ProjektWWW/index.php">Powrót do Strony Głównej<br/></a>
                        <a>Data: </a>
                        <div id="zegarek" style="display: inline;"></div>
                        <div id="data" style="display: inline;"></div>
                        <a><br/></a>
                        <a>Strona stworzona przez</a>
                        <a href="mailto:kosiara099@wp.pl">Michała K.</a> 
                    </div>
                </footer>';
        }
    }
    function PrzypomnijHaslo()
    {
        if($_POST['przyphasl']=='kosiara099@gmail.com')
        {
            $subject='Przypomnienie hasła';
            $body='Twoje hasło to: admin';
            $reciptient = 'kosiara099@gmail.com';
            if(mail($reciptient,$subject,$body))
            {
                echo 'Wysłano email z przypomnieniem hasła';
            }
            else
            {
                echo 'Błąd przy wysyłanie email z przypomnieniem hasła';
            }
        }
        else
        {
            echo
            '<form method="POST">
                <input type="text" name="przyphasl" placeholder="Wpisz swój email" Required>
                <input type="submit" name="przypomnij" value="Przypomnij hasło">
            </form>';
        }
    }

?>