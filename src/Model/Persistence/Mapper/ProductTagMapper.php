<?php


namespace ShareMyArt\Model\Persistence\Mapper;


use PDO;
use ShareMyArt\Model\DomainObject\ProductTag;

class ProductTagMapper extends AbstractMapper
{
    public function save(ProductTag $productTag)
    {
        $this->insert($productTag);
    }

    private function insert(ProductTag $productTag)
    {
        $row = $this->translateToArray($productTag);

        $sql = "insert into share_my_art.product_tag (product_id,tag_id) values (?,?)";

        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(1, $row['product_id'], PDO::PARAM_INT);
        $statement->bindValue(2, $row['tag_id'], PDO::PARAM_INT);

        $statement->execute();
    }

    private function translateToArray(ProductTag $productTag): array
    {
        $row = [
            'product_id' => $productTag->getProductId(),
            'tag_id' => $productTag->getTagId(),

        ];

        return $row;
    }


}