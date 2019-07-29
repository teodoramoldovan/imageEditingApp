<?php


namespace ShareMyArt\View\Renderer;


class UploadsPageRenderer extends AbstractPageRenderer
{
    protected function addNecessaryContent()
    {
        require_once "src/View/Template/uploadsPage.php";
    }

}