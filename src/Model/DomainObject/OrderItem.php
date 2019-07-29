<?php

namespace ShareMyArt\Model\DomainObject;
class OrderItem
{
    /** @var int $userId */
    private $userId;
    /** @var int $tierId */
    private $tierId;
    /** @var \DateTime $createdAt */
    private $createdAt;

    /**
     * OrderItem constructor.
     * @param int $userId
     * @param int $tierId
     * @param \DateTime $createdAt
     */
    public function __construct(int $userId, int $tierId, \DateTime $createdAt)
    {
        $this->userId = $userId;
        $this->tierId = $tierId;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getTierId(): int
    {
        return $this->tierId;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param int $tierId
     */
    public function setTierId(int $tierId): void
    {
        $this->tierId = $tierId;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }




}