<?php

namespace ShareMyArt\View\Renderer;


use ShareMyArt\Model\DomainObject\Tier;
use ShareMyArt\Request\Request;

class ProductPageRenderer extends AbstractPageRenderer
{
    private const UPLOADS_FOLDER_ROOT = "../../../imageUploads/";
    private $tiers;

    /**
     * ProductPageRenderer constructor.
     * @param Request $request
     * @param Tier[] $tiers
     */
    public function __construct(Request $request, array $tiers)
    {
        parent::__construct($request);
        $this->tiers = $tiers;

    }


    protected function addNecessaryContent()
    {
        require_once "src/View/Template/productPage.php";
    }
}