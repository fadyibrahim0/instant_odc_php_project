<?php

function validString($var) {
    return trim(htmlentities(htmlspecialchars($var)));
}

function minVal($string, $min) {
    if(strlen($string) < $min) {
        return true;
    }
    return false;
}

function maxVal($string, $max) {
    if(strlen($string) > $max) {
        return true;
    }
    return false;
}