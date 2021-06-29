
<?php
    session_start();
    if (empty($_SESSION['login'])){
        header('location:index.php');
    }
    include('connex.php');
   
    $sqr= mysqli_query($link,"SELECT * from etudiant where mat_etud= '".$_SESSION['login']."' ");
    $sqr1=mysqli_fetch_array($sqr);
    $facu=mysqli_query($link,"SELECT * FROM faculte where code_facult= '".$sqr1['code_facult']."'");
    $fac = mysqli_fetch_array($facu);
    $depart=mysqli_query($link,"SELECT * FROM departement where code_depart LIKE '".$sqr1['code_depart']."'");
    $dep = mysqli_fetch_array($depart);
    $niveau=mysqli_query($link,"SELECT * FROM niveau where code_niv= '".$sqr1['code_niv']."'");
    $niv= mysqli_fetch_array($niveau);

    $sq8= mysqli_query($link,"SELECT * from etudiant,enseignement where etudiant.code_niv=enseignement.code_niv
    and etudiant.code_depart=enseignement.code_depart and mat_etud='".$_SESSION['login']."' ");
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant - Université Des Comores</title>
    <link rel="shortcut icon" href="./assets/img/udc.png">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="./assets/css/main.css">
</head>
<body>
    <section class="main-wrapper">
        <aside class="left-aside">
            <div class="header-aside">
                <img class="img-rd" src="./assets/img/udc.png" alt="logo UDC">
                <h6 class="m-3 baseline"><strong>Université Des Comores</strong></h6>
            </div>
            <nav class="nav-aside">
                <h4 class="blaze"><?php echo $sqr1['nom'] . " " . $sqr1['prenom']; ?></h4>
                <div class="meta-blaze">
                    <span class="mb-it"><strong>Matricule : </strong><?php echo $sqr1['mat_etud']; ?></span>
                    <span class="mb-it"><?=$fac['design_facult']  ?></span>
                    <span class="mb-it"><?=$dep['design_depart']  ?></span>
                    <span class="mb-it"><?= $niv['intit_niv'] ?></span>
                </div>
                <div class="nav-items">
                    <a href="deconnexion.php" class="btn btn-menu btn-block"><i class="icon-logout"></i>&nbsp; Déconnexion</a>
                </div>
            </nav>
        </aside>
        <main class="main-content">
            <div class="text-center mb-5">
                <h1 class="soft-title-1">Liste des cours</h1>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="accordion" id="accordionExample">
                        <?php 
                            while($sqr1=mysqli_fetch_array($sq8)) 
                            {
                                $sqr = mysqli_query($link,"select * from cours where id_enseignement = '".$sqr1['id']."'and statut = 1 order by date DESC ");
                                $req = mysqli_query($link,"SELECT * FROM enseignant WHERE id_enseignant = '".$sqr1['id_enseignant']."' ");
                                while($result = mysqli_fetch_object($req))
                                {
                                    $mail_enseignant = $result->email;
                                }

                                echo '
                                <div class="course-card fl-start">
                                    <a href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1" class="cc-header hdr-lnk">
                                        <h4 class="cc-title" title="Institut Universitaire de Technologies">'.$sqr1['intitule'].'</h4>
                                    </a>
                                    <div id="collapse1" class="cc-content collapse show" aria-labelledby="heading1" data-parent="#accordionExample">
                                        <ul class="list-unstyled">
                                    ';
                                   
                                            while($sqr2=mysqli_fetch_array($sqr))
                                            {
                                                $path="cours/".$sqr1['code_facult']."/".$sqr1['code_depart']."/".$sqr2['depot'];
                                        
                                                echo '
                                                    <li><a href="'.$path.'" target="blank" >'.$sqr2['depot'].'</a></li>
                                                ';
                                                
                                            }
                                    echo '
                                        </ul>
                                    </div>
                                    <a title="Demander info sur le cours " href="contact.php?mail_enseignant='.$mail_enseignant.'" class="bull-msg"><i class="icon-envelope"></i></a>
                                        
                                </div>';
                            
                            }
                        ?>
                    </div>
                </div>
            </div>

                        
        </main>
    </section>
    <!-- javaScript -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>