<?php


namespace ShareMyArt\Model\DatabaseToEntityMapper;


use ShareMyArt\Model\DomainObject\OrderItem;

class DatabaseToOrderItemMapper
{
    /**
     * Will return an orderItem object with data from a database table row
     *
     * @param array $row representing a tag in the database
     * @return OrderItem
     * @throws \Exception
     */
    public static function getOrderItemFromTableRow(array $row): OrderItem
    {
        return new OrderItem($row['user_id'], $row['tier_id'], new \DateTime($row['created_at']));
    }

}