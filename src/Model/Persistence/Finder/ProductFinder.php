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
    public function findAllProducts(int $resultsPerPage = null): array
    {
        $limit=$this->getLimit($resultsPerPage);
        $offset=$this->getOffset($limit);


        $sql = "select * from share_my_art.product";

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = [];

        $rowsWithTags = $this->insertTagsInRow($rows);

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

    /**
     * @param int $id
     * @return array|Product[]
     * @throws \Exception
     */
    public function findProductsByUserId(int $id): array
    {
        $sql = "select * from share_my_art.product where user_id=?";

        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(1, $id, PDO::PARAM_INT);

        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = [];

        $rowsWithTags = $this->insertTagsInRow($rows);

        foreach ($rowsWithTags as $productItem) {

            $product = DatabaseToProductMapper::getProductFromTableRow($productItem);
            array_push($productsArray, $product);
        }

        return $productsArray;
    }

    private function findProductsNumber(): int
    {
        $sql = "select count(*) from share_my_art.product";

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();

        $numberOfProducts = $statement->fetchColumn();

        return $numberOfProducts;
    }

    private function getLimit(int $resultsPerPage = null): int
    {
        $limit = (null === $resultsPerPage)
            ? 5
            : $resultsPerPage;
        return $limit;

    }

    private function getOffset(int $limit):int
    {
        $pages=ceil($this->findProductsNumber()/$limit);

        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));

        $offset = ($page - 1)  * $limit;

        return $offset;
    }

}