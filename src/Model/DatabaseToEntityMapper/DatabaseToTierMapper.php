<?php


namespace ShareMyArt\Model\DatabaseToEntityMapper;


use ShareMyArt\Model\DomainObject\Tier;

class DatabaseToTierMapper
{
    /**
     * Will return a tag object with data from a database table row
     *
     * @param array $row representing a tag in the database
     * @return Tier
     */
    public static function getTierFromTableRow(array $row): Tier
    {
        $tier = new Tier($row['product_id'], $row['size'], $row['price'], $row['path_with_watermark'],
            $row['path_without_watermark'], $row['id']);

        return $tier;
    }

}