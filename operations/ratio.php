<?php
require_once "utils/utilityFunctions.php";

function getFixedParameterForFormat($payload):array
{
    if(!empty($payload[WIDTH])){
        return [WIDTH=>(int)$payload[WIDTH]];
    }
    if(!empty($payload[HEIGHT])){
        return [HEIGHT=>(int)$payload[HEIGHT]];
    }
    /** @var Imagick $image */
    $image=$payload[IMAGE];
    return [WIDTH=>$image->getImageWidth()];
}

/**
 * @param string $ratioString
 * @return array
 */
function getRatioParameters(string $ratioString):array
{
    [$width,$height]=explode(':',$ratioString);
    return ['ratioWidth'=>(int)$width,'ratioHeight'=>(int)$height];

}
function removeParametersFromOutputArray($payload){
    unset($payload[WIDTH]);
    unset($payload[HEIGHT]);
    unset($payload[FORMAT]);
    unset($payload[HELP]);
    return $payload;
}
function resizeByFormat(array $payload):array
{

    if(!canExecuteFunction(FORMAT,$payload)){
        $newPayload=removeParametersFromOutputArray($payload);
        return $newPayload;
    }

    $fixedParameter=getFixedParameterForFormat($payload);
    $ratioParameters=getRatioParameters($payload[FORMAT]);

    /** @var Imagick $image */
    $image=$payload[IMAGE];
    if(array_key_exists(WIDTH,$fixedParameter)){
        $newHeight=$fixedParameter[WIDTH]*$ratioParameters['ratioHeight']/$ratioParameters['ratioWidth'];
        $image->scaleImage($fixedParameter[WIDTH],$newHeight);
    }

    if(array_key_exists(HEIGHT,$fixedParameter)){
        $newWidth=$fixedParameter[HEIGHT]*$ratioParameters['ratioWidth']/$ratioParameters['ratioHeight'];
        $image->scaleImage($newWidth,$fixedParameter[HEIGHT]);
    }

    $payload[IMAGE]=$image;
    $newPayload=removeParametersFromOutputArray($payload);
    return $newPayload;

}