<?php


namespace ShareMyArt\Model\DatabaseToEntityMapper;


use ShareMyArt\Model\DomainObject\Product;

class DatabaseToProductMapper
{
    /**
     * Will return a product object with data from a database table row
     *
     * @param array $row representing a product in the database
     * @return Product
     * @throws \Exception
     */
    public static function getProductFromTableRow(array $row): Product
    {
        $timestamp=strtotime($row['capture_date']);
        $captureDate=new \DateTime(date("Y-m-d", $timestamp));

        return new Product(

            $row['user_id'],
            $row['title'],
            $row['description'],
            $row['tags'],
            $row['camera_specifications'],
            $captureDate,
            $row['thumbnail_path'],
            $row['id']

        );
    }

}