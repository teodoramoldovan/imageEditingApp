<?php


namespace ShareMyArt\Model\FormToEntityMapper;


use ShareMyArt\Model\DomainObject\OrderItem;
use ShareMyArt\Request\Request;

class BuyFormToOrderItemMapper
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getOrderItem(): OrderItem
    {
        $tierId = $this->getTierIdBySize();

        return new OrderItem($this->request->getSessionData('userId'), $tierId, new \DateTime());
    }

    public function getTierIdBySize(): int
    {
        if (strpos($this->request->getPostData('size'), 'small')) {
            return (int)$this->request->getPostData('smallTierId');
        }

        if (strpos($this->request->getPostData('size'), 'medium')) {
            return (int)$this->request->getPostData('mediumTierId');
        }

        return (int)$this->request->getPostData('largeTierId');
    }
}