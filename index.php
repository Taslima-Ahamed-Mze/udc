<?php
session_start();
include('connex.php');
// if(isset($_POST['pass']) && isset($_POST['login']) ){
    
//   $login = $_POST['login'];
//   $pass=$_POST['pass'];

    if( isset($_POST['submit1']) ){
        $login = $_POST['login'];
        $pass=$_POST['pass'];
        $requete = "SELECT * from etudiant where mat_etud = '$login' and NIN = '$pass'";
        $sql = mysqli_query($link,$requete);
        if(mysqli_num_rows($sql) != 0){
            $result=mysqli_fetch_array($sql);
            $_SESSION['nom'] = $result['nom'];
            $_SESSION['prenom'] = $result['prenom'];
            $_SESSION['login'] =$login;
          
            $resul_con = $result['connexion'];
            $conex =$resul_con+1;
            mysqli_query($link,"UPDATE etudiant set connexion = $conex where mat_etud ='$login'");
            header("Location:student.php");

        }else{

          $message ="Identifiants incorrects";

        }
    }
    elseif(isset($_POST['submit2'])){
        $login = $_POST['login'];
        $pass=$_POST['pass'];
        $mdp=md5($pass);
        $requete = "SELECT * from enseignant where login = '$login' and password = '$mdp'";
        $sql = mysqli_query($link,$requete);
        if(mysqli_num_rows($sql) != 0){
            $result=mysqli_fetch_array($sql);
            $_SESSION['nom'] = $result['nom'];
            $_SESSION['prenom'] = $result['prenom'];
            $_SESSION['login'] =$login;
            $_SESSION['id'] = $result['id_enseignant'];
            $resul_con = $result['connexion'];
            $conex =$resul_con+1;
            mysqli_query($link,"UPDATE enseignant set connexion = $conex where login ='$login'");
            header("Location:teacher.php");

        }else{

            $message ="Identifiants incorrects";
            
        }
    }
// }
?>










<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Université Des Comores</title>
    <link rel="shortcut icon" href="./assets/img/udc.png">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/css.css">

</head>
<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center"><img src="./assets/img/logo_udc.png" alt="logo UDC" width="60">&nbsp;Université Des Comores</h1>
                </div>
            </div>
        </div>
    </header>
    <section id="connect-sx">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="log-box">
                        <h3 class="log-hd">Se connecter</h3>
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab" aria-controls="teacher" aria-selected="true">Enseignant</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="false">Etudiant</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active pt-3" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                                <form method="POST" action ="index.php">
                                    <div class="form-group">
                                        <label for="user1" class="sr-only">Nom d'utilisateur</label>
                                        <input type="text" name="login" class="form-control" id="user1" placeholder="Nom d'utilisateur" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pass1" class="sr-only">Password</label>
                                        <input type="password" name="pass" class="form-control" id="pass1" placeholder="Mot de passe" required>
                                    </div>
                                    <button type="submit" name="submit2" class="btn btn-primary btn-block">Se connecter</button>
        
                                    <div class="mt-2 text-center">
                                        <small><a href="forget.php">Mot de passe oublié ?</a></small><br />
                                        <small class="error"><?php echo $message  ?></small><br />

                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane pt-3" id="student" role="tabpanel" aria-labelledby="student-tab">
                                <form method="POST" action ="index.php">
                                    <div class="form-group">
                                        <label for="user2" class="sr-only">Matricule</label>
                                        <input type="text" name="login" class="form-control" id="user2" placeholder="Matricule" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pass2" class="sr-only">Password</label>
                                        <input type="password" name="pass" class="form-control" id="pass2" placeholder="Mot de passe" required>
                                    </div>
                                    <button type="submit" name="submit1" class="btn btn-primary btn-block">Se connecter</button>
        
                                    <div class="mt-2 text-center">
                                        <small><a href="forget.php">Mot de passe oublié ?</a></small><br />

                                        <small class="error"><?php echo $message  ?></small><br />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p><small>Université Des Comores &copy; 2020</small></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- javaScript -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>