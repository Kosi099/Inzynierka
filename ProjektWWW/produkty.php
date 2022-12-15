<?php
    
    function ListaProduktow($id, $link, $color)
    {
        $id_clear = htmlspecialchars($id);
        $query = "SELECT * FROM page_list2 WHERE id='$id_clear' LIMIT 1";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($result))
        {
            echo '
            <tr>
                <td style="color: '.$color.';">'.$row['id'].'</td>
                <td style="color: '.$color.';"> '.$row['Tytuł'].'</td>
                <td style="color: '.$color.';"> '.$row['Opis'].'</td>
                <td style="color: '.$color.';"> '.$row['Data_utworzenia'].'</td>
                <td style="color: '.$color.';"> '.$row['Data_modyfikacji'].'</td>
                <td style="color: '.$color.';"> '.$row['Data_wygaśnięcia'].'</td>
                <td style="color: '.$color.';"> '.$row['Cena_netto'].'</td>
                <td style="color: '.$color.';"> '.$row['Podatek_vat'].'</td>
                <td style="color: '.$color.';"> '.$row['Ilość_dost_sztuk'].'</td>
                <td style="color: '.$color.';"> '.$row['Status_dost'].'</td>
                <td style="color: '.$color.';"> '.$row['Kategoria'].'</td>
                <td style="color: '.$color.';"> '.$row['Gabaryt'].'</td>';
            if($row['Status_dost']==0||$row['Ilość_dost_sztuk']<10)
            {
                echo '<td style="color: '.$color.';">Brak</td></tr>';
            }
            else
            {
                echo '<td style="color: '.$color.';">Dostępne</td></tr>';
            }
        }
    }

    function DodajProdukt($id, $tytul, $opis,$utwo,$mody,$wygas,$netto,$vat,$sztuk,$stados,$kategoria,$gabaryt,$zdjecie, $link)
    {
        if(mysqli_query($link, "INSERT INTO page_list2 VALUES ('$id','$tytul', '$opis','$utwo','$mody','$wygas','$netto','$vat','$sztuk','$stados','$kategoria','$gabaryt','$zdjecie')"))
        {
            echo 'Pozycja Dodana';
            header("Location:index.php?id=admin");
        }
        else
        {
            echo 'Błąd przy dodawaniu kategorii';
        }  
    }

    function EdytujProdukt($id, $tytul, $opis,$utwo,$mody,$wygas,$netto,$vat,$sztuk,$stados,$kategoria,$gabaryt,$zdjecie, $link)
    {
        if(mysqli_query($link, "UPDATE page_list2 SET Tytuł='$tytul', Opis='$opis', Data_utworzenia='$utwo', Data_modyfikacji='$mody', Data_wygaśnięcia='$wygas', Cena_netto='$netto', Podatek_vat='$vat', Ilość_dost_sztuk='$sztuk', Status_dost='$stados', Kategoria='$kategoria', Gabaryt='$gabaryt', Zdjecie='$zdjecie' WHERE id='$id'"))
        {
            echo 'Pozycja Edytowana';
            header("Location:index.php?id=admin");
        }
        else
        {
            echo 'Błąd przy edycji kategorii';
        }  
    }

    function UsunProdukt($id, $link)
    {
        if(mysqli_query($link, "DELETE FROM page_list2 WHERE id='$id'"))
        {
            echo 'Pozycja Usunięta';
            header("Location:index.php?id=admin");
        }
        else
        {
            echo 'Błąd przy usuwaniu kategorii';
        }  
    }

    function PokazProdukty($link)
    {
        echo '<div><table border="5" style="margin: auto;">
        <tr>
            <th>id</th>
            <th>Tytuł</th>
            <th>Opis</th>
            <th>Data utworzenia</th>
            <th>Data modyfikacji</th>
            <th>Data wygaśnięcia</th>
            <th>Cena_netto</th>
            <th>Podatek_vat</th>
            <th>Ilość dost. sztuk</th>
            <th>Status dostępności</th>
            <th>Kategoria</th>
            <th>Gabaryt</th>
            <th>Dostępność
        </tr>';

        $iter = 1;
        while($iter<=5)
        {
            ListaProduktow($iter, $link, 'aqua');
            $iter = $iter + 1;
        }
        echo '</table></div>';
        

        echo '
        <h3>Edytowanie produktów w sklepie</h3>
        <form method="POST">
            <input type="text" name="idwybrane" placeholder="Wprowadź id" Required><br>
            <input type="text" name="tytul" placeholder="Wprowadź Tytuł" Required><br>
            <input type="text" name="opis" placeholder="Wprowadź Opis" Required><br>
            <label for="utwo">Wybierz Date Utworzenia:</label>
            <input type="date" id="utwo" name="utwo" Required><br>
            <label for="mody">Wybierz Date Modyfikacji:</label>
            <input type="date" id="mody" name="mody" Required><br>
            <label for="wygas">Wybierz Date Wygaśnięcia:</label>
            <input type="date" id="wygas" name="wygas" Required><br>
            <input type="text" name="cenanetto" placeholder="Wprowadź Cene netto" Required><br>
            <input type="text" name="podatekvat" placeholder="Wprowadź Podatek Vat" Required><br>
            <input type="text" name="iloscdostsztuk" placeholder="Wprowadź Ilość dostępnych sztuk" Required><br>
            <input type="text" name="statusdostepnosci" placeholder="Wprowadź Status dostępności" Required><br>
            <input type="text" name="kategoria" placeholder="Wprowadź Kategorie" Required><br>
            <input type="text" name="gabaryt" placeholder="Wprowadź Gabaryt" Required><br>
            <label for="zdjecie">Wybierz zdjęcie:</label>
            <input type="file" id="zjecie" name="zdjecia" Required><br>
            <input type="submit" name="edytuj" value="Edytuj">
        </form>';

        if(isset($_POST['edytuj']))
        {
            $id = $_POST['idwybrane'];
            $tytul = $_POST['tytul'];
            $opis = $_POST['opis'];
            $utwo = $_POST['utwo'];
            $mody = $_POST['mody'];
            $wygas = $_POST['wygas'];
            $netto = $_POST['cenanetto'];
            $vat = $_POST['podatekvat'];
            $sztuk = $_POST['iloscdostsztuk'];
            $stados = $_POST['statusdostepnosci'];
            $kategoria = $_POST['kategoria'];
            $gabaryt = $_POST['gabaryt'];
            $zdjecie = $_POST['zdjecie'];
            echo EdytujProdukt($id, $tytul, $opis,$utwo,$mody,$wygas,$netto,$vat,$sztuk,$stados,$kategoria,$gabaryt,$zdjecie, $link);
        }


        echo '
        <h3>Dodawanie produktów w sklepie</h3>
        <form method="POST">
            <input type="text" name="idwybrane" placeholder="Wprowadź id" Required><br>
            <input type="text" name="tytul" placeholder="Wprowadź Tytuł" Required><br>
            <input type="text" name="opis" placeholder="Wprowadź Opis" Required><br>
            <label for="utwo">Wybierz Date Utworzenia:</label>
            <input type="date" id="utwo" name="utwo" Required><br>
            <label for="mody">Wybierz Date Modyfikacji:</label>
            <input type="date" id="mody" name="mody" Required><br>
            <label for="wygas">Wybierz Date Wygaśnięcia:</label>
            <input type="date" id="wygas" name="wygas" Required><br>
            <input type="text" name="cenanetto" placeholder="Wprowadź Cene netto" Required><br>
            <input type="text" name="podatekvat" placeholder="Wprowadź Podatek Vat" Required><br>
            <input type="text" name="iloscdostsztuk" placeholder="Wprowadź Ilość dostępnych sztuk" Required><br>
            <input type="text" name="statusdostepnosci" placeholder="Wprowadź Status dostępności" Required><br>
            <input type="text" name="kategoria" placeholder="Wprowadź Kategorie" Required><br>
            <input type="text" name="gabaryt" placeholder="Wprowadź Gabaryt" Required><br>
            <label for="zdjecie">Wybierz zdjęcie:</label>
            <input type="file" id="zjecie" name="zdjecia" Required><br>
            <input type="submit" name="dodaj" value="Dodaj">
        </form>';

        if(isset($_POST['dodaj']))
        {
            $id = $_POST['idwybrane'];
            $tytul = $_POST['tytul'];
            $opis = $_POST['opis'];
            $utwo = $_POST['utwo'];
            $mody = $_POST['mody'];
            $wygas = $_POST['wygas'];
            $netto = $_POST['cenanetto'];
            $vat = $_POST['podatekvat'];
            $sztuk = $_POST['iloscdostsztuk'];
            $stados = $_POST['statusdostepnosci'];
            $kategoria = $_POST['kategoria'];
            $gabaryt = $_POST['gabaryt'];
            $zdjecie = $_POST['zdjecie'];
            echo DodajProdukt($id, $tytul, $opis,$utwo,$mody,$wygas,$netto,$vat,$sztuk,$stados,$kategoria,$gabaryt,$zdjecie, $link);
        }

        echo '
        <h3>Usuwanie produktów ze sklepu</h3>
        <form method="POST">
            <input type="text" name="idusun" placeholder="Wprowadź id pozycji do usunięcia" Required>
            <input type="submit" name="usun" value="Usuń">
        </form>';

        if(isset($_POST['usun']))
        {
            $id = $_POST['idusun'];
            echo UsunProdukt($id, $link);
        }
    }

?>