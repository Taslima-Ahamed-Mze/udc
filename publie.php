<?php 
require_once('connex.php');

    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $req = mysqli_query($link,"SELECT * FROM cours WHERE id=$id");
        $reponse = mysqli_fetch_object($req);
        if($reponse->statut == 0)
        {
            mysqli_query($link,"UPDATE cours set statut = 1 where id = $id"); 
            $status = "Retiré"; 

        }else{
            mysqli_query($link,"UPDATE cours set statut = 0 where id = $id");
            $status = "Publié"; ;    
        }
        echo $status;
        
    }
    



?>