<?php


function checkRequestMethod($method){

    if($_SERVER['REQUEST_METHOD']==$method){
        return true;
    }

    return false;
}


function checkPostInput($input){

    if(isset($_POST[$input])){
        return true;
    }

    return false;
}

function sanitizeInput($input){
    return trim(htmlspecialchars(htmlentities($input)));

}

function redirection($path){
    header("location:$path");
}


function requireVal($input){
    if(empty($input)){
        return false;
    }

    return true;
}

function minVal($input, $length){
    if(strlen($input)< $length){
        return false;
    }

    return true;
}

function maxVal($input, $length){
    if(strlen($input)> $length){
        return false;
    }

    return true;
}


function emailVal($input){
    if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
        return false;
    }

    return true;

}



?>