<?php


namespace ShareMyArt\Model\Helper;


class ImageDownloader
{

    public static function downloadImage(string $path)
    {
        $fullFilePath = self::getUrl($path);

        if (file_exists($fullFilePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($fullFilePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($fullFilePath));
            flush();
            readfile($fullFilePath);
        }
    }

    private static function getUrl(string $path)
    {
        return '/var/www/imageUpload/imageUploads/' . $path;
    }

}