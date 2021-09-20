<?php
ob_start();
?>

<!-- À Propos de Aindia Intérim -->
<?php echo styleTitleLevel_1("Aindia Intérim", COLOR_TITLE_LEVEL_A_INTERIM);?>

<div class="row align-items-center">
    <div class="col-12 col-lg-3 text-center">
    </div>
    <div class="col-12 col-lg-9">
        <hr/>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-12 col-lg-3 text-center"></div>
    <div class="col-12 col-lg-9 p-4">
        <p>
            Aindia Interim est une plateforme Numérique qui a pour objectif de dématérialiser
            l'ensemble des processus concernant les activités d'Intérim en offrant une meilleure visibilité aux
            entreprises dans le besoin des travailleurs dynamiques et motivés.
        </p>
        <p>
            Notre ambition est de participer au développement du Sénégal que nous aimons tant et qui nous a beaucoup donné
            en mettant notre savoir fare au service de l'accès à l'emploi à toutes et tous les Sénéaglais. <br/>
        </p>
        <p>
            À travers ce service numérique nous comptons de répondre de manière significative le besoin des entreprises
            et également celui des chercheurs d'emploi avec respect et éfficacité.
        </p>
    </div>
</div>

<!-- À Propos de Aindia Intérim -->



<!-- Équipe de Aindia Intérim -->

<div class="row align-items-center mt-3">
    <div class="col-12 col-lg-3 text-center">
    </div>
    <div class="col-12 col-lg-9">
        <hr/>
    </div>
</div>

<?php echo styleTitleLevel_2("L'Équipe", COLOR_TITLE_LEVEL_A_INTERIM_TEAM);?>
<div class="row align-items-center mt-3">
    <div class="col-12 col-lg-3 text-center">
    </div>
    <div class="col-12 col-lg-9 p-4">
        <p>
            L'Équipe de Aindia Intérim est composé de 4 membres très créatifs et engagés pour le développement du Sénégal. <br/>
        </p>
        <span class="badge badge-primary">Diouldé DIALLO -- </span> Fondateur, Développeur & PDG<br /><br />
        <span class="badge badge-success">Driss Junior DIALLO -- </span> Chargé Du Partenariat Et Du Marketing<br /><br />
        <span class="badge badge-warning">Ibrahima Tamsir SEYDI -- </span> Graphiste <br /><br />
        <span class="badge badge-danger">Goundoba DOUCOURÉ -- </span> Chargée De Communication <br /><br />
    </div>
</div>

<div class="row align-items-center mt-3">
    <div class="col-12 col-lg-3 text-center">
    </div>
    <div class="col-12 col-lg-9">
        <hr/>
    </div>
</div>

<!-- Équipe de Aindia Intérim -->




<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>
