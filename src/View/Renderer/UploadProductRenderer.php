<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class UploadProductRenderer extends AbstractPageRenderer
{
    private $errors;
    private $tags;

    public function __construct(Request $request, array $errors, array $tags)
    {
        parent::__construct($request);
        $this->errors = $errors;
        $this->tags = $tags;
    }

    protected function addNecessaryContent()
    {
        require_once "src/View/Template/uploadProductForm.php";
    }

}