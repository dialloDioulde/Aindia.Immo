<?php


function getCheckBoxValue($checkBoxFieldValue): string {
    $offerShowerAndKitchen = array();
    foreach($checkBoxFieldValue as $checkBoxValue)
    {
        array_push($offerShowerAndKitchen, $checkBoxValue);
    }
    $offerPeculiarity = "";
    $checkboxValueCount = count($offerShowerAndKitchen);
    for ($i = 0; $i < $checkboxValueCount; $i++) {
        if ($i === $checkboxValueCount - 1) {
            $offerPeculiarity .= $offerShowerAndKitchen[$i] . ".";
        } else {
            $offerPeculiarity .= $offerShowerAndKitchen[$i] . "," . " ";
        }
    }

    return $offerPeculiarity;
}
