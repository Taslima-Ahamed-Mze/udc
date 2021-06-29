<?php
   
    if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['email'])&&isset($_POST['tel'])&&isset($_POST['objet'])&&isset($_POST['msg']))
    {
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $expediteur = $_POST['email'];
        $tel = $_POST['tel'];
        $objet = $_POST['objet'];
        $contenu_message = utf8_decode($_POST['msg']);
        $destinataire = $_POST['destinataire'];
        $entete = 'Content-Type: text/html';
        $entete .= 'From: '.$expediteur;

        $contenu_message = 'De : '.$expediteur.',<br /><br /><strong>Sujet :'.$objet.'</strong><br/><br />'.$contenu_message.'\r\n<br/><br />'.$nom.' '.$prenom.'<br/><br />Telephone : '.$tel;
        $contenu_message ='<html><body>'.$contenu_message.'</body></html>';
        if($nom !="" && $prenom != "" && $expediteur!="" && $tel!="" && $objet!="" && $contenu_message!="")
        {
            $reussi = mail($destinataire, $objet, $contenu_message, $entete);

            if(isset($reussi) && $reussi==1)
            {
                $reponse = 1;

            }
            else
            {
                $reponse = 0;

            }
        }
        else{
            $reponse = 2;
        }
        
        echo $reponse;

    }




?>