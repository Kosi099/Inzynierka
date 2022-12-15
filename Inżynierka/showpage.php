<?php
    function PokazPodstrone($id, $link)
    {
        $id_clear = htmlspecialchars($id);
        $query = "SELECT * FROM projekt_www WHERE id='$id_clear' LIMIT 1";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        if(empty($row['id']))
        {
            $web = $row['nie_znaleziono_strony'];
        }
        else
        {
            $web = $row['page_content'];
        }
    return $web;
    }
?>