<?php
ob_start();
?>

<div class="container p-2">
    <h3 class="text-center"><?= $viewHeaderTitle ?></h3>
    <?php if (count($offers) > 0) { ?>
        <!-- Offers Table -->
        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="row">Réf</th>
                <th scope="col">Logement</th>
                <th scope="col">Public</th>
                <th scope="col">Loyé</th>
                <th scope="col">Pièces</th>
                <th scope="col">Ville</th>
                <th scope="col" class="">Actions</th>
            </tr>
            </thead>
            <?php foreach ($offers as $offer) : ?>
                <?php
                $offer = getOfferById($offer['id_offer']);
                $images = getImagesOfOffer($offer['id_offer']);
                $publicOffer = getPublicOfOffer($offer['public_offer']);
                $categoryOffer = getCategoryOfOffer($offer['category_offer']);
                $offer_owner = getUserById($offer['offer_owner']);
                ?>

                <!-- Offers Table -->
                <tbody>
                <tr id="<?= $offer['id_offer'] ?>">
                    <th scope="row"><?= $offer['id_offer'] ?></th>
                    <td><?php echo $categoryOffer['name_category'] ?></td>
                    <td><?php echo $publicOffer['name_public'] ?></td>
                    <td><?php echo $offer['price_offer'] ?></td>
                    <td><?php echo $offer['pieces_offer'] ?></td>
                    <td><?php echo $offer['city_offer'] ?></td>
                    <td class="d-inline-block">
                        <button type="button" class="btn btn-dark offer-display-btn"
                                data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">
                            <i class='bx bxs-show'></i>
                        </button>
                        <button type="button" class="btn btn-dark offer-edit-btn"
                                data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">
                            <i class='bx bxs-message-square-edit'></i>
                        </button>
                        <button type="button" class="btn btn-dark offerDeleteBtn"
                                data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">
                            <i class="icon-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
        <!-- Offers Table -->

        <!-- Pagination -->
        <ul id="offer-dashboard-pagination">
        <?php if ($hasPagination) : ?>
            <?php for ($i = 1; $i <= $totalNumberOfPages; $i++) : ?>
                <li class="<?php if ($currentPage == $i) {
                    echo 'active';
                } ?> bg-dark">
                    <a href="?page=<?php echo $i; ?>" class="text-white"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            </ul>
        <?php endif; ?>
        <!-- Pagination -->
    <?php } ?>
</div>


<!-- Début : Affichage d'une Offre  -->
<?php require_once "public/utils/offersTemplates/displayOfferFormModal.php"; ?>
<!-- Fin : Affichage d'une Offre  -->

<!-- Début : Suppression d'une Offre -->
<?php require_once "public/utils/offersTemplates/deleteOfferFormModal.php"; ?>
<!-- Fin : Suppression d'une Offre -->

<!-- START : edit offer -->
<?php require_once "public/utils/offersTemplates/editOfferFormModal.php"; ?>
<!-- END : edit offer -->


<script src="<?= URL ?>public/js/offers.js"></script>



<?php
$contentView = ob_get_clean();
?>
