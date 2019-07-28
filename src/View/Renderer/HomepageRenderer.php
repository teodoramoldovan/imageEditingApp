<?php


namespace ShareMyArt\View\Renderer;


class HomepageRenderer extends AbstractPageRenderer
{
    protected function addNecessaryContent()
    {
        require_once "src/View/Template/homepage.php";
    }
}