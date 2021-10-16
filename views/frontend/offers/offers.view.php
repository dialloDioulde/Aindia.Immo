<?php
ob_start();
?>

<?php
// On récupère les données grâce à la fonction que nous avons créée dans le offerDao.php
?>


<?php echo styleTitleLevel_2("Offres de Logement", COLOR_TITLE_LEVEL_A_INTERIM); ?>

<div class="m-3" id="searchBar">
    <div class="container">
        <input class="form-control" name="word" id="word" type="text" placeholder="rechercher" />
    </div>
</div>


<div class="" id="offers">
    <div class="container">
        <div class="row">
            <?php foreach ($offers as $offer) : ?>
                <?php
                    $offer = getOfferById($offer['id_offer']);
                    $images = getImagesOfOffer($offer['id_offer']);
                    $publicOffer = getPublicOfOffer($offer['public_offer']);
                    $categoryOffer = getCategoryOfOffer($offer['category_offer']);
                    $offer_owner = getUserById($offer['offer_owner']);
                ?>
                <a class="text-decoration-none" href="<?=URL?>offerDetails&id_offer=<?= $offer['id_offer'] ?>">
                    <div class="card m-1 mb-2" id="<?= $offer['id_offer'] ?>">
                        <div class="card-body text-dark p-2">
                            <p class="card-text text-center"><?php echo $categoryOffer['name_category'] ?></p>
                            <p class="card-text">Public : <?php echo $publicOffer['name_public']   ?></p>
                            <p class="card-text">Loyé Mensuel : <?php echo $offer['price_offer'] ?></p>
                            <p class="card-text">Pièces : <?php echo $offer['pieces_offer']  ?></p>
                            <p class="card-text">Ville : <?php echo $offer['city_offer'] ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>




<script src="<?= URL ?>public/js/offers.js"></script>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>


