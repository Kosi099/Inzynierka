<?php

    function ListaPodstron($id, $link)
    {
        $id_clear = htmlspecialchars($id);
        $query = "SELECT * FROM projekt_www WHERE id='$id_clear' LIMIT 1";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($result))
        {
            echo '<option style="color: aqua;">'.$row['id'].' '.$row['page_title'].'</option>';
        }
    }


    function DodajPodstrone($id, $naza, $kontent,$link)
    {
        if(mysqli_query($link, "INSERT INTO projekt_www VALUES ('$id','$naza', '$kontent', '1')"))
        {
            echo 'Strona Dodana';
            header("Location:?idp=admin");
        }
        else
        {
            echo 'Błąd przy dodawaniu strony';
        }  
    }

    function EdytujPodstrone($id, $naza, $kontent,$link)
    {
        if(mysqli_query($link, "UPDATE projekt_www SET page_title='$naza', page_content='$kontent' WHERE id='$id'"))
        {
            echo 'Strona Edytowana';
            header("Location:?idp=admin");
        }
        else
        {
            echo 'Błąd przy edycji strony';
        }  
    }

    function UsunPodstrone($id, $link)
    {
        if(mysqli_query($link, "DELETE FROM projekt_www WHERE id='$id'"))
        {
            echo 'Strona Usunięta';
            header("Location:?idp=admin");
        }
        else
        {
            echo 'Błąd przy usuwaniu strony';
        }  
    }

    function ZalogowanyAdmin($link)
    {
        echo
        '<div>
            <a class="zalogowanyadmin">Zalogowany</a></br>
            <a class="zalogowanyadmin" href="/Projekty/ProjektWWW/index.php/?idp=logowanie">Wyloguj</a>
        </div>';

        echo '<h1>Zarządzanie Stronami</h1>';

        echo '<div><select>';
        $iter = 1;
        while($iter<=15)
        {
            ListaPodstron($iter, $link);
            $iter = $iter + 1;
        }
        echo '</select></div>';

        echo '
        <form method="POST">
            <input type="text" name="idwybrane" placeholder="Wybierz id strony do zmiany" Required>
            <input type="text" name="nowanazwa" placeholder="Wprowadź nową nazwę">
            <input type="text" name="nowykontent" placeholder="Wprowadź nowy kontent">
            <input type="submit" name="dodaj" value="Dodaj">
            <input type="submit" name="edytuj" value="Edytuj">
            <input type="submit" name="usun" value="Usuń">
        </form>';

        if(isset($_POST['dodaj']))
        {
            $id = $_POST['idwybrane'];
            $naza = $_POST['nowanazwa'];
            $kontent = $_POST['nowykontent'];
            DodajPodstrone($id, $naza, $kontent,$link);
        }

        if(isset($_POST['edytuj']))
        {
            $id = $_POST['idwybrane'];
            $naza = $_POST['nowanazwa'];
            $kontent = $_POST['nowykontent'];
            EdytujPodstrone($id, $naza, $kontent,$link);
        }

        if(isset($_POST['usun']))
        {
            $id = $_POST['idwybrane'];
            UsunPodstrone($id,$link);
        }
        
    }




?>