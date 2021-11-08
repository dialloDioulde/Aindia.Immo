<?php
/**
 * Files Import
 */
require_once "config/config.php";
require_once "public/utils/formatage.php";
require_once "models/pdo.php";
require_once "models/offerDao.php";
require_once "models/imageDao.php";
require_once "models/publicDao.php";
require_once "models/categoryDao.php";
require_once "models/userDao.php";
require_once "models/statusDao..php";

/**
 * View data customization
 * @param $actionType
 * @param $uri
 * @return array
 */
function viewDataCustomization($actionType, $uri): array
{
    $offerStatusId = 1;
    $titleAndDescription = array();
    if ($actionType === APPROVED) {
        $offerStatusId = 1;
        array_push($titleAndDescription,OFFER_APPROVED_VIEW_TITLE, OFFER_APPROVED_VIEW_DESCRIPTION);
    }
    if ($actionType === MODERATED) {
        $offerStatusId = 3;
        array_push($titleAndDescription, OFFER_MODERATED_VIEW_TITLE, OFFER_MODERATED_VIEW_DESCRIPTION);
    }
    if ($actionType === HIDED) {
        $offerStatusId = 4;
        array_push($titleAndDescription, OFFER_HIDED_VIEW_TITLE, OFFER_HIDED_VIEW_DESCRIPTION);
    }
    if ($actionType === BLOCKED) {
        $offerStatusId = 5;
        array_push($titleAndDescription,OFFER_BLOCKED_VIEW_TITLE, OFFER_BLOCKED_VIEW_DESCRIPTION);
    }
    if ($actionType === PENDING) {
        $offerStatusId = 6;
        array_push($titleAndDescription,OFFER_PENDING_VIEW_TITLE, OFFER_PENDING_VIEW_DESCRIPTION);
    }
    $currentPageUri = explode("?", $uri);
    $currentPageUriItemsCount = count($currentPageUri);
    $currentPage = Security::securityHtml(substr($currentPageUri[1], strpos($currentPageUri[1], "=") + 1));
    $numberTotalOfOffer = count(getOfferByStatusIdAndOfferOwnerId($offerStatusId, $_SESSION["id"]));
    $numberOfLinesPerPage = 10;
    $offset = 0;
    if ($currentPageUriItemsCount === 1)
        $offset = 0;
    if ($currentPageUriItemsCount === 2)
        $offset = ($currentPage - 1) * $numberOfLinesPerPage;
    $offers = getUserOffersList($offerStatusId, $_SESSION["id"], $offset, $numberOfLinesPerPage);
    $totalNumberOfPages = ceil($numberTotalOfOffer / $numberOfLinesPerPage);
    $hasPagination = true;
    if ($numberTotalOfOffer <= $numberOfLinesPerPage)
        $hasPagination = false;
    return array($titleAndDescription[0], $titleAndDescription[1], $offers, $totalNumberOfPages, $hasPagination);
}

