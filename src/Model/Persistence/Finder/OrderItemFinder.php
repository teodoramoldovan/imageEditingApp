<?php


namespace ShareMyArt\Model\Persistence\Finder;


use ShareMyArt\Model\DatabaseToEntityMapper\DatabaseToOrderItemMapper;

class OrderItemFinder extends AbstractFinder
{
    /**
     * @param int $userId
     * @return array
     * @throws \Exception
     */
    public function findAllOrdersByUserId(int $userId): array
    {
        $sql = "select * from share_my_art.order_item where user_id=?";

        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(1, $userId, \PDO::PARAM_INT);
        $statement->execute();

        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $orderItemsArray = [];

        foreach ($rows as $orderItem) {
            $order = DatabaseToOrderItemMapper::getOrderItemFromTableRow($orderItem);
            array_push($orderItemsArray, $order);
        }

        return $orderItemsArray;

    }

}