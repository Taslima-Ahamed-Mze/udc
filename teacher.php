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
                    <a href="modif.php" class="btn btn-menu btn-block"><i class="icon-lock"></i>&nbsp; Changer pass</a>
                    <a href="deconnexion.php" class="btn btn-menu btn-block"><i class="icon-logout"></i>&nbsp; Déconnexion</a>
                </div>
            </nav>
        </aside>
        <main class="main-content">
            <div class="text-center mb-5">
                <h1 class="soft-title-1">Liste des cours</h1>
                <h5 class="soft-title-1">Veuillez cliquer sur un bloc pour insérer un cours </h5>

            </div>
            <div class="row">
            <?php
                    while($r_e = mysqli_fetch_object($r_enseignant)) {
                        $code_niv = $r_e->code_niv;
                        $code_depart = $r_e->code_depart;
                        $code_facult = $r_e->code_facult;
                        $id_enseignement = $r_e->id;
                        $r_departement = mysqli_query($link,"SELECT * FROM departement where code_depart='".$code_depart."'");
                        while($r_dep = mysqli_fetch_object($r_departement)) {
                            $departement = $r_dep->design_depart;
                        }
                        $r_facult = mysqli_query($link,"SELECT * FROM faculte where code_facult='".$code_facult."'");
                        while($r_fac = mysqli_fetch_object($r_facult)) {
                            $facult = $r_fac->design_facult;
                        }
                        $r_niveau = mysqli_query($link,"SELECT * FROM niveau where code_niv='".$code_niv."'");
                        while($r_niv = mysqli_fetch_object($r_niveau)) {
                            $niveau = $r_niv->intit_niv;
                        }
                        


                        echo '
                        <div class="col-lg-4 col-md-6">
                            <div class="course-card">
                                <div class="cc-header">
                                    <h4 class="cc-title" title="Institut Universitaire de Technologies">'.$facult.'</h4>
                                </div>
                                <a href="#" class="block" data-toggle="modal" data-target="#exampleModal" data-coursename="'.$r_e->intitule.'" data-id='.$id_enseignement.' data-code_facult='.$code_facult.' data-code_depart='.$code_depart.' data-code_niv='.$code_niv.' class="cc-content">
                                    <div class="dtl-cc">'.$departement.'</div>
                                    <div class="dtl-cc">'.$niveau.'</div>
                                    <div class="dtl-cc">'.$r_e->intitule.'</div>
                                </a>
                                <div class="cc-footer">
                                    <a href="detail.php?facult='.$code_facult.'&dep='.$code_depart.'&niv='.$code_niv.'" class="btn btn-outline-dark btn-sm">Voir cours</a>
                                </div>
                            </div>
                        </div>
                        ';

                    }
                ?>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserer un fichier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="contactForm" method="post" action='' enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" id="courseid">
                            <label for="inputfile" class="col-form-label sr-only">Fichier :</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <div class="text-right">
                            <button type="button" name="submit" id="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                        
                    </form>
                </div>
                
                <div class="modal-footer">
                
                </div>
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

    
    <!-- <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var coursename = button.data('coursename')
        var courseid = button.data('courseid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Nouveau fichier sur ' + coursename)
        modal.find('.modal-body #courseid').val(courseid)
        })
    </script> -->
</body>
</html>