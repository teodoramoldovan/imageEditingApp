<?php

namespace ShareMyArt\Controller;

use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Model\DomainObject\Tier;
use ShareMyArt\Model\FormToEntityMapper\UploadFormToProductMapper;
use ShareMyArt\Model\Persistence\Finder\ProductFinder;
use ShareMyArt\Model\Persistence\Finder\TagFinder;
use ShareMyArt\Model\Persistence\Mapper\ProductMapper;
use ShareMyArt\Model\Persistence\Mapper\TierMapper;
use ShareMyArt\Model\Persistence\PersistenceFactory;
use ShareMyArt\Model\Validation\FormValidator\UploadProductFormValidator;
use ShareMyArt\Saver\ImageSaver;
use ShareMyArt\View\Renderer\HomepageRenderer;
use ShareMyArt\View\Renderer\ProductPageRenderer;
use ShareMyArt\View\Renderer\UploadProductRenderer;

class ProductController extends AbstractController
{

    /**
     * @throws \Exception
     */
    public function showProducts(): void
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        $products = $productFinder->findAllProducts();

        $homepageRenderer = new HomepageRenderer($this->request, $products);
        $homepageRenderer->render();
    }

    /**
     * @throws \Exception
     */
    public function uploadProduct(): void
    {
        $errors = [];

        /** @var TagFinder $tagFinder */
        $tagFinder = PersistenceFactory::createFinder(Tag::class);
        $tags = $tagFinder->findAllTags();

        $uploadProductRenderer = new UploadProductRenderer($this->request, $errors, $tags);
        $uploadProductRenderer->render();
    }

    /**
     * @throws \Exception
     */
    public function uploadProductPost()
    {
        //validate that the form input is correct
        $uploadProductFormValidator = new UploadProductFormValidator($this->request);
        $errors = $uploadProductFormValidator->validateInput($this->request->getPostData(null));

        /** @var TagFinder $tagFinder */
        $tagFinder = PersistenceFactory::createFinder(Tag::class);
        $tags = $tagFinder->findAllTags();

        if (empty($errors)) {
            $imageSaver = new ImageSaver($this->request);
            $savedImagePath = $imageSaver->saveImage();

            $uploadFormToProductMapper = new UploadFormToProductMapper($this->request);
            $newProduct = $uploadFormToProductMapper->getProduct($savedImagePath);

            /** @var ProductMapper $productMapper */
            $productMapper = PersistenceFactory::createMapper(Product::class);
            $productMapper->save($newProduct);

            $smallTier = new Tier($newProduct->getId(), 'small', 1.2, $savedImagePath, $savedImagePath);

            /** @var TierMapper $tierMappper */
            $tierMapper = PersistenceFactory::createMapper(Tier::class);
            $tierMapper->save($smallTier);

        }

        $uploadProductRenderer = new UploadProductRenderer($this->request, $errors, $tags);
        $uploadProductRenderer->render();
    }

    public function buyProduct()
    {
        //TODO
    }

    public function showProduct(int $id)
    {
        $productPageRenderer = new ProductPageRenderer($this->request, $id);
        $productPageRenderer->render();
    }

}