<?php


namespace ShareMyArt\Model\Helper;


class ImageDownloader
{

    /**
     * Will handle image download to be used in buy method from
     * the ProductController
     *
     * @param string $path
     */
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

    /**
     * Will return the full path for the location were the file
     * to be downloaded is
     *
     * @param string $path
     * @return string
     */
    private static function getUrl(string $path)
    {
        return '/var/www/imageUpload/imageUploads/' . $path;
    }

}