<?php

function readCommandLineInput(array $argv):array
{
    $keys=['input-file','output-file','width','height','format','watermark','help'];
    $payload1=array_fill_keys($keys,'');
    array_shift($argv);
    foreach ($argv as $argument){
        preg_match("/(?<index>\w+-?\w+)=?(?<value>[\/?\w]+:?\/*\.?\w*)?/",$argument,$matches);
        $payload1[$matches['index']]=$matches['value'];
    }
    return $payload1;
}