<?php
ob_start();
echo styleTitleLevel_2("Publication d'une Offre", COLOR_TITLE_LEVEL_A_INTERIM);
?>

<div class="row mt-2 p-2 justify-content-center" id="createOfferError">
    <?php if ($ALERT_OFFER_CREATE != "") {?>
        <div class="alert alert-success" id="alert" role="alert">
            <?= $ALERT_OFFER_CREATE; ?>
        </div>
    <?php } elseif ($ALERT_OFFER_CREATE_ERROR != "") { ?>
    <div class="alert alert-danger" id="alert" role="alert">
        <?= $ALERT_OFFER_CREATE_ERROR; ?>
    </div>
    <?php }?>
</div>

<div class="container mt-2 p-2">
    <div class="col-md-12 shadow">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="offerTitle">Titre : </label>
                    <input type="text" class="form-control" name="offerTitle" id="offerTitle">
                </div>
                <div class="form-group col-4">
                    <label for="offerCategory">Type de logement : </label>
                    <select name="offerCategory" id="offerCategory" class="form-control">
                        <?php foreach ($offerCategory = getOfferCategories() as $category) {?>
                            <?php echo '<option value="'.$category["id_category"].'">'.$category["name_category"].'</option>'; ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="offerPeople">Locataire souhaité : </label>
                    <select name="offerPeople" id="offerPeople" class="form-control">
                        <?php foreach ($offerPublic = getOfferPublic() as $public) {?>
                            <?php echo '<option value="'.$public["id_public"].'">'.$public["name_public"].'</option>'; ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="offerTime">Durée du Contrat : </label>
                    <input type="text" class="form-control" name="offerTime" id="offerTime">
                </div>
                <div class="form-group col-4">
                    <label for="offerAvailable">Disponibilité : </label>
                    <input type="text" class="form-control" name="offerAvailable" id="offerAvailable">
                </div>
                <div class="form-group col-4">
                    <label for="offerPieces">Nombre de pièce(s) : </label>
                    <input type="number" class="form-control" name="offerPieces" id="offerPieces">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="offerArea">Surface (m2) : </label>
                    <input type="text" class="form-control" name="offerArea" id="offerArea">
                </div>
                <div class="form-group col-6">
                    <label for="offerPrice">Loyé / Mois : </label>
                    <input type="number" class="form-control" name="offerPrice" id="offerPrice">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="offerCountry">Pays : </label>
                    <input type="text" class="form-control" name="offerCountry" id="offerCountry">
                </div>
                <div class="form-group col-6">
                    <label for="offerCity">Ville : </label>
                    <input type="text" class="form-control" name="offerCity" id="offerCity">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="offerPostalCode">Code Postal : </label>
                    <input type="text" class="form-control" name="offerPostalCode" id="offerPostalCode">
                </div>
                <div class="form-group col-6">
                    <label for="offerAddress">Adresse : </label>
                    <input type="text" class="form-control" name="offerAddress" id="offerAddress">
                </div>
            </div>

            <div class="form-group">
                <label for="offerDescription">Description : </label>
                <textarea class="form-control" id="offerDescription" name="offerDescription" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="numberOfImage">Photo(s): </label>
                <input type="file" class='form-control-file mt-2' name="offerImage[]" multiple="multiple" id="offerImage"/>
            </div>

            <div class="row no-guters p-3">
                <input type="submit" value="PUBLIER" class="btn btn-primary col">
            </div>
        </form>
    </div>
</div>

<script src="<?= URL ?>public/js/offerCreate.js"></script>



<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
