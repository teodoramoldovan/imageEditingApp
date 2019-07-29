<?php

namespace ShareMyArt\Controller;

use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\View\Renderer\HomepageRenderer;
use ShareMyArt\View\Renderer\ProductPageRenderer;
use ShareMyArt\View\Renderer\UploadProductRenderer;

class ProductController extends AbstractController
{

    public function showProducts()
    {
        $products=[
            (new Product())->setTitle('Product1'),
            (new Product())->setTitle('Product2'),
            (new Product())->setTitle('Product3'),

        ];
        $homepageRenderer = new HomepageRenderer($this->request,$products);
        $homepageRenderer->render();
    }

    public function uploadProduct()
    {
        $errors=[];
        $uploadProductRenderer=new UploadProductRenderer($this->request,$errors);
        $uploadProductRenderer->render();
    }

    public function uploadProductPost()
    {
        //TODO things to upload

        //this if errors
       // $uploadProductRenderer=new UploadProductRenderer($this->request,$errors);
        //$uploadProductRenderer->render();
    }

    public function buyProduct()
    {
        //TODO
    }

    public function showProduct()
    {
        $productPageRenderer=new ProductPageRenderer($this->request);
        $productPageRenderer->render();
    }

}