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

    /**
     * @return int
     */
    public function getId(): int
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
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getCameraSpecifications(): string
    {
        return $this->cameraSpecifications;
    }

    /**
     * @param string $cameraSpecifications
     */
    public function setCameraSpecifications(string $cameraSpecifications): void
    {
        $this->cameraSpecifications = $cameraSpecifications;
    }

    /**
     * @return \DateTime
     */
    public function getCaptureDate(): \DateTime
    {
        return $this->captureDate;
    }

    /**
     * @param \DateTime $captureDate
     */
    public function setCaptureDate(\DateTime $captureDate): void
    {
        $this->captureDate = $captureDate;
    }

    /**
     * @return string
     */
    public function getThumbnailPath(): string
    {
        return $this->thumbnailPath;
    }

    /**
     * @param string $thumbnailPath
     */
    public function setThumbnailPath(string $thumbnailPath): void
    {
        $this->thumbnailPath = $thumbnailPath;
    }



    //TODO
    public function getTiers()
    {

    }


}