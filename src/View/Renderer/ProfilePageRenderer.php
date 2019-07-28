<?php


namespace ShareMyArt\View\Renderer;


class ProfilePageRenderer extends AbstractPageRenderer
{
    protected function addNecessaryContent()
    {
        require_once "src/View/Template/myProfile.php";
    }
}