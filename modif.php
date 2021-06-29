<?php
session_start();
if (empty($_SESSION['login'])){
    header('location:index.php');
}
include("connex.php");

$sq= mysqli_query($link,"SELECT * from enseignant where login= '".$_SESSION['login']."' ");
$sq1=mysqli_fetch_array($sq);
$message="";
// $num=0;

if(isset($_POST['submit'])  && isset($_POST['pass'])&& isset($_POST['pass1']) && isset($_POST['pass2'])){
  
    $pass= md5($_POST['pass']);
    $pass1=md5($_POST['pass1']);
    $pass2 = md5($_POST['pass2']);
   // $login = $_POST['login'];

   $sq= mysqli_query($link,"SELECT * from enseignant where login= '".$_SESSION['login']."' ");
   $sq1=mysqli_fetch_array($sq);

   //$sqlog= mysqli_query($link,"SELECT * from enseignant where login= '$login' ");
   
   if($sq1['password'] == $pass){
        if($pass1 == $pass2){
           
            mysqli_query($link,"UPDATE enseignant SET password = '$pass1' where login= '".$_SESSION['login']."' ");
            
            header("Location:index.php");
          
        }else
        {
            $message="Mauvaise confirmation";
            
        }
   }
   else{
       $message="Le mot de passe actuel saisi est incorrect";
       
   }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professeur - Université Des Comores</title>
    <link rel="shortcut icon" href="./assets/img/udc.png">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/css.css">

</head>
<body>
    <section class="main-wrapper">
        <aside class="left-aside">
            <div class="header-aside">
                <img class="img-rd" src="./assets/img/udc.png" alt="logo UDC">
                <h6 class="m-3 baseline"><strong>Université Des Comores</strong></h6>
            </div>
            <nav class="nav-aside">
                <h4 class="blaze"><?php echo $sq1['nom'] . " " . $sq1['prenom']; ?></h4>
                <div class="meta-blaze">
                    <span class="mb-it"><i class="icon-envelope"></i> <?php echo $sq1['email'] ?></span>
                    <span class="mb-it"><i class="icon-phone"></i> <?php echo $sq1['tel']; ?></span>
                </div>
                <div class="nav-items">
                    <a href="teacher.php" class="btn btn-menu btn-block"><i class="icon-home"></i>&nbsp; Accueil</a>
                    <a href="modif.php" class="btn btn-menu btn-block"><i class="icon-lock"></i>&nbsp; Changer pass</a>
                    <a href="deconnexion.php" class="btn btn-menu btn-block"><i class="icon-logout"></i>&nbsp; Déconnexion</a>
                </div>
            </nav>
        </aside>
        <main class="main-content">
            <div class="text-center mb-5">
                <h1 class="soft-title-1">Modification</h1>
            </div> 
            <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="log-box sgnup">
                        
                        <form action ="modif.php" method="POST">
                            <div class="form-row">
                              <div class="form-group col-sm-12">
                                <label for="nom" class="sr-only">Ancien mot de passe</label>
                                <input type="password" class="form-control" name="pass" placeholder="Ancien mot de passe" required>
                              </div>
                              
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                  <label for="email" class="sr-only">Nouveau mot de passe</label>
                                  <input type="password" class="form-control" name="pass1" placeholder="Nouveau mot de passe" required>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                  <label for="subject" class="sr-only">Confirmation mot de passe</label>
                                  <input type="password" class="form-control" name="pass2" placeholder="Confirmation mot de passe" required>
                                </div>
                            </div>
                            
                            <div class="mt-2 text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
                                <br>
                                <br>
                                <?php
                                    if($message !=""){
                                        echo '<div class="alert alert-danger" role="alert">'.$message.'</div> ';                                   
                                    }
         
                                ?>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>      
  

    </main>
    </section>
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/script.js"></script>