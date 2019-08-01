<?php


namespace ShareMyArt\Model\Persistence\Mapper;


use PDO;
use ShareMyArt\Model\DomainObject\Tier;

class TierMapper extends AbstractMapper
{
    /**
     * @param Tier $tier
     */
    public function save(Tier $tier)
    {
        if (null === $tier->getId()) {
            $this->insert($tier);
            return;
        }
        $this->update($tier);
    }

    /**
     * @param Tier $tier
     */
    private function insert(Tier $tier)
    {
        $sql = "insert into share_my_art.tier 
            (price,path_with_watermark,path_without_watermark,size,product_id)
            values (?,?,?,?,?)";

        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(1, $tier->getPrice(), PDO::PARAM_STR);
        $statement->bindValue(2, $tier->getImagePathWithWatermark(), PDO::PARAM_STR);
        $statement->bindValue(3, $tier->getImagePathWithoutWatermark(), PDO::PARAM_STR);
        $statement->bindValue(4, $tier->getSize(), PDO::PARAM_STR);
        $statement->bindValue(5, $tier->getProductId(), PDO::PARAM_INT);

        $statement->execute();
    }

    /**
     * @param Tier $tier
     */
    private function update(Tier $tier)
    {

    }

}