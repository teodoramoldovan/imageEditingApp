<?php

namespace ShareMyArt\Model\DomainObject;
class Product
{
    /** @var int $id */
    private $id;
    /** @var int $userId */
    private $userId;
    /** @var string $title */
    private $title;
    /** @var string $description */
    private $description;
    /** @var array $tags */
    private $tags;
    /** @var string $cameraSpecifications */
    private $cameraSpecifications;
    /** @var \DateTime $captureDate */
    private $captureDate;
    /** @var string $thumbnailPath */
    private $thumbnailPath;
    //others?

    /**
     * Product constructor.
     * @param int $id
     * @param int $userId
     * @param string $title
     * @param string $description
     * @param array $tags
     * @param string $cameraSpecifications
     * @param \DateTime $captureDate
     * @param string $thumbnailPath
     */
    public function __construct(int $userId, string $title, string $description, array $tags,
                                string $cameraSpecifications, \DateTime $captureDate,
                                string $thumbnailPath, int $id = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
        $this->cameraSpecifications = $cameraSpecifications;
        $this->captureDate = $captureDate;
        $this->thumbnailPath = $thumbnailPath;
    }

    //TODO getters and setters if needed

    //TODO
    public function getTiers()
    {

    }


}