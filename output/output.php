<?php
function showHelp()
{
    $fileName="help.txt";
    $handler=fopen($fileName,"r");

    if($handler===false){
        echo "Error in opening file";
    }

    while(!feof($handler)){
        echo fread($handler,fileSize($fileName));
    }

    fclose($handler);
    exit;
}
function showErrors(string $errors){
    echo $errors;
}
function showSucces(string $outputPath){
    echo "SUCCESS. The processed image can be found here: ".$outputPath.PHP_EOL;
}