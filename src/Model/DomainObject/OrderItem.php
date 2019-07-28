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

    //TODO getters and setters when needed


}