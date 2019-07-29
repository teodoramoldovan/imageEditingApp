<?php


namespace ShareMyArt\View\Renderer;


class OrdersPageRenderer extends AbstractPageRenderer
{
    protected function addNecessaryContent()
    {
        require_once "src/View/Template/ordersPage.php";
    }
}