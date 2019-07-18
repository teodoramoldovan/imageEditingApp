<?php
const IMAGE_CORNERS=["TOP_LEFT","TOP_RIGHT","BOTTOM_LEFT","BOTTOM_RIGHT"];

function resizeWatermark(Imagick $image,Imagick $watermark)
{
    $imageWidth=$image->getImageWidth();
    $newWatermarkWidth=0.15*$imageWidth;
    $watermark->scaleImage($newWatermarkWidth,0);
    return $watermark;

}

function computeWatermarkCoordinates(Imagick $image,Imagick $watermark)
{
    $randomCornerIndex=mt_rand(0,3);
    $cornerPosition=IMAGE_CORNERS[$randomCornerIndex];

    switch ($cornerPosition){
        case 'TOP_LEFT':
            $xCoordinate=0;
            $yCoordinate=0;
            break;
        case 'TOP_RIGHT':
            $xCoordinate=$image->getImageWidth()-$watermark->getImageWidth();
            $yCoordinate=0;
            break;
        case 'BOTTOM_LEFT':
            $xCoordinate=0;
            $yCoordinate=$image->getImageHeight()-$watermark->getImageHeight();
            break;
        case 'BOTTOM_RIGHT':
            $xCoordinate=$image->getImageWidth()-$watermark->getImageWidth();
            $yCoordinate=$image->getImageHeight()-$watermark->getImageHeight();
            break;
        default:
            $xCoordinate=$image->getImageWidth()-$watermark->getImageWidth();
            $yCoordinate=$image->getImageHeight()-$watermark->getImageHeight();

    }
    return ['x'=>$xCoordinate,'y'=>$yCoordinate];
}

function addWatermarkToImage($payload){

    if(!canExecuteFunction(WATERMARK,$payload)){
        return $payload;
    }

    $watermark=new Imagick($payload[WATERMARK]);
    $resizedWatermark=resizeWatermark($payload[IMAGE],$watermark);
    $resizedWatermark->setImageOpacity(0.4);

    $coordinates=computeWatermarkCoordinates($payload[IMAGE],$resizedWatermark);

    /**
     * @var Imagick $image
     */
    $image=$payload[IMAGE];
    $image->compositeImage($resizedWatermark, imagick::COMPOSITE_OVER, $coordinates['x'],$coordinates['y']);
    $payload[IMAGE]=$image;
    return $payload;
}