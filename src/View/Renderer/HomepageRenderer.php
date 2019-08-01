<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class HomepageRenderer extends AbstractPageRenderer
{
    private const UPLOADS_FOLDER_ROOT = "../../../imageUploads/";
    private $products;
    private $page;
    private $resultsPerPage;

    public function __construct(Request $request, array $products, int $page, int $resultsPerPage)
    {
        parent::__construct($request);

        $this->page = $page;
        $this->products = $products;
        $this->resultsPerPage = $resultsPerPage;
    }

    protected function addNecessaryContent()
    {
        $numberOfProducts = count($this->products);
        $prev = $this->page - 1;
        $next = $this->page + 1;
        require_once "src/View/Template/homepage.php";
    }
}