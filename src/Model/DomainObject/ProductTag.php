<?php


namespace ShareMyArt\Model\DomainObject;


class ProductTag
{
    /**
     * @var int
     */
    private $productId;
    /**
     * @var int
     */
    private $tagId;

    /**
     * ProductTag constructor.
     * @param int $productId
     * @param int $tagId
     */
    public function __construct(int $productId, int $tagId)
    {
        $this->productId = $productId;
        $this->tagId = $tagId;
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
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tagId;
    }

    /**
     * @param int $tagId
     */
    public function setTagId(int $tagId): void
    {
        $this->tagId = $tagId;
    }


}