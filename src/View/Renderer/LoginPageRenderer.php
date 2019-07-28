<?php


namespace ShareMyArt\View\Renderer;


class LoginPageRenderer extends AbstractPageRenderer
{
    private $errors;

    public function __construct($errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    protected function addNecessaryContent()
    {
        require_once "src/View/Template/loginForm.php";
    }

}