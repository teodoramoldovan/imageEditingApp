<?php

namespace ShareMyArt\Controller;

use ShareMyArt\View\Renderer\HomepageRenderer;

class ProductController
{
    public function showProducts()
    {
        $homepageRenderer = new HomepageRenderer();
        $homepageRenderer->render();
    }

}