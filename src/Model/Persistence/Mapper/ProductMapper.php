<?php


namespace ShareMyArt\Model\Persistence\Mapper;


use PDO;
use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\DomainObject\ProductTag;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Model\Persistence\Finder\TagFinder;
use ShareMyArt\Model\Persistence\PersistenceFactory;

class ProductMapper extends AbstractMapper
{
    public function save(Product $product)
    {
        if (null === $product->getId()) {
            $this->insert($product);
            return;
        }
        $this->update($product);

        $product->setId($this->getPdo()->lastInsertId());

    }

    private function insert(Product $product)
    {
        $row = $this->translateToArray($product);

        $sql = "insert into share_my_art.product (title,description,camera_specifications,
                                                capture_date,thumbnail_path,user_id) values 
                                   (?,?,?,?,?,?)";
        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(1, $row['title'], PDO::PARAM_STR);
        $statement->bindValue(2, $row['description'], PDO::PARAM_STR);
        $statement->bindValue(3, $row['camera_specifications'], PDO::PARAM_STR);
        $statement->bindValue(4, $product->getCaptureDate()->format("Y-m-d"), PDO::PARAM_STR);
        $statement->bindValue(5, $row['thumbnail_path'], PDO::PARAM_STR);
        $statement->bindValue(6, $row['user_id'], PDO::PARAM_INT);

        $statement->execute();

        $newId = $this->getPdo()->lastInsertId();
        $product->setId($newId);

        $this->insertProductTags($product);


    }

    private function translateToArray(Product $product): array
    {
        $row = [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'description' => $product->getDescription(),
            'camera_specifications' => $product->getCameraSpecifications(),
            'capture_date' => $product->getCaptureDate(),
            'thumbnail_path' => $product->getThumbnailPath(),
            'user_id' => $product->getUserId()
        ];

        return $row;
    }

    /**
     * Will insert data into product_tag table when a product is inserted
     * only if the tags exist in the tag table
     *
     * @param Product $product
     */
    private function insertProductTags(Product $product)
    {
        foreach ($product->getTags() as $tagItem) {
            /** @var TagFinder $tagFinder */
            $tagFinder = PersistenceFactory::createFinder(Tag::class);
            $tag = $tagFinder->findTagByName($tagItem->getTagName());

            if (null === $tag) {
                return;
            }

            $productTag = new ProductTag($product->getId(), $tag->getId());

            /** @var ProductTagMapper $productTagMapper */
            $productTagMapper = PersistenceFactory::createMapper(ProductTag::class);
            $productTagMapper->save($productTag);

        }
    }

    private function update(Product $product)
    {

    }

}