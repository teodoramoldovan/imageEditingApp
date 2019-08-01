<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class HomepageRenderer extends AbstractPageRenderer
{
    private $products;

    private const UPLOADS_FOLDER_ROOT = "../../../imageUploads/";

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