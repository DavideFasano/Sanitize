<?php
function sanitizeName($name){

    $noScript = preg_replace('/<script\b[^>]*>(.*?)<\/script>/m', "", $name);
    /* $noSpaceEndName = preg_replace('/(\s)+$/m',"",$noScript);
    $noSpaceStartName = preg_replace('/(^\s*)+/m',"",$noSpaceEndName); */
    //elimina tag
    $strippedName = strip_tags($noScript);
    //$strippedName = filter_var($noSpaceName, FILTER_SANITIZE_STRING);
    //elimina simboli e numeri
    $tinyName = preg_replace('/[^a-zA-Z .]+/m',"",$strippedName);
    $cleanName = preg_replace('/[ ]{2,}/m'," ",$tinyName);
    //rende stringa in array*
    $explodeName = explode(" ",$cleanName);
    //corregge maiuscole e minuscole
    $correctNames = array_map('correctCase',$explodeName);
    //ricompatta array* e esce con stringa singola
    $finalName = implode(" ",$correctNames);
    $noSpaceEndNameLast = preg_replace('/(\s)+$/m',"",$finalName);
    return preg_replace('/(^\s*)+/m',"",$noSpaceEndNameLast);
    

}

function correctCase($name){
    // aAAa | AAA   ->  aaa
    $nameLowerCase = strtolower($name);
    //aaaa   ->   Aaaa
    $upperCaseName = ucfirst($nameLowerCase);
    return $upperCaseName;
}


