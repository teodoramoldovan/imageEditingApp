<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class HomepageRenderer extends AbstractPageRenderer
{
    private $products;

    public function __construct(Request $request, array $products)
    {
        parent::__construct($request);


        $this->products = $products;
    }

    protected function addNecessaryContent()
    {
        $numberOfProducts = count($this->products);
        require_once "src/View/Template/homepage.php";
    }
}