<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\Request\Request;

class LoginPageRenderer extends AbstractPageRenderer
{
    private $errors;

    public function __construct(Request $request, $errors)
    {
        parent::__construct($request);
        $this->errors = $errors;
    }

    protected function addNecessaryContent()
    {
        require_once "src/View/Template/loginForm.php";
    }

}