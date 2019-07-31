<?php


namespace ShareMyArt\Model\Persistence\Finder;


use ShareMyArt\Model\DatabaseToEntityMapper\DatabaseToTagMapper;
use ShareMyArt\Model\DomainObject\Tag;
use PDO;

class TagFinder extends AbstractFinder
{
    /**
     * @param int $productId
     * @return array|Tag[]
     * @throws \Exception
     */
    public function findAllTagByProductId(int $productId): array
    {
        $sql = "select * from share_my_art.tag 
              where tag.id in 
              (select tag_id from product_tag inner join product
              where product_id=?)";

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $productId, PDO::PARAM_STR);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $tagsArray = [];

        foreach ($rows as $tagItem) {
            $tag = DatabaseToTagMapper::getTagFromTableRow($tagItem);
            array_push($tagsArray, $tag);
        }

        return $tagsArray;
    }

    public function findTagByName(string $name): ?Tag
    {
        $sql = "select * from share_my_art.tag where tag_name=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $name, PDO::PARAM_STR);

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($row)) {
            return null;
        }

        return new Tag($row['tag_name'], $row['id']);
    }

    /**
     * @return array|Tag[]
     * @throws \Exception
     */
    public function findAllTags(): array
    {
        $sql = "select * from share_my_art.tag";

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $tagsArray = [];

        foreach ($rows as $tagItem) {
            $tag = DatabaseToTagMapper::getTagFromTableRow($tagItem);
            array_push($tagsArray, $tag);
        }

        return $tagsArray;
    }

}