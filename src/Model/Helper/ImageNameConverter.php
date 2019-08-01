<?php


namespace ShareMyArt\Model\Helper;


class ImageNameConverter
{
    private const EXTRACT_IMAGE_NAME_PATTERN = '/(?<imageName>.*)\./';
    private const EXTRACT_IMAGE_EXTENSION_PATTERN = '/\.(?<extension>.*)/';

    /**
     * Will add _small,_medium or _large to the original image name
     * based on the size of the photo to be saved
     *
     * @param string $imagePath
     * @param string $size
     * @return string
     */
    public static function addTierSizeToImagePath(string $imagePath, string $size): string
    {
        $imageName = self::getImageName($imagePath);
        $imageExtension = self::getImageExtension($imagePath);

        $newImageName = $imageName . '_' . $size . '.' . $imageExtension;

        return $newImageName;
    }

    /**
     * @param string $imagePath
     * @return string
     */
    private static function getImageName(string $imagePath): string
    {
        preg_match(self::EXTRACT_IMAGE_NAME_PATTERN, $imagePath, $matches);

        return $matches['imageName'];
    }

    /**
     * @param string $imagePath
     * @return string
     */
    private static function getImageExtension(string $imagePath): string
    {
        preg_match(self::EXTRACT_IMAGE_EXTENSION_PATTERN, $imagePath, $matches);

        return $matches['extension'];
    }

    /**
     * Will add _watermark to the image name if the image will contain
     * an image with watermark
     *
     * @param string $imagePath
     * @return string
     */
    public static function addWatermarkToImagePath(string $imagePath): string
    {
        $imageName = self::getImageName($imagePath);
        $imageExtension = self::getImageExtension($imagePath);

        $newImageName = $imageName . '_watermark' . '.' . $imageExtension;

        return $newImageName;
    }

    /**
     * Will add _thumbnail to the image name if the image will contain
     * an image to be displayed in the home page
     *
     * @param string $imagePath
     * @return string
     */
    public static function addThumbnailToImagePath(string $imagePath): string
    {
        $imageName = self::getImageName($imagePath);
        $imageExtension = self::getImageExtension($imagePath);

        $newImageName = $imageName . '_thumbnail' . '.' . $imageExtension;

        return $newImageName;
    }

}