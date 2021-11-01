<?php

// Custom offer list Pagination
function getPagination($offerStatusId, $uri): array
{
    $currentPageUri = explode("?", $uri);
    $currentPageUriItemsCount = count($currentPageUri);
    $currentPage = Security::securityHtml(substr($currentPageUri[1], strpos($currentPageUri[1], "=") + 1));
    $numberTotalOfOffer = count(getOfferByStatusIdAndOfferOwnerId($offerStatusId, $_SESSION["id"]));
    $numberOfLinesPerPage = 2;
    $offset = 0;
    if ($currentPageUriItemsCount === 1)
        $offset = 0;
    if ($currentPageUriItemsCount === 2)
        $offset = ($currentPage - 1) * $numberOfLinesPerPage;
    $offers = getUserOffersList(1, $_SESSION["id"], $offset, $numberOfLinesPerPage);
    $totalNumberOfPages = ceil($numberTotalOfOffer / $numberOfLinesPerPage);

    $viewHasPagination = true;
    if ($numberTotalOfOffer <= $numberOfLinesPerPage)
        $viewHasPagination = false;
    return array($offers, $totalNumberOfPages, $viewHasPagination);
}
