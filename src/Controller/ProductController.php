<?php

namespace ShareMyArt\Controller;

use ShareMyArt\Helper\ImageNameConverter;
use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Model\DomainObject\Tier;
use ShareMyArt\Model\FormToEntityMapper\UploadFormToProductMapper;
use ShareMyArt\Model\Persistence\Finder\ProductFinder;
use ShareMyArt\Model\Persistence\Finder\TagFinder;
use ShareMyArt\Model\Persistence\Finder\TierFinder;
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


            $this->insertTiers($savedImagePath,$newProduct);
            //redirect to a succes page or show succes as flash message

        }

        $uploadProductRenderer = new UploadProductRenderer($this->request, $errors, $tags);
        $uploadProductRenderer->render();
    }

    private function insertTiers(string $savedImagePath, Product $newProduct)
    {
        $smallTierImageName = ImageNameConverter::addTierSizeToImagePath($savedImagePath, 'small');
        $smallTierImageNameWithWatermark = ImageNameConverter::addWatermarkToImagePath($smallTierImageName);
        $smallTier = new Tier($newProduct->getId(), 'small', $this->request->getPostData('price'), $smallTierImageNameWithWatermark,
            $smallTierImageName);

        /** @var TierMapper $tierMapper */
        $tierMapper = PersistenceFactory::createMapper(Tier::class);
        $tierMapper->save($smallTier);

        $mediumTierImageName = ImageNameConverter::addTierSizeToImagePath($savedImagePath, 'medium');
        $mediumTierImageNameWithWatermark = ImageNameConverter::addWatermarkToImagePath($mediumTierImageName);
        $mediumTier = new Tier($newProduct->getId(), 'medium', $this->request->getPostData('price')-0.5, $mediumTierImageNameWithWatermark,
            $mediumTierImageName);

        ;
        $tierMapper->save($mediumTier);


        $largeTierImageNameWithWatermark = ImageNameConverter::addWatermarkToImagePath($savedImagePath);
        $largeTier = new Tier($newProduct->getId(), 'large', $this->request->getPostData('price')-1, $largeTierImageNameWithWatermark,
            $savedImagePath);

        $tierMapper->save($largeTier);
    }

    public function buyProduct()
    {
        //TODO
    }

    public function showProduct(int $id)
    {
        /** @var TierFinder $tierFinder */
        $tierFinder = PersistenceFactory::createFinder(Tier::class);
        $tiers = $tierFinder->findAllTiersByProductId($id);

        $productPageRenderer = new ProductPageRenderer($this->request, $tiers);
        $productPageRenderer->render();
    }

}