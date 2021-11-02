<?php

// Importation des Fichiers
require_once "config/config.php";
require_once "public/utils/formatage.php";
require_once "models/pdo.php";
require_once "models/offerDao.php";
require_once "models/imageDao.php";
require_once "models/publicDao.php";
require_once "models/categoryDao.php";
require_once "models/userDao.php";
require_once "models/statusDao..php";

// Custom offer list Pagination
function getPagination($offerStatusId, $uri): array
{
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
    return array($offers, $totalNumberOfPages, $hasPagination);
}
