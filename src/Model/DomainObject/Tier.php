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

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getImagePathWithWatermark(): string
    {
        return $this->imagePathWithWatermark;
    }

    /**
     * @param string $imagePathWithWatermark
     */
    public function setImagePathWithWatermark(string $imagePathWithWatermark): void
    {
        $this->imagePathWithWatermark = $imagePathWithWatermark;
    }

    /**
     * @return string
     */
    public function getImagePathWithoutWatermark(): string
    {
        return $this->imagePathWithoutWatermark;
    }

    /**
     * @param string $imagePathWithoutWatermark
     */
    public function setImagePathWithoutWatermark(string $imagePathWithoutWatermark): void
    {
        $this->imagePathWithoutWatermark = $imagePathWithoutWatermark;
    }



}