<?php
    session_start();
    if (empty($_SESSION['login'])){
        header('location:index.php');
    }
    require_once('connex.php');
    $sqr= mysqli_query($link,"SELECT * FROM enseignement,niveau,departement,enseignant where 
    enseignement.code_niv=niveau.code_niv and enseignement.code_depart = departement.code_depart 
    and enseignant.id_enseignant = enseignement.id_enseignant and enseignant.login = '".$_SESSION['login']."' ");
    $sqr1=mysqli_fetch_array($sqr);
    $facu=mysqli_query($link,"SELECT * FROM faculte where code_facult= '".$sqr1['code_facult']."'");
    $r_enseignant = mysqli_query($link,"SELECT * FROM enseignement,enseignant where 
    enseignant.id_enseignant= enseignement.id_enseignant and enseignant.login= '".$_SESSION['login']."'");

    $facult = $_GET['facult'];
    $dep = $_GET['dep'];
    $niv = $_GET['niv'];

    $r_enseignant = mysqli_query($link,"SELECT * FROM enseignement,cours where enseignement.id=cours.id_enseignement and code_facult='".$facult."' and code_depart='".$dep."' and code_niv='".$niv."' and id_enseignant=".$_SESSION['id']);
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
                <h4 class="blaze"><?php echo $sqr1['nom'] . " " . $sqr1['prenom']; ?></h4>
                <div class="meta-blaze">
                    <span class="mb-it"><i class="icon-envelope"></i> <?php echo $sqr1['email'] ?></span>
                    <span class="mb-it"><i class="icon-phone"></i> <?php echo $sqr1['tel']; ?></span>
                </div>
                <div class="nav-items">
                    <a href="teacher.php" class="btn btn-menu btn-block"><i class="icon-home"></i>&nbsp; Accueil</a>
                    <a href="#" class="btn btn-menu btn-block"><i class="icon-lock"></i>&nbsp; Changer pass</a>
                    <a href="deconnexion.php" class="btn btn-menu btn-block"><i class="icon-logout"></i>&nbsp; Déconnexion</a>
                </div>
            </nav>
        </aside>
        <main class="main-content">
            <div class="text-center mb-5">
                <h1 class="soft-title-1">Détails des cours</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fichier</th>
                                    <th>Statut</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>


                            <?php
                                while($r_e = mysqli_fetch_object($r_enseignant)) {
                                    $path = "cours/".$facult."/".$dep."/".$r_e->depot;
                                    if($r_e->statut == 0)
                                    {
                                        $status = "Publié";
                                    }
                                    else{
                                        $status = "Retiré";
                                    }

                                    echo '
                                        <tr>
                                            <td><a href="'.$path.'" target="blank">'.$r_e->depot.'</a></td>
                                            <td><div class="publie" id="'.$r_e->id.'" data-id="'.$r_e->id.'">'.$status.'</div></td>
                                            <td><small><a href="'.$path.'" target="blank">Voir</a>&nbsp;<a href="#" class="supprimer"  data-id="'.$r_e->id.'">Supprimer</a></small></td>
                                        </tr>
                                    ';

                                }
                            ?>
                                <!-- <tr>
                                    <td><a href="#">Cours_Thermodynamique_STE_S2.pdf</a></td>
                                    <td>Publié</td>
                                    <td><small><a href="#">Voir</a>&nbsp;<a href="#">Supprimer</a></small></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <!-- javaScript -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/script.js"></script>

</body>
</html>