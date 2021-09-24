<?php
ob_start();
?>

<?php
// On récupère les données grâce à la fonction que nous avons créée dans le offerDao.php
?>

<div class="" id="offers">
    <div class="container">
        <div class="row">
            <?php foreach ($offers as $offer) : ?>

                <?php
                $images = getImageOfOffer($offer['id_offer']);
                ?>
                <?php
                foreach ($images as $image) { ?>
                    <a href="<?=URL?>offerDetails&id_offer=<?= $offer['id_offer'] ?>">
                        <img src="<?=URL?><?=$image['url_image']?>" class="m-1" style="width: 300px; height: 250px;" data-src="<?=$image["name_image"]?>" alt="<?=$image["name_image"]?>"><br/>
                    </a>
                    <?php
                }
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script src="<?= URL ?>public/js/offers.js"></script>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>


