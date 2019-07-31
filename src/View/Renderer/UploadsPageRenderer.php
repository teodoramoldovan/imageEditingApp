<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Request\Request;

class UploadsPageRenderer extends AbstractPageRenderer
{
    /**
     * @var Product[]
     */
    private $uploads;

    private const SITE_ROOT = "imageUpload/";
    private const UPLOADS_FOLDER_ROOT =  "../../../imageUploads/";

    public function __construct(Request $request, array $uploads)
    {
        parent::__construct($request);
        $this->uploads=$uploads;
    }

    protected function addNecessaryContent()
    {
        require_once "src/View/Template/uploadsPage.php";
    }

}