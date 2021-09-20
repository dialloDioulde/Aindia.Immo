<?php
ob_start();
?>

<?php
// On récupère les données grâce à la fonction que nous avons créée dans le offerDao.php
$offers = getOffers();
?>

<div class="" id="offers">
    <div class="container">
        <div class="row">
            <?php foreach ($offers as $offer) : ?>
                <?php
                $images = getImageOfOffer($offer['id_offer']);
                ?>
                <div class="col-md-4 mt-1 mb-1" id="offers-content">
                    <?php
                    foreach ($images as $image) { ?>
                        <a href="<?=URL?>offerDetails&id_offer=<?= $offer['id_offer'] ?>">
                            <img src="<?=URL?><?=$image['url_image']?>" style="width: 350px; height: 350px;" data-src="<?=$image["name_image"]?>" alt="<?=$image["name_image"]?>"><br/>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script src="<?= URL ?>public/js/offers.js"></script>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>


