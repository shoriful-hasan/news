<?php

function str_limit($string,$limit=200){
    $string = $string."";
    $string = substr($string,0,$limit);
    $string = substr($string,0,strpos($string,""));
    $string = $string."....";
    return $string;
}



?>