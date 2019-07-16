<?php

function readImage(array $info):array
{
    $imagePath=array_shift($info);
    $image=new Imagick($imagePath);
    $info=['image'=>$image] + $info;
    return $info;
}