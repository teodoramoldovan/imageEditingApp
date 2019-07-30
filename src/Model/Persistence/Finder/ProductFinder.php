<?php


namespace ShareMyArt\Model\Persistence\Finder;


use ShareMyArt\Model\DatabaseToEntityMapper\DatabaseToProductMapper;
use ShareMyArt\Model\DomainObject\Product;
use PDO;

class ProductFinder extends AbstractFinder
{
    /**
     * @return array|Product[]
     */
    public function findAllProducts(): array
    {
        $sql = "select * from share_my_art.product";

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $productsArray=[];

        foreach ($rows as $productItem) {
            $product = DatabaseToProductMapper::getProductFromTableRow($productItem);
            array_push($productsArray,$product);
        }

        return $productsArray;
    }

}