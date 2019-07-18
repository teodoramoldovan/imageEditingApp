<?php

function readImage(array $info):array
{
    $imagePath=$info[INPUT_FILE];
    $image=new Imagick($imagePath);
    $info=[IMAGE=>$image] + $info;
    return $info;
}