<?php


namespace ShareMyArt\Model\Persistence\Finder;


use ShareMyArt\Model\DatabaseToEntityMapper\DatabaseToProductMapper;
use ShareMyArt\Model\DomainObject\Product;
use PDO;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Model\Persistence\PersistenceFactory;


class ProductFinder extends AbstractFinder
{
    const SEARCHABLE_FIELDS = ['title', 'description'];

    /**
     * @param int $page
     * @param int $resultsPerPage
     * @param string $query
     * @param array $filters
     * @param array $sorts
     * @return array
     * @throws \Exception
     */
    public function findAllProducts(int $page, int $resultsPerPage, $query = '', $filters = [], $sorts = []): array
    {
        $sql = "SELECT * FROM share_my_art.product";

        if ($query) {
            $sql .= ' WHERE';
            foreach (self::SEARCHABLE_FIELDS as $field) {
                $sql .= " {$field} LIKE '%{$query}%' OR";
            }

            $sql = rtrim($sql, ' OR');
        }


        if (!empty($sorts['sort'] || !empty($sorts['direction']))) {
            $sql .= " ORDER BY {$sorts['sort']} {$sorts['direction']}";

        }

        $limit = $resultsPerPage;
        $offset = $resultsPerPage * $page;
        $sql .= ' LIMIT ?,?';


        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->bindValue(2, $limit, PDO::PARAM_INT);

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

    /**
     * @param array $rows
     * @return array
     * @throws \Exception
     */
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
     * @param int $productId
     * @return Product
     * @throws \Exception
     */
    public function findProductById(int $productId): Product
    {
        $sql = "select * from share_my_art.product where id=?";

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $productId, PDO::PARAM_INT);

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $rowsWithTags = $this->insertTagsInRow([$row]);

        $product = DatabaseToProductMapper::getProductFromTableRow($rowsWithTags[0]);

        return $product;

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

    /**
     * @param int|null $resultsPerPage
     * @return int
     */
    private function getLimit(int $resultsPerPage = null): int
    {
        $limit = (null === $resultsPerPage)
            ? 5
            : $resultsPerPage;
        return $limit;

    }

    /**
     * @param int $limit
     * @return int
     */
    private function getOffset(int $limit): int
    {
        $pages = ceil($this->findProductsNumber() / $limit);

        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default' => 1,
                'min_range' => 1,
            ),
        )));

        $offset = ($page - 1) * $limit;

        return $offset;
    }

    /**
     * @return int
     */
    private function findProductsNumber(): int
    {
        $sql = "select count(*) from share_my_art.product";

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();

        $numberOfProducts = $statement->fetchColumn();

        return $numberOfProducts;
    }

}