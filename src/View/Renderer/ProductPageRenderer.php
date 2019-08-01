<?php

namespace ShareMyArt\View\Renderer;


use ShareMyArt\Model\DomainObject\Tier;
use ShareMyArt\Request\Request;

class ProductPageRenderer extends AbstractPageRenderer
{
    private const UPLOADS_FOLDER_ROOT = "../../../imageUploads/";
    private $tiers;
    private $orders;
    private $boughtTierIds;

    /**
     * ProductPageRenderer constructor.
     * @param Request $request
     * @param Tier[] $tiers
     * @param array $orders
     */
    public function __construct(Request $request, array $tiers, array $orders)
    {
        parent::__construct($request);
        $this->tiers = $tiers;
        $this->orders = $orders;
        $this->boughtTierIds = $this->getOrderIds();
    }

    private function getOrderIds(): array
    {
        $orderIds = [];

        foreach ($this->orders as $order) {
            $orderIds[] = $order->getTierId();
        }

        return $orderIds;
    }

    protected function addNecessaryContent()
    {
        require_once "src/View/Template/productPage.php";
    }
}