<?php


namespace ShareMyArt\Model\Persistence\Finder;


use ShareMyArt\Model\DatabaseToEntityMapper\DatabaseToTierMapper;

class TierFinder extends AbstractFinder
{
    public function findAllTiersByProductId(int $productId):array
    {
        $sql="select * from share_my_art.tier where product_id=?";

        $statement=$this->getPdo()->prepare($sql);

        $statement->bindValue(1,$productId,\PDO::PARAM_INT);
        $statement->execute();

        $rows=$statement->fetchAll(\PDO::FETCH_ASSOC);

        $tiersArray=[];

        foreach($rows as $tierItem){
            $tier=DatabaseToTierMapper::getTierFromTableRow($tierItem);
            array_push($tiersArray,$tier);
        }

        return $tiersArray;

    }

}