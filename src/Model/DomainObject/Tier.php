<?php

namespace ShareMyArt\Model\DomainObject;
class Tier
{
    /** @var int $id */
    private $id;
    /** @var int $productId */
    private $productId;
    /** @var string size */
    private $size;
    /** @var float $price */
    private $price;
    /** @var string $imagePathWithWatermark */
    private $imagePathWithWatermark;
    /** @var string $imagePathWithoutWatermark */
    private $imagePathWithoutWatermark;

    /**
     * Tier constructor.
     * @param int $id
     * @param int $productId
     * @param string $size
     * @param float $price
     * @param string $imagePathWithWatermark
     * @param string $imagePathWithoutWatermark
     */
    public function __construct(int $productId, string $size, float $price,
                                string $imagePathWithWatermark, string $imagePathWithoutWatermark, int $id = null)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->size = $size;
        $this->price = $price;
        $this->imagePathWithWatermark = $imagePathWithWatermark;
        $this->imagePathWithoutWatermark = $imagePathWithoutWatermark;
    }

    //TODO getters and setters when needed

    public function getOrders()
    {

    }


}