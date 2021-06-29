<?php
    require_once('connex.php');

    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        mysqli_query($link,"DELETE FROM cours WHERE id=$id");
        echo "supprimer";
    }
    
    





?>