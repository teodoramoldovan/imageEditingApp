<?php


namespace ShareMyArt\Saver;


use ShareMyArt\Request\Request;

class ImageSaver
{

    private const SITE_ROOT = "/var/www/imageUpload/";
    private const UPLOADS_FOLDER_ROOT = self::SITE_ROOT . "imageUploads/";
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function saveImage(): string
    {
        $savedImagePath = uniqid() . '.png';
        if (count($this->request->getFiles())) {
            move_uploaded_file($this->request->getFiles('image', 'tmp_name'),
                self::UPLOADS_FOLDER_ROOT . $savedImagePath);
        }

        return $savedImagePath;
    }


}