<?php

namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class ProductPageRenderer extends AbstractPageRenderer
{
    private $productId;

    public function __construct(Request $request, int $productId)
    {
        parent::__construct($request);
        $this->productId = $productId;
    }


    protected function addNecessaryContent()
    {
        require_once "src/View/Template/productPage.php";
    }
}