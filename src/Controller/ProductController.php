<?php

namespace ShareMyArt\Controller;

use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\Persistence\Finder\ProductFinder;
use ShareMyArt\Model\Persistence\PersistenceFactory;
use ShareMyArt\View\Renderer\HomepageRenderer;
use ShareMyArt\View\Renderer\ProductPageRenderer;
use ShareMyArt\View\Renderer\UploadProductRenderer;

class ProductController extends AbstractController
{

    public function showProducts()
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        $products = $productFinder->findAllProducts();

        $homepageRenderer = new HomepageRenderer($this->request, $products);
        $homepageRenderer->render();
    }

    public function uploadProduct()
    {
        $errors = [];
        $uploadProductRenderer = new UploadProductRenderer($this->request, $errors);
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

    public function showProduct(int $id)
    {
        $productPageRenderer = new ProductPageRenderer($this->request,$id);
        $productPageRenderer->render();
    }

}