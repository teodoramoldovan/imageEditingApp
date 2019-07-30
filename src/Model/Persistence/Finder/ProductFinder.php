<?php


namespace ShareMyArt\Model\Persistence\Finder;


use ShareMyArt\Model\DatabaseToEntityMapper\DatabaseToProductMapper;
use ShareMyArt\Model\DomainObject\Product;
use PDO;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Model\Persistence\PersistenceFactory;

class ProductFinder extends AbstractFinder
{
    /**
     * @return array|Product[]
     * @throws \Exception
     */
    public function findAllProducts(): array
    {
        $sql = "select * from share_my_art.product";

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = [];

        $rowsWithTags=$this->insertTagsInRow($rows);

        foreach ($rowsWithTags as $productItem) {

            $product = DatabaseToProductMapper::getProductFromTableRow($productItem);
            array_push($productsArray, $product);
        }

        return $productsArray;
    }

    private function insertTagsInRow(array $rows): array
    {
        $newRows = [];

        foreach ($rows as $row) {
            $productId = $row['id'];

            /** @var TagFinder $tagFinder */
            $tagFinder = PersistenceFactory::createFinder(Tag::class);
            $tags = $tagFinder->findAllTagByProductId($productId);
            $row['tags'] = $tags;

            array_push($newRows, $row);
        }

        return $newRows;
    }

}