<?php


namespace ShareMyArt\Model\Helper;


class ImageNameConverter
{
    private const EXTRACT_IMAGE_NAME_PATTERN = '/(?<imageName>.*)\./';
    private const EXTRACT_IMAGE_EXTENSION_PATTERN = '/\.(?<extension>.*)/';

    /**
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

    public static function addThumbnailToImagePath(string $imagePath): string
    {
        $imageName = self::getImageName($imagePath);
        $imageExtension = self::getImageExtension($imagePath);

        $newImageName = $imageName . '_thumbnail' . '.' . $imageExtension;

        return $newImageName;
    }

}