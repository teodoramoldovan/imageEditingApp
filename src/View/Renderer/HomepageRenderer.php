<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class HomepageRenderer extends AbstractPageRenderer
{
    private const UPLOADS_FOLDER_ROOT = "../../../imageUploads/";
    private $products;
    private $page;
    private $resultsPerPage;
    private $sortData;
    private $queryData;
    private $directionData;

    public function __construct(Request $request, array $products, int $page, int $resultsPerPage,
                                $sortData, $directionData, $queryData)
    {
        parent::__construct($request);

        $this->page = $page;
        $this->products = $products;
        $this->resultsPerPage = $resultsPerPage;
        $this->queryData = $queryData;
        $this->directionData = $directionData;
        $this->sortData = $sortData;
    }

    protected function addNecessaryContent()
    {
        $numberOfProducts = count($this->products);
        $prev = $this->page - 1;
        $next = $this->page + 1;
        require_once "src/View/Template/homepage.php";
    }


}