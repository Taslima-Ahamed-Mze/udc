<?php
    $destinataire = $_GET['$mail_enseignant'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact support - Université Des Comores</title>
    <link rel="shortcut icon" href="./assets/img/udc.png">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="./assets/css/main.css">
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
                    <div class="log-box sgnup">
                        <h3 class="log-hd">Nous contacter</h3>
                        <form method='post' action='contact.php'>
                            <div class="form-row">
                              <div class="form-group col-sm-6">
                                <label for="nom" class="sr-only">Nom</label>
                                <input type="text" class="form-control" id="nom" placeholder="Nom" required>
                              </div>
                              <div class="form-group col-sm-6">
                                <label for="prenom" class="sr-only">Prénom</label>
                                <input type="text" class="form-control" id="prenom" placeholder="Prénom" required>
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                  <label for="email" class="sr-only">Adresse email</label>
                                  <input type="email" class="form-control" id="email" placeholder="Adresse email">
                                </div>
                                <div class="form-group col-sm-6">
                                  <label for="telephone" class="sr-only">Téléphone</label>
                                  <input type="tel" class="form-control" id="telephone" placeholder="Numéro de téléphone">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                  <label for="subject" class="sr-only">Objet</label>
                                  <input type="text" class="form-control" id="subject" placeholder="Objet" required>
                                  <input type="hidden" class="form-control" id="destinataire" value="<?php echo $destinataire ?>" >

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                  <label for="msg" class="sr-only">Message</label>
                                  <textarea id="msg" class="form-control" rows="4" placeholder="Tapez votre message"></textarea>
                                </div>
                            </div>

                            <div class="mt-2 text-center">
                                <button type="submit" id="send" class="btn btn-primary">Envoyer un message</button>
                                <br>
                                <small><a href="index.php">Se connecter</a></small>
                                <div id="message"></div>

                            </div>
                          </form>
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
    <script src="./assets/js/contact.js"></script>

</body>
</html>