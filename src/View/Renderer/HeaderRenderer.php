<?php


namespace ShareMyArt\View\Renderer;


class HeaderRenderer
{
    private $menuList;

    public function __construct($menuList)
    {
        $this->menuList = $menuList;
        require_once "src/View/Template/header.php";
    }

}