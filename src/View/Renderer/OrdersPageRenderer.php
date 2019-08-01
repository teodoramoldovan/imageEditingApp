<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class OrdersPageRenderer extends AbstractPageRenderer
{
    private const UPLOADS_FOLDER_ROOT = "../../../imageUploads/";
    private $tiers;

    public function __construct(Request $request,array $tiers)
    {
        parent::__construct($request);
        $this->tiers=$tiers;
    }

    protected function addNecessaryContent()
    {
        require_once "src/View/Template/ordersPage.php";
    }
}