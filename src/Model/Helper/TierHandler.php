<?php


namespace ShareMyArt\Model\Helper;


use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\DomainObject\Tier;
use ShareMyArt\Request\Request;
use ShareMyArt\Model\Saver\ImageSaver;

class TierHandler
{
    /**
     * @var Request
     */
    private $request;

    /**
     * TierHandler constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Will prepare the tier for saving in the imageUploads directory
     *
     * @param string $savedImagePath
     * @param Product $newProduct
     * @param string $size
     * @return Tier
     */
    public function getTier(string $savedImagePath, Product $newProduct, string $size): Tier
    {
        $imageSaver = new ImageSaver($this->request);

        $tierImageName = ImageNameConverter::addTierSizeToImagePath($savedImagePath, $size);
        $tierImageNameWithWatermark = ImageNameConverter::addWatermarkToImagePath($tierImageName);

        $imageSaver->saveTierWithoutWatermark($savedImagePath, $tierImageName, $size);
        $imageSaver->saveTierWithWatermark($savedImagePath, $tierImageNameWithWatermark, $size);

        $price = $this->getTierPrice($size);

        $tier = new Tier($newProduct->getId(),
            $size,
            $price,
            $tierImageNameWithWatermark,
            $tierImageName);

        return $tier;
    }

    /**
     * Will generate a price based on the tier size and on the
     * price for the original image
     *
     * @param string $size
     * @return float
     */
    private function getTierPrice(string $size): float
    {
        $originalPrice = $this->request->getPostData('price');

        $discount = ('small' === $size)
            ? 0.5 * $originalPrice
            : 0.3 * $originalPrice;

        $tierPrice = $originalPrice - $discount;

        return $tierPrice;
    }

    /**
     * @param string $savedImagePath
     * @param Product $newProduct
     * @return Tier
     */
    public function getOriginalTier(string $savedImagePath, Product $newProduct): Tier
    {
        $imageSaver = new ImageSaver($this->request);

        $largeTierImageNameWithWatermark = ImageNameConverter::addWatermarkToImagePath($savedImagePath);
        $largeTier = new Tier($newProduct->getId(), 'large', $this->request->getPostData('price'),
            $largeTierImageNameWithWatermark,
            $savedImagePath);

        $imageSaver->saveTierWithoutWatermark($savedImagePath, $savedImagePath, 'large');
        $imageSaver->saveTierWithWatermark($savedImagePath, $largeTierImageNameWithWatermark, 'large');

        return $largeTier;
    }

}