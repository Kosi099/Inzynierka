<?php

    function ListaKategori($id, $matka, $link, $color)
    {
        $id_clear = htmlspecialchars($id);
        $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($result))
        {
            if($row['matka']==$matka)
            {
                echo '<tr><td style="color: '.$color.';">'.$row['id'].' '.$row['nazwa'].'</td></tr>';
            }
            
        }
    }

    
    function DodajKategorie($id, $matka, $nazwa, $link)
    {
        if(mysqli_query($link, "INSERT INTO page_list VALUES ('$id', '$matka', '$nazwa')"))
        {
            echo 'Kategoria Dodana';
            header("Location:index.php?id=admin");
        }
        else
        {
            echo 'Błąd przy dodawaniu kategorii';
        }  
    }

    function EdytujKategorie($id, $matka, $nazwa, $link)
    {
        if(mysqli_query($link, "UPDATE page_list SET matka='$matka', nazwa='$nazwa' WHERE id='$id'"))
        {
            echo 'Kategoria Edytowana';
            header("Location:index.php?id=admin");
        }
        else
        {
            echo 'Błąd przy edycji kategorii';
        }  
    }

    function UsunKategorie($id, $link)
    {
        if(mysqli_query($link, "DELETE FROM page_list WHERE id='$id'"))
        {
            echo 'Kategoria Usunięta';
            header("Location:index.php?id=admin");
        }
        else
        {
            echo 'Błąd przy usuwaniu kategorii';
        }  
    }

    function PokazKategorie($link)
    {
        echo '<div><table width="500" height="500">';

        $iter = 1;
        $matka = 0;
        while($iter<=50)
        {
            ListaKategori($iter, $matka, $link, 'aqua');
            $iter2 = 1;
            while($iter2<=50)
            {
                ListaKategori($iter2, $iter, $link, 'black');
                $iter2 = $iter2 + 1;
            }
            $iter = $iter + 1;
        }
        echo '</table></div>';

        echo '
        <form method="POST">
            <input type="text" name="idwybrane" placeholder="Wprowadź id" Required>
            <input type="text" name="matka" placeholder="Wprowadź matke">
            <input type="text" name="nazwa" placeholder="Wprowadź nazwę">
            <input type="submit" name="dodaj" value="Dodaj">
            <input type="submit" name="edytuj" value="Edytuj"> 
            <input type="submit" name="usun" value="Usuń"> 
        </form>';

        if(isset($_POST['dodaj']))
        {
            $id = $_POST['idwybrane'];
            $matka = $_POST['matka'];
            $nazwa = $_POST['nazwa'];
            echo DodajKategorie($id, $matka, $nazwa, $link);
        }
        if(isset($_POST['edytuj']))
        {
            $id = $_POST['idwybrane'];
            $matka = $_POST['matka'];
            $nazwa = $_POST['nazwa'];
            echo EdytujKategorie($id, $matka, $nazwa, $link);
        }
        if(isset($_POST['usun']))
        {
            $id = $_POST['idwybrane'];
            echo UsunKategorie($id, $link);
        }

    }

?>