<?php

function str_name($name){
    return mb_strtoupper(mb_substr($name, 0, 1)) . mb_substr($name, 1);
}

function str_first_char($string){
    return str_limit($string, 1, '');
}