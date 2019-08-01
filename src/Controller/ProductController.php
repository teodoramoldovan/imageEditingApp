<?php

namespace ShareMyArt\Controller;

use ShareMyArt\Helper\ImageDownloader;
use ShareMyArt\Helper\ImageNameConverter;
use ShareMyArt\Helper\TierHandler;
use ShareMyArt\Model\DomainObject\OrderItem;
use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Model\DomainObject\Tier;
use ShareMyArt\Model\FormToEntityMapper\BuyFormToOrderItemMapper;
use ShareMyArt\Model\FormToEntityMapper\UploadFormToProductMapper;
use ShareMyArt\Model\Persistence\Finder\OrderItemFinder;
use ShareMyArt\Model\Persistence\Finder\ProductFinder;
use ShareMyArt\Model\Persistence\Finder\TagFinder;
use ShareMyArt\Model\Persistence\Finder\TierFinder;
use ShareMyArt\Model\Persistence\Mapper\OrderItemMapper;
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


            $thumbnailPath = ImageNameConverter::addThumbnailToImagePath($savedImagePath);
            $imageSaver->saveThumbnail($savedImagePath, $thumbnailPath);

            $uploadFormToProductMapper = new UploadFormToProductMapper($this->request);
            $newProduct = $uploadFormToProductMapper->getProduct($thumbnailPath);

            /** @var ProductMapper $productMapper */
            $productMapper = PersistenceFactory::createMapper(Product::class);
            $productMapper->save($newProduct);


            $this->insertTiers($savedImagePath, $newProduct);

            //redirect to a succes page or show succes as flash message

        }

        $uploadProductRenderer = new UploadProductRenderer($this->request, $errors, $tags);
        $uploadProductRenderer->render();
    }

    private function insertTiers(string $savedImagePath, Product $newProduct)
    {
        $tierHandler = new TierHandler($this->request);

        $smallTier = $tierHandler->getTier($savedImagePath, $newProduct, 'small');
        $mediumTier = $tierHandler->getTier($savedImagePath, $newProduct, 'medium');
        $largeTier = $tierHandler->getOriginalTier($savedImagePath, $newProduct);

        /** @var TierMapper $tierMapper */
        $tierMapper = PersistenceFactory::createMapper(Tier::class);

        $tierMapper->save($smallTier);
        $tierMapper->save($mediumTier);
        $tierMapper->save($largeTier);
    }


    public function buyProduct()
    {

        $path = $this->request->getPostData('size');


        $buyFormMapper = new BuyFormToOrderItemMapper($this->request);
        $orderItem = $buyFormMapper->getOrderItem();

        /** @var OrderItemMapper $orderItemMapper */
        $orderItemMapper = PersistenceFactory::createMapper(OrderItem::class);
        $orderItemMapper->save($orderItem);

        ImageDownloader::downloadImage($path);

        header('Location:/user/myOrders');

    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function showProduct(int $id)
    {
        /** @var TierFinder $tierFinder */
        $tierFinder = PersistenceFactory::createFinder(Tier::class);
        $tiers = $tierFinder->findAllTiersByProductId($id);

        /** @var OrderItemFinder $orderItemsFinder */
        $orderItemsFinder=PersistenceFactory::createFinder(OrderItem::class);

        $orders=[];
        if(!empty($this->request->getSessionData(null))){
            $orders=$orderItemsFinder->findAllOrdersByUserId($this->request->getSessionData('userId'));
        }


        $productPageRenderer = new ProductPageRenderer($this->request, $tiers,$orders);
        $productPageRenderer->render();
    }


}