<?php

function styleTitleLevel_1($text, $color) {
    $txt = "<h1 class='text-center mt-4 ".$color." my_policeTitle'>";
    $txt .= $text;
    $txt .= "</h1>";
    return $txt;
}
function styleTitleLevel_2($text, $color) {
    $txt = "<h2 class='text-center mt-5 ".$color." my_policeTitle'>";
    $txt .= $text;
    $txt .= "</h2>";
    return $txt;
}

?>
