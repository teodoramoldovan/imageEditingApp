<?php

namespace ShareMyArt\Controller;

use ShareMyArt\Request\Request;
use ShareMyArt\View\Renderer\HomepageRenderer;

class ProductController extends AbstractController
{

    public function showProducts()
    {
        $homepageRenderer = new HomepageRenderer($this->request);
        $homepageRenderer->render();
    }

}