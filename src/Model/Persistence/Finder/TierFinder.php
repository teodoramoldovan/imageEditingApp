<?php


namespace ShareMyArt\Model\Persistence\Finder;


use ShareMyArt\Model\DatabaseToEntityMapper\DatabaseToTierMapper;

class TierFinder extends AbstractFinder
{
    public function findAllTiersByProductId(int $productId): array
    {
        $sql = "select * from share_my_art.tier where product_id=?";

        $tiersArray = $this->getTiers($sql, $productId);;

        return $tiersArray;

    }

    private function getTiers(string $sql, int $parameterValue): array
    {
        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(1, $parameterValue, \PDO::PARAM_INT);
        $statement->execute();

        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $tiersArray = [];

        foreach ($rows as $tierItem) {
            $tier = DatabaseToTierMapper::getTierFromTableRow($tierItem);
            array_push($tiersArray, $tier);
        }

        return $tiersArray;
    }

    public function findTierOrderItemsByUserId(int $userId): array
    {
        $sql = "select * from share_my_art.tier where id in (select tier_id from order_item where user_id=?)";

        $tiersArray = $this->getTiers($sql, $userId);

        return $tiersArray;
    }

}