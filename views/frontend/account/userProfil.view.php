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
    <link href="<?= URL ?>public/css/userProfile.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">

    <!-- Box Icons -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="<?= URL ?>public/bootstrap/js/bootstrap.js"></script>

</head>


<body id="body-pd">
<header class="header" id="header">
    <div class="header__toggle">
        <i class='bx bx-menu' id="header-toggle"></i>
    </div>

    <div class="header__img">
        <?php echo $_SESSION['name_user']?>
        <img src="assets/img/perfil.jpg" alt="">
    </div>
</header>

<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="welcomeOffer"  class="nav__logo">
                <i class='bx bx-store nav__logo-icon''></i>
                <span class="nav__logo-name">AINDIA</span>
            </a>

            <div class="nav__list">
                <a href="#" class="nav__link">
                    <i class='bx bx-user-circle  nav__icon' ></i>
                    <span class="nav__name">PROFIL</span>
                </a>

                <!-- Offers -->
                <div  class="submenu">
                    <i class='bx bxs-dashboard'></i>
                    <span class="nav__name ml-3">OFFRES</span>
                    <i class='bx bx-chevron-down' id="collapse__link"></i>
                    <ul class="collapse__menu">
                        <li><a href="userProfil&actionType=pending" class="collapse__sublink">Attentes</a></li>
                        <li><a href="userProfil&actionType=approved"  class="collapse__sublink">Approuvées</a></li>
                        <li><a href="userProfil&actionType=moderated"  class="collapse__sublink">Modérées</a></li>
                        <li><a href="userProfil&actionType=hided"  class="collapse__sublink">Retirées</a></li>
                        <li><a href="userProfil&actionType=blocked"  class="collapse__sublink">Bloquées</a></li>
                    </ul>
                </div>
                <!-- Offers -->

                <a href="#" class="nav__link">
                    <i class='bx bx-wallet nav__icon'></i>
                    <span class="nav__name">PAIEMENTS</span>
                </a>

            </div>
        </div>

        <a href="userLogout" class="nav__link logout">
            <i class='bx bx-log-out nav__icon' ></i>
            <span class="nav__name">Déconnexion</span>
        </a>
    </nav>
</div>

<section class="home-section mt-2">
    <?= $contentView ?>
</section>


<script src="<?= URL ?>public/js/userProfile.js"></script>


</body>

</html>



