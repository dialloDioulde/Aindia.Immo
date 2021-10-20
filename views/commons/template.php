<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= $description ?>">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="<?= URL ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= URL ?>public/css/main.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="<?= URL ?>public/bootstrap/js/bootstrap.js"></script>
</head>

<body>
    <!-- Début : Corps Du Site WEB -->
    <div class="container-fluid p-0 rounded my_shadow">
        <!-- Début Header -->
        <header class="bg-info text-white sticky-top rounded-top my_policeTitle ">
            <div class="row align-items-center m-0">
                <div class="col-6 col-lg-10 m-0 p-0">
                    <?php include("views/commons/menu.php") ?>
                </div>
                <div class="col col-lg-2  text-right pt-1 pr-4">
                    <?php if(isset($_SESSION["id"]) && $_SESSION['role_is_admin']) { ?>
                        <a href="<?= URL ?>dashboard" class="nav-link d-inline text-white">Admin</a>
                    <?php } elseif (isset($_SESSION["id"]) && $_SESSION['role_is_user']) { ?>
                        <a href="<?= URL ?>userProfil" class="nav-link d-inline text-white"><?php echo $_SESSION['name_user']?></a>
                        <?php } else {?>
                        <a href="<?= URL ?>userLogin" class="nav-link d-inline text-white">Connexion</a>
                    <?php }?>
                </div>
            </div>
        </header>
        <!-- Fin Header -->

        <!-- Début Contenu du Site Web Début -->
        <div class="my_HeightSizeMin">
            <?= $content ?>
        </div>
        <!-- Fin Contenu du Site Web -->

        <!-- Début Footer -->
        <!-- <footer class="bg-dark text-white rounded-bottom">
            <div id="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="contact-left">
                                <h3>COORDONNÉES</h3>
                                <p>Notre Objectif c'est Votre Satisfaction !</p>
                                <div id="contact-info">
                                    <address>
                                        <p>
                                            <strong>Aindia-Immo </strong><br>
                                            8 Rue De L'Ecrin<br>
                                            34080, Montpellier, France
                                        </p>
                                    </address>
                                    <div id="phone-email">
                                        <p>
                                            <strong>Tel : </strong> <span>+336 26 58 57 13</span><br>
                                            <strong>Email : </strong> <span>contact@aindia.com</span><br>
                                        </p>
                                    </div>
                                    <ul class="social-list">
                                        <li><a href="#" class="social-icon"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="social-icon"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="social-icon"><i class="fa fa-whatsapp"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="contact-right">
                                <h3>CONTACTEZ NOUS</h3>
                                <form class="" method="POST" action="">
                                    <input type="text" name="username" class="form-control contact-form" placeholder="Indiquer votre nom">
                                    <input type="text" name="email" class="form-control contact-form" placeholder="Indiquer votre email">
                                    <textarea rows="5" name="message" class="form-control contact-form" placeholder="Taper votre Message"></textarea>
                                    <div id="send-btn">
                                        <button type="submit" class="btn mt-1">ENVOYER</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="footer-copyrights">
                                <p>Copyrights &copy; 2021 Tous Droits Réservés</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="footer-menu">
                                <ul>
                                    <li><a href="#immovable">Immobilier</a></li>
                                    <li><a href="#login">Connexion</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
        -->
        <!-- Fin Footer -->
    </div>

    <!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="public/bootstrap/js/bootstrap.js"></script>
     -->

    <!-- Début : Corps Du Site WEB -->
</body>

</html>
