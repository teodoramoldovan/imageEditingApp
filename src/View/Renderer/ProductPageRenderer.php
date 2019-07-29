<?php


namespace ShareMyArt\View\Renderer;


class ProductPageRenderer extends AbstractPageRenderer
{
    protected function addNecessaryContent()
    {
        require_once "src/View/Template/productPage.php";
    }
}