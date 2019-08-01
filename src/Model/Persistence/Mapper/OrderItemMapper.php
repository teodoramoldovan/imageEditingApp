<?php


namespace ShareMyArt\Model\Persistence\Mapper;


use PDO;
use ShareMyArt\Model\DomainObject\OrderItem;

class OrderItemMapper extends AbstractMapper
{
    /**
     * @param OrderItem $orderItem
     */
    public function save(OrderItem $orderItem)
    {
        $this->insert($orderItem);
    }

    /**
     * @param OrderItem $orderItem
     */
    private function insert(OrderItem $orderItem)
    {
        $sql = "insert into share_my_art.order_item (user_id,tier_id,created_at) values (?,?,?)";

        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(1, $orderItem->getUserId(), PDO::PARAM_INT);
        $statement->bindValue(2, $orderItem->getTierId(), PDO::PARAM_INT);
        $statement->bindValue(3, $orderItem->getCreatedAt()->format("Y-m-d"), PDO::PARAM_STR);

        $statement->execute();

    }

}