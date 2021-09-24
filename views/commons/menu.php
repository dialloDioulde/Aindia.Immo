<nav class="navbar navbar-expand-lg navbar-dark bg-dark my_HeaderFontSize">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= URL ?>welcomeOffer" id="home">
                    A.Immo
                </a>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Services
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-dark" href="<?= URL ?>a.immo">Immobilier</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Secteurs
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item perso_ColorOrangeMenu" href="<?= URL ?>dashboard">Admin</a>
                    <a class="dropdown-item perso_ColorOrangeMenu" href="#">Annonces</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
